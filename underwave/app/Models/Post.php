<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'price_range',
        'user_id',
        'image_path',
        'audio_path',
        'event_date',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Un post tiene muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Los usuarios que asisten a este evento
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'post_user')->withTimestamps();
    }
}
