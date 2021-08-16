<template>
    <app-public>
        <search-field />

        <section class="section_type">
            <div class="header">
                <h2>{{ page_config[0] }}</h2>
                <p>{{ page_config[1] }}</p>
            </div>
            <div class="list_container">
                <listing-cards
                    :static_list="false"
                    :pautas_data="pauta_data[0]"
                    :list_name="0"
                    :total_pautas="total_pautas"
                    :from_search="true"
                />
            </div>
        </section>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import ListageVotePautas from "@/Components/geral/ListageVotePautas";
import SearchField from "@/Components/geral/SearchField";

export default {
    data(){
        return{
            pauta_data: [],
        }
    },
    methods: {
        refresh() {
            if (this.db_data && this.pauta_data != this.db_data) {
                this.pauta_data = this.db_data;
            }
        },
    },
    created() {
        this.refresh();
    },
    updated() {
        this.refresh();
    },
    props:{
        db_data: Array,
        page_config: Array,
        total_pautas: Number,
    },
    components:{
        AppPublic,
        "listing-cards": ListageVotePautas,
        SearchField,
    },
}
</script>

<style lang="scss" scoped>
.section_type{
    padding-top: 40px;

    .header{
        margin: 80px auto 40px auto;
        width: 80%;

        h2{
            @include Title3;
            font-size: 35px;
            color: $darken-blue;
        }
        p{
            @include Font1;
            font-size: 18px;
            color: $blue1;
            text-align: justify;
        }
    }
    .list_container{

    }
}
</style>