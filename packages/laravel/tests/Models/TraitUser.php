<?php

namespace ReedJones\Vuexcellent\Test\Models;

use Illuminate\Database\Eloquent\Model;
use ReedJones\Vuexcellent\Traits\Vuexable;

class TraitUser extends Model
{
    use Vuexable;

    protected $table = 'users';

    protected $guarded = [];
}
