# Laravel Contacts

[![Latest Version on Packagist](https://img.shields.io/packagist/v/masterix21/laravel-contacts.svg?style=flat-square)](https://packagist.org/packages/masterix21/laravel-contacts)
[![Tests](https://img.shields.io/github/actions/workflow/status/masterix21/laravel-contacts/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/masterix21/laravel-contacts/actions?query=workflow%3Arun-tests+branch%3Amain)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/masterix21/laravel-contacts/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/masterix21/laravel-contacts/actions?query=workflow%3APHPStan+branch%3Amain)
[![Code Style](https://img.shields.io/github/actions/workflow/status/masterix21/laravel-contacts/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/masterix21/laravel-contacts/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/masterix21/laravel-contacts.svg?style=flat-square)](https://packagist.org/packages/masterix21/laravel-contacts)

Attach a contact book to any Eloquent model. Users, companies, venues, projects — anything that needs phone numbers, emails, websites, or social handles can grow them through a single polymorphic relation, without you spinning up a dedicated table for every model.

## Why

Most apps end up scattering contact fields across half a dozen tables: a `phone` column on `users`, an `email` on `companies`, a separate `addresses` table that nobody trusts. This package centralises all of that into one `contacts` table and lets any model attach as many entries as it needs.

A single contact row can hold a label (e.g. *Office*, *Personal*), a phone, a mobile, an email, a website, a few social handles, a push token, and a freeform `meta` JSON payload for anything else.

## Requirements

- PHP 8.2+
- Laravel 11, 12, or 13

## Installation

Install via Composer:

```bash
composer require masterix21/laravel-contacts
```

Publish and run the migration:

```bash
php artisan vendor:publish --tag="laravel-contacts-migrations"
php artisan migrate
```

If you need to swap the `Contact` model for your own subclass, publish the config:

```bash
php artisan vendor:publish --tag="laravel-contacts-config"
```

```php
// config/contacts.php
return [
    'models' => [
        'contact' => \App\Models\Contact::class,
    ],
];
```

## Usage

Add the `HasContacts` trait to any model that should own contacts:

```php
use Illuminate\Database\Eloquent\Model;
use LucaLongo\LaravelContacts\Models\Concerns\HasContacts;

class User extends Model
{
    use HasContacts;
}
```

That's it — the model now exposes a polymorphic `contacts()` relation plus four filtered helpers.

### Adding contacts

```php
$user->contacts()->create([
    'label' => 'Office',
    'email' => 'luca@example.com',
    'phone' => '+39 02 1234567',
    'website' => 'https://example.com',
]);

$user->contacts()->create([
    'label' => 'Personal',
    'mobile' => '+39 333 1234567',
    'meta' => [
        'preferred_channel' => 'whatsapp',
        'timezone' => 'Europe/Rome',
    ],
]);
```

### Reading contacts

The trait ships with helpers that filter the relation by the field you care about:

```php
$user->contacts;   // every contact
$user->emails;     // only contacts with a non-null email
$user->phones;     // only contacts with a non-null phone
$user->mobiles;    // only contacts with a non-null mobile
$user->websites;   // only contacts with a non-null website
```

Each helper returns a `MorphMany`, so you can keep chaining:

```php
$primaryEmail = $user->emails()->where('label', 'Office')->first()?->email;
```

### The meta field

`meta` is cast to `AsArrayObject`, so you can read and write it like a native array and Laravel will persist the JSON for you:

```php
$contact = $user->contacts()->first();

$contact->meta['preferred_channel'] = 'email';
$contact->save();
```

### Available fields

| Field | Type | Notes |
|------|------|------|
| `label` | string | Free label, e.g. *Office*, *Billing* |
| `phone`, `mobile` | string | Landline / mobile numbers |
| `email` | string | |
| `website` | string | |
| `facebook`, `x`, `linkedin` | string | Social handles or full URLs |
| `push_token` | string | Device push token |
| `meta` | array | Anything else, stored as JSON |

The model has no `$fillable` and `$guarded = []`, so mass-assignment is open by design — guard your input at the request layer.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG](CHANGELOG.md) for the release history.

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md).

## Security

Found a vulnerability? Please review the [security policy](../../security/policy) before opening a public issue.

## Credits

- [Luca Longo](https://github.com/masterix21)
- [All contributors](../../contributors)

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md).
