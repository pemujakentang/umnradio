<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['keterangan', 'image'];

    protected $guarded = ['id'];

    use HasFactory;
}
