<?php

namespace ReedJones\Vuexcellent\Interfaces;

interface CanVuex {
    /**
     * Returns the default (if available) namespace or null
     */
    public function getDefaultVuexModule(): ?string;

    /**
     * Returns the default Vuex key for the data to be stored at
     */
    public function getDefaultVuexKey(): string;

    /**
     *  Stores the calling data into this.$store.state[namespace][key]
     *
     * @param $namespace vuex namespace (optional/nullable)
     * @param $key  vuex key for the data to be saved at
     */
    public function toVuex(?string $namespace = null, ?string $key = null);
}
