<template>
    <header>
        <div class="top">
            <div id="logo">
                <Link id="logo_link" :href="route('inicio')"><bandeira /></Link>
            </div>
            <div id="title">
                <h1>
                    <span id="area">Área do </span>
                    {{ title }}
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
            <div id="dropmenu_container">
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
                        v-for="(array_values, index) in links_header.primary"
                        :key="index"
                        :id="array_values[1]"
                        :class="array_values[3]"
                        :href="array_values[2]"
                        @mouseenter="open(array_values)"
                        >{{ array_values[0] }}</Link
                    >
                </div>
                <!-- LINKS SECUNDÁRIOS -->
                <div id="sublinks_container">
                    <div
                        class="sublinks"
                        v-for="(array, index) in links_header.secondary"
                        :key="index"
                        :id="array[index][1] + '_container'"
                    >
                        <Link
                            v-for="(elements, index) in array"
                            :key="index"
                            :href="elements[2]"
                            >{{ elements[0] }}</Link
                        >
                    </div>
                </div>
            </nav>
        </div>
        <div id="dropmenu" data-anim="none">
            <ul>
                <li v-if="$page.props.user.tecnico" class="link">
                    <Link :href="route('tecnico.show')">Área do Técnico</Link>
                </li>
                <li v-if="$page.props.user.tecnico"><hr /></li>
                <li v-if="$page.props.user.politico" class="link">
                    <Link :href="route('politico.pauta_create.show')"
                        >Área do Político</Link
                    >
                </li>
                <li v-if="$page.props.user.politico"><hr /></li>
                <li class="link">
                    <Link :href="route('profile.show')">Conta</Link>
                </li>
                <li><hr /></li>
                <li class="link">
                    <button @click="$inertia.post(route('logout'))">
                        Sair
                    </button>
                </li>
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
            links_header: {
                primary: {},
                secondary: [],
            },
        };
    },
    created() {
        if (this.$page.props.user) {
            this.user_name = this.$page.props.user.name.split(" ")[0];
        }
        if (this.links) {
            var link_obj = this.links;
            var primary_title = Object.keys(link_obj),
                primary_array = Object.values(link_obj);

            var primary_links = [
                    /*['title', 'id', 'route, has secondary?'],*/
                ],
                secondary_links = [
                    /*['title', 'owner(id)', 'route],*/
                ];

            var secondary_values = [];
            for (
                var parent_i = 0;
                parent_i < primary_title.length;
                parent_i++
            ) {
                primary_links.push([
                    primary_title[parent_i],
                    primary_array[parent_i][0],
                    primary_array[parent_i][1],
                    "",
                ]);

                if (primary_array[parent_i][2]) {
                    primary_links[parent_i][3] = "more";

                    var secondary_titles = Object.keys(
                            primary_array[parent_i][2]
                        ),
                        secondary_routes = Object.values(
                            primary_array[parent_i][2]
                        );

                    var secondary_values_sub = [];
                    for (let i = 0; i < secondary_titles.length; i++) {
                        secondary_values_sub[i] = [
                            secondary_titles[i],
                            primary_array[parent_i][0],
                            secondary_routes[i],
                        ];
                    }
                    secondary_values.push(secondary_values_sub);

                    this.links_header.secondary = secondary_values;
                }
            }

            this.links_header.primary = primary_links;
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
        open(arr) {
            if (arr[3] == "more") {
                if (this.opened != "") {
                    let container = document.querySelector(
                        "#" + this.opened + "_container"
                    );
                    container.style.display = "none";
                }
                this.opened = arr[1];
                let container = document.querySelector(
                    "#" + arr[1] + "_container"
                );
                container.style.display = "flex";
            }
        },
    },
    props: {
        title: String,
        links: Object,
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

            #bandeira {
                width: 70px;
            }
        }
        #title {
            h1 {
                @include Title3;
                font-size: 50px;
                color: $blue;
                #area {
                    font-size: 0.5em;
                    text-transform: lowercase;
                }
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
            li:first-child {
                padding: 16px 10px 8px 10px;
            }
            li:last-child {
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
