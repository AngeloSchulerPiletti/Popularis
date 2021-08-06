<template>
  <app-admin area="politico" :links="links">
      <slot></slot>
  </app-admin>
</template>

<script>
import AppAdmin from "@/Layouts/AppAdmin";

export default {
    data(){
        return{
            links: {},
        }
    },
    components:{
        AppAdmin,
    }

}
</script>

<style>

</style>