<?php

namespace LucaLongo\LaravelContacts\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use LucaLongo\LaravelContacts\Models\Concerns\HasContacts;

class TestUser extends Model
{
    use HasContacts;

    protected $table = 'test_users';

    protected $guarded = [];

    public $timestamps = false;
}
