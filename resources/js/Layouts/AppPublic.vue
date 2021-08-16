<template>
    <div id="website">
        <messages-report :errors="$page.props.errors" :status="status" class="messages"/>

        <info-window id="info_window" :window_content="content_to_pass"/>
        <div id="header_container">
            <header-component />
        </div>
        <main>
            <slot></slot>
        </main>
        <div id="footer_container">
            <footer-component />
        </div>
    </div>
</template>

<script>
import Messages from "@/Components/geral/Messages";
import InfoWindow from "@/Components/geral/InfoWindow";
import Header from "@/Components/public/Header";
import Footer from "@/Components/public/Footer";

export default {
    data(){
        return{
            content_to_pass: {},
            status: {},
        }
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
    props:{   
        window_content: Object,  
    },
    components: {
        "header-component": Header,
        "footer-component": Footer,
        "messages-report": Messages,
        InfoWindow,
        Messages,
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
    #footer_container {
        margin-top: auto;
    }
}
</style>
