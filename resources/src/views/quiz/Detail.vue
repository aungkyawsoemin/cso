<template>
    <main class="px-3 text-center border-box py-5 px-5 w-80 mx-auto">
        <template v-if="quiz != undefined">
            <template v-if="questionIndex === undefined">
                <h3 class="fw-bold lh-1">{{ quiz.name }}</h3>
                <img :src="quiz.thumbnail_url" class="img-fluid rounded-start rounded-end mt-3" alt="thumbnail"
                    style="height: 150px;">
                <p class="lead mt-4">{{ quiz.description }}</p>
                <p class="lead mb-5">
                    <button @click="questionIndex = 0" type="button" class="btn btn-lg fw-bold mt-3">Let's start</button>
                </p>
            </template>
            <template v-else>
                <progress id="file" :max="this.quiz.questions.length" :value="questionIndex + 1"></progress>
                <h3 class="fw-bold lh-1">{{ question.title }}</h3>

                <img :src="question.thumbnail_url" class="img-fluid rounded-start rounded-end mt-3" alt="thumbnail"
                    style="height: 150px;">

                <div :class="{ 'restricted': showDescription !== undefined }">
                    <ul class="list-group"
                        v-if="[CONSTANTS.QUESTION_TYPE_SINGLE, CONSTANTS.QUESTION_TYPE_MULTIPLE].includes(question.type)">
                        <li class="list-group-item" v-for="list in question.items" :key="list.id">
                            <input class="form-check-input" :type="question.type === 0 ? 'radio' : 'checkbox'"
                                :name="'item_' + list.id" :id="'item_' + list.id" :value="list.id" v-model="selectedItem">
                            <label class="form-check-label" :for="'item_' + list.id"><span
                                    v-if="showDescription !== undefined">{{
                                        list.is_correct ? '✅' : '❌'
                                    }}</span>{{ list.name }}</label>
                        </li>
                    </ul>
                    <select class="form-select" :class="{ 'restricted': showDescription !== undefined }"
                        v-if="question.type === CONSTANTS.QUESTION_TYPE_DROPDOWN" v-model="selectedItem">
                        <option :value="0" selected disabled hidden>Select your answer</option>
                        <option v-for="list in question.items" :key="list.id" :value="list.id">
                            <span v-if="showDescription !== undefined">{{ list.is_correct ? '✅' : '❌'
                            }}</span>{{ list.name }}
                        </option>
                    </select>
                </div>

                <template v-if="showDescription !== undefined">
                    <p>{{ answer }}</p>
                    <div class="alert alert-primary" role="alert">
                        {{ showDescription }}
                    </div>
                </template>
                <div class="card-footer py-3">
                    <button class="btn" @click="check()" :disabled="selectedItem.length === 0 || selectedItem == 0"
                        v-show="showDescription === undefined">Check</button>
                    <button class="btn" @click="next()" v-show="showDescription !== undefined">Next</button>
                </div>
            </template>
        </template>
    </main>
</template>

<script>
import { inject } from 'vue';

export default {
    name: "QuizDetail",
    inject: ['CONSTANTS'],
    data() {
        return {
            id: 1,
            loading: false,
            quiz: undefined,
            questionIndex: undefined,
            selectedItem: [],
            showDescription: undefined,
            point: 0,
            showBounce: false
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
            var correctAnswer = this.question.items.filter(x => (x.is_correct === 1));
            console.log(temp.length);
            console.log(correctAnswer.length);
            if (temp.length === correctAnswer.length) {
                this.point += this.question.score;
                this.showBounce = true;
                return '✅ Your answer is correct.';
            } else if (temp.length > 0 && temp.length < correctAnswer.length) {
                return '⚠️ Your answer is incomplete.';
            }
            return '❌ Your answer is incorrect.'
        }
    },
    async mounted() {
        const CONSTANTS = inject('CONSTANTS');
        await this.$store.dispatch("fetchQuiz");
        this.quiz = this.quizList.find(x => x.id == this.id);
        this.reset();
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
            this.reset();
        },
        reset() {
            if (this.question != undefined && this.question.type == this.CONSTANTS.QUESTION_TYPE_DROPDOWN) this.selectedItem = 0;
            else this.selectedItem = [];
            this.showDescription = undefined;
            this.showBounce = false;
        },
        totalPoints() {
            return this.quiz.questions.reduce((total, object) => {
                return total + object.score;
            }, 0);
        },
        showCountdown(i) {

        }
    }
}
</script>

<style scoped>
.btn:disabled {
    text-decoration: line-through;
    color: #b2b2b2 !important;
    cursor: not-allowed !important;
}

.restricted {
    cursor: no-drop !important;
    opacity: 0.7;
    border: 3px dashed gray;
}

.restricted input,
.restricted label {
    pointer-events: none !important;
}
</style>