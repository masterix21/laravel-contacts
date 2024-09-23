<?php

namespace LucaLongo\LaravelContacts\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/** @mixin Model */
trait HasContacts
{
    public function contacts(): MorphMany
    {
        return $this->morphMany(config('contacts.models.contact'), 'contactable');
    }

    public function emails(): MorphMany
    {
        return $this->contacts()->whereNotNull('email');
    }

    public function phones(): MorphMany
    {
        return $this->contacts()->whereNotNull('phone');
    }

    public function mobiles(): MorphMany
    {
        return $this->contacts()->whereNotNull('mobile');
    }

    public function websites(): MorphMany
    {
        return $this->contacts()->whereNotNull('website');
    }
}
