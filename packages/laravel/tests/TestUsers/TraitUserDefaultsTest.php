<?php

namespace ReedJones\Vuexcellent\Test;

use Vuex;
use ReedJones\Vuexcellent\Test\Models\TraitUserDefaults;

class TraitUserDefaultsTest extends TestCase
{
    public function test_a_trait_model_with_defaults_saves_to_module()
    {
        TraitUserDefaults::find(1)->toVuex();

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => ['activeUser' => TraitUserDefaults::find(1)->toArray()]
                    ]
                ]
            ]
        );
    }

    public function test_all_trait_models_without_defaults_saves_to_state()
    {
        TraitUserDefaults::all()->toVuex();

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => [
                            'allUsers' =>  TraitUserDefaults::all()->toArray()
                        ]
                    ]
                ]
            ]
        );
    }

    public function test_a_trait_model_with_defaults_specified_module_saves_to_module()
    {
        TraitUserDefaults::find(1)->toVuex('users', 'testUser');

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => ['testUser' => TraitUserDefaults::find(1)->toArray()]
                    ]
                ]
            ]
        );
    }

    public function test_all_trait_models_with_specified_module_saves_to_module()
    {
        TraitUserDefaults::all()->toVuex('users', 'allUsers');

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => [
                            'allUsers' => TraitUserDefaults::all()->toArray()
                        ]
                    ]
                ]
            ]
        );
    }
}
