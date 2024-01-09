# Manege comments with livewire in laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/centrex/livewire-comments.svg?style=flat-square)](https://packagist.org/packages/centrex/livewire-comments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/centrex/livewire-comments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/centrex/livewire-comments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/centrex/livewire-comments/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/centrex/livewire-comments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/centrex/livewire-comments?style=flat-square)](https://packagist.org/packages/centrex/livewire-comments)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Contents

- [Some Features Highlight](#some-features-highlight)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage Examples](#usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

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
composer require centrex/livewire-comments
```

You can run the migrations with:

```bash
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="comments-config"
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
use Centrex\LivewireComments\Traits\Commentable;

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
use Centrex\LivewireComments\Traits\HasUserAvatar;

class User extends Model
{
    use HasUserAvatar;
}
```

## Testing

🧹 Keep a modern codebase with **Pint**:
```bash
composer lint
```

✅ Run refactors using **Rector**
```bash
composer refacto
```

⚗️ Run static analysis using **PHPStan**:
```bash
composer test:types
```

✅ Run unit tests using **PEST**
```bash
composer test:unit
```

🚀 Run the entire test suite:
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Laravel](https://laravel.com)
- [Tailwind](https://tailwindcss.com/)
- [Livewire](https://laravel-livewire.com/)
- [FlowBite](https://flowbite.com)

- [centrex](https://github.com/centrex)
- [All Contributors](../../contributors)
- [commentify](https://github.com/usamamuneerchaudhary/commentify/)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
