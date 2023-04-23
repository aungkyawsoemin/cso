<template>
    <main class="border-box py-5 px-5 w-60 mx-auto">
        <h2 class="d-block text-center mb-5">သင်ဖြေဆိုခဲ့သော မေးခွန်းများအတွက် သင်၏ရလဒ်</h2>
        <div class="d-block mx-auto" style="width: 40%;">
            <Pie id="my-chart-id" :options="chartOptions" :data="chartData" />
        </div>
        <div class="card-footer py-3 mt-5">
            <button @click="next()" class="btn btn-cso-primary mx-auto mt-3 d-block">ပြန်လည် ဖြေဆိုမည်</button>
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
                    data: [40, 20, 12]
                }]
            },
            chartOptions: {
                responsive: true
            }
        }
    },
    methods: {
        next() {
            this.$router.push({ name: 'QuizDetail', params: { id: this.id } });
        }
    }
}
</script>