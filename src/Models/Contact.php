<?php

namespace LucaLongo\LaravelContacts\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'meta' => AsArrayObject::class,
    ];

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }
}
