<template>
  <header class="mb-auto">
    <div class="navbar bg-transparent shadow-sm">
      <div class="container">
        <!-- <router-link class="navbar-brand d-flex align-items-left" :to="{name: 'Home'}">
          <img src="/images/logo.webp" height="80">
        </router-link> -->
        <router-link class="navbar-brand d-flex align-items-center" :to="{name: 'Home'}">
          <img src="/images/logo.webp" height="80">
        </router-link>
        <!-- <router-link class="navbar-brand d-flex align-items-right" :to="{name: 'Home'}">
          <img src="/images/logo.webp" height="80">
        </router-link> -->
      </div>
    </div>
  </header>

  <router-view></router-view>
</template>

<script>
export default {
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s
}

.fade-enter,
.fade-leave-active {
  opacity: 0
}

footer p {
  color: #fff;
}</style>