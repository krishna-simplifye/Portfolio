<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // === GUEST / CLIENT ENDPOINTS ===

    public function fetchMessages(Request $request)
    {
        $deviceId = $request->header('X-Device-Id');
        if (!$deviceId) {
            return response()->json(['messages' => []]);
        }

        $conversation = ChatConversation::firstOrCreate(['session_id' => $deviceId]);
        
        // Mark all admin messages as read when fetched by guest
        $conversation->messages()
            ->where('is_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['messages' => $conversation->messages()->orderBy('created_at', 'asc')->get()]);
    }

    public function unreadCount(Request $request)
    {
        $deviceId = $request->header('X-Device-Id');
        if (!$deviceId) {
            return response()->json(['unread_count' => 0]);
        }

        $conversation = ChatConversation::where('session_id', $deviceId)->first();
        if (!$conversation) {
            return response()->json(['unread_count' => 0]);
        }

        $unreadCount = $conversation->messages()
            ->where('is_admin', true)
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
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
            'message' => $request->message,
            'is_read' => false
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
                $unreadCount = $conv->messages()
                    ->where('is_admin', false)
                    ->where('is_read', false)
                    ->count();

                return [
                    'id' => $conv->id,
                    'session_id' => $conv->session_id,
                    'client_mobile' => $conv->client_mobile ?: 'guest_' . substr($conv->session_id, -8),
                    'client_country' => $conv->client_country,
                    'client_reason' => $conv->client_reason,
                    'last_message_at' => $conv->last_message_at,
                    'latest_message' => $conv->messages->first() ? $conv->messages->first()->message : '',
                    'unread_count' => $unreadCount,
                ];
            });

        return response()->json(['conversations' => $conversations]);
    }

    public function adminFetchMessages(ChatConversation $conversation)
    {
        // Mark all client messages in this conversation as read when fetched by admin
        $conversation->messages()
            ->where('is_admin', false)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['messages' => $conversation->messages()->orderBy('created_at', 'asc')->get()]);
    }

    public function adminSendMessage(Request $request, ChatConversation $conversation)
    {
        $request->validate(['message' => 'required|string']);

        $message = $conversation->messages()->create([
            'is_admin' => true,
            'message' => $request->message,
            'is_read' => false
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json(['message' => $message]);
    }
}
