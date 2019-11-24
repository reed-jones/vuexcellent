/**
 * iterates through updated store values & attempts to auto-commit them
 *
 * @param {Object} store server supplied vuex updates
 */
const commitData = ({ store, mutator, _state }, { state = {}, modules = {} }) => {
    // Commit base state changes
    Object.entries(state).forEach(([key, value]) => { store.commit(mutator(key), value) })

    // Commit 1-level deep module state changes
    Object.entries(modules).forEach(([name, data]) => {
        Object.entries(data.state || {}).forEach(([key, value]) => {
            const mod = name.split('/').reduce((acc, n) => acc[n] || acc.modules[n], _state.modules)
            const { namespaced = false } = mod
            store.commit(mutator(key, namespaced && name), value)
        })
    })
}

/**
 * Axios interceptor Generator to automatically call mutations
 * and commit changed data. Sets up interceptor
 *
 * @param {Object} store initialized vuex store
 * @param {Object} _state raw vuex starting data
 * @param {Function} mutator function name generator
 *
 * @return {Function}
 */
export const autoMutateInterceptor = (store, _state, mutator) =>
    /**
     * Axios Interceptor. if $vuex key is present in response data,
     * an attempt is made to parse the state and modules and commit
     * any changes
     *
     * @param {Object} response axios response
     *
     * @return {Object} response
     */
    response => {
        if (response.data.$vuex) {
            try {
                // grab state & modules, if existing
                commitData({ store, _state, mutator }, response.data.$vuex)
            } catch (err) {
                console.error(err)
                console.error(`[Vuexcellent] An error occurred during the auto commit process.\nYour vuex state may not be what you expected.`)
            }
        }

        return response;
    }
