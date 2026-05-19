<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // === CHAT PROCESS METHODS ===

    public function showCountrySelection()
    {
        return view('chat.country');
    }

    public function storeCountry(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:100',
            'mobile' => 'required|string|max:20'
        ]);

        session(['chat_country' => $request->country, 'chat_mobile' => $request->mobile]);
        
        return redirect()->route('chat.reason');
    }

    public function showReasonPage()
    {
        if (!session('chat_country') || !session('chat_mobile')) {
            return redirect()->route('chat.country');
        }

        return view('chat.reason');
    }

    public function storeReason(Request $request)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        session(['chat_reason' => $request->reason]);
        
        return redirect()->route('chat.start');
    }

    public function startChat(Request $request)
    {
        if (!session('chat_country') || !session('chat_mobile') || !session('chat_reason')) {
            return redirect()->route('chat.country');
        }

        // Store the chat information in session for later use
        session(['chat_verified' => true]);

        return view('chat.start');
    }

    // === GUEST / CLIENT ENDPOINTS ===

    public function fetchMessages(Request $request)
    {
        $deviceId = $request->header('X-Device-Id');
        if (!$deviceId) {
            return response()->json(['messages' => []]);
        }

        $conversation = ChatConversation::firstOrCreate(['session_id' => $deviceId]);
        return response()->json(['messages' => $conversation->messages()->orderBy('created_at', 'asc')->get()]);
    }

    public function sendMessage(Request $request)
    {
        $deviceId = $request->header('X-Device-Id');
        if (!$deviceId) {
            return response()->json(['error' => 'No device ID'], 400);
        }

        $request->validate(['message' => 'required|string']);

        $conversation = ChatConversation::firstOrCreate(
            ['session_id' => $deviceId],
            [
                'client_country' => session('chat_country'),
                'client_mobile' => session('chat_mobile'),
                'client_reason' => session('chat_reason'),
            ]
        );
        
        $message = $conversation->messages()->create([
            'is_admin' => false,
            'message' => $request->message
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json(['message' => $message]);
    }

    // === ADMIN ENDPOINTS ===

    public function adminChatView()
    {
        return view('admin-chat');
    }

    public function adminConversations()
    {
        $conversations = ChatConversation::with(['messages' => function($query) {
                $query->latest()->limit(1);
            }])
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(function($conv) {
                return [
                    'id' => $conv->id,
                    'session_id' => $conv->session_id,
                    'client_mobile' => $conv->client_mobile ?: 'guest_' . substr($conv->session_id, -8),
                    'client_country' => $conv->client_country,
                    'client_reason' => $conv->client_reason,
                    'last_message_at' => $conv->last_message_at,
                    'latest_message' => $conv->messages->first() ? $conv->messages->first()->message : '',
                ];
            });

        return response()->json(['conversations' => $conversations]);
    }

    public function adminFetchMessages(ChatConversation $conversation)
    {
        return response()->json(['messages' => $conversation->messages()->orderBy('created_at', 'asc')->get()]);
    }

    public function adminSendMessage(Request $request, ChatConversation $conversation)
    {
        $request->validate(['message' => 'required|string']);

        $message = $conversation->messages()->create([
            'is_admin' => true,
            'message' => $request->message
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json(['message' => $message]);
    }
}
