<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'user_id',
        'month',
        'image',
        'keterangan',
        'status'
    ];

    public function uploader(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
