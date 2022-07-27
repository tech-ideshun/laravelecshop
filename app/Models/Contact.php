<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'status'];
    
    public static $rules = array(
        'title' => 'required|max:255',
        'content' => 'required',
    );

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}
