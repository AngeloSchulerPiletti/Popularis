<template>
  <app-admin area="tecnico" :links="links">
      <slot></slot>
  </app-admin>
</template>

<script>
import AppAdmin from "@/Layouts/AppAdmin";

export default {
    data(){
        return{
            links: {'link-principal': ['/rota/para/'], 'link-principal': ['/rota/para/', {'link-secundario': '/rota/para/'}]},
        }
    },
    components:{
        AppAdmin,
    }

}
</script>

<style>

</style>