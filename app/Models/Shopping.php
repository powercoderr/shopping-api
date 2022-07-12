<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'createddate',
    ];

    /**Get user belongs to */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public $timestamps = true;

}
