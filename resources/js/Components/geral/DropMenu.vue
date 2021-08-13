<template>
  <div id="dropmenu" data-anim="none">
            <ul>
                <li v-if="$page.props.user.tecnico" class="link">
                    <Link :href="route('tecnico.requisicoes.show')"
                        >Área do Técnico</Link
                    >
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
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components:{
        Link,
    }
}
</script>

<style lang="scss" scoped>
#dropmenu {
        // display: none;
        color: $white;

        width: 200px;
        position: absolute;
        bottom: 0;
        right: $lateral_padding_top;
        transform: translateY(0);
        z-index: -1;

        box-shadow: 0px 0px 5px $black;
        border-radius: 0px 0px 8px 8px;

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
</style>