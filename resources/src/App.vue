<template>
  <div :data-bs-theme="getMode()" class="cover-container d-flex min-vh-100 w-100 h-100 p-3 mx-auto flex-column"
    :class="{ 'text-bg-dark': !modeLight, 'text-bg-light': modeLight }">
    <header class="mb-auto text-center">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <router-link to="/">
          <img class="logo light-brand-logo" src="/images/logo.webp" alt="logo" height="70">
          <img class="logo dark-brand-logo" src="/images/dark-logo.webp" alt="logo" height="70">
        </router-link>

        <div class="mode-switch">
          <button class="btn" @click="modeLight = !modeLight">
            <i class="fa" :class="{ 'fa-solid fa-moon': modeLight, 'fa-solid fa-sun': !modeLight }"></i></button>
          <button type="button" class="btn ml-2" data-bs-toggle="modal" data-bs-target="#aboutUsModal"
            style="    margin-left: 20px;">
            ကျွန်ုပ်တို့ အကြောင်း
          </button>
        </div>
      </div>
    </header>

    <router-view></router-view>

    <footer class="mt-auto text-white-50">

    </footer>

    <!-- Modal -->
    <div class="modal fade" id="aboutUsModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="aboutUsModalLabel">ကျွန်ုပ်တို့ အကြောင်း</h1>
            <button type="button" class="btn btn-close no-shadow" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="lead mt-3">
              CSO Academy ကို CSO များမှ မြန်မာနိုင်ငံရှိအဖွဲ့အစည်းများ​၏ လူထုအသိုင်းဝိုင်းသို့ လိုအပ်သည့်အကူညီအထောက်ပံ့များပေးရာတွင် နည်းပညာသုံးဖြန့်ဝေမှု နှင့် နှီးနှောဆက်သွယ်ချိတ်ဆက်မှုကို ပိုမိုတိုးတက်ကောင်းမွန်လာစေရန်အပြင် ၎င်းအဖွဲ့အစည်းများ​၏ ဒစ်ဂျစ်တယ်အသွင်ကူးပြောင်းမှု (Digital Transformation) နှင့် အဖွဲ့အစည်းတိုးတက်မှု (Organizational Development) များကိုအားဖြည့်အထောက်အကူပြုနိုင်ရန် ရည်ရွယ်၍တည်ထောင်ထားပါသည်။
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">ပိတ်မည်</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Landing",
  data() {
    return {
      loading: false,
      modeLight: true,
    };
  },
  computed: {
    user() {
      return this.$store.getters.user;
    },
  },
  async mounted() {
    await this.$store.dispatch("getUser");
  },
  methods: {
    getMode() {
      return this.modeLight ? 'light' : 'dark';
    }
  }
}
</script>