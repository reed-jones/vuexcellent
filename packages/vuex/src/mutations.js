/**
 *
 * @param {Object} options Vuexcellent options
 * @param {String} mutationPrefix prefix mutations to avoid namespace collisions
 */
export const mutantGenerator = ({ mutationPrefix }) => {

    /** Retrieves mutation name base on key */
    const getMutation = (key, ns = null) => ns ? `${ns}/${mutationPrefix}_${key.toUpperCase()}` : `${mutationPrefix}_${key.toUpperCase()}`

    /** Default mutation */
    const newMutation = key => new Function('state', 'val', `state.${key} = val`)

    /** Creates mutations based in state keys */
    const generateMutations = ({ state = {}, mutations = {} }) => Object.keys(state).reduce((acc, key) => ({ ...acc, [getMutation(key)]: newMutation(key) }), mutations)

    /**
     * Recursive (through modules) mutation creation
     *
     * @param {Object} mod vuex module
     *
     * @return {Object} updated vuex module
     */
    const createMutant = mod => {
        mod.mutations = generateMutations(mod)

        Object.entries(mod.modules || {}).forEach(([key, _]) => {
            const { [key]: data } = mod.modules
            mod.modules[key].mutations = generateMutations(data)
            mod.modules[key] = createMutant(data)
        });

        return mod;
    }

    return { createMutant, getMutation }
}
