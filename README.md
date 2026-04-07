# Livewire Comments

[![Latest Version on Packagist](https://img.shields.io/packagist/v/centrex/livewire-comments.svg?style=flat-square)](https://packagist.org/packages/centrex/livewire-comments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/centrex/livewire-comments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/centrex/livewire-comments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/centrex/livewire-comments/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/centrex/livewire-comments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/centrex/livewire-comments?style=flat-square)](https://packagist.org/packages/centrex/livewire-comments)

Real-time polymorphic comment threads built with Livewire. Supports nested replies, likes (by authenticated user or by IP/user-agent for guests), Markdown rendering, `@mention` linking, and soft-deletes.

## Installation

```bash
composer require centrex/livewire-comments
php artisan vendor:publish --tag="livewire-comments-migrations"
php artisan migrate
```

## Usage

### 1. Add the Livewire component to any Blade view

```blade
<livewire:comments :model="$post" />
```

The `$model` can be any Eloquent model — comments are stored polymorphically.

### 2. Add the `HasUserAvatar` trait to your User model (optional)

```php
use Centrex\LivewireComments\Traits\HasUserAvatar;

class User extends Authenticatable
{
    use HasUserAvatar;
    // Provides avatar() → Gravatar URL based on email
}
```

### 3. Comment model

```php
use Centrex\LivewireComments\Models\Comment;

// All top-level comments for a model
Comment::parent()->where('commentable_type', Post::class)
    ->where('commentable_id', $post->id)
    ->with('children', 'user')
    ->get();

// Nested replies
$comment->children;    // ordered oldest-first
$comment->isParent();  // true if no parent_id

// Likes
$comment->likes_count;
$comment->isLiked();
$comment->removeLike();
```

### 4. Comment presenter

```php
$comment->presenter()->markdownBody();       // HtmlString (Markdown rendered)
$comment->presenter()->relativeCreatedAt();  // "2 hours ago"
$comment->presenter()->replaceUserMentions($text); // links @mentions to user profiles
```

### Config

```bash
php artisan vendor:publish --tag="livewire-comments-config"
```

```php
// config/commentify.php
'users_route_prefix' => 'users',   // used for @mention links: /users/{username}
```

## Testing

```bash
composer test        # full suite
composer test:unit   # pest only
composer test:types  # phpstan
composer lint        # pint
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [centrex](https://github.com/centrex)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
