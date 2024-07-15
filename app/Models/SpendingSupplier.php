<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendingSupplier extends Spending
{
    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope('type', function(Builder $builder){
            $builder->where('type', 'spending_supplier');
        });
    }
}
