<?php

namespace ReedJones\Vuexcellent\Test;

use Vuex;

class VuexFacadeStateModuleTest extends TestCase
{
    public function test_vuex_state_matches_vuex_as_array()
    {
        $data = ['works' => true];

        Vuex::state($data);

        $this->assertSame(
            Vuex::asArray(),
            ['state' => $data]
        );
    }

    public function test_vuex_module_matches_vuex_as_array()
    {
        $namespace = 'app';
        $data = ['works' => true];

        Vuex::module($namespace, $data);

        $this->assertSame(
            Vuex::asArray(),
            ['modules' => [
                $namespace => [
                    'state' => $data
                ]
            ]]
        );
    }

    public function test_vuex_module_multiple_calls_get_merged()
    {
        $namespace = 'app';

        Vuex::module($namespace, ['works' => true]);

        Vuex::module($namespace, ['success' => 'confirmed']);

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

        Vuex::state(['works' => true]);

        Vuex::module($namespace, ['success' => 'confirmed']);

        $this->assertSame(
            Vuex::asArray(),
            [
                'state' => [
                    'works' => true
                ],
                'modules' => [
                    $namespace => [
                        'state' => [ 'success' => 'confirmed' ]
                    ]
                ]
            ]
        );
    }
}
