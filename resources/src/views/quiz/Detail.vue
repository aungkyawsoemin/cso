<template>
    <div v-if="quiz != undefined">
        <h1>
            Quiz Title - {{ quiz.name }} {{ selectedItem }}
        </h1>
        <p>{{ quiz.description }}</p>
        <img :src="quiz.thumbnail_url" width="150" />
        <hr />
        <progress id="file" :max="this.quiz.questions.length" :value="questionIndex + 1"></progress>
        <h2>Question - {{ question.title }}</h2>
        <p>{{ question.correct_description }}</p>
        <img :src="question.thumbnail_url" width="150" />
        <hr />
        <ul v-if="[CONSTANTS.QUESTION_TYPE_SINGLE, CONSTANTS.QUESTION_TYPE_MULTIPLE].includes(question.type)"
            :class="{ 'restricted': showDescription !== undefined }">
            <li v-for="list in question.items" :key="list.id">
                <input :type="question.type === 0 ? 'radio' : 'checkbox'" :name="'item_' + list.id" :id="'item_' + list.id"
                    :value="list.id" v-model="selectedItem">
                <label :for="'item_' + list.id"><span v-if="showDescription !== undefined">{{ list.is_correct ? '✅' : '❌'
                }}</span>{{ list.name }}</label>
            </li>
        </ul>
        <select v-if="question.type === CONSTANTS.QUESTION_TYPE_DROPDOWN" v-model="selectedItem">
            <option :value="0">Select your answer</option>
            <option v-for="list in question.items" :key="list.id" :value="list.id">
                <span v-if="showDescription !== undefined">{{ list.is_correct ? '✅' : '❌' }}</span>{{ list.name }}
            </option>
        </select>
        <div style="min-height: 55px;">
            <p v-if="showDescription !== undefined">{{ answer }} --- REASON:: {{ showDescription }}</p>
        </div>
        <button @click="check()" :disabled="selectedItem.length === 0" v-show="showDescription === undefined">Check</button>
        <button @click="next()" v-show="showDescription !== undefined">Next</button>
    </div>
</template>

<script>
import { inject } from 'vue'

export default {
    name: "QuizDetail",
    inject: ['CONSTANTS'],
    data() {
        return {
            id: this.$route.params.id,
            loading: false,
            quiz: undefined,
            questionIndex: 0,
            selectedItem: [],
            showDescription: undefined,
        };
    },
    computed: {
        count() {
            return this.$store.getters.count;
        },
        quizList() {
            return this.$store.getters.quiz;
        },
        question() {
            return this.quiz.questions[this.questionIndex];
        },
        answer() {
            var tempItem;
            if (typeof this.selectedItem !== 'object') tempItem = [this.selectedItem]
            else tempItem = this.selectedItem;

            var temp = this.question.items.filter(x => (tempItem.includes(x.id) && x.is_correct === 1));
            if (temp.length === tempItem.length) return '✅ Your answer is correct.';
            return '❌ Your answer is incorrect.'
        }
    },
    async mounted() {
        const CONSTANTS = inject('CONSTANTS')
        await this.$store.dispatch("fetchQuiz");
        this.quiz = this.quizList.find(x => x.id == this.id);
    },
    methods: {
        actionCount(sign) {
            this.quiz = this.quizList.find(x => x.id == this.id);
            if (sign === '+') this.$store.dispatch("plusCount");
            else this.$store.dispatch("minusCount");
        },
        check() {
            this.showDescription = this.question.correct_description;
        },
        next() {
            // check answer and show correct description;
            if (this.questionIndex < (this.quiz.questions.length - 1)) this.questionIndex += 1;
            else {
                this.$router.push({ name: 'QuizResult', params: { id: this.id } });
            }
            this.selectedItem = [];
            this.showDescription = undefined;
        }
    }
}
</script>

<style scoped>
.restricted {
    cursor: no-drop !important;
    opacity: 0.7;
    background-color: gray;
}

.restricted input,
.restricted label {
    pointer-events: none !important;
}</style>