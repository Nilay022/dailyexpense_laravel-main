<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'name',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    
}
