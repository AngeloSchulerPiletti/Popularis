<template>
    <tecnico-container>
        <!-- MODAL  -->
        <pauta-preview @close_pauta="pauta_to_preview={};" v-show="Object.keys(pauta_to_preview).length > 0" :pauta="pauta_to_preview"/>
        
        <!-- PAGE -->
        <page-header
            :title="page_header.title"
            :paragraph="page_header.paragraph"
        />
        <section v-if="Object.keys(db_pautas).length > 0" id="cards_container">
            <div v-for="(obj, index) in pautas_showing" :key="index">
                <card-requisicao :pauta="obj" @preview="showModal" @refresh="listingArticles()"/>
            </div>
            <div
                class="pagination"
                id="actions"
                v-show="total_pautas > pautas_perpage"
            >
                <nav class="actions_container">
                    <div
                        class="arrow"
                        id="back"
                        v-show="list_selector > 1"
                        @click="setList(list_selector - 1)"
                    >
                        <arrow color="$white" />
                    </div>
                    <div id="pages_number">
                        <span
                            v-show="list_selector > 3"
                            @click="setList(list_selector - 3)"
                            >{{ list_selector - 3 }}</span
                        >
                        <span
                            v-show="list_selector > 2"
                            @click="setList(list_selector - 2)"
                            >{{ list_selector - 2 }}</span
                        >
                        <span
                            v-show="list_selector > 1"
                            @click="setList(list_selector - 1)"
                            >{{ list_selector - 1 }}</span
                        >
                        <span id="actual_list">{{ list_selector }}</span>
                        <span
                            v-show="
                                list_selector * pautas_perpage < total_pautas
                            "
                            @click="setList(list_selector + 1)"
                            >{{ list_selector + 1 }}</span
                        >
                        <span
                            v-show="
                                (list_selector + 1) * pautas_perpage <
                                total_pautas
                            "
                            @click="setList(list_selector + 2)"
                            >{{ list_selector + 2 }}</span
                        >
                        <span
                            v-show="
                                (list_selector + 2) * pautas_perpage <
                                total_pautas
                            "
                            @click="setList(list_selector + 3)"
                            >{{ list_selector + 3 }}</span
                        >
                    </div>
                    <div
                        class="arrow"
                        id="next"
                        v-show="list_selector * pautas_perpage < total_pautas"
                        @click="setList(list_selector + 1)"
                    >
                        <arrow color="$blue"/>
                    </div>
                </nav>
            </div>
        </section>
        <div class="without_db" v-else>
            <h5>Não existem pautas para serem aprovadas!</h5>
        </div>
    </tecnico-container>
</template>

<script>
import Tecnico from "@/Pages/admin/Tecnico";
import Cabecalho1 from "@/Components/admin/Cabecalho1";
import CardRequisicao from "@/Components/admin/CardRequisicao";
import Arrow from "@/Components/SVGs/Icons/Arrow";
import PautaPreview from "@/Components/geral/PautaPreview";

export default {
    data() {
        return {
            page_header: {
                title: "Requisicoes Atuais",
                paragraph:
                    "Leia atentamente às pautas atente-se a erros de formatação e aprove ou negue em até 30 dias.",
            },
            list_selector: 1,
            pautas_perpage: 5,
            total_pautas: 0,
            pautas_showing: [],
            pauta_to_preview: {},
        };
    },
    created() {
        this.listingArticles();
    },
    methods: {
        showModal(pauta){
            this.pauta_to_preview = pauta;
        },
        setList(wich) {
            this.pauta_to_preview = {};
            this.list_selector = wich;
            this.listingArticles();
            window.scrollTo(0, 0);
        },
        listingArticles: function () {
            var keys = Object.keys(this.db_pautas),
                perpage = this.pautas_perpage,
                page = this.list_selector;

            this.pautas_showing = [];
            this.total_pautas = keys.length;

            for (
                let i = perpage * page - perpage;
                i < perpage * page && i < keys.length;
                i++
            ) {
                this.pautas_showing.push(this.db_pautas[i]);
            }
        },
    },
    props: {
        db_pautas: Object,
    },
    components: {
        "tecnico-container": Tecnico,
        "page-header": Cabecalho1,
        CardRequisicao,
        Arrow,
        PautaPreview,
    },
};
</script>

<style lang="scss" scoped>
#cards_container {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
#actions {
    @include pagination_style();
}
.without_db{
    h5{
        text-align: center;
        @include Title4;
        font-size: 20px;
        color: $blue;
    }
}
</style>
