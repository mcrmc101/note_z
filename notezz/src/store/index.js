import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [createPersistedState({
    storage: {
      getItem: (key) => Cookies.get(key),
      // Please see https://github.com/js-cookie/js-cookie#json, on how to handle JSON.
      setItem: (key, value) =>
        Cookies.set(key, value, { expires: 7, secure: true }),
      removeItem: (key) => Cookies.remove(key)
    }
  })],
  state: {
    usertoken: '',
    isuser: false,
    hascats: 0,
    cats: '',
    file: null,
    selectedCat: ''
  },
  mutations: {
    settoken (state, token) {
      state.usertoken = token
    },
    sethascats (state, hascat) {
      state.hascats = hascat
    },
    setcats (state, cats) {
      state.cats = cats
    },
    setfile (state, file) {
      state.file = file
    },
    setSelectedCat (state, cat) {
      state.selectedCat = cat
    }
  },
  actions: {
  },
  modules: {
  }
})
