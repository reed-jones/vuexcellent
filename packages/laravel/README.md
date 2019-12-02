# Vuexcellent

Vuexcellent is an easy to use way to load data from your Laravel backend to your Vuex managed front end. For more info visit [Vuexcellent](https://vuexcellent.netlify.com/)

This is the repo containing the Laravel component of Vuexcellent.

# Laravel installation

```sh
composer require vuexcellent/laravel
```

Out of the box, `ReedJones\Vuexcellent\VuexcellentServiceProvider` should be automatically registered, and `ReedJones\Vuexcellent\Facades\Vuex` should be aliased as `Vuex`.

All thats left before moving to the javascript is to add the injection point. Go to the `<head>` section of your blade file and add the blade directive `@vuex`

```html
<head>
  <title>Vuexcellent Docs</title>
  @vuex
</head>
```
