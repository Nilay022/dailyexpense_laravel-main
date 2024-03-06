<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour_member extends Model
{
    use HasFactory;
    protected $table = "tour_members";
    protected $fillable = [
        'user_id',
        'member_id',
        'tour_id'

    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
