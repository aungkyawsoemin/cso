<template>
  <div :data-bs-theme="getMode()" class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"
    :class="{ 'text-bg-dark': !modeLight, 'text-bg-light': modeLight }">
    <header class="mb-auto text-center">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <router-link to="/">
          <img class="logo light-brand-logo" src="/images/logo.webp" alt="logo" height="70">
          <img class="logo dark-brand-logo" src="/images/dark-logo.webp" alt="logo" height="70">
        </router-link>

        <div class="mode-switch">
          <button class="btn" @click="modeLight = !modeLight">
            {{ modeLight ? 'Dark' : 'Light' }}</button>
          <button type="button" class="btn ml-2" data-bs-toggle="modal" data-bs-target="#aboutUsModal"
            style="    margin-left: 20px;">
            About us
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
            <h1 class="modal-title fs-5" id="aboutUsModalLabel">About us</h1>
            <button type="button" class="btn btn-close no-shadow" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="lead mt-3">
            We want you to understand the types of information we collect as you use our services
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
            <p class="lead">
            When you’re not signed in to a Google Account, we store the information we collect with unique identifiers
            tied to the browser, application, or device you’re using. This allows us to do things like maintain your
            preferences across browsing sessions, such as your preferred language or whether to show you more relevant
            search results or ads based on your activity.
            </p>
            <p class="lead">
            When you’re signed in, we also collect information that we store with your Google Account, which we treat as
            personal information. We want you to understand the types of information we collect as you use our services
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
            <p class="lead">
            When you’re not signed in to a Google Account, we store the information we collect with unique identifiers
            tied to the browser, application, or device you’re using. This allows us to do things like maintain your
            preferences across browsing sessions, such as your preferred language or whether to show you more relevant
            search results or ads based on your activity.
            </p>
            <p class="lead">
            When you’re signed in, we also collect information that we store with your Google Account, which we treat as
            personal information. We want you to understand the types of information we collect as you use our services
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
            <p class="lead">
            When you’re not signed in to a Google Account, we store the information we collect with unique identifiers
            tied to the browser, application, or device you’re using. This allows us to do things like maintain your
            preferences across browsing sessions, such as your preferred language or whether to show you more relevant
            search results or ads based on your activity.
            </p>
            <p class="lead">
            When you’re signed in, we also collect information that we store with your Google Account, which we treat as
            personal information. We want you to understand the types of information we collect as you use our services
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
            <p class="lead">
            When you’re not signed in to a Google Account, we store the information we collect with unique identifiers
            tied to the browser, application, or device you’re using. This allows us to do things like maintain your
            preferences across browsing sessions, such as your preferred language or whether to show you more relevant
            search results or ads based on your activity.
            </p>
            <p class="lead">
            When you’re signed in, we also collect information that we store with your Google Account, which we treat as
            personal information. We want you to understand the types of information we collect as you use our services
            </p>
            <p class="lead">
            We collect information to provide better services to all our users — from figuring out basic stuff like which
            language you speak, to more complex things like which ads you’ll find most useful, the people who matter most
            to you online, or which YouTube videos you might like. The information Google collects, and how that
            information is used, depends on how you use our services and how you manage your privacy controls.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
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
  mounted() {
  },
  methods: {
    getMode() {
      return this.modeLight ? 'light' : 'dark';
    }
  }
}
</script>