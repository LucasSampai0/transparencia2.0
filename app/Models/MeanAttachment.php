<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeanAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file',
        'mean_id',
    ];

    public function mean()
    {
        return $this->belongsTo(Mean::class);
    }
}
