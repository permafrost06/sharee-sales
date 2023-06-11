<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'customer_id', 'id');
    }
}
