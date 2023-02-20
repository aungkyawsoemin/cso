<template>
  <main class="flex-shrink-0 py-5 container">
    <div class="container text-center py-lg-5">
      <h1 class="mt-5 mb-3">Amazing heading text</h1>
      <p class="lead w-80 mx-auto">Pin a footer to the bottom of the viewport in desktop browsers with this custom HTML
        and CSS. A
        fixed navbar has been added with <code class="small">padding-top: 60px;</code> on the <code
          class="small">main &gt; .container</code>.</p>
      <router-link :to="{name: 'QuizDetail', params:{id: 1}}" type="button" class="eightbit-btn mt-3">Getting start</router-link>
    </div>

    <div class="modal fade show" :class="{stick: showModal}" @click="showModal = !showModal" style="display: block;">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-center">ကျွန်ုပ်တို့ အကြောင်း</h1>
          </div><div class="modal-body">
        <p>This is some placeholder content to show the scrolling behavior for modals. We use repeated line breaks to demonstrate how content can exceed minimum inner height, thereby showing inner scrolling. When content becomes longer than the predefined max-height of modal, content will be cropped and scrollable within the modal.</p>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <p>This content should appear at the bottom after you scroll.</p>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="save()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "Home",
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

<style scoped>
h1 {
  color: purple;
}

.w-80 {
  width: 80%;
}
.modal{
  transition: all 1.5s;
}
.modal .modal-header {
  display: block;
}
.modal.stick {
  top: 90vh;
}
.modal:not(.stick){
  background-color: #99a09080;
}
.modal-dialog {
    position: relative;
    box-shadow: inset -4px -4px 0px 0px #4aa52e;
}
.modal-dialog:before {
    top: -6px;
    left: 0;
    border-top: 6px black solid;
    border-bottom: 6px black solid;
}
.modal-dialog:after{
    left: -6px;
    top: 0;
    border-left: 6px black solid;
    border-right: 6px black solid;
}
.modal-dialog:before,.modal-dialog:after{
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    box-sizing: content-box; 
}
.modal-content {
  border-radius: 0px;
  background: #f7d79f;
}
.modal-header {
  cursor: pointer;
  border-bottom-color: #000;  
}
.modal-body {
  border-top-color: #000;
}
</style>