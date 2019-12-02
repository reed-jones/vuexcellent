# Vuexcellent

Vuexcellent is an easy to use way to load data from your Laravel backend to your Vuex managed front end. For more info visit [Vuexcellent](https://vuexcellent.netlify.com/)

This is the repo containing the Vue.js component of Vuexcellent.

## Vue.js installation

```sh
npm install @vuexcellent/vuex
yarn add @vuexcellent/vuex
```

Now just use `@vuexcellent/vuex` instead of `vuex` when you are creating your store.

```js
import Vuex, { Store } from '@vuexcellent/vuex'

const store = new Store({
    //...
```

All vuex options are re-exported from vuexcellent for ease of use. For example:

```js
import { mapState } from '@vuexcellent/vuex'
```
