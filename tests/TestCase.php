<?php

declare(strict_types = 1);

use Centrex\LivewireComments\Providers\CommentifyServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Livewire\LivewireServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    /** @return string[] */
    protected function getPackageProviders($app): array
    {
        return [
            CommentifyServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        Model::unguard();

        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__ . '/../database/migrations'),
        ]);
    }

    public function tearDown(): void
    {
        Schema::drop('articles');
        Schema::drop('episodes');
        Schema::drop('comments');
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('articles', function ($table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('episodes', function ($table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }
}
