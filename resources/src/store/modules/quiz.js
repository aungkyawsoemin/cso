import axios from "axios";

const state = {
    quiz: [],
    page: 1,
    keyword: '',
    result: {
        correct: 0,
        incorrect: 0,
        incomplete: 0
    }
};

const mutations = {
    setQuiz(state, item) {
        state.quiz = item;
    },
    setResult(state, item) {
        state.result = item;
    },
    resetResult(state) {
        state.result = {
            correct: 0,
            incorrect: 0,
            incomplete: 0
        }
    }
}

const actions = {
    fetchQuiz({commit}) {
        return axios.get("/api/quiz",
            {
                headers: {
                    Authorization: "Basic dmdURW1aYkxaT0tiMVo3enVMdHc6WA==",
                    "Content-Type": "application/json"
                }
            })
            .then(({data}) => {
              commit("setQuiz", data.data);
            })
            .catch((err) => console.error(err));

    },
    updateResult({commit}, data) {
        commit("setResult", data);
    },
    resetResult({commit}) {
        commit("resetResult")
    }
}

const getters = {
    quiz: (state) => state.quiz,
    result: (state) => state.result
};

export default {
    state,
    mutations,
    getters,
    actions
};