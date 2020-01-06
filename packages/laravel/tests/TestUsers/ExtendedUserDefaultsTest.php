<?php

namespace ReedJones\Vuexcellent\Test;

use ReedJones\Vuexcellent\Facades\Vuex;
use ReedJones\Vuexcellent\Test\Models\ExtendedUserDefaults;

class ExtendedUserDefaultsTest extends TestCase
{
    public function test_an_extended_model_with_defaults_saves_to_module() {
        ExtendedUserDefaults::find(1)->toVuex();

        $this->assertVuex(
            [
                'modules' => [
                    'users' => [
                        'state' => [ 'activeUser' => ExtendedUserDefaults::find(1)->toArray() ]
                    ]
                ]
            ]
        );
    }

    public function test_all_trait_models_without_defaults_saves_to_state()
    {
        ExtendedUserDefaults::all()->toVuex();

        $this->assertVuex(
            [
                'modules' => [
                    'users' => [
                        'state' => [
                            'allUsers' =>  ExtendedUserDefaults::all()->toArray()
                        ]
                    ]
                ]
            ]
        );
    }

    public function test_an_extended_model_with_specified_module_saves_to_module() {
        ExtendedUserDefaults::find(1)->toVuex('users', 'testUser');

        $this->assertVuex(
            [
                'modules' => [
                    'users' => [
                        'state' => [ 'testUser' => ExtendedUserDefaults::find(1)->toArray() ]
                    ]
                ]
            ]
        );
    }


    public function test_all_trait_models_with_specified_module_saves_to_module()
    {
        ExtendedUserDefaults::all()->toVuex('users', 'allUsers');

        $this->assertVuex(
            [
                'modules' => [
                    'users' => [
                        'state' => [
                            'allUsers' => ExtendedUserDefaults::all()->toArray()
                        ]
                    ]
                ]
            ]
        );
    }
}
