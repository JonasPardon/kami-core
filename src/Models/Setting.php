<?php

namespace JonasPardon\KamiCore\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'label',
        'key',
        'category',
        'order',
        'active',
        'value',
        'type',
        'extras',
    ];
}
