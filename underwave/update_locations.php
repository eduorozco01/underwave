<?php
foreach(\App\Models\Post::all() as $post) { 
    $post->update([
        'latitude' => mt_rand(37360000, 37420000) / 1000000, 
        'longitude' => mt_rand(-6020000, -5950000) / 1000000
    ]); 
} 
echo "Ubicaciones actualizadas a Sevilla.\n";
