<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mean extends Model
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

    public function meanAttachments()
    {
        return $this->hasMany(MeanAttachment::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }
    
}
