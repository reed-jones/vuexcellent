<?php

namespace ReedJones\Vuexcellent\Mixins;

use ReedJones\Vuexcellent\Facades\Vuex;

class VuexCollectionMixin
{

    public function toVuex()
    {
        function getVuexModule()
        {
            // same as key (ideally in the same loop even)
            return null;
        }

        function getVuexModelKey()
        {
            // Try to find key
            // $this->count() && $this->every->key === $this->first->key;
            return null;
        }

        return function ($namespace = null, $key = null) {
            $namespace = $namespace ?? getVuexModule();
            $key = $key ?? getVuexModelKey();

            // TODO: if not key, throw error
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
