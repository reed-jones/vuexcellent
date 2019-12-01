<?php

namespace ReedJones\Vuexcellent\Test\Models;

use Illuminate\Database\Eloquent\Model;
use ReedJones\Vuexcellent\Traits\Vuexable;

class TraitUserDefaults extends Model
{
    use Vuexable;

    protected $table = 'users';

    protected $guarded = [];

    protected $vuex = [
        'namespace' => 'users',
        'model' => 'activeUser',
        'collection' => 'allUsers'
    ];
}
