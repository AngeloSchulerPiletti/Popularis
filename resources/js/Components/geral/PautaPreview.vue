<template>
  <div>
      <div>
          <div>
              <div>
              <h1></h1>
              <p></p>
              <p></p>
              </div>
              <div>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
              </div>
              <div>
                  <p>Criada em: </p>
                  <p>Disponível até: </p>
              </div>
          </div>
          <article v-html="pauta.pauta">
              
          </article>
      </div>
  </div>
</template>

<script>
export default {
    props:{
        pauta: Object,
    }
}
</script>

<style>

</style>