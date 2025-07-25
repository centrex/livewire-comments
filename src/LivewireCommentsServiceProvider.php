<?php

declare(strict_types = 1);

namespace Centrex\LivewireComments;

use Centrex\LivewireComments\Http\Livewire\{Comment, Comments, Like};
use Centrex\LivewireComments\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireCommentsServiceProvider extends ServiceProvider
{
    /** Bootstrap the application services. */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'livewire-comments');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-comments');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Livewire::component('comments', Comments::class);
        Livewire::component('comment', Comment::class);
        Livewire::component('like', Like::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('livewire-comments.php'),
            ], 'livewire-comments-config');

            $this->publishes([
                __DIR__ . '/../../tailwind.config.js' => base_path('tailwind.config.js'),
            ], 'comments-tailwind-config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-comments'),
            ], 'livewire-comments-views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/livewire-comments'),
            ], 'livewire-comments-assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/livewire-comments'),
            ], 'livewire-comments-lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /** Register the application services. */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'livewire-comments');

        $this->app->bind(CommentPolicy::class, fn ($app): CommentPolicy => new CommentPolicy());

        Gate::policy(Models\Comment::class, CommentPolicy::class);

        // Register the main class to use with the facade
        $this->app->singleton('livewire-comments', fn (): LivewireComments => new LivewireComments());
    }
}
