<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['title', 'embed_code', 'program_id'];
}