<?php

namespace ReedJones\Vuexcellent\Traits;

use ReedJones\Vuexcellent\Extensions\VuexCollection;
use ReedJones\Vuexcellent\Facades\Vuex;

trait Vuexable
{
    /**
     * Creates a new collection
     *
     * @param array [$models=[]]
     *
     * @return \ReedJones\Vuexcellent\Extensions\VuexCollection;
     */
    public function newCollection(array $models = [])
    {
        return new VuexCollection(
            $models,
            $this->getVuexModule(),
            $this->getVuexCollectionKey()
        );
    }

    /**
     * Attempts to retrieve the preferred vuex module namespace for the model
     *
     * @return string|null
     */
    private function getVuexModule()
    {
        if (property_exists($this, 'vuex') && isset($this->vuex['namespace'])) {
            return $this->vuex['namespace'];
        } else {
            return null;
        }
    }

    /**
     * Attempts to retrieve the preferred model key for vuex.
     * This is for a single item
     *
     * @return string
     */
    private function getVuexModelKey()
    {
        if (property_exists($this, 'vuex') && isset($this->vuex['model'])) {
            return $this->vuex['model'];
        } else {
            return config('vuex.model', 'active');
        }
    }

    /**
     * Attempts to retrieve the preferred collection key for vuex
     * This is an array of items
     *
     * @return string
     */
    private function getVuexCollectionKey()
    {
        if (property_exists($this, 'vuex') && isset($this->vuex['collection'])) {
            return $this->vuex['collection'];
        } else {
            return config('vuex.collection', 'all');
        }
    }

    /**
     * Formats the current model & stores to local vuex state
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
