<template>
    <header>
        <div class="top">
            <div id="logo">
                <Link :href="route('inicio')"><bandeira /></Link>
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
            <nav
                @mouseleave="
                    show.estadual = false;
                    show.federal = false;
                "
            >
                <Link
                    :href="route('pautas.federal.all')"
                    @mouseenter="show.federal = true"
                    >Pautas Federais</Link
                >
                <div v-show="show.federal">
                    <Link :href="route('pautas.federal', { type: 'atuais' })"
                        >Pautas Atuais</Link
                    >
                    <Link :href="route('pautas.federal', { type: 'passadas' })"
                        >Pautas Passadas</Link
                    >
                    <Link :href="route('pautas.federal', { type: 'futuras' })"
                        >Pautas Futuras</Link
                    >
                </div>
                <Link
                    :href="route('pautas.estadual.all')"
                    @mouseenter="show.estadual = true"
                    >Pautas Estaduais</Link
                >
                <div v-show="show.estadual">
                    <Link :href="route('pautas.estadual', { type: 'atuais' })"
                        >Pautas Atuais</Link
                    >
                    <Link :href="route('pautas.estadual', { type: 'passadas' })"
                        >Pautas Passadas</Link
                    >
                    <Link :href="route('pautas.estadual', { type: 'futuras' })"
                        >Pautas Futuras</Link
                    >
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
            show: {
                federal: false,
                estadual: false,
            },
        };
    },
    components: {
        Link,
        Bandeira,
    },
};
</script>

<style lang="scss" scoped>
header {
    background-color: $white;
    box-shadow: 0px 0px 15px 0px $black;

    display: flex;
    flex-direction: column;
    color: $blue1;

    .top {
        display: grid;
        grid-template-columns: 2fr 4fr 2fr;

        #logo {
            #bandeira {
                width: 6.2vw;
            }
        }
        #title {
            h1 {
                @include Title2;
                font-size: 4vw;
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
                    span:nth-child(3){
                        color: $green;
                    }
                }
            }
        }
        #options {
            ul {
                li {
                    @include Font1;
                }
            }
        }
    }
    .bottom {
    }
}
</style>
