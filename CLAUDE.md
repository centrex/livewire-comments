# CLAUDE.md

## Package Overview

`centrex/livewire-comments` — Livewire-powered comment threads for any Laravel model.

Namespace: `Centrex\LivewireComments\`  
Service Provider: `LivewireCommentsServiceProvider`  
Facade: `Facades/LivewireComments`

## Commands

Run from inside this directory (`cd livewire-comments`):

```sh
composer install          # install dependencies
composer test             # full suite: rector dry-run, pint check, phpstan, pest
composer test:unit        # pest tests only
composer test:lint        # pint style check (read-only)
composer test:types       # phpstan static analysis
composer test:refacto     # rector refactor check (read-only)
composer lint             # apply pint formatting
composer refacto          # apply rector refactors
composer analyse          # phpstan (alias)
composer build            # prepare testbench workbench
composer start            # build + serve testbench dev server
```

Run a single test:
```sh
vendor/bin/pest tests/ExampleTest.php
vendor/bin/pest --filter "test name"
```

## Structure

```
src/
  LivewireComments.php
  LivewireCommentsServiceProvider.php
  Facades/
  Commands/
  Http/
  Models/                       # Comment model (polymorphic)
  Policies/                     # Comment authorization policy
  Scopes/
  Traits/                       # HasComments trait
resources/views/livewire/
config/config.php
database/migrations/
tests/
workbench/
```

## Key Concepts

- `Traits/HasComments`: add to any model to make it commentable
- Comments are stored polymorphically (commentable_type, commentable_id)
- Policies handle authorization (who can edit/delete comments)
- Livewire component renders the comment thread with real-time updates
- Scopes provide filtered queries (approved, pending, etc.)

## Usage

```blade
{{-- In a Blade view --}}
<livewire:livewire-comments :model="$post" />
```

```php
use Centrex\LivewireComments\Traits\HasComments;

class Post extends Model
{
    use HasComments;
}
```

## Conventions

- PHP 8.2+, `declare(strict_types=1)` in all files
- Pest for tests, snake_case test names
- Pint with `laravel` preset
- Rector targeting PHP 8.3 with `CODE_QUALITY`, `DEAD_CODE`, `EARLY_RETURN`, `TYPE_DECLARATION`, `PRIVATIZATION` sets
- PHPStan at level `max` with Larastan
