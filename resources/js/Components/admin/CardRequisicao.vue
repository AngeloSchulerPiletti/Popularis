<template>
    <div class="card_container">
        <div class="left">
            <div class="top">
                <h4>{{ pauta_info.title }}</h4>
                <p>{{ pauta_info.resume }}</p>
            </div>
            <ul class="bottom">
                <li class="responsavel">{{ badges.responsavel }}</li>
                <li class="assunto">{{ badges.assunto }}</li>
                <li class="data">{{ badges.data }}</li>
            </ul>
        </div>
        <div class="right">
            <button><icon-agree class="icon agree" /></button>
            <button><icon-eye class="icon eye" /></button>
            <button><icon-block class="icon block" /></button>
        </div>
    </div>
</template>

<script>
import Agree from "@/Components/SVGs/icons/Agree";
import Block from "@/Components/SVGs/icons/Block";
import Eye from "@/Components/SVGs/icons/Eye";

export default {
    data() {
        return {
            pauta_info: {
                title: "",
                resume: "",
            },
            badges: {
                responsavel: "",
                assunto: "",
                data: "",
            },
            current_pauta: {},
        };
    },
    methods: {
        refresh() {
            if (this.pauta && this.pauta != this.current_pauta) {
                this.current_pauta = this.pauta;
                var vm = this.pauta;
                var title = vm.titulo,
                    resume = vm.resumo;

                this.pauta_info.title = title;
                this.pauta_info.resume = resume;

                var infos = {
                    responsavel: vm.responsavel,
                    assunto: vm.assunto,
                    data: vm.created_at.split(" ")[0],
                };
                infos.data = infos.data.split("-");
                infos.data = `${infos.data[2]}/${infos.data[1]}/${infos.data[0]}`;

                this.badges = infos;
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
    components: {
        "icon-agree": Agree,
        "icon-block": Block,
        "icon-eye": Eye,
    },
};
</script>

<style lang="scss" scoped>
.card_container {
    box-shadow: 2px 2px 5px $black;
    border-radius: 6px;
    padding: 20px;

    width: 80%;
    margin: auto;

    display: flex;
    justify-content: space-between;
    gap: 60px;

    .left {
        .top {
            h4 {
                color: $blue1;
                @include Title4_I;
                font-size: 25px;
            }
            p {
                color: $black;
                @include Font1;
                font-size: 14px;

                word-wrap: break-word;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2; /* number of lines to show */
                -webkit-box-orient: vertical;
                overflow: hidden;

                height: 45px;
            }
        }
        .bottom {
            margin-top: 20px;

            display: flex;
            gap: 12px;

            li {
                padding: 1px 10px 1px 10px;
                border-radius: 6px;
                @include Font2;
                font-size: 12px;
                background-color: $blue1;
                color: $white;
            }
        }
    }
    .right {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 9px;
        justify-content: center;
        position: relative;
        padding-left: 16px;

        &::before {
            content: "";
            height: 85%;
            border-left: 1px solid $blue;
            position: absolute;
            left: 0;
        }

        button {
        }
        .icon {
            width: 16px;
            height: 16px;
        }
        .agree {
            // &:hover{
            //     path{
            //         fill: black;
            //     }
            // }
        }
        .eye {
        }
        .block {
        }
    }
}
</style>
