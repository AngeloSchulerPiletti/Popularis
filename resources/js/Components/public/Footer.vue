<template>
    <footer>
        <nav>
            <ul>
                <li><Link href="#">Fale Conosco</Link></li>
                <li><Link href="#">Contribua</Link></li>
                <li><Link href="#">Governo Estadual</Link></li>
            </ul>
            <ul>
                <li><Link href="#">Termos de Uso</Link></li>
                <li><Link href="#">Política de Privacidade</Link></li>
                <li><Link href="#">Governo Federal</Link></li>
            </ul>
        </nav>
        <p>&copy; Popularis, all rights reserved</p>
    </footer>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components:{
        Link,
    }
};
</script>

<style lang="scss" scoped>
footer {
    background-color: $blue;
    padding: 4vw 4vw 2vw 4vw !important;
    margin-top: 5vw !important;
            color: $white;

    nav{
        display: flex;
        justify-content: center;
        gap: 20vw;

        margin-bottom: 3vw;

        ul{
            @include Font1;
            font-size: 14px;

            display: flex;
            flex-direction: column;
            gap: 0.5vw;

            a{
                transition: color 200ms;
                &:hover{
                    color: $blue2;
                }
            }
        }
    }
    p{
        text-align: center;
        font-size: 0.6em;
    }
}
</style>
