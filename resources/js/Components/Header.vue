<template>
  <header>
      <div class="top">
          <div id="logo">
              <Link :href="route('inicio')"></Link>
          </div>
          <div id="title">

          </div>
          <div id="options">
              
          </div>
      </div>
      <div class="bottom">
          <nav @mouseleave="show.estadual = false; show.federal = false;">
                <Link :href="route('pautas.federal.all')" @mouseenter="show.federal = true">Pautas Federais</Link>
                <div v-show="show.federal">
                    <Link :href="route('pautas.federal', {'type': 'atuais'})">Pautas Atuais</Link>
                    <Link :href="route('pautas.federal', {'type': 'passadas'})">Pautas Passadas</Link>
                    <Link :href="route('pautas.federal', {'type': 'futuras'})">Pautas Futuras</Link>
                </div>
                <Link :href="route('pautas.estadual.all')" @mouseenter="show.estadual = true">Pautas Estaduais</Link>
                <div v-show="show.estadual">
                    <Link :href="route('pautas.estadual', {'type': 'atuais'})">Pautas Atuais</Link>
                    <Link :href="route('pautas.estadual', {'type': 'passadas'})">Pautas Passadas</Link>
                    <Link :href="route('pautas.estadual', {'type': 'futuras'})">Pautas Futuras</Link>
                </div>
          </nav>
      </div>
  </header>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    data(){
        return{
            show:{
                federal: false,
                estadual: false,
            }      
        }
    },
    components:{
        Link,
    }
}
</script>

<style lang="scss" scoped>

</style>