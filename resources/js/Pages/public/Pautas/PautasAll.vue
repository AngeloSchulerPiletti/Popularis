<template>
    <app-public>
        <section>
            <!-- INTRO -->
        </section>

        <section v-if="page.scope != ''">
            <div v-if="page.scope == 'fed'">

            </div>
            <div v-else-if="page.scope == 'est'">

            </div>
        </section>



        <!-- ------------------------------- -->
        <!-- CASO HAJA INCONGRUÊNCIA NA PROP -->
        <!-- ------------------------------- -->
        <section v-else>
            <h2>Houve um erro com os dados vindos do servidor</h2>
        </section>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";

export default {
    data() {
        return {
            page: {
                scope: "",
            },
        };
    },
    created() {
        this.pageConfig();
    },
    methods: {
        pageConfig: function(){
            var scope = this.$props.pauta_scope,
                accepted = {scope: ['est', 'fed'], type: ['atuais', 'passadas', 'futuras']};

            accepted.scope.forEach(data => {
                if (data == scope) {
                    this.$data.page.scope = data;
                }
            });
        }
    },
    props: {
        pauta_scope: String,
    },
    components:{
        AppPublic,
    }
}
</script>

<style>

</style>