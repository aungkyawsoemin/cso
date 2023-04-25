import { uuid } from 'vue-uuid'; 
import axios from "axios";

const state = {
    count: 1,
    user: {
        id: undefined,
        uuid: undefined,
        division: undefined,
        occupication: undefined,
        gender: undefined,
        age: undefined,
        ethnicity: undefined,
        updateAt: undefined
    }
};

const mutations = {
    setCount(state, item) {
        state.count = item;
    },
    setUser(state, item) {
        
        state.user = item;
    }
}

const actions = {
    plusCount({ commit }) {
        commit('setCount', state.count + 1)
    },
    minusCount({ commit }) {
        commit('setCount', state.count - 1)
    },
    getUser({commit}) {
        if(localStorage.userId == undefined) {
            state.user.uuid = localStorage.userId = uuid.v4();
            axios.post("/api/cso-user/"+state.user.uuid, state.user,
            {
                headers: {
                    Authorization: "Basic dmdURW1aYkxaT0tiMVo3enVMdHc6WA==",
                    "Content-Type": "application/json"
                }
            })
            .then(({data}) => {
                commit('setUser', data.data)
            })
            .catch((err) => console.error(err));
        } else {
            state.user.uuid = localStorage.userId
            axios.get("/api/cso-user/"+state.user.uuid,
            {
                headers: {
                    Authorization: "Basic dmdURW1aYkxaT0tiMVo3enVMdHc6WA==",
                    "Content-Type": "application/json"
                }
            })
            .then(({data}) => {
                commit('setUser', data.data)
            })
        }
    }
}

const getters = {
    count: (state) => state.count,
    user: (state) => state.user
};

export default {
    state,
    mutations,
    getters,
    actions
};