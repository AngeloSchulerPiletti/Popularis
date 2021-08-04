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

                <div class="form_sec especial">
                    <label for="cpf">CPF</label>
                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        v-model="form.cpf"
                        @input="cpf_mask"
                    />
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
                rg: "",
                titulo_eleitoral: "",
                terms: false,
            }),
            char_count: 0,
        };
    },

    methods: {
        cpf_mask: function () {
            var input = document.querySelector("#cpf"),
                value = this.form.cpf;
            var counter = value.length;

            if(value.match(/.*[a-zA-Z]+/)){
                this.form.cpf
                //CONTINUA DAQUI
            }

            if (counter > this.char_count) {
                if (value.length == 3 || value.length == 7) {
                    this.$data.form.cpf += ".";
                }
                if (value.length == 11) {
                    this.$data.form.cpf += "-";
                }
            }

            this.char_count = value.length;
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
