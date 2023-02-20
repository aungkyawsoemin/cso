const state = {
    count: 1
};

const mutations = {
    setCount(state, item) {
        state.count = item;
    },
}

const actions = {
    plusCount({ commit }) {
        commit('setCount', state.count + 1)
    },
    minusCount({ commit }) {
        commit('setCount', state.count - 1)
    }
}

const getters = {
    count: (state) => state.count
};

export default {
    state,
    mutations,
    getters,
    actions
};