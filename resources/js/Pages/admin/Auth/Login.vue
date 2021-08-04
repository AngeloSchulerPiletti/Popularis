<template>
    <app-public>
        <div class="form_container">
            <form @submit.prevent="submit">
                <div class="form_sec">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                    />
                </div>

                <div class="form_sec">
                    <label for="password">Senha</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                </div>

                <div class="form_sec">
                    <label class="checkbox_label">
                        <input type="checkbox" name="remember" v-model="form.remember"/>
                        <span>Lembre de mim</span>
                    </label>
                </div>

                <div class="options">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                    >
                        Esqueceu sua senha?
                    </Link>

                    <button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Entrar
                    </button>
                </div>
            </form>
        </div></app-public
    >
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        Link,
        AppPublic,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false,
            }),
        };
    },

    methods: {
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? "on" : "",
                }))
                .post(this.route("login"), {
                    onFinish: () => this.form.reset("password"),
                });
        },
    },
};
</script>

<style lang="scss" scoped>
.form_container {
    @include form_container();
}
</style>
