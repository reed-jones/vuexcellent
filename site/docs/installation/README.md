# Installation

Installation of vuexcellent is primarily a two step process. This is split up between the front end, and backend. Although it is possible to use each independently and down the road the possibility exists to have multiple backends to choose from depending on your server environment, at this time Laravel is the only supported backed.

## TLDR
```sh
composer require vuexcellent/laravel
yarn add @vuexcellent/vuex
```
```html
<!-- layout.blade.php -->
<head>
  <title>Vuexcellent Docs</title>
  @vuex
</head>
```
```js
// store.js
import Vuex, { Store } from '@vuexcellent/vuex'
import axios from 'axios'
Vue.use(Vuex, { axios })

const store = new Store({
    //...
```

## Backend - Laravel
```sh
composer require vuexcellent/laravel
```
Next, its recommended to add the `@vuex` directive into your head tag. This isn't required if you are planning on passing all data via API calls, but its an easy step and can make for a nicer experience when all the data is already loaded on page load.
```html
<head>
  <title>Vuexcellent Docs</title>
  @vuex
</head>
```

Out of the box `ReedJones\Vuexcellent\Facades\Vuex` is aliased as `Vuex` to make usage as easy as possible.

## Frontend - Vue
```sh
yarn add @vuexcellent/vuex
# Or
npm install @vuexcellent/vuex
```

Next is to import store from `@vuexcellent/vuex` instead of `vuex` when you are creating your store. This uses the actual Vuex to create the store, it just sets up the vuexcellent helpers first :)
By default auto-mutations are enabled (these will be discussed later), but this feature requires access to axios. This can either be attached to the window, or a passed in as an object.

```js
import Vue from 'vue'
import Vuex, { Store } from '@vuexcellent/vuex'
import axios from 'axios'
Vue.use(Vuex, { axios })

const store = new Store({
    //...
```
Alternatively...
```js
const Vue = require('vue')
const Vuex = require('@vuexcellent/vuex')
window.axios = require('axios')
Vue.use(Vuex)

const store = new Vuex.Store({
    //...
```
Auto Mutations can be explicitly disabled via a config option
```js
Vue.use(Vuex, {
    autoMutate: false
})
```
