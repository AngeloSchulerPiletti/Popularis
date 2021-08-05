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
            <div id="options" v-if="!$page.props.user">
                <ul>
                    <li>
                        <Link :href="route('entrar')">Entrar</Link>
                    </li>
                    <li>
                        <Link :href="route('cadastro')">Cadastro</Link>
                    </li>
                </ul>
            </div>
            <div id="dropmenu_container" v-else-if="$page.props.user">
                <div id="welcome">
                    <h6>Bem vindo, {{ user_name }}</h6>
                    <arrow-button
                        id="arrow_dropmenu"
                        class="arrow_btn"
                        color="blue"
                        @click="dropmenu"
                        data-anim="none"
                    />
                </div>
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
                    <Link v-if="$page.props.user" :href="route('profile.votes')">Meus votos</Link>
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
        <div v-if="$page.props.user" id="dropmenu" data-anim="none">
            <ul>
                <li v-if="$page.props.user.tecnico" class="link"><Link :href="route('tecnico.show')">Área do Técnico</Link></li>
                <li v-if="$page.props.user.tecnico"><hr /></li>
                <li v-if="$page.props.user.politico" class="link"><Link :href="route('politico.show')">Área do Político</Link></li>
                <li v-if="$page.props.user.politico"><hr /></li>
                <li class="link"><Link :href="route('profile.show')">Conta</Link></li>
                <li><hr /></li>
                <li class="link"><button @click="$inertia.post(route('logout'));">Sair</button></li>
            </ul>
        </div>
    </header>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Bandeira from "@/Components/SVGs/Bandeira";
import Arrow from "@/Components/SVGs/Arrow";

export default {
    data() {
        return {
            opened: "",
            user_name: "",
        };
    },
    created() {
        if (this.$page.props.user) {
            this.user_name = this.$page.props.user.name.split(" ")[0];
        }
    },
    methods: {
        dropmenu: function () {
            var arrow = document.querySelector("#arrow_dropmenu"),
                dropmenu = document.querySelector("#dropmenu");

            if (arrow.dataset.anim == "off" || arrow.dataset.anim == "none") {
                dropmenu.style.display = "block";

                setTimeout(function () {
                    arrow.dataset.anim = "on";
                    dropmenu.dataset.anim = "on";
                }, 10);
            } else if (arrow.dataset.anim == "on") {
                arrow.dataset.anim = "off";
                dropmenu.dataset.anim = "off";

                setTimeout(function () {
                    dropmenu.style.display = "none";
                }, 700);
            }
        },
        close() {
            var containers = document.querySelectorAll(".sublinks");
            containers.forEach((cont) => {
                cont.style.display = "none";
            });
        },
        open(wich) {
            if (this.opened != "") {
                let container = document.querySelector(
                    "#" + this.opened + "_container"
                );
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
        "arrow-button": Arrow,
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

    $lateral_padding_top: 2.5vw;
    .top {
        display: grid;
        grid-template-columns: 2fr 7fr 4fr;
        align-items: center;
        padding: 0.3vw $lateral_padding_top 0.3vw $lateral_padding_top;

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
                gap: 20px;
                justify-content: flex-end;
                li {
                    cursor: default;
                    @include Font1;
                    font-size: 17px;

                    a {
                        cursor: pointer;
                        transition: color 300ms;
                        &:hover {
                            color: $blue;
                        }
                    }
                }
            }
        }
        #dropmenu_container {
            // position: relative;

            #welcome {
                display: flex;
                gap: 5px;
                justify-content: flex-end;
                align-items: center;

                h6 {
                    cursor: default;
                    @include Font1;
                    font-size: 17px;
                }
                .arrow_btn {
                    width: 42px;
                    transform: rotate(-90deg);
                    cursor: pointer;

                    &[data-anim] {
                        transition: transform 500ms;
                    }
                    &[data-anim="on"] {
                        transform: rotate(-90deg) scaleX(-1);
                    }
                    &[data-anim="off"] {
                        transform: rotate(-90deg) scaleX(1);
                    }
                }
            }
            // #dropmenu {
            //     // display: none;
            //     background-color: $blue1;
            //     color: $white;

            //     width: 200px;
            //     position: absolute;
            //     bottom: 0;
            //     right: 0;

            //     padding: 5px 0 5px 0;
            //     border-radius: 0px 0px 8px 8px;

            //     &[data-anim] {
            //     }
            //     &[data-anim="on"] {
            //     }
            //     &[data-anim="off"] {
            //     }
            // }
        }
    }
    .bottom {
        position: absolute;
        z-index: -10;
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
    #dropmenu {
        // display: none;
        color: $white;

        width: 200px;
        position: absolute;
        bottom: 0;
        right: $lateral_padding_top;
        transform: translateY(0);
        z-index: -1;

        &[data-anim] {
            transition: transform 600ms;
        }
        &[data-anim="on"] {
            transform: translateY(100%);
        }
        &[data-anim="off"] {
            transform: translateY(0);
        }

        ul {
            display: flex;
            flex-direction: column;

            .link {
                padding: 8px 10px 8px 10px;
                display: flex;

        @include hover1(
                        $white,
                        $blue,
                        transparent,
                        $blue,
                        $white,
                        transparent,
                        200ms
                    );

                a {
                    flex-grow: 1;
                    font-size: 15px;
                    
                }
            }
            li:first-child{
                padding: 16px 10px 8px 10px;
            }
            li:last-child{
                padding: 8px 10px 8px 16px;
                
        border-radius: 0px 0px 8px 8px;
            }

            hr {
                outline: none;
                border: none;
                height: 1px;
                background-color: $white;
            }
        }
    }
}
</style>
