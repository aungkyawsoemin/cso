<template>
    <main class="border-box py-md-5 px-md-5 mt-5 col-md-8 col-12 mx-auto">
        <h2 class="d-block text-center mb-md-5 mt-3 mt-md-0">သင်ဖြေဆိုခဲ့သော မေးခွန်းများအတွက် သင်၏ရလဒ်</h2>
        <div class="d-block mx-auto" style="width: 40%;">
            <Pie id="my-chart-id" :options="chartOptions" :data="chartData" />
        </div>
        <div class="card-footer py-3 mt-5">
            <button @click="next()" class="btn btn-cso-primary mx-auto mt-3 d-block">ပြန်လည် ဖြေဆိုမည်</button>
        </div>

        <div class="card mt-5" v-show="quiz.course_link != undefined">
            <h5 class="card-header">အောက်ပါသင်တန်းကို အခမဲ့ လေ့လာနိုင်ပါတယ်</h5>
            <div class="card-body">
                <h5 class="card-title">{{ quiz.course_name }}</h5>
                <p class="card-text">{{ quiz.course_description }}</p>
                <a :href="quiz.course_link" target="_blank" class="btn btn-cso-primary">လေ့လာမယ်</a>
            </div>
        </div>
    </main>
</template>

<script>
import Skeleton from "../components/skeleton.vue";
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: "Result",
    components: {
        Skeleton, Pie
    },
    data() {
        return {
            id: this.$route.params.id,
            chartData: {
                labels: ['အဖြေမှန်', 'အဖြေမှား', 'မတိကျသော အဖြေ'],
                datasets: [{
                    backgroundColor: ['#6fd9ea', '#e0456f', '#e4b24c', '#DD1B16'],
                    data: [this.$store.getters.result.correct, this.$store.getters.result.incorrect, this.$store.getters.result.incomplete]
                }]
            },
            chartOptions: {
                responsive: true
            },
            quiz: {
                id: undefined,
                course_link: undefined
            }
        }
    },
    computed: {
        quizList() {
            return this.$store.getters.quiz;
        },
    },
    async mounted() {
        await this.$store.dispatch("fetchQuiz");
        this.quiz = this.quizList.find(x => x.id == this.id);
        console.log(this.quiz)
    },
    methods: {
        next() {
            this.$router.push({ name: 'QuizDetail', params: { id: this.id } });
        }
    }
}
</script>