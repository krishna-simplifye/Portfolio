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


// Chat routes for guest
Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
Route::post('/chat/message', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/chat/unread-count', [ChatController::class, 'unreadCount'])->name('chat.unread_count');

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