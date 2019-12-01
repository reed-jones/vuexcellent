<?php

namespace ReedJones\Vuexcellent\Extensions;

use Illuminate\Database\Eloquent\Collection;
use ReedJones\Vuexcellent\Facades\Vuex;

class VuexSmartCollection extends Collection
{
    /**
     * Collection constructor override. Setup vuex namespace & key.
     *
     * @param array [$models=[]]
     * @param string|null $namespace
     * @param string|null $key
     */
    public function __construct(array $models = [], $namespace = null, $key = null)
    {
        $this->namespace = $namespace;
        $this->key = $key;

        parent::__construct($models);
    }

    private function getVuexModule() {
        return $this->namespace;
    }
    private function getVuexModelKey() {
        return $this->key;
    }

    /**
     * Formats the collection & adds to vuex
     *
     * @param string|null [$namespace=null]
     * @param string|null [$key=null]
     *
     * @return $this
     */
    public function toVuex($namespace = null, $key = null)
    {
        $namespace = $namespace ?? $this->getVuexModule();
        $key = $key ?? $this->getVuexModelKey();

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
    }
}
