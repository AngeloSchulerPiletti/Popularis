<template>
    <app-public>
        <div class="view_header">
            <div class="aviso"><p>Atenção ao votar. Você não poderá mudar o voto uma vez que enviado!</p></div>
            <div class="vote_container">
                <div class="votos favor">
                    <h3>A Favor</h3>
                    <h5>{{ pauta.pos_votes }}</h5>
                    <button @click="vote('pos')" v-if="!votou">VOTAR</button>
                </div>
                <div class="votos contra">
                    <h3>Contra</h3>
                    <h5>{{ pauta.neg_votes }}</h5>
                    <button @click="vote('neg')" v-if="!votou">VOTAR</button>
                </div>
                <div class="percentual pos">
                    <h4>{{ percentual_pos }}%</h4>
                </div>
                <div class="percentual neg">
                    <h4>{{ percentual_neg }}%</h4>
                </div>
            </div>
            <div id="back"></div>
        </div>
        <div class="view_container">
            <pauta-view :pauta="pauta" />
        </div>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import PautaView from "@/Components/geral/PautaView";

export default {
    data() {
        return {
            percentual_pos: 0,
            percentual_neg: 0,
            per_pos: 0,
        };
    },
    created() {
        this.calc_percentual();
    },
    updated() {
        this.calc_percentual();
    },
    methods: {
        vote(type) {
            this.$inertia
                .form({ voto: type })
                .post(route("pauta.store", { url: this.$props.pauta.url }));
        },
        calc_percentual() {
            var vm = this.pauta;
            var pos = vm.pos_votes == 0 ? 1 : vm.pos_votes,
                neg = vm.neg_votes == 0 ? 1 : vm.neg_votes;

            var total = pos + neg;
            var per_pos = ((pos / total) * 100).toFixed(2),
                per_neg = ((neg / total) * 100).toFixed(2);

            this.percentual_pos = per_pos;
            this.percentual_neg = per_neg;

            this.per_pos = Number(per_pos).toFixed(0);
        },
    },
    props: {
        pauta: Object,
        votou: Boolean,
    },
    components: {
        AppPublic,
        PautaView,
    },
};
</script>

<style lang="scss" scoped>
$padding_container: 20px;

.view_header {
    position: relative;

    .aviso{
        position: absolute;
        top: -10px;
        transform: translateY(-100%);
        left: 0;
        right: 0;

        p{
            width: 80%;
            margin: auto;
            text-align: center;
            @include Font1_I;
            color: $blue2;
            font-size: 13px;
        }
    }
    .vote_container {
        display: flex;
        justify-content: center;

        margin: 8vw auto 8vw auto;
        padding: 15px $padding_container;
        border-radius: 15px;

        box-shadow: 2px 2px 5px $black;
        background-color: $blue;
        width: 70%;

        position: relative;

        .votos {
            background-color: transparent;

            display: flex;
            flex-direction: column;
            align-items: center;

            h3 {
                @include Title3;
                font-size: 30px;
                color: $white;
                text-align: center;
            }
            h5 {
                font-size: 25px;
                color: $white;
                font-family: Arial, Helvetica, sans-serif;
            }
            button {
                margin-top: 10px;
                box-shadow: 2px 2px 5px $black;
                @include hover1(
                    $blue,
                    $white,
                    $white,
                    $white,
                    $blue1,
                    $blue1,
                    300ms
                );
                padding: 1px 20px;
                border-radius: 4px;
                @include Font0;
                font-size: 18px;
            }
        }
        .contra {
            flex-grow: 1;
            border-left: 2px solid $blue1;
        }
        .favor {
            flex-grow: 1;
            border-right: 2px solid $blue1;
        }
    }
    #back {
        position: absolute;
        z-index: -1;
        height: 68%;
        top: 50%;
        transform: translateY(-50%);
        background-color: $darken-blue;
        left: 0;
        right: 0;
    }
    .percentual {
        position: absolute;
        z-index: -1;
        height: 40%;
        background-color: $darken-blue;
        bottom: 0;
        color: $white;
        border-radius: 6px;

        display: flex;
        align-items: flex-end;

        h4 {
            padding: 10px 20px;
            font-family: Arial, Helvetica, sans-serif;
            color: $white;
            font-size: 30px;
        }
        &.pos {
            left: 25%;
            transform: translateY(90%) translateX(calc(-50% + 10px));

        }
        &.neg {
            left: 75%;
            transform: translateY(90%) translateX(calc(-50% - 10px));

        }
    }
}
.view_container {
    padding: 10vw 5vw 5vw 5vw;
}
</style>
