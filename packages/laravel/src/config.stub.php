<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Vuex Collection Storage
    |--------------------------------------------------------------------------
    |
    | When ->toVuex() is called on an acceptable collection instance (on made
    | up of vuexable models), this is the default key name that it will be
    | stored in. It can be overriden on a per model bases, or called
    | dynamically as the second argument in the ->toVuex() call,
    | (the first being the namespace)
    |
    | ->toVuex('users', 'allUsers'); // available at this.$store.state.users.allUsers
    | ->toVuex(null, 'allUsers'); // available at this.$store.state.allUsers
    */
    'collection' => 'all',

    /*
    |--------------------------------------------------------------------------
    | Default Vuex Model Storage
    |--------------------------------------------------------------------------
    |
    | When ->toVuex() is called on an available model instance, (one that
    | is has the Vuexable trait) the default key name that it will be
    | stored in. As with Collections, It can be overriden on a per
    | model bases, or called dynamically as the second argument
    | in the ->toVuex() call, (the first being the namespace)
    |
    | ->toVuex('users', 'activeUser'); // available at this.$store.state.users.activeUser
    | ->toVuex(null, 'user'); // available at this.$store.state.user
    */
    'model'      => 'active'
];
