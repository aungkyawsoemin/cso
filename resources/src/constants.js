export default {
    install(Vue) {
      Vue.prototype.$constants = function() {
        return {
          "VERSION": "1.0.1",
        }
      }
    }
  }