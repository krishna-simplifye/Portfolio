<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Chat process routes
Route::get('/chat/country', [ChatController::class, 'showCountrySelection'])->name('chat.country');
Route::post('/chat/country', [ChatController::class, 'storeCountry'])->name('chat.country.store');
Route::get('/chat/reason', [ChatController::class, 'showReasonPage'])->name('chat.reason');
Route::post('/chat/reason', [ChatController::class, 'storeReason'])->name('chat.reason.store');
Route::get('/chat/start', [ChatController::class, 'startChat'])->name('chat.start');

// Chat routes for guest
Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
Route::post('/chat/message', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        $contacts = \App\Models\Contact::latest()->get();
        return view('admin', compact('contacts'));
    });

    // Chat routes for admin
    Route::get('/admin/chat', [ChatController::class, 'adminChatView'])->name('admin.chat');
    Route::get('/admin/chat/conversations', [ChatController::class, 'adminConversations']);
    Route::get('/admin/chat/{conversation}/messages', [ChatController::class, 'adminFetchMessages']);
    Route::post('/admin/chat/{conversation}/message', [ChatController::class, 'adminSendMessage']);
});