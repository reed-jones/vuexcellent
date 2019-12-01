<?php

namespace ReedJones\Vuexcellent\Test;

use Vuex;
use Route;

class VuexFacadeReturnTypesTest extends TestCase
{
    public function test_vuex_as_array_is_array()
    {
        $data = ['works' => true];

        Vuex::state($data);

        $this->assertSame(
            ['state' => $data],
            Vuex::asArray()
        );
    }

    public function test_vuex_as_json_is_json_string()
    {
        $data = ['works' => true];

        Vuex::state($data);

        $this->assertSame(
            '{"state":{"works":true}}',
            Vuex::asJson(),
        );
    }

    public function test_vuex_as_response_is_json_response()
    {
        Route::get('/get-json', function () {
            $data = ['works' => true];
            Vuex::state($data);
            return Vuex::asResponse();
        });

        $response = $this->get('/get-json');

        $response->assertJson(
            ['$vuex' => ["state" => ["works" => true] ] ]
        );
    }

    public function test_as_array_with_no_data_returns_empty_array() {
        $this->assertSame(
            [],
            Vuex::asArray()
        );
    }
}
