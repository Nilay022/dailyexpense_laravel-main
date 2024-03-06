<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
class Tour extends Model
{
     use HasFactory;
         protected $table = 'tour';
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
