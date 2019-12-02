# Api Reference

Namespace:
```php
use ReedJones\Vuexcellent\Facades\Vuex;
```

## Facade Methods

```php
Vuex::store(Closure $closure);
```

Passing a Closure function to the static `store` method, will receive an injected Vuex instance that can be used to update the end result vuex state.

Example:
```php
Vuex::store(function($store) {
    // update $store
    // $store->state(array $data);
    // $store->module(string $namespace, array $data);
});
```

---

```php
Vuex::state(array|Collection $state);
```
Merges `$state` to the base vuex state object. `state` accepts a single argument which can be either an `array`, or a Laravel Collection (`\Illuminate\Support\Collection`);

Example:
```php
Vuex::state(['is_admin' => false]);
```

---

```php
Vuex::module(string $namespace, array|Collection $state);
```
Merges `$state` into the `$naamespace`'d vuex module. `module` accepts two arguments. The first is a string, and will be used as the vuex module name. The second is an `array` or `\Illuminate\Support\Collection` which will be used as the state for the module.

Example:
```php
Vuex::module('users', ['all' => User::all()]);
```

---

```php
$data = Vuex::asArray();
```
Formats all currently supplied data into an array matching Vuex hierarchy, for easy merging.

---
```php
$json = Vuex::asJson();
```
Same as the above `asArray` however Json encoded.

---

```php
return Vuex::asResponse();
```
Returns a response properly formatted to be picked up by the auto-mutators on the front-end.

---

## Blade Directives
```
@vuex
```

Behind the scenes `@vuex` expands into

```php
<script id='initial-state'>
    window.__INITIAL_STATE__ = <?php echo ReedJones\Vuexcellent\Facades\Vuex::asJson(); ?>
</script>
```
---

```
@app
```

`@app` is just a shorthand for `<div id="app"></div>`

## Configuration Options
Configuration Options to be supplied when first instantiating Vuexcellent.
```js
Vue.use(Vuex, options)
```
---

```
options.autoMutate
```
True by default. Expects a boolean value. Enables auto mutations in response to api calls.

---

```
options.axios
```
Axios instance. In order for auto-mutate to work, axios must be made available. This option allows providing an instance. Alternatively, axios may be attached to the window `window.axios = axios`

---

```
options.mutationPrefix
```
String. This is the prefix used for all generated mutations to avoid namespace collisions. Defaults to `X_SET`. It is unlikely that this will be needed to change, however it is exposed as an advanced option.

## Model/Collection Methods

```php
$model->toVuex()
```
Saves the current `Model` or `Collection` to the vuex store, with optional (but often used) namespace & key overrides.

Example:
```php
$users->toVuex('users', 'all');
// Saves '$users' to this.$store.state.users.all

$posts->toVuex('blog', 'posts');
// Saves '$posts' to this.$store.state.blog.posts

Auth::user()->toVuex('users'); // uses default 'active' key for a model
// saves Currently logged in user to this.$store.state.users.active
```
