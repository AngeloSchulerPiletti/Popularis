<template>
  <app-public>
      <div class="view_header">
          <div class="vote_container">
              <div class="votos favor">
                  <h3>A Favor</h3>
                  <h5>{{pauta.pos_votes}}</h5>
                  <button @click="vote('pos')" v-if="!votou">VOTAR</button>
              </div> 
              <div class="votos contra">
                  <h3>Contra</h3>
                  <h5>{{pauta.neg_votes}}</h5>
                  <button @click="vote('neg')" v-if="!votou">VOTAR</button>
              </div>
              <div id="progresso"><div id="bar"></div></div>
              <span id="percentual">{{percentual}}%</span>
          </div>
      </div>
      <div class="view_container">
        <pauta-view :pauta="pauta"/>
      </div>
  </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import PautaView from "@/Components/geral/PautaView";

export default {
    data(){
        return{
            percentual: 0,
            per_pos: 0,
        }
    },
    mounted(){
        var elemento = document.querySelector("#bar");
        elemento.style.width = (this.per_pos+"%");
    },
    created(){
        this.calc_percentual();
    },
    updated(){
        this.calc_percentual(); 
    },
    methods:{
        vote(type){
            this.$inertia.form({'voto': type}).post(route('pauta.store', {url: this.$props.pauta.url}));
        },
        calc_percentual(){
            var vm = this.pauta;
            var pos = vm.pos_votes == 0 ? 1 : vm.pos_votes,
                neg = vm.neg_votes == 0 ? 1 : vm.neg_votes;
            
            var total = pos+neg;
            var per_pos = (pos/total * 100).toFixed(2),
                per_neg = (neg/total * 100).toFixed(2);

            if(per_pos > per_neg){
                this.percentual = per_pos;
            } 
            else{
                this.percentual = per_neg;
            }
            
            this.per_pos = Number(per_pos).toFixed(0);
        },
    },
    props:{
        pauta: Object,
        votou: Boolean,
    },
    components:{
        AppPublic,
        PautaView,
    }
}
</script>

<style lang="scss" scoped>
    .view_header{
        .vote_container{
            display: flex;
            justify-content: center;
            gap: 40%;
            margin: 10vw 0 2vw 0;

            position: relative;

            .votos{
                background-color: $blue;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 2px 2px 5px $black;

                display: flex;
                flex-direction: column;
                align-items: center;

                h3{
                    @include Title3;
                    font-size: 34px;
                    color: $white;
                    text-align: center;
                }
                h5{
                    font-size: 25px;
                    color: $white; 
                    font-family: Arial, Helvetica, sans-serif;

                }
                button{
                    margin-top: 10px;
                    box-shadow: 2px 2px 5px $black;
                    @include hover1($blue, $white, $white, $white, $blue1, $blue1, 300ms);
                    padding: 1px 10px;
                    border-radius: 4px;
                    @include Font0;
                    font-size: 18px;
                }
            }
            .contra{

            }
            .favor{

            }
            #progresso{
                position: absolute;
                height: 20%;
                width: 100%;
                background-color: $green;
                z-index: -1;
                top: 50%;
                transform: translateY(-50%);
                box-shadow: 0px 0px 5px $black;

                #bar{
                    background-color: $yellow;
                    height: 100%;
                    margin-left: auto;

                }
            }
            #percentual{
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                bottom: -15%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 38px;
                font-weight: 500;

                background-color: $blue1;
                color: $white;
                border-radius: 100vw;
                padding: 0 20px;
                box-shadow: 2px 2px 5px $black;

            }
        }
    }
    .view_container{
        padding: 10vw 5vw 5vw 5vw;
    }

</style>
