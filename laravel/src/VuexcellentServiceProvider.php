<?php

namespace ReedJones\Vuexcellent;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use ReedJones\Vuexcellent\Facades\Vuex;

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

        // Response macros response()->vuex()
        $this->setMacros();

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
     * Sets up the ->vuex response macro
     */
    public function setMacros()
    {
        Response::macro('vuex', function (array $data = [], int $status = 200, array $headers = [], int $options = 0) {
            try {
                return Response::json(
                    array_merge( ['$vuex' => Vuex::asArray()], $data ),
                    $status, $headers, $options
                );
            } catch (Exception $err) {
                return Response::json([
                    'vuexcellent' => $err->getMessage()
                ], 422);
            }
        });
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
