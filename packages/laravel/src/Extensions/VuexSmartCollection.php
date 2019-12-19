<?php

namespace ReedJones\Vuexcellent\Extensions;

use Illuminate\Database\Eloquent\Collection;
use ReedJones\Vuexcellent\Exceptions\VuexInvalidKeyException;
use ReedJones\Vuexcellent\Facades\Vuex;
use ReedJones\Vuexcellent\Interfaces\CanVuex;

class VuexSmartCollection extends Collection implements CanVuex
{
    /**
     * Collection constructor override. Setup vuex namespace & key.
     *
     * @param array [$models=[]]
     * @param string|null $namespace
     * @param string|null $key
     */
    public function __construct($models = [], $namespace = null, $key = null)
    {
        $this->namespace = $namespace;
        $this->key = $key;

        parent::__construct($models);
    }

    /**
     * Attempts to retrieve the preferred vuex module namespace for the collection
     *
     * @return string|null
     */
    public function getDefaultVuexModule(): ?string {
        return $this->namespace;
    }

    /**
     * Attempts to retrieve the preferred model key for vuex.
     * This is for a collection
     *
     * @return string
     */
    public function getDefaultVuexKey(): string {
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
    public function toVuex(?string $namespace = null, ?string $key = null)
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
