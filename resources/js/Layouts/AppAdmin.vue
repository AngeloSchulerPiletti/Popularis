<template>
    <div id="website">
        <messages-report :errors="$page.props.errors" :status="status" class="messages"/>
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
import Messages from "@/Components/geral/Messages";

export default {
    data() {
        return {
            title: {
                tecnico: "Técnico",
                politico: "Político",
            },
            content_to_pass: {},
            status: {},
        };
    },
    methods:{ 
        refresh(){
            if(this.$data.content_to_pass != this.window_content && this.window_content){
                this.$data.content_to_pass = this.window_content ? this.window_content     : {};
            }
            if(this.$data.status != this.$page.props.status && this.$page.props.status){
                this.$data.status = this.$page.props.status      ? this.$page.props.status : {};
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
        "messages-report": Messages,
    },
};
</script>

<style lang="scss" scoped>
#website {
    display: flex;
    flex-direction: column;
    min-height: 100vh;

    .messages{
        z-index: 100000;
    }
    #info_window{
        z-index: 10000;
    }
    #header_container {
        position: relative;
        z-index: 1000;
    }
}
</style>
