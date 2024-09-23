<?php

namespace LucaLongo\LaravelContacts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }
}
