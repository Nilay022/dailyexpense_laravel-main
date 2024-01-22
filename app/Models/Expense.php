<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense',
        'user_id',
        'category',
        'date',
        'description'

    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
