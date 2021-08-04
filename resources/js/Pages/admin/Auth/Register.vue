<template>
    <app-public>
        <div class="form_container">
            <form @submit.prevent="submit">
                <div class="form_sec">
                    <label for="name">Nome</label>
                    <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </div>

                <div class="form_sec">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                    />
                </div>

                <div class="form_sec">
                    <label for="password">Senha</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="form_sec">
                    <label for="password_confirmation">Confirme a senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="especial">
                    <div class="form_sec">
                        <label for="cpf">CPF</label>
                        <input
                            type="text"
                            name="cpf"
                            id="cpf"
                            v-model="form.cpf"
                            @input="cpf_mask"
                        />
                    </div>
                    <div class="form_sec">
                        <label for="titulo_eleitoral"
                            >Nº Título Eleitoral</label
                        >
                        <input
                            type="text"
                            name="titulo_eleitoral"
                            id="titulo_eleitoral"
                            v-model="form.titulo_eleitoral"
                            @input="titulo_eleitoral_mask"
                        />
                    </div>
                </div>

                <div
                    v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                >
                    <label for="terms">
                        <div>
                            <input
                                type="checkbox"
                                name="terms"
                                id="terms"
                                v-model="form.terms"
                            />
                            <div>
                                I agree to the
                                <a target="_blank" :href="route('terms.show')"
                                    >Terms of Service</a
                                >
                                and
                                <a target="_blank" :href="route('policy.show')"
                                    >Privacy Policy</a
                                >
                            </div>
                        </div>
                    </label>
                </div>

                <div class="options">
                    <Link :href="route('entrar')"> Já possui conta? </Link>

                    <button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        Link,
        AppPublic,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                cpf: "",
                titulo_eleitoral: "",
                terms: false,
            }),
            cpf_char_count: 0,
            titulo_eleitoral_char_count: 0,
        };
    },

    methods: {
        titulo_eleitoral_mask: function () {
            var value = this.form.titulo_eleitoral;
            var counter = value.length;

            if (counter > 14) {
                this.form.titulo_eleitoral =
                    this.form.titulo_eleitoral.substring(0, counter - 1);
                Math.abs(this.titulo_eleitoral_char_count) - Math.abs(counter) <
                2
                    ? counter--
                    : null;
            }
            if (value.match(/.*[a-zA-Z]+/)) {
                this.form.titulo_eleitoral =
                    this.form.titulo_eleitoral.substring(0, counter - 1);
                Math.abs(this.titulo_eleitoral_char_count) - Math.abs(counter) <
                2
                    ? counter--
                    : null;
            }


            if (value.match(/[0-9]{1}$/) && (counter == 5 || counter == 10)) {
                this.form.titulo_eleitoral = [value.slice(0, -1), " ", value.slice(-1)].join("");
                counter++;
            }
            if (counter > this.titulo_eleitoral_char_count && (counter == 5 || counter == 10)) {
                this.$data.form.titulo_eleitoral += " ";
                counter++;
            }

            this.titulo_eleitoral_char_count = counter;
        },
        cpf_mask: function () {
            var value = this.form.cpf;
            var counter = value.length;

            if (counter > 14) {
                this.form.cpf = this.form.cpf.substring(0, counter - 1);
                Math.abs(this.cpf_char_count) - Math.abs(counter) < 2
                    ? counter--
                    : null;
            }
            if (value.match(/[0-9]{1}$/)) {
                this.form.cpf =
                    counter == 12
                        ? [value.slice(0, -1), "-", value.slice(-1)].join("")
                        : counter == 4 || counter == 8
                        ? [value.slice(0, -1), ".", value.slice(-1)].join("")
                        : this.form.cpf;
            }
            if (value.match(/.*[a-zA-Z]+/)) {
                this.form.cpf = this.form.cpf.substring(0, counter - 1);
                Math.abs(this.cpf_char_count) - Math.abs(counter) < 2
                    ? counter--
                    : null;
            }
            if (counter > this.cpf_char_count) {
                this.$data.form.cpf +=
                    counter == 3 || counter == 7
                        ? "."
                        : counter == 11
                        ? "-"
                        : "";
            }

            this.cpf_char_count = counter;
        },
        submit() {
            this.form.post(this.route("register"), {
                onFinish: () =>
                    this.form.reset("password", "password_confirmation"),
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
