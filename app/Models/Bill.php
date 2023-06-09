<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
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
        'user_id',
        'url',
        'file',
        'status'

    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedBy(User $user)
    {
        // returns if bill is already liked by user
        return $this->likes->contains('user_id', $user->id);
    }

    // public function ownedBy(User $user){ 
    //     return $this->
    // }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }
    
    public function likes() 
    {
        return $this->hasMany(Like::class);
    }
}
