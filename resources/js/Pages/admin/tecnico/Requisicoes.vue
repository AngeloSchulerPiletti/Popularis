<template>
  <tecnico-container>
    <h1>Isso é um título</h1>
  </tecnico-container>
</template>

<script>
import Tecnico from "@/Pages/admin/Tecnico";

export default {
    created(){
      console.log(this.db_pautas);
    },
    props:{
      db_pautas: Object,
    },
    components: {
        'tecnico-container': Tecnico,
    },
}
</script>

<style lang="scss" scoped>

</style>