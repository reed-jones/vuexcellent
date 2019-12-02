# Usage

## Adding Data
The `Vuex` facade has a simple API.

`new in v2.0.0` state and module are exposed on the facade itself.
```php
Vuex::state([
    'count' => 5,
    'numbers' => [
        'even' => [0, 2, 4, 6, 8],
        'odd' => [1, 3, 5, 7, 9]
    ]
]);

// Can be called multiple times, state/modules will be merged
Vuex::state([
    'numbers' => [
        'random' => 5
    ]
]);

// To add or update modules state
Vuex::module('moduleName', [
    'data' => 'goes here'
]);
```

`New in v2.0.0`
Collections can be quickly added to the vuex store using the `->toVuex($namespace, $key)` macro
```php
User::all()->toVuex('users', 'all'); // saves to this.$store.state.users.all
User::where('is_client', false)->get()->toVuex('clients', 'all'); // saves to this.$store.state.clients.all
```

`New in v2.0.0`
Models using the `Vuexable` trait can use the same `->toVuex()` interface above, with the ability to set default namespaces & keys.
```php
// User.php
use ReedJones\Vuexcellent\Traits\Vuexable;
//...
class User extends Authenticatable
{
    uses Vuexable;

    protected $vuex = [
        'namespace' => 'users',
        'model' => 'active',
        'collection' => 'all'
    ];
}

// Somewhere in a Controller (Or anywhere really)...
User::find(1)->toVuex(); // this.$store.state.users.active
User::all()->toVuex(); // this.$store.state.users.all
```


`version 1.0.0`
```php
// Creating or adding to the current store instance
Vuex::store(function($store) {

    // To add data to the root state object
    $store->state([
        // Array's and Collections are acceptable
        'count' => 5,
        'numbers' => [
            'even' => [0, 2, 4, 6, 8],
            'odd' => [1, 3, 5, 7, 9]
        ]
    ]);

    // To add or update modules state
    $store->module('moduleName', [
        'data' => 'goes here'
    ]);
});
```

## API Responses

`New in v2.0.0`
The ->vuex response macro has been added which automatically adds all data currently in storage to the api response. This accepts all the same arguments  as the ->json response, in the event you need to pass other non-vuex data.
```php
return response()->vuex();

return response()->vuex([
    'other_data' => 'not in vuex'
], 201);
```

`v1.0.0`
For usage in Api calls, the returned response must include the Vuex data as `$vuex`.

```php
return response()->json([
    '$vuex' => Vuex::asArray()
]);
```

For convenience, a helper is supplied which contains the above snippet.
```php
return Vuex::asResponse();
```

## Blade Templates

Assuming you have used the `@vuex` directive, and everything is installed properly, your initial vuex state should already be in place on page load.

If not using the directive, you will need to set `window.__INITIAL_STATE__` manually. The `Vuex::asArray()` or `Vuex::asJson()` accessors may be of use. Again, this should not be needed if you are using the `@vuex` directive, but is documented here for completeness.

```html
<script>window.__INITIAL_STATE__ = {!! Vuex::asJson() !!}</script>
```

With that in place, and auto-commit enabled, all saved data should be committed the the vuex store automatically. As with regular vuex, after the initial page load, new keys may not be added to the state object. The built in commits are rather blunt and simply overwrite the existing data, however in practice this works quite well for refreshing data from the database for example.
