<template>
    <app-admin area="tecnico" :links="links" :window_content="window_content">
        <div id="tecnico_container">
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
                "Requisições": [
                    "requisicoes",
                    route("tecnico.requisicoes_default.show"),
                ],
                "Bugs": [
                    "bugs",
                    route("tecnico.requisicoes_default.show"),
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
#tecnico_container {
    @include page_bottom;
}
</style>
