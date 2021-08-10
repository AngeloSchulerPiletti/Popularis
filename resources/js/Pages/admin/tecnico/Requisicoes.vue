<template>
  <tecnico-container>
    <page-header :title="page_header.title" :paragraph="page_header.paragraph"/>
    <section v-if="Object.keys(db_pautas).length > 0" id="cards_container">
      <div v-for="(obj, index) in db_pautas" :key="index">
        <card-requisicao :pauta="obj"/>
      </div>
      <div class="pagination">
        <nav>
          
        </nav>
      </div>
    </section>
    <div v-else>
      <h5>Não existem pautas para serem aprovadas!</h5>
    </div>
  </tecnico-container>
</template>

<script>
import Tecnico from "@/Pages/admin/Tecnico";
import Cabecalho1 from "@/Components/admin/Cabecalho1";
import CardRequisicao from "@/Components/admin/CardRequisicao";

export default {
    data(){
      return{
        page_header:{
          title: "Requisicoes Atuais",
          paragraph: "Leia atentamente às pautas atente-se a erros de formatação e aprove ou negue em até 30 dias.",
        }
      }
    },
    created(){
      console.log(this.db_pautas);
    },
    props:{
      db_pautas: Object,
    },
    components: {
        'tecnico-container': Tecnico,
        'page-header': Cabecalho1,
        CardRequisicao,
    },
}
</script>

<style lang="scss" scoped>
#cards_container{
  display: flex;
  flex-direction: column;
  gap: 30px;
}
</style>