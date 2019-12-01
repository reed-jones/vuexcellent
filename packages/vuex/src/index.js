import Vuex, * as vuexImports from 'vuex';
import { objectMerge } from './objectMerge';
import { autoMutateInterceptor } from './interceptor'
import { mutantGenerator } from './mutations'
export * from 'vuex'

/**
 * Default options. override using
 * Vue.use(Vuex, {
 *   autoMutate: true,
 *   axios: require('axios')
 * })
 */
let options = {
    autoMutate: true,
    axios: null,
    mutationPrefix: `X_SET`
}

/**
 * Extend the base Vuex store class to pull window.__INITIAL_STATE__ by default
 */
export class Store extends Vuex.Store {
    constructor(vuexState = {}, SSRState = window.__INITIAL_STATE__) {

        // merge in the initial state
        const mergedState = objectMerge(
            vuexState,
            SSRState
        );

        const { createMutant, getMutation } = mutantGenerator(options)

        // generate 'set' mutations for each state value if autoMutate is enabled
        const newState = options.autoMutate
            ? createMutant(mergedState)
            : mergedState

        // with our data now formatted and merged, use Vuex's original constructor
        // to create the store we know and love
        super(newState);

        // check if axios is available
        // its a requirement for auto-mutations
        const axios = options.axios || window.axios;

        if (!axios && options.autoMutate) {
            console.error('[Vuexcellent] It appears that auto-mutate could not be initialized.\nAn instance of axios could not be found.')
        }

        if (axios && options.autoMutate) {
            // register automatic mutation interceptors
            axios.interceptors.response.use(
                autoMutateInterceptor(this, newState, getMutation),
                error => Promise.reject(error)
            );
        }
    }
}

/**
 * Drop-in replacement for vuex that adds a handy static mergeState function.
 *
 * Merges initial vuex store (from .js files) with Laravel supplied data,
 * likely passed to window.__INITIAL_STATE__
 */
export default {
    // re-export all vuex api's
    ...vuexImports,

    // overwrite as needed
    Store,

    // install & auto install the plugin
    install(Vue, _options = {}) {
        // set available options
        options = {
            // defaults to all namespaced modules
            ...options,

            // overrides
            ..._options,
        };

        // install base Vuex package
        Vue.use(Vuex);
    }
};
