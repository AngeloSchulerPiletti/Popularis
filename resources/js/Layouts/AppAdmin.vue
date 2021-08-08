<template>
    <div id="website">
        <info-window id="info_window" :window_content="content_to_pass"/>
        <div id="header_container">
            <header-component :title="title[area]" :links="links"/>
        </div>
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
import Header from "@/Components/admin/Header";
import InfoWindow from "@/Components/geral/InfoWindow";

export default {
    data() {
        return {
            title: {
                tecnico: "Técnico",
                politico: "Político",
            },
            content_to_pass: {},
        };
    },
    methods:{
        refresh(){
            if(this.window_content){
                let prop = this.window_content;
                this.$data.content_to_pass = prop;
            }
        },
    },
    updated(){
        this.refresh();
    },
    mounted(){
        this.refresh();
    },
    props: {
        area: String,
        links: Object,
        window_content: Object,
    },
    components: {
        "header-component": Header,
        InfoWindow,
    },
};
</script>

<style lang="scss" scoped>
#website {
    display: flex;
    flex-direction: column;
    min-height: 100vh;

    #info_window{
        z-index: 10000;
    }
    #header_container {
        position: relative;
        z-index: 1000;
    }
}
</style>
