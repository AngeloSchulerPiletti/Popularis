<template>
    <politico-container area="politico">
        <div>
            <form @submit.prevent="submit">
                <div class="input_container">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" v-model="form.titulo"/>
                </div>
                <div class="input_container">
                    <label for="assunto">Assunto</label>
                    <input type="text" name="assunto" id="assunto" v-model="form.assunto"/>
                </div>
                <div class="input_container">
                    <label for="autores">Autores</label>
                    <input type="text" name="autores" id="autores" v-model="form.autores"/>
                </div>
                <div class="input_container">
                    <label for="palavras_chave">Palavras-Chave</label>
                    <input
                        type="text"
                        name="palavras_chave"
                        id="palavras_chave" v-model="form.palavras_chave"
                    />
                </div>
                <div class="input_container">
                    <label for="resumo">Resumo</label>
                    <textarea name="resumo" id="resumo" v-model="form.resumo"> </textarea>
                </div>
                <div class="input_container">
                    <label for="pauta">Pauta</label>
                    <textarea name="pauta" id="pauta" v-model="form.pauta"> </textarea>
                </div>
                <div class="actions"><button type="submit">Enviar</button></div>
            </form>
        </div>
    </politico-container>
</template>

<script>
import Politico from "@/Pages/admin/Politico";

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
        };
    },
    methods: {
        submit() {
          this.form.post(route('politico.create_pauta'), {
            //
          })
        },
    },
    components: {
        'politico-container': Politico,
    },
};
</script>

<style lang="scss" scoped></style>
