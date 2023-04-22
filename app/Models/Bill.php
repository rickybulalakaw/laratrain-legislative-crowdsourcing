<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'bill_no',
        'year',
        'summary',
        'user_id'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
