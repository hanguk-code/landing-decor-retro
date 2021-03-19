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

    // basket: state => JSON.parse(window.localStorage.getItem('basket')),
    // totalPrice: state => JSON.parse(window.localStorage.getItem('totalPrice')),
    // cartData: state => JSON.parse(window.localStorage.getItem('cartData')),
}

// mutations
export const mutations = {
    SET_CART_ITEM(state, cartData) {
        state.basket.push(cartData)
        state.totalPrice += parseFloat(cartData.price)
        state.cartData = cartData

        // if (process.browser) {
        window.localStorage.setItem('basket', JSON.stringify(state.basket))
        window.localStorage.setItem('totalPrice', JSON.stringify(state.totalPrice))
        window.localStorage.setItem('cartData', JSON.stringify(state.cartData))
        // }
    },
}

// actions
export const actions = {
    saveCartItem({commit, dispatch}, {cartData}) {
        commit('SET_CART_ITEM', cartData)
    },
}
