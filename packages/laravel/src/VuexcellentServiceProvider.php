<?php

namespace ReedJones\Vuexcellent;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/** Macros */

use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use ReedJones\Vuexcellent\Factories\VuexFactory;
use ReedJones\Vuexcellent\Mixins\VuexCollectionMixin;
use ReedJones\Vuexcellent\Mixins\VuexResponseMixin;

class VuexcellentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // php artisan vendor:publish --provider="ReedJones\Vuexcellent\VuexcellentServiceProvider" --tag="config"
        $this->publishes([__DIR__ . '/config.stub.php' => config_path('vuexcellent.php')], 'config');

        App::bind(VuexFactory::class, function () {
            return new VuexFactory;
        });

        // apply response & collection mixins
        $this->applyMixins();

        // blade directives @app @vuex
        $this->setDirectives();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config.stub.php', 'vuexcellent');
    }

    /**
     * Sets up the utility mixins
     */
    public function applyMixins()
    {
        // Response macros response()->vuex()
        Response::mixin(new VuexResponseMixin);

        // Collection macros collect([])->toVuex('namespace', 'key')
        Collection::mixin(new VuexCollectionMixin);
    }

    /**
     * Sets up the blade directives
     */
    public function setDirectives()
    {
        Blade::directive('app', function () {
            return "<?= '<div id=\'app\'></div>'; ?>";
        });

        Blade::directive('vuex', function () {
            return "<?='<script id=\'initial-state\'>window.__INITIAL_STATE__='.ReedJones\Vuexcellent\Facades\Vuex::asJson().'</script>';?>";
        });
    }
}
