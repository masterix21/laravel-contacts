<?php

use LucaLongo\LaravelContacts\Models\Contact;
use LucaLongo\LaravelContacts\Tests\Fixtures\TestUser;

beforeEach(function () {
    $this->user = TestUser::create(['name' => 'Owner']);
});

it('exposes a morphMany contacts relation', function () {
    Contact::factory()->count(3)->contactable($this->user)->create();

    expect($this->user->contacts)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Contact::class);
});

it('does not return contacts owned by other models', function () {
    $other = TestUser::create(['name' => 'Other']);

    Contact::factory()->contactable($this->user)->create();
    Contact::factory()->count(2)->contactable($other)->create();

    expect($this->user->contacts)->toHaveCount(1);
    expect($other->contacts)->toHaveCount(2);
});

it('filters emails, phones, mobiles and websites', function () {
    Contact::factory()->contactable($this->user)->create([
        'email' => 'a@example.com',
        'phone' => null,
        'mobile' => null,
        'website' => null,
    ]);

    Contact::factory()->contactable($this->user)->create([
        'email' => null,
        'phone' => '02 1234',
        'mobile' => null,
        'website' => null,
    ]);

    Contact::factory()->contactable($this->user)->create([
        'email' => null,
        'phone' => null,
        'mobile' => '333 9876',
        'website' => null,
    ]);

    Contact::factory()->contactable($this->user)->create([
        'email' => null,
        'phone' => null,
        'mobile' => null,
        'website' => 'https://example.com',
    ]);

    expect($this->user->emails)->toHaveCount(1);
    expect($this->user->phones)->toHaveCount(1);
    expect($this->user->mobiles)->toHaveCount(1);
    expect($this->user->websites)->toHaveCount(1);
});

it('creates a contact through the relation', function () {
    $contact = $this->user->contacts()->create([
        'label' => 'Personal',
        'email' => 'me@example.com',
    ]);

    expect($contact)
        ->contactable_type->toBe(TestUser::class)
        ->contactable_id->toBe($this->user->getKey())
        ->email->toBe('me@example.com');
});
