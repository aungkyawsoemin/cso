<template>
  <main class="text-center border-box py-5 px-md-5 mt-5 h-md-75 col-md-8 mx-auto" style="margin-bottom: 5em;">
    <div class="d-none d-lg-block d-xl-block mt-5"></div>
    <h1 class="display-4 fw-bold lh-1">Assessment Platform</h1>
    <p class="lead mt-5 md:px-5 px-3">CSO Academy ကို CSO များမှ မြန်မာနိုင်ငံရှိအဖွဲ့အစည်းများ​၏ လူထုအသိုင်းဝိုင်းသို့ နည်းပညာသုံးဖြန့်ဝေမှု နှင့် နှီးနှောဆက်သွယ်ချိတ်ဆက်မှုကို ပိုမိုတိုးတက်ကောင်းမွန်လာစေရန်အပြင် ၎င်းအဖွဲ့အစည်းများ​၏ ဒစ်ဂျစ်တယ်အသွင်ကူးပြောင်းမှုကိုအားဖြည့်အထောက်အကူပြုနိုင်ရန် ရည်ရွယ်၍တည်ဆောက်ထားပါသည်။</p>
    <div class="d-none d-md-block d-lg-block d-xl-block mt-5"></div>
    <p class="lead mb-5">
      <router-link :to="{ name: 'QuizIndex' }" type="button" class="btn btn-cso-primary mt-3">
        စစ်ကြည့်မည်
      </router-link>
    </p>
  </main>
</template>

<script>
export default {
  name: "Landing",
  data() {
    return {
      loading: false,
      showModal: true,
    };
  },
  mounted() {
    //
  },
  methods: {
    save() {
      //
    }
  }
}
</script>