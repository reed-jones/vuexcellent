# Vue.js Installation

```sh
npm install @j0nz/vuexcellent
# or
yarn add @j0nz/vuexcellent
```

Now just use `@j0nz/vuexcellent` instead of `vuex` when you are creating your store.

```js
import Vue from 'vue'
import Vuex, { Store } from '@j0nz/vuexcellent'
Vue.use(Vuex)

const store = new Store({
    //...
```

In order to take advantage of auto-mutations, axios must be made available to Vuexcellent. This can be accomplished by either attaching axios to `window`
```js
window.axios = require('axios')
```
or by supplying axios in the initialization options
```js
Vue.use(Vuex, {
    axios: require('axios')
})
```
