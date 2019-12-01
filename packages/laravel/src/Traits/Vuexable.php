<?php

namespace ReedJones\Vuexcellent\Traits;

use ReedJones\Vuexcellent\Exceptions\VuexInvalidKeyException;
use ReedJones\Vuexcellent\Extensions\VuexSmartCollection;
use ReedJones\Vuexcellent\Facades\Vuex;

trait Vuexable
{
    /**
     * Creates a new collection
     *
     * @param array [$models=[]]
     *
     * @return \ReedJones\Vuexcellent\Extensions\VuexSmartCollection;
     */
    public function newCollection(array $models = [])
    {
        return new VuexSmartCollection(
            $models,
            $this->getDefaultVuexModule(),
            $this->getDefaultVuexCollectionKey()
        );
    }

    /**
     * Attempts to retrieve the preferred vuex module namespace for the model
     *
     * @return string|null
     */
    public function getDefaultVuexModule()
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
    public function getDefaultVuexKey()
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
    public function getDefaultVuexCollectionKey()
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
        $namespace = $namespace ?? $this->getDefaultVuexModule();
        $key = $key ?? $this->getDefaultVuexKey();

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
    }
}
