<template>
    <app-admin area="politico" :links="links" :window_content="window_content">
        <div id="politico_container">
            <slot></slot>
        </div>
    </app-admin>
</template>

<script>
import AppAdmin from "@/Layouts/AppAdmin";

export default {
    data() {
        return {
            links: {
                "Criar Pauta": [
                    "criarpauta",
                    route("politico.pauta_create_default.show"),
                ],
                "Minhas Pautas": [
                    "minhaspautas",
                    route("politico.historico_pautas.show"),
                    {
                        Estatísticas: route("politico.estatisticas.show"),
                        Histórico: route("politico.historico_pautas.show"),
                    },
                ],
                "Gerenciar Equipes": [
                    "gerenciarequipes",
                    route("politico.gerenciar_equipe.show"),
                ],
            },
        };
    },
    props:{
        window_content: Object,
    },
    components: {
        AppAdmin,
    },
};
</script>

<style lang="scss" scoped>
#politico_container{
    @include page_bottom;
}
</style>
