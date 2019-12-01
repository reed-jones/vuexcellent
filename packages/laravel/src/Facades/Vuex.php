<?php

namespace ReedJones\Vuexcellent\Facades;

use Illuminate\Support\Facades\Facade;
use ReedJones\Vuexcellent\Factories\VuexFactory;

class Vuex extends Facade {
    protected static function getFacadeAccessor() {
        return VuexFactory::class;
    }
}
