<template>
    <div @click="close" class="window" data-anim="none">
        <div class="info_container">
            <div class="head_info">
                <h3>{{ title }}</h3>
                <p>{{ subtitle }}</p>
            </div>
            <div class="body_info">
                <p v-for="(p, index) in par" :key="index">{{ p }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "",
            subtitle: "",
            par: [],
        };
    },
    methods: {
        close(event) {
            if (event.path.length <= 7) {
                var container = document.querySelector(".window");

                container.dataset.anim = "off";
                setTimeout(() => {
                    container.style.display = "none";
                }, 400);
            }
        },
        refresh() {
            var container = document.querySelector(".window");

            if (Object.keys(this.$props.window_content).length > 0) {
                var content = this.window_content;
                this.$data.title = content[0];

                let other_props = content[1]; //['subtitle', ['p1', 'p2', 'p3' ...n 'pn']]
                this.$data.subtitle = other_props[0];
                this.$data.par = other_props[1];

                if (container.style.display != "block") {
                    console.log('resolved');

                    container.style.display = "block";
                    setTimeout(() => {
                        container.dataset.anim = "on";
                    }, 10);
                }
            }
        },
    },
    mounted() {
        this.refresh();
    },
    updated() {
        this.refresh();
    },
    props: {
        window_content: Object, //['titulo', ['subtitle', ['p1', 'p2', 'p3' ...n 'pn']]]
    },
};
</script>

<style lang="scss" scoped>
.window {
    display: none;
    opacity: 0;
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: #000000b0;
    z-index: 10000;

    .info_container {
        width: 60vw;
        margin: 10vh auto 0 auto;
        max-height: 80vh;
        overflow-y: auto;
        background-color: $white;

        padding: 20px;
        border-radius: 10px;

        .head_info {
            border-bottom: 1px solid $blue;
            padding-bottom: 10px;
            margin-bottom: 18px;

            h3 {
                @include Title4;
                font-size: 24px;
                color: $blue;
            }
            p {
                @include Font1_I;
                font-size: 14px;
                color: $blue1;
            }
        }
        .body_info {
            display: flex;
            flex-direction: column;
            gap: 8px;

            p {
                @include Font1;
                font-size: 16px;
                color: $black;

                text-indent: 1em;
            }
        }
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
