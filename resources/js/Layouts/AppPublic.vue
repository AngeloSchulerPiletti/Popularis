<template>
  <div>
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

</style>