<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total',
        'category_id',
        'client_id',
        'supplier_id',
        'type'
    ];

    protected static function booted()
    {
        static::addGlobalScope('type', function(Builder $builder){
            $builder->where('type', static::class);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
