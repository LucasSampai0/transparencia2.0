<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'cnpj',
        'address',
        'slug',
        'phone',
        'site'
    ];



    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function means()
    {
        return $this->hasMany(Mean::class);
    }

    public function publicSessions()
    {
        return $this->hasMany(PublicSession::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
