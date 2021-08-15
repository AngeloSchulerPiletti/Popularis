<template>
    <div
        class="card_container"
        @mouseenter="anim_div('on')"
        @mouseleave="anim_div('off')"
        
        :id="card_name"
    >
        <div class="top">
            <div class="header">
                <h2>{{ pauta[0] }}</h2>
                <link-icon class="card_share" @click="copy_text" />
            </div>
            <p>{{ pauta[1] }}</p>
        </div>
        <div class="bottom" data-anim="none">
            <ul>
                <li v-for="(value, title) in pauta[4]" :key="title">
                    {{ title }}<span>{{ value }}</span>
                </li>
            </ul>
            <span class="id_card">{{ pauta[2] }}</span>
        </div>
    </div>
</template>

<script scoped>
import LinkIcon from "@/Components/SVGs/icons/LinkIcon";

export default {
    data() {
        return {
            //
        };
    },
    methods: {
        anim_div(action) {
            var div = document.querySelector("#"+this.card_name).querySelector('.bottom');

            if (action == "on") {
                    div.style.display = "block";
                    setTimeout(() => {
                        div.dataset.anim = "on";
                    }, 10);
            } else {
                div.dataset.anim = "off";
                setTimeout(() => {
                    div.style.display = "none";
                }, 300);
            }
        },
        copy_text(which) {
            //
        },
    },
    props: {
        pauta: Array, // [[Pauta format], [title, resume, id, url, {'titulo de prop1': prop1, ...}]]
        card_name: String,
    },
    components: {
        LinkIcon,
    },
};
</script>

<style lang="scss" scoped>
.card_container {
    width: 80%;
    margin: auto;
    border-left: 2px solid $blue;
    padding-left: 30px;

    position: relative;
    box-sizing: border-box;

    .top {
        display: flex;
        flex-direction: column;

        border-bottom: 2px solid $blue;
        padding-bottom: 10px;
        margin-bottom: 10px;

        background-color: $white;

        .header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;

            h2 {
                @include Title4;
                color: $blue;
                font-size: 30px;
            }
            .card_share {
                width: 20px;
                height: 20px;
            }
        }
        p {
            @include Font1;
            color: $black;
            text-align: justify;
        }
    }
    .bottom {
        position: relative;
        z-index: -1;
        transform: translateY(-100%);

        display: none;
        opacity: 0;

        ul {
            display: flex;
            flex-direction: column;
            gap: 6px;

            li {
                @include Font0;
                font-size: 14px;
                color: $black;

                span {
                    @include Font1_I;
                    font-size: 16px;
                    @include badge($white, $blue);
                }
            }
        }
        .id_card {
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
            font-size: 12px;
            color: $black;
        }

        &[data-anim] {
            transition: transform 300ms, opacity 200ms;
        }
        &[data-anim="off"] {
            transform: translateY(-100%);
            opacity: 0;
        }
        &[data-anim="on"] {
            transform: translateY(0);
            opacity: 1;
        }
    }
}
</style>
