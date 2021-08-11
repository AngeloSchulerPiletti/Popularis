<template>
    <div @click="close" class="modal_container" data-anim="none">
        <div class="modal">
        <pauta-view :pauta="pauta"/>
        </div>
    </div>
</template>

<script>
import PautaView from "@/Components/geral/PautaView";

export default {
    data() {
        return {
            current_pauta: {},
            
        };
    },
    methods: {
        close(event) {
            if (event.path.length <= 9) {
                var container = document.querySelector(".modal_container");

                container.dataset.anim = "off";
                setTimeout(() => {
                    this.$emit('close_pauta');
                    this.current_pauta = {};
                }, 400);
            }
        },
        refresh() {
            if (Object.keys(this.pauta).length > 0 && this.pauta != this.current_pauta) {
                var container = document.querySelector(".modal_container");
                setTimeout(() => {
                container.dataset.anim = "on";
                }, 10);

                var vm = this.pauta;
                this.current_pauta = vm;
            }
        },
    },
    created() {
        this.refresh();
    },
    updated() {
        this.refresh();
    },
    props: {
        pauta: Object,
    },
    components:{
        PautaView,
    },
};
</script>

<style lang="scss" scoped>
.modal_container {
    opacity: 0;
    position: fixed;
    width: 100vw;
    top: 0;
    bottom: 0;
    background-color: #000000b0;
    z-index: 10000;

    .modal {
    background-color: $white;
    border-radius: 10px;
    width: 80%;
    margin: auto;
    max-height: 80vh;
    margin-top: 10vh;
    box-sizing: border-box;
    padding: 20px;

    overflow-y: auto;
    }

    &[data-anim] {
        transition: opacity 390ms;
    }
    &[data-anim="on"] {
        opacity: 1;
    }
    &[data-anim="off"] {
        opacity: 0;
    }
}
</style>
