// state
export const state = () => ({
    cartData: null,
    basket: [],
    totalPrice: 0,
    categories: []
})

// getters
export const getters = {
    cartData: state => state.cartData,
    basket: state => state.basket,
    totalPrice: state => state.totalPrice,
    categories: state => state.categories,
}

// mutations
export const mutations = {
    SET_CART_ITEM(state, cartData) {
        state.basket.push(cartData)
        state.totalPrice += parseFloat(cartData.price)
        state.cartData = cartData

        if (process.browser) {
            window.localStorage.setItem('basket', JSON.stringify(state.basket))
            window.localStorage.setItem('totalPrice', JSON.stringify(state.totalPrice))
            window.localStorage.setItem('cartData', JSON.stringify(state.cartData))
        }
    },
    SET_CATEGORIES(state, categories) {
        state.categories = categories
    },
    RESTORE_BASKET(state, basket, cartData, totalPrice) {
        state.basket = basket
        state.cartData = cartData
        state.totalPrice = totalPrice
    },
    REMOVE_FROM_BASKET(state, id) {
        // state.basket
    },
}

// actions
export const actions = {
    saveCartItem({commit, dispatch}, {cartData}) {
        commit('SET_CART_ITEM', cartData)
    },
    saveCategories({commit, dispatch}, {categories}) {
        commit('SET_CATEGORIES', categories)
    },
    restoreBasket({commit, dispatch}, {basket, cartData, totalPrice}) {
        commit('RESTORE_BASKET', basket, cartData, totalPrice)
    },
    removeFromBasket({commit, dispatch}, {id}) {
        commit('REMOVE_FROM_BASKET', id)
    },
}
