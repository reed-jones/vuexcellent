<?php

namespace ReedJones\Vuexcellent\Test;

use ReedJones\Vuexcellent\Facades\Vuex;

class BasicCollectionTest extends TestCase
{
    public function test_to_vuex_can_be_applied_to_arbitrary_collections()
    {
        collect([1, 2, 3, 4, 5])->toVuex('numbers', 'digits');

        $this->assertVuex(
            [
                'modules' => [
                    'numbers' => [
                        'state' => [ 'digits' => [1,2,3,4,5] ]
                    ]
                ]
            ]
        );
    }
}
