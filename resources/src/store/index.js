import { createStore } from 'vuex';
import base from "./modules/base";
import quiz from "./modules/quiz";

export const store = createStore({
    modules: {
        base,
        quiz
    }
});