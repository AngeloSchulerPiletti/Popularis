<template>
    <politico-container area="politico" :window_content="info_content">
        <div class="form_container">
            <div class="form_header">
                <h3>Criador de Pautas</h3>
                <p>
                    Para criar sua pauta preencha todos os campos de maneira
                    correta.
                </p>
            </div>
            <form @submit.prevent="submit">
                <div class="especial">
                    <div class="form_sec">
                        <label for="titulo">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            id="titulo"
                            v-model="form.titulo"
                        />
                    </div>
                    <div class="form_sec">
                        <label for="assunto">Assunto</label>
                        <input
                            type="text"
                            name="assunto"
                            id="assunto"
                            v-model="form.assunto"
                        />
                    </div>
                    <div class="form_sec">
                        <label for="autores">Autores</label>
                        <input
                            type="text"
                            name="autores"
                            id="autores"
                            v-model="form.autores"
                        />
                    </div>
                </div>
                <div class="form_sec">
                    <label for="palavras_chave">Palavras-Chave</label>
                    <input
                        type="text"
                        name="palavras_chave"
                        id="palavras_chave"
                        v-model="form.palavras_chave"
                    />
                </div>
                <div class="form_sec">
                    <label for="resumo"
                        >Resumo<info-icon
                            @click="info_change('resumo')"
                            class="pauta_info icon_info"
                    /></label>
                    <textarea name="resumo" id="resumo" v-model="form.resumo">
                    </textarea>
                </div>
                <div class="form_sec">
                    <label for="pauta"
                        >Pauta<info-icon
                            @click="info_change('pauta')"
                            class="pauta_info icon_info"
                    /></label>
                    <textarea name="pauta" id="pauta" v-model="form.pauta">
                    </textarea>
                </div>
                <div class="actions"><button type="submit">Enviar</button></div>
            </form>
        </div>
    </politico-container>
</template>

<script>
import Politico from "@/Pages/admin/Politico";
import Info from "@/Components/SVGs/Info";

export default {
    data() {
        return {
            form: this.$inertia.form({
                titulo: "",
                assunto: "",
                autores: "",
                palavras_chave: "",
                resumo: "",
                pauta: "",
            }),
            info_content: {},
        };
    },
    methods: {
        info_change(which) {
            if (which == "pauta") {
                this.$data.info_content = [
                    "Markdown Pauta",
                    [
                        "Atenção às orientações sobre como formatar a pauta corretamente",
                        [                            
                            "Atenção, o markdown é sensível à quebra de linha, isso quer dizer que linhas em branco serão adicionadas ao texto como quebra de linha.",
                            'Para indicar um títlo use "#", sendo "#" o maior título e "######" o menor.',
                            'Para indicar início de um parágrafo use "@@"',
                            'Para criar uma lista utilize a seguinte marcação: adicione "---" para indicar o início da lista, então pule de linha liste cada elemento adicionando "--" antes e pulando uma linha. Ao fim da lista adicione "---" para finalizar.',
                            'Para deixar um texto em negrito, ponha-o entre "*".',
                            'Para deixar um texto em itálico, ponha-o entre "**"',
                        ],
                    ],
                ]; //{'titulo': ['subtitle', ['p1', 'p2', 'p3' ...n 'pn']]}
            } else if (which == "resumo") {
                this.$data.info_content = [
                    "Regras do Resumo",
                    [
                        "Siga às instruções para escrever corretamente o resumo",
                        [
                            "Defina os objetivos da pauta com clareza e objetividade.",
                            "Esclareça os pontos mais relevantes.",
                            "Introduza as consequências de ambas decisões.",
                        ],
                    ],
                ]; //{'titulo': ['subtitle', ['p1', 'p2', 'p3' ...n 'pn']]}
            }
        },
        submit() {
            this.form.post(route("politico.create_pauta"), {
                //
            });
        },
    },
    components: {
        "politico-container": Politico,
        "info-icon": Info,
    },
};
</script>

<style lang="scss" scoped>
.form_container {
    margin: 0vw auto 0vw auto;
    width: 550px;

    box-shadow: 2px 2px 5px $black;
    border-radius: 6px;
    padding: 20px;

    @include form_style();

    .form_header {
        @include form_header;
    }
}
</style>
