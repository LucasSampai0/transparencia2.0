<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
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

    public function mean()
    {
        return $this->belongsTo(Mean::class);
    }
}
