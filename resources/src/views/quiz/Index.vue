<template>
    <main>
        <Skeleton v-if="quizList.length == 0"></Skeleton>
        <template v-if="quizList.length > 0">
            <template v-for="item in quizList">
                <div class="border-box py-md-5 px-md-5 pt-3 mt-3 mb-5 col-md-8 col-12 mx-auto">
                    <div class="mx-auto py-3 px-5">
                        <h3 class="fw-bold lh-1 mt-2">{{ item.name }}</h3>
                        <p class="lead mt-4">{{ item.description }}</p>
                        <p class="lead mb-3">
                            <button @click="startQuiz(item.id)" type="button" class="btn btn-cso-primary mt-3">ဝင်မည်</button>
                        </p>
                    </div>
                </div>
            </template>
        </template>
    </main>
</template>

<script>
import { inject } from 'vue';
import Skeleton from "../components/skeleton.vue";
import UserData from "../components/UserData.vue";

export default {
    name: "QuizDetail",
    inject: ['CONSTANTS'],
    components: {
        Skeleton,
        UserData
    },
    data() {
        return {
            id: 1,
            loading: false,
            quiz: undefined,
            quizzes: [],
            questionIndex: undefined,
            selectedItem: [],
            showDescription: undefined,
            point: 0,
            showBounce: false,
            answerType: '',
            requestUserData: false,
            attemptAnswerCount: 0,
        };
    },
    computed: {
        user() {
            return this.$store.getters.user
        },
        storeResult() {
            return this.$store.getters.result
        },
        progress() {
            return ((this.questionIndex + 1) / this.quiz.questions.length) * 100;
        },
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
                this.answerType = "success";
                this.storeResult.correct += 1;
                return '✅ မှန်ကန်ပါသည်။';
            } else if (temp.length > 0 && temp.length < correctAnswer.length) {
                this.answerType = "warning";
                this.storeResult.incomplete += 1;
                return '⚠️ အဖြေမှန်အားလုံးကို ရွေးချယ်ထားခြင်းမရှိပါ။';
            }
            this.storeResult.incorrect += 1;
            this.answerType = "error";
            return '❌ မှားယွင်းနေပါသည်။'
        }
    },
    beforeMount() {
        this.$store.dispatch("resetResult");
    },
    async mounted() {
        const CONSTANTS = inject('CONSTANTS');
        await this.$store.dispatch("fetchQuiz");
        this.quiz = this.quizList.find(x => x.id == this.id);
        this.reset();
    },
    methods: {
        startQuiz(id) {
            this.$router.push({ name: 'QuizDetail', params: { id: id } });
        }
    }
}
</script>
