<template>
    <app-public>
        <!-- MOSTRA ATUAL PASSADA E FUTURA -->
        <section v-if="!has_type">
            <div class="header">

            </div>
            <div v-for="(info, index) in page_config[1]" :key="index" :class="'sec sec'+index">
                <div>
                    <h3>{{info[0]}}</h3>
                    <p>{{info[1]}}</p>
                </div>
                <listing-cards :static_list="true" :pautas_data="pauta_data[index]"/>
            </div>
           
        </section>
        <!-- MOSTRA ESPECIFICA  -->
        <section v-else>

        </section>

        
        </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import ListageVotePautas from "@/Components/geral/ListageVotePautas";

export default {
    data() {
        return {
            has_type: false,
            pauta_data: [],
        };
    },
    methods:{
        has_type_check(){
            this.has_type = this.escope.length > 1; 
        },
        refresh(){
            if(this.db_data){
                var vm = this.db_data;
                
                this.pauta_data[0] = vm[0];
                for (let i = 0; i < vm[1].length; i++) {
                    this.pauta_data[0][i] = vm[i];
                }
                this.pauta_data[1] = vm[2];
                this.pauta_data[2] = vm[3];
            }
        },
    },
    created(){
        this.has_type_check();
        this.refresh();
        console.log(this.db_data);
        console.log(this.pauta_data);
    },
    updated(){
        this.has_type_check();
        this.refresh();
    },
    props:{
        escope: Array,
        db_data: Array,
        page_config: Array,
    },
    components:{
        AppPublic,
        'listing-cards': ListageVotePautas, 
    }
};
</script>

<style></style>
