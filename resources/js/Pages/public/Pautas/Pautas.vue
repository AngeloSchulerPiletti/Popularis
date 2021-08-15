<template>
    <app-public>
        <!-- MOSTRA ATUAL, PASSADA E FUTURA -->
        <section v-if="!has_type" class="section">
            <div class="header">
                <h2>{{ page_config[0] }}</h2>
            </div>
            <div class="sec_container">
                <div
                    v-for="(info, index) in page_config[1]"
                    :key="index"
                    :class="'sec sec' + index"
                >
                    <div class="listing_header">
                        <h3>{{ info[0] }}</h3>
                        <p>{{ info[1] }}</p>
                    </div>
                    <listing-cards
                        :ver_mais="vermais_routes[index]"
                        :static_list="true"
                        :pautas_data="pauta_data[index]"
                        :list_name="index"
                    />
                </div>
            </div>
        </section>

        <!-- MOSTRA ESPECIFICA  -->
        <section v-else class="section_type">
            <div class="header">
                <h2>{{ page_config[0] }}</h2>
                <p>{{ page_config[1] }}</p>
            </div>
            <div class="list_container">
                <listing-cards
                    :static_list="false"
                    :pautas_data="pauta_data[0]"
                    :list_name="0"
                    :total_pautas="total_pautas"
                />
            </div>
        </section>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
import ListageVotePautas from "@/Components/geral/ListageVotePautas";

export default {
    data() {
        return {
            has_type: false,
            pauta_data: [],
            vermais_routes: [
                route("pautas.section.type.show", {
                    section: this.escope_url,
                    type: "passadas",
                }),
                route("pautas.section.type.show", {
                    section: this.escope_url,
                    type: "atuais",
                }),
                route("pautas.section.type.show", {
                    section: this.escope_url,
                    type: "futuras",
                }),
            ],
        };
    },
    methods: {
        has_type_check() {
            this.has_type = this.escope.length > 1;
        },
        refresh() {
            if (this.db_data) {
                this.pauta_data = this.db_data;
            }
        },
    },
    created() {
        this.has_type_check();
        this.refresh();
    },
    updated() {
        this.has_type_check();
        this.refresh();
    },
    props: {
        escope: Array,
        db_data: Array,
        page_config: Array,
        escope_url: String,
        total_pautas: Number,
    },
    components: {
        AppPublic,
        "listing-cards": ListageVotePautas,
    },
};
</script>

<style lang="scss" scoped>
.section {
    padding-top: 40px;

    .header {
        margin: 80px 0 40px 0;
        h2 {
            text-align: center;
            width: 80%;
            margin: auto;
            @include Title3;
            font-size: 35px;
            color: $darken-blue;
        }
    }
    .sec_container {
        display: flex;
        flex-direction: column;
        gap: 100px;

        .sec {
            .listing_header {
                width: 80%;
                margin: 0 auto 14px auto;

                h3 {
                    @include Title4;
                    color: $blue1;
                    font-size: 20px;
                }
                p {
                    @include Font1;
                    color: $blue1;
                    font-size: 15px;
                }
            }

            &.sec0 {
            }
            &.sec1 {
            }
            &.sec2 {
            }
        }
    }
}

.section_type{
    padding-top: 40px;

    .header{
        margin: 80px auto 40px auto;
        width: 80%;

        h2{
            @include Title3;
            font-size: 35px;
            color: $darken-blue;
        }
        p{
            @include Font1;
            font-size: 18px;
            color: $blue1;
            text-align: justify;
        }
    }
    .list_container{

    }
}
</style>
