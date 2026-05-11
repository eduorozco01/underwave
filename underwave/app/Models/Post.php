<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Campos que permitimos guardar desde el formulario
    protected $fillable = [
        'title',
        'content',
        'category',
        'price_range',
        'user_id',
        'image_path'
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
}
