<template>
    <div id="website">
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

export default {
    data() {
        return {
            title: {
                tecnico: "Técnico",
                politico: "Político",
            },
        };
    },
    methods: {
        //
    },
    props: {
        area: String,
        links: Object,
    },
    components: {
        "header-component": Header,
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
}
</style>
