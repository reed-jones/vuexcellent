<?php

namespace ReedJones\Vuexcellent\Test\Models;

use ReedJones\Vuexcellent\Models\Model;

class ExtendedUser extends Model
{
    protected $table = 'users';

    protected $guarded = [];
}
