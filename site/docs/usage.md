# Usage

The `Vuex` facade has a simple API.

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

Assuming you have used the `@vuex` directive, and everything is installed properly, your initial vuex state should already be in place. If not, you will need to set `window.__INITIAL_STATE__` manually. The `Vuex::asArray()` or `Vuex::asJson()` accessors may be of use. Again, this should not be needed if you are using the `@vuex` directive, but is documented here for completeness.

```html
<script>window.__INITIAL_STATE__ = {!! Vuex::asJson() !!}</script>
```

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

With that in place, and auto-commit enabled, all saved data should be committed the the vuex store automatically. As with regular vuex, after the initial page load, new keys may not be added to the state object. The built in commits are rather blunt and simply overwrite the existing data, however in practice this works quite well for refreshing data from the database for example.
