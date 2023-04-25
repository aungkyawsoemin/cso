<template>
    <main class="flex-shrink-0 py-5 container" v-if="quiz != undefined">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-lg-12" v-if="questionIndex === undefined">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img :src="quiz.thumbnail_url" class="img-fluid rounded-start" alt="thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">{{ quiz.name }}</h5>
                                        <p class="card-text mb-5">{{ quiz.description }}</p>
                                        <p class="card-text mt-3"><small class="text-muted">{{ totalPoints() }} points</small>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="eightbit-btn" @click="questionIndex = 0">
                                            Let's start
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" v-else>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <progress id="file" :max="this.quiz.questions.length" :value="questionIndex + 1"></progress>
                                <div class="col-md-4">
                                    <button class="point mt-3" :class="{ 'bounce': showBounce }">{{ point
                                    }}<br><em>Points</em></button>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">{{ question.title }}</h5>
                                        <ul class="list-group"
                                            v-if="[CONSTANTS.QUESTION_TYPE_SINGLE, CONSTANTS.QUESTION_TYPE_MULTIPLE].includes(question.type)"
                                            :class="{ 'restricted': showDescription !== undefined }">
                                            <li class="list-group-item" v-for="list in question.items" :key="list.id">
                                                <input class="form-check-input"
                                                    :type="question.type === 0 ? 'radio' : 'checkbox'"
                                                    :name="'item_' + list.id" :id="'item_' + list.id" :value="list.id"
                                                    v-model="selectedItem">
                                                <label class="form-check-label" :for="'item_' + list.id"><span
                                                        v-if="showDescription !== undefined">{{
                                                            list.is_correct ? '✅' : '❌'
                                                        }}</span>{{ list.name }}</label>
                                            </li>
                                        </ul>
                                        <select class="form-select" :class="{ 'restricted': showDescription !== undefined }"
                                            v-if="question.type === CONSTANTS.QUESTION_TYPE_DROPDOWN"
                                            v-model="selectedItem">
                                            <option :value="0" selected disabled hidden>Select your answer</option>
                                            <option v-for="list in question.items" :key="list.id" :value="list.id">
                                                <span v-if="showDescription !== undefined">{{ list.is_correct ? '✅' : '❌'
                                                }}</span>{{ list.name }}
                                            </option>
                                        </select>
                                        <div class="mt-3" style="min-height: 100px;">
                                            <template v-if="showDescription !== undefined">
                                                <p>{{ answer }}</p>
                                                <div class="alert alert-primary" role="alert">
                                                    {{ showDescription }}
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="card-footer py-3">
                                        <button class="eightbit-btn" @click="check()"
                                            :disabled="selectedItem.length === 0 || selectedItem == 0"
                                            v-show="showDescription === undefined">Check</button>
                                        <button class="eightbit-btn eightbit-btn--proceed" @click="next()"
                                            v-show="showDescription !== undefined">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { inject } from 'vue';

export default {
    name: "QuizDetail",
    inject: ['CONSTANTS'],
    data() {
        return {
            id: this.$route.params.id,
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

            if (temp.length === correctAnswer.length) {
                this.point += this.question.score;
                this.showBounce = true;
                return '✅ Your answer is correct.';
            } else if(temp.length > 0 && temp.length < correctAnswer.length) {
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
            if (this.question.type == this.CONSTANTS.QUESTION_TYPE_DROPDOWN) this.selectedItem = 0;
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
main {
    min-height: 100vh;
}
.restricted {
    cursor: no-drop !important;
    opacity: 0.7;
    background-color: gray;
}

.restricted input,
.restricted label {
    pointer-events: none !important;
}
.card-footer {
    background-color: unset;
    border-top: unset;
}
em {
    font-size: 8px;
    display: block;
    margin-top: -12px;
}

input.form-check-input {
    margin-right: 10px;
    margin-top: 6px;
}
label.form-check-label {
    width: 80%;
}
</style>