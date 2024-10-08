<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'category_id',
        'client_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function supplierAttachments()
    {
        return $this->hasMany(SupplierAttachment::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function getTotalSpendingAttribute()
    {
        return $this->spendings->sum('total');
    }
}
