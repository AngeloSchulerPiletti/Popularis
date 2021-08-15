<template>
    <div class="card_container">
        <div class="top">
            <div class="header">
                <h2>{{ pauta[0] }}</h2>
                <link-icon class="card_share" @click="copy_text" />
            </div>
            <p>{{ pauta[1] }}</p>
        </div>
        <div class="bottom">
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
        return {};
    },
    methods: {
        copy_text(which) {
            //
        },
    },
    props: {
        pauta: Array, // [[Pauta format], [title, resume, id, url, {'titulo de prop1': prop1, ...}]]
    },
    components: {
        LinkIcon,
    },
};
</script>

<style lang="scss" scoped>
.card_container{
    width: 80%;
    margin: auto;

    .top{
        display: flex;
        flex-direction: column;

        .header{
            display: flex;

            h2{

            }
            .card_share{
                width: 20px;
                height: 20px;

            }
        }
        p{

        }
    }
    .bottom{
        ul{
            li{

            }
        }
        .id_card{

        }
    }
}
</style>
