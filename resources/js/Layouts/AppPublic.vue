<template>
    <div id="website">
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
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";

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
    },
};
</script>

<style lang="scss" scoped>
#website {
    display: flex;
    flex-direction: column;
    min-height: 100vh;

    #header_container {
        position: relative;
        z-index: 1000;
    }
    #footer_container {
        margin-top: auto;
    }
}
</style>
