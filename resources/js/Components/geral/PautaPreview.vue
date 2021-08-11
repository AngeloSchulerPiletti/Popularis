<template>
    <div @click="close" class="modal_container" data-anim="none">
        <div class="modal">
            <div class="header">
                <div class="sec1">
                    <h1>{{ pauta_to_show.titulo }}</h1>
                    <p>{{ pauta_to_show.resumo }}</p>
                </div>
                <div class="sec2 listing">
                    <h6>Autores:</h6>
                    <ul>
                        <li
                            v-for="(autor, index) in pauta_to_show.autores"
                            :key="index"
                        >
                            {{ autor }}
                        </li>
                    </ul>
                </div>
                <div class="sec3 listing">
                    <h6>Região:</h6>
                    <ul>
                        <li>{{ pauta_to_show.assunto }}</li>
                        <li>{{ pauta_to_show.escopo }}</li>
                        <li>{{ pauta_to_show.local }}</li>
                    </ul>
                </div>
                <div class="sec4 listing">
                    <h6>Palavras-chave:</h6>
                    <ul>
                        <li
                            v-for="(
                                key_w, index
                            ) in pauta_to_show.palavras_chave"
                            :key="index"
                        >
                            {{ key_w }}
                        </li>
                    </ul>
                </div>
                <div class="sec5">
                    <p>
                        <span>Criada em:</span> {{ pauta_to_show.data_inicial }}
                    </p>
                    <p>
                        <span>Disponível até:</span>
                        {{ pauta_to_show.data_final }}
                    </p>
                </div>
            </div>
            <article v-html="pauta_to_show.pauta"></article>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pauta_to_show: {
                pauta: "",
                resumo: "",
                autores: [],
                data_inicial: "",
                data_final: "",
                assunto: "",
                palavras_chave: [],
                escopo: "",
                local: "",
            },
            current_pauta: {},
            
        };
    },
    methods: {
        close(event) {
            if (event.path.length <= 9) {
                var container = document.querySelector(".modal_container");

                container.dataset.anim = "off";
                setTimeout(() => {
                    this.$emit('close_pauta');
                    this.current_pauta = {};
                }, 400);

                
            }
        },
        refresh() {
            if (Object.keys(this.pauta).length > 0 && this.pauta != this.current_pauta) {
                var container = document.querySelector(".modal_container");
                setTimeout(() => {
                container.dataset.anim = "on";
                }, 10);

                var vm = this.pauta;
                this.current_pauta = vm;

                this.pauta_to_show.titulo = vm.titulo;
                this.pauta_to_show.resumo = vm.resumo;
                this.pauta_to_show.assunto = vm.assunto;
                this.pauta_to_show.local = vm.local;
                this.pauta_to_show.pauta = vm.pauta;

                let escope = { est: "Estadual", fed: "Federal" };
                this.pauta_to_show.escopo = escope[vm.escopo];

                let autores = vm.autores.split("-");
                this.pauta_to_show.autores = autores;

                let palavras_chave = vm.palavras_chave.split("-");
                this.pauta_to_show.palavras_chave = palavras_chave;

                let data = vm.created_at.split(" ");
                data = data[0].replace("-", "/");
                data = data.replace("-", "/");

                this.pauta_to_show.data_inicial = data;

                let data_f = vm.final_date.split("-");
                this.pauta_to_show.data_final = `${data_f[2]}/${data_f[1]}/${data_f[0]}`;
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
        pauta: Object,
    },
};
</script>

<style lang="scss" scoped>
.modal_container {
    opacity: 0;
    position: fixed;
    width: 100vw;
    top: 0;
    bottom: 0;
    background-color: #000000b0;
    z-index: 10000;

    .modal {
        background-color: $white;
        border-radius: 10px;
        width: 80%;
        margin: auto;
        max-height: 80vh;
        margin-top: 10vh;
        box-sizing: border-box;
        padding: 20px;

        overflow-y: auto;

        .header {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid $blue;
            margin-bottom: 40px;

            .listing {
                display: flex;
                flex-direction: column;
                gap: 4px;

                h6 {
                    @include Title4;
                    font-size: 18px;
                    color: $blue;
                }
                ul {
                    display: flex;
                    gap: 8px;

                    li {
                        @include badge($white, $blue1);
                        text-transform: capitalize;
                    }
                }
            }
            .sec1 {
                h1 {
                    @include Title3;
                    font-size: 28px;
                    color: $blue;
                    text-align: center;
                    margin: 10px 0;
                }
                p {
                    @include Font1;
                    font-size: 15px;
                    color: $blue1;
                    text-align: justify;
                }
            }
            // .sec2{

            // }
            // .sec3{

            // }
            // .sec4{

            // }
            .sec5 {
                p {
                    @include Font0;
                    font-size: 16px;

                    span {
                        color: $blue;
                        font-size: 1.2em;
                    }
                }
            }
        }
        article {
            @include pauta_style;
        }
    }

    &[data-anim] {
        transition: opacity 390ms;
    }
    &[data-anim="on"] {
        opacity: 1;
    }
    &[data-anim="off"] {
        opacity: 0;
    }
}
</style>
