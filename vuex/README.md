# Vuexcellent

Vuexcellent is an easy to use way to load data from your Laravel backend to your Vuex managed front end. For more info visit [Vuexcellent](https://vuexcellent.netlify.com/)

This is the repo containing the Vue.js component of Vuexcellent.

## Vue.js installation

```sh
npm install @j0nz/vuexcellent
yarn add @j0nz/vuexcellent
```

Now just use `@j0nz/vuexcellent` instead of `vuex` when you are creating your store.

```js
import Vuex, { Store } from '@j0nz/vuexcellent'

const store = new Store({
    //...
```

All vuex options are re-exported from vuexcellent for ease of use. For example:

```js
import { mapState } from '@j0nz/vuexcellent'
```
