# Manege comments with livewire in laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/centrexbd/livewire-comments.svg?style=flat-square)](https://packagist.org/packages/centrexbd/livewire-comments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/centrexbd/livewire-comments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/centrexbd/livewire-comments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/centrexbd/livewire-comments/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/centrexbd/livewire-comments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/centrexbd/livewire-comments.svg?style=flat-square)](https://packagist.org/packages/centrexbd/livewire-comments)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Some Features Highlight

- Easy to integrate
- Supports Laravel 10+
- Supports Livewire 3
- Livewire powered commenting system
- Tailwind UI
- Add comments to any model
- Nested Comments
- Comments Pagination
- Youtube style Like/unlike feature
- Guest like/unlike of comments (based on `IP` & `UserAgent`)
- Mention User with @ in Replies/Edits

## Prerequisites

- [Livewire](https://laravel-livewire.com/docs/2.x/installation)
- [TailwindCSS](https://tailwindcss.com/)
- [AlpineJS](https://alpinejs.dev/essentials/installation)

## Installation

You can install the package via composer:

```bash
composer require centrexbd/livewire-comments
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="livewire-comments-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="livewire-comments-config"
```

This is the contents of the published config file:

```php
return [
];
```

you can publish `tailwind.config.js` file, 

This package utilizes TailwindCSS, and use some custom configurations. You can publish package's `tailwind.config.
js` file by running the following command:

```php
php artisan vendor:publish --tag="comments-tailwind-config"
```

## Usage
In your model, where you want to integrate comments, simply add the `Commentable` trait in that model.
For example: 
```php
use Centrexbd\LivewireComments\Traits\Commentable;

class Article extends Model
{
    use Commentable;
}
```

Next, in your view, pass in the livewire comment component. For example, if your view file is `articles/show.blade.
php`. We can add the following code:
```html
<livewire:comments :model="$article"/>
```

#### Additionally, add the `HasUserAvatar` trait in `App\Models\User`, to use avatars:
```php
use Centrexbd\LivewireComments\Traits\HasUserAvatar;

class User extends Model
{
    use HasUserAvatar;
}
```

## Testing

```bash
composer test
```

## Credits

- [Laravel](https://laravel.com)
- [Tailwind](https://tailwindcss.com/)
- [Livewire](https://laravel-livewire.com/)
- [FlowBite](https://flowbite.com)
- [commentify](https://github.com/usamamuneerchaudhary/commentify/)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [centrexbd](https://github.com/centrexbd)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
