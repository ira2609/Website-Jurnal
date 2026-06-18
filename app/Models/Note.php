<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'title', 'content', 'image', 'mood', 'is_favorite'])]
class Note extends Model
{
    use HasFactory;

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function moodOptions(): array
    {
        return [
            '😊 Happy',
            '😐 Neutral',
            '😢 Sad',
            '😡 Angry',
            '😴 Tired',
            '😍 Excited',
        ];
    }

    public function imageUrl(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
