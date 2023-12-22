<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [];

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}
