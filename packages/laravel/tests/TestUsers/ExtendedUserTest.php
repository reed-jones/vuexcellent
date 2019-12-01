<?php

namespace ReedJones\Vuexcellent\Test;

use Vuex;
use ReedJones\Vuexcellent\Test\Models\ExtendedUser;

class ExtendedUserTest extends TestCase
{
    public function test_an_extended_model_without_defaults_saves_to_state() {
        ExtendedUser::find(1)->toVuex();

        $this->assertSame(
            Vuex::asArray(),
            [
                'state' => [ 'active' => ExtendedUser::find(1)->toArray() ]
            ]
        );
    }

    public function test_all_trait_models_without_defaults_saves_to_state() {
        ExtendedUser::all()->toVuex();

        $this->assertSame(
            Vuex::asArray(),
            [
                'state' => [
                    'all' =>  ExtendedUser::all()->toArray()
                ]
            ]
        );
    }


    public function test_an_extended_model_with_specified_module_saves_to_module() {
        ExtendedUser::find(1)->toVuex('users', 'testUser');

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => [ 'testUser' => ExtendedUser::find(1)->toArray() ]
                    ]
                ]
            ]
        );
    }

    public function test_all_trait_models_with_specified_module_saves_to_module() {
        ExtendedUser::all()->toVuex('users', 'allOtherUsers');

        $this->assertSame(
            Vuex::asArray(),
            [
                'modules' => [
                    'users' => [
                        'state' => [
                            'allOtherUsers' => ExtendedUser::all()->toArray()
                        ]
                    ]
                ]
            ]
        );
    }
}
