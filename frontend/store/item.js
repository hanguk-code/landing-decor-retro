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

    // this.basket = JSON.parse(window.localStorage.getItem('basket'))
    // this.cartData = JSON.parse(window.localStorage.getItem('cartData'))
    // this.totalPrice = JSON.parse(window.localStorage.getItem('totalPrice'))

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

        if (process.browser) {
            window.localStorage.setItem('basket', JSON.stringify(state.basket))
            window.localStorage.setItem('totalPrice', JSON.stringify(state.totalPrice))
            window.localStorage.setItem('cartData', JSON.stringify(state.cartData))
        }
    },
    SET_CATEGORIES(state, categories) {
        state.categories = categories
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
}
