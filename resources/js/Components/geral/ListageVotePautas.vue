<template>
    <section id="pagination_container" v-if="pautas_data.length > 0">
        <div v-if="!static_list" id="pagination_options">
            <select name="perpage" id="perpage_field" v-model="listing.perpage" @change="setList(listing.actual_page)">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
            </select>
        </div>
        <div class="cards_list">
            <pauta-card
                :pauta="obj"
                v-for="(obj, index) in pautas_formatted"
                :key="index"
                :card_name="'name_'+list_name+index"
            />
        </div>
        <div class="pagination" id="actions" v-if="!static_list">
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
                            listing.actual_page * listing.perpage < total_pautas
                        "
                        @click="setList(listing.actual_page + 1)"
                        >{{ listing.actual_page + 1 }}</span
                    >
                    <span
                        v-show="
                            (listing.actual_page + 1) * listing.perpage <
                            total_pautas
                        "
                        @click="setList(listing.actual_page + 2)"
                        >{{ listing.actual_page + 2 }}</span
                    >
                    <span
                        v-show="
                            (listing.actual_page + 2) * listing.perpage <
                            total_pautas
                        "
                        @click="setList(listing.actual_page + 3)"
                        >{{ listing.actual_page + 3 }}</span
                    >
                </div>
                <div
                    class="arrow"
                    id="next"
                    v-show="listing.actual_page * listing.perpage < total_pautas"
                    @click="setList(listing.actual_page + 1)"
                >
                    <arrow color="$blue" />
                </div>
            </nav>
        </div>
        <div class="link_vermais" v-else>
            <Link :href="ver_mais">Ver mais</Link>
        </div>
    </section>
    <section id="pagination_container" v-else>
        <h3 class="warn">Por enquanto não existem pautas para serem apresentadas</h3>
    </section>
</template>

<script>
import PautaVoteCard from "@/Components/geral/PautaVoteCard";
import Arrow from "@/Components/SVGs/Icons/Arrow";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            pautas_formatted: [],
            listing: {
                perpage: 5,
                actual_page: 1,
                from_search: false,
            },
            pautas_save: [],
        };
    },
    methods: {
        setList(which) {
                this.listing.from_search = this.from_search ? this.from_search : false;
                this.listing.actual_page = which;
                this.$inertia.form(this.listing).post(route("pagination.load"));
        },
        refresh() {
            if (this.pautas_data && this.pautas_data != this.pautas_save) {
                var vm = this.pautas_data;
                this.pautas_save = vm;
                var new_vm = [];
                for (let i = 0; i < vm.length; i++) {
                    new_vm[i] = [
                        vm[i].titulo,
                        vm[i].resumo,
                        vm[i].id,
                        vm[i].url,
                        {
                            "Assunto: ": vm[i].assunto,
                            "Escopo: ": vm[i].escopo,
                            "De: ": vm[i].local,
                            "Disponível até: ": vm[i].final_date,
                        },
                    ];
                }
                this.pautas_formatted = new_vm;
            }
            if (this.which_page && this.listing.actual_page != this.which_page) {
                this.listing.actual_page = this.which_page;
            }
            if (this.per_page && this.listing.perpage != this.per_page) {
                this.listing.perpage = this.per_page;
            }
        },
    },
    created() {
        this.refresh();
    },
    updated() {
        this.refresh();
    },
    props: {
        pautas_data: Array,
        which_page: Number,
        per_page: Number,
        static_list: Boolean,
        ver_mais: String,
        list_name: Number,
        total_pautas: Number, 
        from_search: Boolean,
    },
    components: {
        "pauta-card": PautaVoteCard,
        Arrow,
        Link,
    },
};
</script>

<style lang="scss" scoped>
.warn{
    width: 80%;
    margin: auto;
    @include Title4;
    color: $blue;
    font-size: 20px;
}
#pagination_options{
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 600;
    font-size: 20px;
    padding: 0 10% 0 10%;
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;

    select{
        padding: 1px 15px;
        border-radius: 5px;
    }
}
.cards_list {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
#actions{
    @include pagination_style();
}
.link_vermais{
    padding: 0 10% 0 10%;
    display: flex;
    justify-content: center;
    margin-top: 20px;

    a{
        @include Font2_I;
        font-size: 18px;
        color: $blue1;
        text-decoration: underline;

        @include hover1($blue1, transparent, transparent, $darken-blue, transparent, transparent, 200ms);
    }
}
</style>
