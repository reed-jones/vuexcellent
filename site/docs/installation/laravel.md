# Laravel installation

```sh
composer require reed-jones/vuexcellent
```

Out of the box, `ReedJones\Vuexcellent\VuexcellentServiceProvider` should be automatically registered, and `ReedJones\Vuexcellent\Facades\Vuex` should be aliased as `Vuex`.

All thats left before moving to the javascript is to add the injection point. Go to the `<head>` section of your blade file and add the blade directive `@vuex`

```html
<head>
  <title>Vuexcellent Docs</title>
  @vuex
</head>
```

Now any data stored on the Laravel side in 'Vuex' will be made immediately available in Vue.js upon page load.
