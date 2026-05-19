<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\ChatConversation;
use Illuminate\Support\Facades\DB;

echo "Updating conversation with test data...\n";

// Update the existing conversation
$updated = DB::table('chat_conversations')
    ->where('id', 1)
    ->update([
        'client_mobile' => '+1234567890',
        'client_country' => 'United States',
        'client_reason' => 'Test conversation for debugging'
    ]);

if ($updated) {
    echo "Successfully updated conversation 1\n";
} else {
    echo "Failed to update conversation 1\n";
}

// Verify the update
$conv = ChatConversation::find(1);
echo "After update:\n";
echo "Mobile: " . ($conv->client_mobile ?? 'NULL') . "\n";
echo "Country: " . ($conv->client_country ?? 'NULL') . "\n";
echo "Reason: " . ($conv->client_reason ?? 'NULL') . "\n";
