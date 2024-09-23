<?php

use Illuminate\Support\Facades\Schema;

it('migrate database', function () {
    expect(Schema::hasTable('contacts'))->toBeTrue();
});
