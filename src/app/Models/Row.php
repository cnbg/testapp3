<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $table = 'rows';
    public $timestamps = false;

    protected $fillable = ['id', 'name', 'date'];

    protected $casts = [
        'id' => 'integer',
    ];

    public function getDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d.m.Y');
    }
}
