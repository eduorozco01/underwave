<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

App\Models\Comment::query()->delete();
App\Models\Post::query()->delete();

$allUsers = App\Models\User::all();

App\Models\Post::factory(30)->recycle($allUsers)->create()->each(function ($post) use ($allUsers) {
    $numeroComentarios = rand(0, 5);
    App\Models\Comment::factory($numeroComentarios)->create([
        'post_id' => $post->id,
        'user_id' => $allUsers->random()->id,
    ]);
});

echo "Posts and comments reseeded successfully with Sevilla themes.\n";
