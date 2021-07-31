<template>
  <div id="header_container">
      <header-component/>
  </div>
  <main>
      <slot></slot>
  </main>
</template>

<script>
import Header from "@/Components/Header";
export default {
  components:{
    'header-component': Header,
  }
}
</script>

<style lang="scss" scoped>
#header_container{
  position: relative;
  z-index: 1000;
}
</style>