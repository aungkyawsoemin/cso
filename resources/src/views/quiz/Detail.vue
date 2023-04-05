<template>
    <main class="border-box py-5 px-5 w-60 mx-auto">
        <template v-if="quiz != undefined">
            <template v-if="questionIndex === undefined">
                <img :src="quiz.thumbnail_url" class="img-fluid" alt="thumbnail">
                <div class="mx-auto py-3 px-5">
                    <h3 class="fw-bold lh-1 mt-2">{{ quiz.name }}</h3>
                    <p class="lead mt-4">{{ quiz.description }}</p>
                    <p class="lead mb-5">
                        <button @click="questionIndex = 0" type="button" class="btn btn-cso-primary mt-3">စတင်ဖြေဆိုမည်</button>
                    </p>
                </div>
            </template>
            <template v-else>
                <progress id="file" :max="this.quiz.questions.length" :value="questionIndex + 1"></progress>
                <img :src="quiz.thumbnail_url" class="img-fluid" alt="thumbnail">

                <div class="answer-box">
                    <h3 class="fw-bold lh-1 mb-3">{{ question.title }}</h3>
                    <p>အဖြေမှန်တစ်ခုကို ရွေးချယ်ပါ။</p>
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
                        <template v-if="answerType == 'success'">
                            <div class="alert mt-3" :class="{'alert-success': answerType == 'success'}" role="alert">
                                <p>{{ answer }}</p>
                                <p>{{ showDescription }}</p>
                            </div>
                        </template>
                        <template v-else>
                            <div class="alert mt-3" :class="{'alert-danger': answerType == 'error', 'alert-warning': answerType == 'warning'}" role="alert">
                                <p>{{ answer }}</p>
                            </div>
                            <div class="alert alert-success mt-3" role="alert">
                                <p>{{ showDescription }}</p>
                            </div>
                        </template>
                    </template>
                    <div class="card-footer py-3">
                        <button class="btn btn-cso-primary mx-auto mt-3" @click="check()" :disabled="selectedItem.length === 0 || selectedItem == 0"
                            v-show="showDescription === undefined" style="display: block;">စစ်ဆေးမည်</button>
                        <button class="btn btn-cso-primary mx-auto mt-3" @click="next()" style="display: block;" v-show="showDescription !== undefined">နောက်ထပ်</button>
                    </div>
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
            showBounce: false,
            answerType: '',
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
                this.answerType = "success";
                return '✅ မှန်ကန်ပါသည်။';
            } else if (temp.length > 0 && temp.length < correctAnswer.length) {
                this.answerType = "warning";
                return '⚠️ အဖြေမှန်အားလုံးကို ရွေးချယ်ထားခြင်းမရှိပါ။';
            }
            this.answerType = "error";
            return '❌ မှားယွင်းနေပါသည်။'
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


.border-box > div {
  background: #fff;
  border-radius: 0px 0px 10px 10px;
}
[data-bs-theme=dark] .border-box > div {
  background: transparent !important;
}

.answer-box {
  padding: 35px 70px;
}

.answer-box h3 {
  font-family: 'Noto Sans Myanmar';
  font-style: normal;
  font-weight: 700;
  font-size: 24px;
  line-height: 36px !important;
}
.btn:disabled {
    background-color: #D9D9D9 !important;
    color: rgba(34, 34, 34, 0.6) !important;
    cursor: not-allowed !important;
}

.alert p:nth-child(1) {
  margin-bottom: 5px;
}
.alert p:nth-child(2) {
  line-height: 28px;
  padding-left: 25px;
  padding-top: 0px;
}

.list-group li {
  margin-bottom: 16px;
  border-radius: 20px !important;
  padding: 8px 15px 10px;
  border: 0.8px solid grey;
  border-top-width: 0.8px !important;
}
.list-group li input {
  margin-top: 5px;
}
.list-group li label {
  margin-left: 8px;
}

.restricted {
    cursor: no-drop !important;
    opacity: 0.7;
}

.restricted input,
.restricted label {
    pointer-events: none !important;
}
</style>