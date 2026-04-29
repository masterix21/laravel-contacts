<?php

use LucaLongo\LaravelContacts\Models\Contact;
use LucaLongo\LaravelContacts\Tests\Fixtures\TestUser;

it('builds a valid contact via factory', function () {
    $contact = Contact::factory()->make();

    expect($contact)
        ->label->not->toBeEmpty()
        ->email->not->toBeEmpty()
        ->phone->not->toBeEmpty()
        ->mobile->not->toBeEmpty()
        ->website->not->toBeEmpty()
        ->facebook->toStartWith('https://facebook.com/')
        ->x->toStartWith('https://x.com/@')
        ->linkedin->toStartWith('https://linkedin.com/')
        ->push_token->not->toBeEmpty();
});

it('attaches a contactable owner via state', function () {
    $user = TestUser::create(['name' => 'Owner']);

    $contact = Contact::factory()->contactable($user)->create();

    expect($contact)
        ->contactable_type->toBe(TestUser::class)
        ->contactable_id->toBe($user->getKey());
});

it('sets meta payload via state and casts to ArrayObject', function () {
    $user = TestUser::create(['name' => 'Owner']);
    $payload = ['nickname' => 'boss', 'tags' => ['vip', 'partner']];

    $contact = Contact::factory()->contactable($user)->meta($payload)->create();
    $meta = $contact->fresh()->meta;

    expect($meta)->toBeInstanceOf(ArrayObject::class);
    expect($meta->getArrayCopy())->toBe($payload);
    expect($meta['nickname'])->toBe('boss');
});
