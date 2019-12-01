<?php

namespace ReedJones\Vuexcellent\Test;

use Vuex;

class VuexFacadeStoreTest extends TestCase
{
    public function test_vuex_store_state_matches_vuex_as_array()
    {
        $data = ['works' => true];

        Vuex::store(function ($store) use ($data) {
            $store->state($data);
        });

        $this->assertSame(
            Vuex::asArray(),
            ['state' => $data]
        );
    }

    public function test_vuex_store_module_matches_vuex_as_array()
    {
        $namespace = 'app';
        $data = ['works' => true];

        Vuex::store(function ($store) use ($namespace, $data) {
            $store->module($namespace, $data);
        });

        $this->assertSame(
            Vuex::asArray(),
            ['modules' => [
                $namespace => [
                    'state' => $data
                ]
            ]]
        );
    }

    public function test_vuex_store_multiple_module_calls_get_merged()
    {
        $namespace = 'app';

        Vuex::store(function ($store) use ($namespace) {
            $store->module($namespace, ['works' => true]);
        });

        Vuex::store(function ($store) use ($namespace) {
            $store->module($namespace, ['success' => 'confirmed']);
        });

        $this->assertSame(
            Vuex::asArray(),
            ['modules' => [
                $namespace => [
                    'state' => [
                        'works' => true,
                        'success' => 'confirmed',
                    ]
                ]
            ]]
        );
    }

    public function test_vuex_store_state_and_modules_can_coexist()
    {
        $namespace = 'app';

        Vuex::store(function ($store) {
            $store->state(['works' => true]);
        });

        Vuex::store(function ($store) use ($namespace) {
            $store->module($namespace, ['success' => 'confirmed']);
        });

        $this->assertSame(
            Vuex::asArray(),
            [
                'state' => [
                    'works' => true
                ],
                'modules' => [
                    $namespace => [
                        'state' => [
                            'success' => 'confirmed',
                        ]
                    ]
                ]
            ]
        );
    }
}
