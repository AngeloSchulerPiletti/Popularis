<template>
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
                    v-for="(key_w, index) in pauta_to_show.palavras_chave"
                    :key="index"
                >
                    {{ key_w }}
                </li>
            </ul>
        </div>
        <div class="sec5">
            <p><span>Criada em:</span> {{ pauta_to_show.data_inicial }}</p>
            <p>
                <span>Disponível até:</span>
                {{ pauta_to_show.data_final }}
            </p>
        </div>
    </div>
    <article v-html="pauta_to_show.pauta"></article>
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
        refresh() {
            if (
                Object.keys(this.pauta).length > 0 &&
                this.pauta != this.current_pauta
            ) {
                var vm = this.pauta;
                this.current_pauta = vm;

                this.pauta_to_show.titulo = vm.titulo;
                this.pauta_to_show.resumo = vm.resumo;
                this.pauta_to_show.assunto = vm.assunto;
                this.pauta_to_show.local = vm.local;
                this.pauta_to_show.pauta = vm.pauta;

                let escope = { estadual: "Estadual", federal: "Federal" };
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
</style>
