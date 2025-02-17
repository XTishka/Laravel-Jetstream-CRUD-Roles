<?php

namespace Modules\Finance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Finance\Database\factories\CurrencyFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "fnc_currencies";

    protected $fillable = [
        'title',
        'code',
        'designation',
        'base_currency'
    ];

    protected static function newFactory()
    {
        return CurrencyFactory::new();
    }
}
