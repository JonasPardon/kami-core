<?php

namespace JonasPardon\KamiCore\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'label',
        'type',
        'order',
        'content',
        'page_id',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
