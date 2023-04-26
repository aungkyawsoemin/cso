<template>
    <div class="answer-box">
        <h3 class="fw-bold lh-1 mb-5">{{ question.title }}</h3>
        <div :class="{ 'restricted': showDescription !== undefined }">
            <ul class="list-group"
                v-if="question.type === 0">
                <li class="list-group-item" v-for="list in question.items" :key="list.id">
                    <input class="form-check-input" type="radio"
                        :name="'item_' + question.id" :id="'item_' + list.id" :value="list.id" v-model="selectedItem">
                    <label class="form-check-label" :for="'item_' + list.id">&nbsp;{{ list.name }}</label>
                </li>
            </ul>
            <input v-else type="text" class="form-control" placeholder="ဖြေဆိုပါ" v-model="selectedItem">
        </div>

        <template v-if="showDescription !== undefined">
            <template v-if="answerType == 'success'">
                <div class="alert alert-success mt-3" role="alert">
                    <p>{{ showDescription }}</p>
                </div>
            </template>
        </template>
        <div class="card-footer py-3">
            <button class="btn btn-cso-primary mx-auto mt-3" :disabled="selectedItem.length === 0 || selectedItem === ''" @click="check();$emit('disable-userdata');"
                style="display: block;">ဖြေဆိုမည်</button>
    </div>
</div>
</template>

<script>

export default {
    name: "UserData",
    emits: ['enlarge-text'],
    data() {
        return {
            questionList: [
                {
                    id: 'division',
                    title: 'သင်၏ တည်နေရာ',
                    type: 0,
                    items: [
                        {
                            id: 0,
                            name: 'မြန်မာနိုင်ငံပြင်ပ',
                        },
                        {
                            id: 1,
                            name: 'စစ်ကိုင်းတိုင်းဒေသကြီး',
                        },
                        {
                            id: 2,
                            name: 'မန္တလေးတိုင်းဒေသကြီး',
                        },
                        {
                            id: 3,
                            name: 'မကွေးတိုင်းဒေသကြီး',
                        },
                        {
                            id: 4,
                            name: 'ပဲခူးတိုင်းဒေသကြီး',
                        },
                        {
                            id: 5,
                            name: 'ဧရာဝတီတိုင်းဒေသကြီး',
                        },
                        {
                            id: 6,
                            name: 'ရန်ကုန်တိုင်းဒေသကြီး',
                        },
                        {
                            id: 7,
                            name: 'တနင်္သာရီတိုင်းဒေသကြီး',
                        },
                        {
                            id: 8,
                            name: 'ကချင်ပြည်နယ်',
                        },
                        {
                            id: 9,
                            name: 'ကယားပြည်နယ်',
                        },
                        {
                            id: 10,
                            name: 'ကရင်ပြည်နယ်',
                        },
                        {
                            id: 11,
                            name: 'ချင်းပြည်နယ်',
                        },
                        {
                            id: 12,
                            name: 'မွန်ပြည်နယ်',
                        },
                        {
                            id: 13,
                            name: 'ရခိုင်ပြည်နယ်',
                        },
                        {
                            id: 14,
                            name: 'ရှမ်းပြည်နယ်',
                        },
                        {
                            id: 15,
                            name: 'နေပြည်တော် ပြည်တောင်စုနယ်မြေ',
                        }
                    ]
                },
                {
                    id: 'occupication',
                    title: 'သင်၏ အလုပ်အကိုင်',
                    type: 1,
                    items: []
                },
                {
                    id: 'gender',
                    title: 'သင်၏ လိင်အမျိုးအစား',
                    type: 0,
                    items: [
                        {
                            id: 0,
                            name: 'ကျား'
                        },
                        {
                            id: 1,
                            name: 'မ'
                        },
                        {
                            id: 2,
                            name: 'အခြား'
                        },
                    ]
                },
                {
                    id: 'age',
                    title: 'သင်၏ အသက်အပိုင်းအခြား',
                    type: 0,
                    items: [
                        {
                            id: 0,
                            name: '၂၀ နှစ်နှင့် အောက်'
                        },
                        {
                            id: 1,
                            name: '၂၁-၂၅'
                        },
                        {
                            id: 2,
                            name: '၂၆-၃၀'
                        },
                        {
                            id: 3,
                            name: '၃၁-၄၀'
                        },
                        {
                            id: 4,
                            name: '၄၁-၄၅'
                        },
                        {
                            id: 5,
                            name: '၄၅-၅၀'
                        },
                        {
                            id: 6,
                            name: '၅၀နှင့် အထက်'
                        },
                    ]
                },
                {
                    id: 'ethnicity',
                    title: 'သင်၏ လူမျိုး',
                    type: 1,
                    items: []
                },
            ],
            showDescription: undefined,
            selectedItem: []
        }
    },
    async mounted() {
        await this.$store.dispatch("getUser");
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
        question() {
            var tempId = '';
            var that = this;
            this.questionList.forEach(function(value, key) {
                if(that.user[value.id] == null && tempId == '') {
                    tempId = value.id;
                }
            })
            if(tempId == '') tempId = 'division';
            var question = this.questionList.find(x => x.id == tempId);
            if (question.type == 0) this.selectedItem = [];
            else this.selectedItem = "";
            return question;
        }
    },
    methods: {
        async check() {
            if(this.question.type == 0) var result = this.question.items.find(x => x.id == this.selectedItem).name;
            else var result = this.selectedItem;

            this.user[this.question.id] = result;
            await this.$store.dispatch("updateUser", this.user);
        }
    }
}
</script>