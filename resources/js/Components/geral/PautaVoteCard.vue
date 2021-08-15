<template>
    <div
        class="card_container"
        @mouseenter="anim_div('on')"
        @mouseleave="anim_div('off')"
        
        :id="card_name"
        data-anim="none"
    ><Link :href="'/pauta/'+pauta[3]">
        <div class="top" data-anim="none">
            <div class="header">
                <h2>{{ pauta[0] }}</h2>
                <link-icon class="card_share" @click="copy_text" />
            </div>
            <p>{{ pauta[1] }}</p>
        </div></Link>
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
import { Link } from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            //
        };
    },
    methods: {
        anim_div(action) {
            var container = document.querySelector("#"+this.card_name);
            var div_bottom = container.querySelector('.bottom'),
                div_top = container.querySelector('.top');

            if (action == "on") {
                    div_bottom.style.display = "block";
                    setTimeout(() => {
                        div_bottom.dataset.anim = "on";
                        div_top.dataset.anim = "on";
                        container.dataset.anim = "on";
                    }, 10);
            } else {
                div_top.dataset.anim = "off";
                container.dataset.anim = "off";
                div_bottom.dataset.anim = "off";
                setTimeout(() => {
                    div_bottom.style.display = "none";
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
        Link,
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

    .top {
        display: flex;
        flex-direction: column;
        position: relative;

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
                font-size: 30px;
                color: $blue;
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

        &::after{
            position: absolute;
            content: "";
            bottom: 0;
            left: 0;
            right: 100%;
            opacity: 0;
            border: 1px solid $blue;
            background-color: $blue;
        }

        &[data-anim]::after{
            transition: right 300ms, opacity 10ms;
        }
        &[data-anim="off"]::after{
            right: 100%;
            opacity: 0;
        }
        &[data-anim="on"]::after{
            right: 0;
            opacity: 1;
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


    // &[data-anim] {
    //         transition: transform 300ms, opacity 200ms;
    //     }
    //     &[data-anim="off"] {
    //         transform: translateY(-100%);
    //         opacity: 0;
    //     }
    //     &[data-anim="on"] {
    //         transform: translateY(0);
    //         opacity: 1;
    //     }
}
</style>
