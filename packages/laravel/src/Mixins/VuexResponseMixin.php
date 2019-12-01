<?php

namespace ReedJones\Vuexcellent\Mixins;

use Exception;
use ReedJones\Vuexcellent\Facades\Vuex;

class VuexResponseMixin
{
    public function vuex()
    {
        return function (array $data = [], int $status = 200, array $headers = [], int $options = 0) {
            try {
                $data = array_merge(['$vuex' => Vuex::asArray()], $data);
                return $this->json($data, $status, $headers, $options);
            } catch (Exception $err) {
                return $this->json([
                    'vuexcellent' => $err->getMessage()
                ], 422);
            }
        };
    }
}
