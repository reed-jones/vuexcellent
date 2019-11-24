<?php

namespace ReedJones\Vuexcellent\Facades;

use Closure;

class Vuex
{
    /**
     * Base (non-namespaced) vuex state
     *
     * @var array $_state
     */
    private static $_state;

    /**
     * Vuex modules
     *
     * @var array
     */
    private static $_modules;

    /**
     * Creates a new 'Vuex' class for easy $store access
     *
     * @param Closure $callable
     *
     * @return void
     */
    public static function store(Closure $closure)
    {
        // call the closure, injecting a new store instance
        // for state/module creation
        $closure(new Vuex);
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
            throw new \InvalidArgumentException('$state must be an array or a Collection.');
        }

        if ($state instanceof \Illuminate\Support\Collection) {
            $state = $state->toArray();
        }

        // set or append data to internal _state array
        self::$_state = isset(self::$_state)
            ? array_merge(self::$_state, $state)
            : $state;
    }

    /**
     * Creates or Updates a new vuex module
     *
     * @param string $namespace
     * @param \Illuminate\Support\Collection|array $module
     *
     * @return void
     */
    public function module(string $namespace, $module)
    {
        if (!is_string($namespace) || empty($namespace)) {
            throw new \InvalidArgumentException('$namespace must be a string.');
        }

        if (!is_array($module) && !$module instanceof \Illuminate\Support\Collection) {
            throw new \InvalidArgumentException('$module must be an array or a Collection.');
        }

        if ($module instanceof \Illuminate\Support\Collection) {
            $module = $module->toArray();
        }

        self::$_modules[$namespace] = isset(self::$_modules[$namespace])
            ? array_merge(self::$_modules[$namespace], $module)
            : $module;
    }

    /**
     * Returns the currently saved data as an array
     *
     * @return array
     */
    public static function asArray()
    {
        $store = [];

        if (self::$_state) {
            $store['state'] = self::$_state;
        }

        if (self::$_modules) {
            $store['modules'] = [];

            foreach (self::$_modules as $module => $value) {
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
    public static function asJson()
    {
        return json_encode(self::asArray());
    }

    /**
     * Returns the current vuex data as a json response to
     * be picked up by the front end.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function asResponse() {
        return response()->json([
            '$vuex' => self::asArray()
        ]);
    }
}
