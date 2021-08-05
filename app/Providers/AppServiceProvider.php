<?php

namespace App\Providers;

use App\Articles\ElasticsearchRepository;
use App\Articles\EloquentRepository;
use App\Articles\ArticlesRepository;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticlesRepository::class, function ($app) {
            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            
            if (! config('services.search.enabled')) {
                return new EloquentRepository();;
            }

            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setBasicAuthentication($app['config']->get('services.search.user'),$app['config']->get('services.search.password'))
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
