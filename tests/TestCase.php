<?php

namespace virlatinus\PermissionsUI\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Permission\PermissionServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use virlatinus\PermissionsUI\PermissionsUIServiceProvider;
use Orchestra\Testbench\Attributes\WithMigration;

#[WithMigration]
abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function defineEnvironment($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            PermissionServiceProvider::class,
            PermissionsUIServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $CreatePermissionTables = include __DIR__.'/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';
        $CreatePermissionTables->up();
    }
}
