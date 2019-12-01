<?php

namespace ReedJones\Vuexcellent\Test\Models;

use ReedJones\Vuexcellent\Models\Model;

class ExtendedUserDefaults extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    protected $vuex = [
        'namespace' => 'users',
        'model' => 'activeUser',
        'collection' => 'allUsers'
    ];
}
