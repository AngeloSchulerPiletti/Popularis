<template>
  <app-admin area="tecnico" :links="links">
      <div id="tecnico_container">
        <slot></slot>
      </div>
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

<style lang="scss" scoped>
#tecnico_container{
    @include page_bottom;
}
</style>