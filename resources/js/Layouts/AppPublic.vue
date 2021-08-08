<template>
    <div id="website">
        <messages class="messages"/>
        <!-- <info-window id="info_window" :window_content="content_to_pass"/> -->
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
            //
        }
    },
    methods:{
        //
    },
    components: {
        "header-component": Header,
        "footer-component": Footer,
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
