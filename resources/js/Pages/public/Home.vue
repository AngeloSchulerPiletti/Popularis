<template>
    <app-public>
        <div class="sec">
            <section id="sec1">
                <div id="background">
                    <Link href="#">Exerça sua cidadania</Link>
                </div>
            </section>
            <section id="sec2">
                <img src="images/smile.jpg" />
                <div>
                    <p id="quotes">
                        Votar é um direito de todo cidadão e, através da
                        plataforma Popularis, o Governo Federal garante a
                        soberania desse direito
                    </p>
                    <p id="autor">Cristiano Ferreira</p>
                </div>
            </section>
            <section id="sec3">
                <div
                    class="card"
                    @mouseenter="card[0] = 'white'"
                    @mouseleave="card[0] = ''"
                >
                    <com class="icon" :int="card[0]" />
                    <legend>Comunicados</legend>
                </div>
                <div
                    class="card"
                    @mouseenter="card[1] = 'white'"
                    @mouseleave="card[1] = ''"
                >
                    <rep class="icon" :int="card[1]" />
                    <legend>Representantes</legend>
                </div>
                <div
                    class="card"
                    @mouseenter="card[2] = 'white'"
                    @mouseleave="card[2] = ''"
                >
                    <faq class="icon" :int="card[2]" />
                    <legend>FAQ</legend>
                </div>
            </section>
            <section id="sec4" v-if="notices">
                <h4>Últimas Notícias</h4>
                <div class="notice_container">
                    <div
                        class="notice_card"
                        v-for="notice in notices"
                        :key="notice"
                    >
                        <Link href="#">
                            <h3>{{ notice[0] }}</h3>
                            <p>{{ notice[1] }}</p>
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import { Link } from "@inertiajs/inertia-vue3";
import { scrollF } from "@/Pages/scripts/scrolling";

// SVGs
import Com from "@/Components/SVGs/Inicio/Com";
import Faq from "@/Components/SVGs/Inicio/Faq";
import Rep from "@/Components/SVGs/Inicio/Rep";

export default {
    data() {
        return {
            card: ["", "", ""],
            notices: [],
        };
    },
    methods:{
        //--------------- ABOUT THE SCROLL ---------------- 
        scrollCheck: function(sections){
            var scroll_data = {
                'html_height':    document.body.scrollHeight,
                'screen_height':  window.innerHeight,
                'Ytop_value':     window.pageYOffset,
                'Ybottom_value':  window.pageYOffset + window.innerHeight,
            };
            sections.forEach((sec) => {
                if (
                    sec.offsetTop <
                    3 * (scroll_data.screen_height / 4) +
                        scroll_data.Ytop_value
                ) {
                    sec.classList.add("anim_it");
                }
            });
        }
        //--------------- ABOUT THE SCROLL ---------------- 

    },
    mounted() {
        let data = this.notices_data;
        this.notices =
            typeof data !== "undefined"
                ? data.length > 0
                    ? data
                    : false
                : false;

        //--------------- ABOUT THE SCROLL ---------------- 
        var sections = document.querySelectorAll("section"),
            vm = this;

        this.scrollCheck(sections);
        document.addEventListener("scroll", function(){
            vm.scrollCheck(sections);
        });
        //--------------- ABOUT THE SCROLL ---------------- 
    },
    components: {
        AppPublic,
        Link,
        Faq,
        Rep,
        Com,
    },
    props: {
        notices_data: Array,
    },
};
</script>

<style lang="scss" scoped>
.sec {
    display: flex;
    flex-direction: column;
    gap: 8vw;
}
#sec1 {
    #background {
        background-image: url("/images/colheita.jpg");
        width: 100%;
        height: 28vw;
        background-repeat: no-repeat;
        background-size: cover;
        background-position-y: 65%;

        position: relative;

        a {
            position: absolute;
            right: 10%;
            bottom: 20%;

            @include Title3;
            font-size: 21px;
            color: $white;
            background-color: $blue;
            padding: 5px 26px;
            border-radius: 25px;

            box-shadow: 0px 0px 7px $black;

            transition: box-shadow 400ms, background-color 200ms;
            &:hover {
                background-color: $blue1;
                box-shadow: none;
            }
        }
    }
}
#sec2 {
    display: flex;
    justify-content: center;
    gap: 3vw;
    align-items: center;

    img {
        width: 15vw;
        height: 15vw;
        object-fit: cover;
        border-radius: 0.7vw;
    }
    p {
        color: $blue;
        font-size: 18px;
    }
    #quotes {
        width: 50vw;
        margin-bottom: 1.5vw;
        line-height: 140%;

        &::after,
        &::before {
            font-family: "Times New Roman", Times, serif;
            font-size: 1.5em;
            font-weight: 900;
        }
        &::after {
            content: "\201d";
        }
        &::before {
            content: "\201c";
        }
    }
}
#sec3 {
    display: flex;
    justify-content: center;
    gap: 5vw;

    .card {
        width: 16vw;
        border: 2px solid $blue;
        padding: 2vw;
        border-radius: 1vw;

        cursor: pointer;

        .icon {
            width: 80%;
            margin: auto;
        }
        legend {
            font-size: 16px;
            color: $blue;
            @include Font0;

            text-align: center;
            text-transform: uppercase;
            width: 80%;
            margin: 1vw auto 0 auto;

            transition: color 200ms;
        }

        transition: background-color 200ms;
        &:hover {
            background-color: $blue;

            legend {
                color: $white;
            }
        }
    }
}
#sec4 {
    h4 {
        @include Title2;
        text-transform: capitalize;
        font-size: 25px;
        margin: 2vw 0vw 2.5vw 0vw;
        color: $blue;
        text-align: center;
    }
    .notice_container {
        width: 80%;
        margin: auto;

        display: flex;
        flex-direction: column;
        gap: 2vw;

        .notice_card {
            position: relative;
            padding: 1vw;

            &::before {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;

                content: "";
                border-left: 2px solid $blue;

                transition: top 700ms, height 700ms;
            }
            &:hover::before {
                top: 50%;
                height: 0;
            }

            h3 {
                @include Font0;
                font-size: 19px;
                color: $blue;
                margin-bottom: 0.4vw;
            }
            p {
                // color: ;
                font-size: 15px;
            }
        }
    }
}
</style>
