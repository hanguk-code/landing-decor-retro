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
    totalPrice: state => parseFloat(state.totalPrice),
    categories: state => state.categories,
}

// mutations
export const mutations = {
    CLEAR_BASKET(state) {
        state.basket = []
        state.totalPrice = 0
        state.cartData = null
    },
    SET_CART_ITEM(state, cartData) {
        let twice = false
        state.basket.forEach(function (value) {
            if (value.article === cartData.article) {
                twice = true
            }
        })

        if(twice){
            return false
        }

        state.basket.push(cartData)
        state.totalPrice += parseFloat(cartData.price.replace(/ /g, ''))
        state.cartData = null

        if (process.browser) {
            window.localStorage.setItem('basket', JSON.stringify(state.basket))
            window.localStorage.setItem('totalPrice', state.totalPrice)
            window.localStorage.setItem('cartData', JSON.stringify(state.cartData))
        }
    },
    SET_CATEGORIES(state, categories) {
        state.categories = categories
    },
    RESTORE_BASKET(state, basket) {
        state.basket = basket
    },
    RESTORE_TOTAL_PRICE(state, totalPrice) {
        state.totalPrice = totalPrice
    },
    REMOVE_FROM_BASKET(state, index) {
        state.basket.splice(index, 1)
        let tPrice = 0
        state.basket.forEach(function (value, index) {
            tPrice += parseFloat(value.price.replace(/ /g, ''))
        })
        state.totalPrice = parseFloat(tPrice)
        if (process.browser) {
            window.localStorage.setItem('basket', JSON.stringify(state.basket))
            window.localStorage.setItem('totalPrice', state.totalPrice)
        }
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
    restoreBasket({commit, dispatch}, {basket, totalPrice}) {
        commit('RESTORE_BASKET', basket)
        commit('RESTORE_TOTAL_PRICE', totalPrice)
    },
    removeFromBasket({commit, dispatch}, {index}) {
        commit('REMOVE_FROM_BASKET', index)
    },
    clearBasket({commit}) {
        commit('CLEAR_BASKET')
    },
}
