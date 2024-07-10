<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
        'time',
        'client_id',
        'attachment',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


}
