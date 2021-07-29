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
          <nav>
                <Link :href="route('pautas.federal.all')">Pautas Federais</Link>
                <div>
                    <Link :href="route('pautas.federal', {'type': 'atuais'})">Pautas Atuais</Link>
                    <Link :href="route('pautas.federal', {'type': 'passadas'})">Pautas Passadas</Link>
                    <Link :href="route('pautas.federal', {'type': 'futuras'})">Pautas Futuras</Link>
                </div>
                <Link :href="route('pautas.estadual.all')">Pautas Estaduais</Link>
                <div>
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
    components:{
        Link,
    }
}
</script>

<style lang="scss" scoped>

</style>