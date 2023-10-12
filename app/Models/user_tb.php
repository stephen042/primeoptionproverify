<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_tb extends Model
{
    use HasFactory;
    public $table = 'user_tb';
    public $guarded = [];
}
