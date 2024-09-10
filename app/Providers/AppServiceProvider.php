<?php

namespace App\Providers;

use Laudis\Neo4j\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SchoolRepositoryInterface;
use App\Repositories\StudentRepositoryInterface;
use App\Repositories\SubjectRepositoryInterface;
use App\Repositories\Neo4j\SchoolNeo4jRepository;
use App\Repositories\Neo4j\StudentNeo4jRepository;
use App\Repositories\Neo4j\SubjectNeo4jRepository;
use App\Repositories\Eloquent\SchoolEloquentRepository;
use App\Repositories\Eloquent\StudentEloquentRepository;
use App\Repositories\Eloquent\SubjectEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SchoolRepositoryInterface::class, SchoolNeo4jRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentNeo4jRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectNeo4jRepository::class);
        // if u want to access to mysql remove the comment
        /*
        $this->app->bind(SchoolRepositoryInterface::class, SchoolEloquentRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentEloquentRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectEloquentRepository::class);
        */

        $this->app->singleton('neo4j', function ($app) {
            return ClientBuilder::create()
                ->withDriver('default', 'http://neo4j:test@localhost:7474') // Adjust this based on your credentials
                ->build();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}