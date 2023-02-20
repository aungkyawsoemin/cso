import axios from "axios";

const state = {
    quiz: [],
    page: 1,
    keyword: '',
};

const mutations = {
    setQuiz(state, item) {
        state.quiz = item;
    },
}

const actions = {
    fetchQuiz({commit}) {
        return axios.get("https://cso.bahomart.com/api/quiz",
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

    }
}

const getters = {
    quiz: (state) => state.quiz
};

export default {
    state,
    mutations,
    getters,
    actions
};