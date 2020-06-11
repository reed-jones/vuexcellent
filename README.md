# Vuexcellent

---

> ⚠️⚠️⚠️ Deprecated ⚠️⚠️⚠️

This project has by and large been replaced by [Phase](https://phased.dev) - [reed-jones/phase](https://github.com/reed-jones/phase).

Phase expands on the ideas here, but expands beyond vuex integration, with the addition of Vue-Router integration. Phase is built with modularity in mind, so If you are not interested in Vue-Router integration and are only looking for Vuex Helpers, Phase still provides all the core vuexcellent utilities.


### Migration
To migrate to the vuex only configuration of Phase should be fairly straight forward.

```
composer remove vuexcellent/laravel
yarn remove @vuexcellent/vuex

composer require phased/state
yarn add @phased/state
```

Next, in `store.js` (assuming you have followed the 'official' vuexcellent docs)
```diff
// store.js
- import Vuex, { Store } from '@vuexcellent/vuex'
+ import Vuex, { Store } from 'vuex'
+ import { hydrate } from '@phased/state'

- import axios from 'axios'
- Vue.use(Vuex, { axios })
+ import axios from 'axios'
+ window.axios = axios;
+ Vue.use(Vuex)

- const store = new Store({
+ const store = new Store(hydrate({
    //...
```

Finally, in PHP, change all the Vuex namespaces
> Note: If you are using the alias `use Vuex`; then nothing needs to change.
```diff

- use ReedJones\Vuexcellent\Facades\Vuex;
+ use Phased\State\Facades\Vuex;

- use ReedJones\Vuexcellent\Traits\Vuexable;
+ use Phased\State\Traits\Vuexable;
```


---

## Links

- [Phase Docs](https://phased.dev)
- [reed-jones/phase](https://github.com/reed-jones/phase)
- [Phase Demo](https://github.com/reed-jones/phase-blog-demo)
- [reed-jones/phase-blog-demo](https://github.com/reed-jones/phase-blog-demo)
