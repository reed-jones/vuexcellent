<?php

namespace ReedJones\Vuexcellent\Factories;

use Closure;
use ReedJones\Vuexcellent\Exceptions\VuexInvalidModuleException;
use ReedJones\Vuexcellent\Exceptions\VuexInvalidStateException;

class VuexFactory
{
    /**
     * Base (non-namespaced) vuex state
     *
     * @var array $_state
     */
    private $_state;

    /**
     * Vuex modules
     *
     * @var array
     */
    private $_modules;

    /**
     * Creates a new 'Vuex' class for easy $store access
     *
     * @param Closure $callable
     *
     * @return void
     */
    public function store(Closure $closure)
    {
        // call the closure, injecting a new store instance
        // for state/module creation
        // left for historical purposes, unlikely to be used moving forward
        $closure($this);

        // Examples... this call is effectively replaced by:
        // Vuex::state(['all' => User::all()]);
        // Vuex::module('users', ['all' => User::all()]);
    }

    /**
     * Sets or adds to the base vuex state
     *
     * @param \Illuminate\Support\Collection|array $state
     *
     * @return void
     */
    public function state($state)
    {
        if (!is_array($state) && !$state instanceof \Illuminate\Support\Collection) {
            throw new VuexInvalidStateException('$state must be an array or a Collection.');
        }

        if ($state instanceof \Illuminate\Support\Collection) {
            $state = $state->toArray();
        } else {
            $state = collect($state)->toArray();
        }

        // set or append data to internal _state array
        $this->_state = isset($this->_state)
            ? array_merge($this->_state, $state)
            : $state;

        return $this;
    }

    /**
     * Creates or Updates a new vuex module
     *
     * @param string $namespace
     * @param \Illuminate\Support\Collection|array $state
     *
     * @return void
     */
    public function module(string $namespace, $state)
    {
        if (!is_string($namespace) || empty($namespace)) {
            throw new VuexInvalidModuleException('$namespace must be a string.');
        }

        if (!is_array($state) && !$state instanceof \Illuminate\Support\Collection) {
            throw new VuexInvalidStateException('$state must be an array or a Collection.');
        }

        if ($state instanceof \Illuminate\Support\Collection) {
            $state = $state->toArray();
        } else {
            $state = collect($state)->toArray();
        }

        $this->_modules[$namespace] = isset($this->_modules[$namespace])
            ? array_merge($this->_modules[$namespace], $state)
            : $state;

        return $this;
    }

    /**
     * Returns the currently saved data as an array
     *
     * @return array
     */
    public function asArray()
    {
        $store = [];

        if ($this->_state) {
            $store['state'] = $this->_state;
        }

        if ($this->_modules) {
            $store['modules'] = [];

            foreach ($this->_modules as $module => $value) {
                $store['modules'][$module] = ['state' => $value];
            }
        }

        return $store;
    }

    /**
     * Returns the currently saved data as a json string
     *
     * @return string|false
     */
    public function asJson()
    {
        return json_encode($this->asArray());
    }

    /**
     * Returns the current vuex data as a json response to
     * be picked up by the front end.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function asResponse() {
        return response()->json(['$vuex' => $this->asArray()]);
    }
}
