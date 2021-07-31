<template>
    <app-public>
        <section class="sec" id="sec1">
            <div id="background">
                <Link :href="route('entrar')">Exerça sua cidadania</Link>
            </div>
        </section>
        <section class="sec" id="sec2">
            
        </section>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppPublic,
        Link,
    },
};
</script>

<style lang="scss" scoped>
.sec {
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
            &:hover{
                background-color: $blue1;
                box-shadow: none;
            }
        }
    }
}
</style>
