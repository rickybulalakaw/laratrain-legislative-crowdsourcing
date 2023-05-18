<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bill_id',
        'like',
        // 'summary',
        // 'user_id'
    ]; 

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // public function bill() 
    // {
    //     return $this->belongsTo(Bill::class);
    // }

    // public function belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
    // {
        
    // }
}
