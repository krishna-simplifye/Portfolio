<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\ChatConversation;

echo "Checking Chat Conversations:\n";
echo "========================\n";

$conversations = ChatConversation::all();

foreach ($conversations as $conv) {
    echo "ID: " . $conv->id . "\n";
    echo "Session ID: " . $conv->session_id . "\n";
    echo "Client Mobile: " . ($conv->client_mobile ?? 'NULL') . "\n";
    echo "Client Country: " . ($conv->client_country ?? 'NULL') . "\n";
    echo "Client Reason: " . ($conv->client_reason ?? 'NULL') . "\n";
    echo "Last Message At: " . ($conv->last_message_at ?? 'NULL') . "\n";
    echo "------------------------\n";
}

echo "Total conversations: " . $conversations->count() . "\n";
