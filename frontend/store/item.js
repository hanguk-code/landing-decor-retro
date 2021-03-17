// state
export const state = () => ({
    cartData: null,
    basket: [],
    totalPrice: 0,
})

// getters
export const getters = {
    cartData: state => state.cartData,
    basket: state => state.basket,
    totalPrice: state => state.totalPrice,
}

// mutations
export const mutations = {
    SET_CART_ITEM (state, cartData) {
        state.basket.push(cartData)
        state.totalPrice += parseFloat(cartData.price)
        state.cartData = cartData
    },
}

// actions
export const actions = {
    saveCartItem ({ commit, dispatch }, { cartData }) {
        commit('SET_CART_ITEM', cartData)
    },
}
