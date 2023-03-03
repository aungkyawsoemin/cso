<template>
  <main class="px-3 text-center border-box py-5 px-5 h-75 w-80 mx-auto">
    <div class="d-none d-lg-block d-xl-block mt-5"></div>
    <h1 class="display-4 fw-bold lh-1">Amazing Title Here</h1>
    <p class="lead mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores repudiandae assumenda libero
      porro excepturi eveniet adipisci, quaerat quam inventore ea recusandae dolorum tempora quidem rem quae repellat
      corrupti ex at?</p>
    <div class="d-none d-md-block d-lg-block d-xl-block mt-5"></div>
    <p class="lead mb-5">
      <router-link :to="{ name: 'QuizDetail', params: { id: 1 } }" type="button" class="btn btn-lg fw-bold mt-3">Getting
        started</router-link>
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
    console.log("hello");
  },
  methods: {
    save() {
      console.log('hello')
    }
  }
}
</script>