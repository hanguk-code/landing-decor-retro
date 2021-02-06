// state
export const state = () => ({
    cartData: null,
})

// getters
export const getters = {
    cartData: state => state.cartData,
}

// mutations
export const mutations = {
    SET_CART_ITEM (state, cartData) {
        state.cartData = cartData
    },
}

// actions
export const actions = {
    saveCartItem ({ commit, dispatch }, { cartData }) {
        commit('SET_CART_ITEM', cartData)
    },
}
