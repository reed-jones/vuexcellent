<?php

namespace ReedJones\Vuexcellent\Models;

use ReedJones\Vuexcellent\Traits\Vuexable;
use Illuminate\Database\Eloquent\Model as BaseModel;
use ReedJones\Vuexcellent\Interfaces\CanVuex;

/**
 * This base model comes PreEquipped with Vuexable.
 * If desired all models can the extended from here,
 * instead of adding the trait. No pressure.
 */
class Model extends BaseModel implements CanVuex
{
    use Vuexable;
}
