<?php

use LucaLongo\LaravelContacts\Models\Contact;
use LucaLongo\LaravelContacts\Tests\Fixtures\TestUser;

it('persists a contact with all known fields', function () {
    $user = TestUser::create(['name' => 'Owner']);

    $contact = Contact::create([
        'contactable_type' => $user::class,
        'contactable_id' => $user->getKey(),
        'label' => 'Work',
        'phone' => '+39 02 1234567',
        'mobile' => '+39 333 1234567',
        'email' => 'work@example.com',
        'website' => 'https://example.com',
        'facebook' => 'https://facebook.com/me',
        'x' => 'https://x.com/@me',
        'linkedin' => 'https://linkedin.com/in/me',
        'push_token' => 'token-abc',
    ]);

    expect($contact->fresh())
        ->label->toBe('Work')
        ->phone->toBe('+39 02 1234567')
        ->mobile->toBe('+39 333 1234567')
        ->email->toBe('work@example.com')
        ->website->toBe('https://example.com')
        ->facebook->toBe('https://facebook.com/me')
        ->x->toBe('https://x.com/@me')
        ->linkedin->toBe('https://linkedin.com/in/me')
        ->push_token->toBe('token-abc');
});

it('resolves the polymorphic contactable owner', function () {
    $user = TestUser::create(['name' => 'Owner']);

    $contact = Contact::factory()->contactable($user)->create();

    $owner = $contact->contactable;

    expect($owner)
        ->toBeInstanceOf(TestUser::class)
        ->and($owner->is($user))->toBeTrue();
});

it('has no protected attributes via guarded', function () {
    expect((new Contact)->getGuarded())->toBe([]);
});
