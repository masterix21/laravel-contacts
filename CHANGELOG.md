# Changelog

All notable changes to `laravel-contacts` will be documented in this file.

## 1.0.0 - 2026-04-29

### Added
- Support for Laravel 13.
- Expanded Pest test suite covering `Contact`, `HasContacts` trait, factory, and migrations.
- Array casting for the `Contact` `meta` field.

### Changed
- Bumped minimum Pest to v3 to align with the test suite API.
- Updated GitHub Actions: `actions/checkout` v6, `ramsey/composer-install` v4, `stefanzweifel/git-auto-commit-action` v7, `dependabot/fetch-metadata` v3.1.

### Removed
- Support for Laravel 10.
- Unused `solution-forest/filament-tree` dependency.
- Auto-registered `LaravelContacts` facade alias.

## 0.0.4 - 2024-09-23

### 0.0.4 - 2024-09-23

- [FIX] Add empty guarded to `Contact` model

## 0.0.3 - 2024-09-23

### 0.0.3 - 2024-09-24

- [FIX] Migrations

## 0.0.2 - 2024-09-23

### 0.0.2 - 2024-09-23

- [FIX] Minor bugs

## 0.0.1 - 2024-09-23

### 0.0.1 - 2024-09-24

- Very first and young release
