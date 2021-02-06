<template>
  <div>
      <Header />
      <!--<nuxt keep-alive />-->
      <nuxt />
      <Footer />
  </div>
</template>

<script>
     export default {
        data() {
            return {
                userMenu: []
            };
        },
        async fetch() {
          
        },
        methods: {
          
        }

    }
</script>

<style >
.page-enter-active,
  .page-leave-active {
    transition: all 0.25s ease;
  }

  .page-enter,
  .page-leave-active {
    opacity: 0;
    transform: translateZ(0);
    backface-visibility: hidden;
  }
</style>
