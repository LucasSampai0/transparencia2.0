<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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


//    public function setDateAttribute($value)
//    {
//        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
//    }


    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function onlineProposals()
    {
        return $this->hasMany(OnlineProposal::class);
    }


}
