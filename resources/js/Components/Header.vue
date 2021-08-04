<template>
    <header>
        <div class="top">
            <div id="logo">
                <Link id="logo_link" :href="route('inicio')"><bandeira /></Link>
            </div>
            <div id="title">
                <h1>
                    Popularis
                    <span id="govbr">
                        <span>g</span>
                        <span>o</span>
                        <span>v</span>
                        <span>.</span>
                        <span>b</span>
                        <span>r</span>
                    </span>
                </h1>
            </div>
            <div id="options">
                <ul>
                    <li>
                        <Link :href="route('entrar')">Entrar</Link>
                    </li>
                    <li>
                        <Link :href="route('cadastro')">Cadastro</Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom">
            <nav @mouseleave="close()">
                <!-- LINKS PRINCIPAIS  -->
                <div id="links">
                    <Link
                        class="more"
                        :href="route('pautas.federal.all')"
                        @mouseenter="open('fed')"
                        >Pautas Federais</Link
                    >
                    <Link
                        class="more"
                        :href="route('pautas.estadual.all')"
                        @mouseenter="open('est')"
                        >Pautas Estaduais</Link
                    >
                    <Link :href="route('pautas.all')">Entenda</Link>
                </div>

                <!-- LINKS SECUNDÁRIOS -->
                <div id="sublinks_container">
                    <div class="sublinks" id="fed_container">
                        <Link
                            :href="route('pautas.federal', { type: 'atuais' })"
                            >P.F. Atuais</Link
                        >
                        <Link
                            :href="
                                route('pautas.federal', { type: 'passadas' })
                            "
                            >P.F. Passadas</Link
                        >
                        <Link
                            :href="route('pautas.federal', { type: 'futuras' })"
                            >P.F. Futuras</Link
                        >
                    </div>

                    <div class="sublinks" id="est_container">
                        <Link
                            :href="route('pautas.estadual', { type: 'atuais' })"
                            >P.E. Atuais</Link
                        >
                        <Link
                            :href="
                                route('pautas.estadual', { type: 'passadas' })
                            "
                            >P.E. Passadas</Link
                        >
                        <Link
                            :href="
                                route('pautas.estadual', { type: 'futuras' })
                            "
                            >P.E. Futuras</Link
                        >
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Bandeira from "@/Components/SVGs/Bandeira";

export default {
    data() {
        return {
            opened: "",
        };
    },
    methods: {
        close() {
            var containers = document.querySelectorAll(".sublinks");
            containers.forEach((cont) => {
                cont.style.display = "none";
            });
        },
        open(wich) {
            if(this.opened != ""){
                let container = document.querySelector("#" + this.opened + "_container");
                container.style.display = "none";
            }
            this.opened = wich;
            let container = document.querySelector("#" + wich + "_container");
                container.style.display = "flex";
           
        },
    },
    components: {
        Link,
        Bandeira,
    },
};
</script>

<style lang="scss" scoped>
header {
    position: relative;

    background-color: $white;
    box-shadow: 0px 0px 15px 0px $black;

    display: flex;
    flex-direction: column;
    color: $blue1;

    .top {
        display: grid;
        grid-template-columns: 2fr 7fr 2fr;
        align-items: center;
        padding: 0.3vw 2.5vw 0.3vw 2.5vw;

        #logo {
            width: fit-content;
            height: fit-content;

            #logo_link {
            }
            #bandeira {
                width: 70px;
            }
        }
        #title {
            h1 {
                @include Title3;
                font-size: 50px;
                color: $blue;
                #govbr {
                    font-size: 0.45em;
                    text-transform: lowercase;
                    color: $blue1;
                    span:nth-child(2) {
                        color: $yellow;
                    }
                    span:nth-child(6) {
                        color: $yellow;
                    }
                    span:nth-child(3) {
                        color: $green;
                    }
                }
            }
        }
        #options {
            ul {
                display: flex;
                gap: 15px;
                justify-content: flex-end;
                li {
                    @include Font1;
                    font-size: 17px;
                    transition: color 300ms;

                    &:hover {
                        color: $blue;
                    }
                }
            }
        }
    }
    .bottom {
        position: absolute;
        right: 0;
        left: 0;
        bottom: 0;
        transform: translateY(100%);
        

        background: linear-gradient(
            165deg,
            lighten($black, 60%),
            $white,
            lighten($black, 68%) 42%,
            $white,
            lighten($black, 60%)
        );

        nav {
            $vertical_adjust: 0.3vw;
            display: flex;
            flex-direction: column;
            padding: $vertical_adjust 2.5vw $vertical_adjust 2.5vw;
            justify-content: flex-start;
            a {
                transition: color 200ms;

                &:hover {
                    color: $blue;
                }
            }

            #links {
                display: flex;
                gap: 30px;

                a {
                    font-size: 16px;
                    &.more::after {
                        content: " \2b9f";
                        vertical-align: center;
                    }
                }
            }
            #sublinks_container {
                .sublinks {
                    display: none;
                    gap: 3.4vw;

                    a {
                        font-size: 14px;
                    }
                }
            }
        }
    }
}
</style>
