<?php

namespace ReedJones\Vuexcellent\Mixins;

use ReedJones\Vuexcellent\Exceptions\VuexInvalidKeyException;
use ReedJones\Vuexcellent\Facades\Vuex;
use ReedJones\Vuexcellent\Interfaces\CanVuex;

class VuexCollectionMixin implements CanVuex
{

    public function toVuex()
    {
        function getDefaultVuexModule()
        {
            // same as key (ideally in the same loop even)
            return null;
        }

        function getDefaultVuexKey()
        {
            // Try to find key
            // $this->count() && $this->every->key === $this->first->key;
            return null;
        }

        return function ($namespace = null, $key = null) {
            $namespace = $namespace ?? getDefaultVuexModule();
            $key = $key ?? getDefaultVuexKey();

            if (!$key) {
                throw new VuexInvalidKeyException("Could not determine key");
            }
            $data = [$key => $this];

            Vuex::store(function ($store) use ($namespace, $data) {
                if ($namespace) {
                    $store->module($namespace, $data);
                } else {
                    $store->state($data);
                }
            });

            return $this;
        };
    }
}
