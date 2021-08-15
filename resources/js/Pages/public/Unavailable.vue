<template>
    <app-public>
        <div class="unavailable_container">
            <div class="header">
                <h3>{{ page_config[0] }}</h3>
                <p>{{ page_config[1] }}</p>
            </div>
            <div v-if="suggestions" class="suggestions">
                <ul>
                    <li v-for="(route, name) in suggestions" :key="name">
                        <Link :href="route">{{ name }}</Link>
                    </li>
                </ul>
            </div>
        </div>
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
    props: {
        page_config: Array, //['titulo', 'paragrafo']
        suggestions: Object, //['link_name': route('nome-da-rota'), ...]
    },
};
</script>

<style lang="scss" scoped>
.unavailable_container {
    padding: 110px 10% 0 10%;
    display: flex;
    flex-direction: column;
    gap: 45px;

    .header {
        border-left: 2px solid $blue;
        padding-left: 25px;

        h3 {
            @include Title4;
            font-size: 20px;
            color: $darken-blue;
        }
        p {
            @include Font2_I;
            color: $blue1;
            font-size: 15px;
        }
    }
    .suggestions {
        ul {
            li {
                a {
                    text-decoration: underline;
                    @include hover1(
                        $blue1,
                        transparent,
                        transparent,
                        $blue,
                        transparent,
                        transparent,
                        300ms
                    );
                }
            }
        }
    }
}
</style>
