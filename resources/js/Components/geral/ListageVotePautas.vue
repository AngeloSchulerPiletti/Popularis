<template>
  <section id="pagination_container">
        <div id="pagination_options">
            <select name="perpage" id="perpage_field" v-model="listing.perpage">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
            </select>

        </div>
            <div v-for="(obj, index) in pautas_in_data" :key="index">
                <pauta-card :pauta="obj"/>
            </div>
            <div
                class="pagination"
                id="actions"
            >
                <nav class="actions_container">
                    <div
                        class="arrow"
                        id="back"
                        v-show="listing.actual_page > 1"
                        @click="setList(listing.actual_page - 1)"
                    >
                        <arrow color="$white" />
                    </div>
                    <div id="pages_number">
                        <span
                            v-show="listing.actual_page > 3"
                            @click="setList(listing.actual_page - 3)"
                            >{{ listing.actual_page - 3 }}</span
                        >
                        <span
                            v-show="listing.actual_page > 2"
                            @click="setList(listing.actual_page - 2)"
                            >{{ listing.actual_page - 2 }}</span
                        >
                        <span
                            v-show="listing.actual_page > 1"
                            @click="setList(listing.actual_page - 1)"
                            >{{ listing.actual_page - 1 }}</span
                        >
                        <span id="actual_list">{{ listing.actual_page }}</span>
                        <span
                            v-show="
                                listing.actual_page * pautas_perpage < total_pautas
                            "
                            @click="setList(listing.actual_page + 1)"
                            >{{ listing.actual_page + 1 }}</span
                        >
                        <span
                            v-show="
                                (listing.actual_page + 1) * pautas_perpage <
                                total_pautas
                            "
                            @click="setList(listing.actual_page + 2)"
                            >{{ listing.actual_page + 2 }}</span
                        >
                        <span
                            v-show="
                                (listing.actual_page + 2) * pautas_perpage <
                                total_pautas
                            "
                            @click="setList(listing.actual_page + 3)"
                            >{{ listing.actual_page + 3 }}</span
                        >
                    </div>
                    <div
                        class="arrow"
                        id="next"
                        v-show="listing.actual_page * pautas_perpage < total_pautas"
                        @click="setList(listing.actual_page + 1)"
                    >
                        <arrow color="$blue"/>
                    </div>
                </nav>
            </div>
        </section>
</template>

<script>
import PautaVoteCard from "@/Components/geral/PautaVoteCard";
import Arrow from "@/Components/SVGs/Icons/Arrow";

export default {
    data(){
        return{
            pautas_in_data: [],
            listing:{
                perpage: 5,
                actual_page: 1,
            }
        }
    },
    methods:{
        setList(which){
            this.listing.actual_page = which;
            
            this.$inertia.form(this.listing).post(route('pagination.load'));

        },
        refresh(){
            if(this.pautas_data){
                this.pautas_in_data = this.pautas_data;
            }
            if(this.which_page){
                this.listing.actual_page = this.which_page;
            }
            if(this.per_page){
                this.listing.perpage = this.per_page;
            }
        },
    },
    created(){
        this.refresh();
    },
    updated(){
        this.refresh();
    },
    props:{
        pautas_data: Array, //[[Pauta format], [title, resume, url, id, {'titulo de prop1': prop1, ...}]]
        which_page: Number,
        per_page: Number,
    },
    components: {
        'pauta-card': PautaVoteCard,

    }
}
</script>

<style>

</style>