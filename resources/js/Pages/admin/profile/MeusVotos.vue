<template>
    <profile-container>
        <div class="meusvotos_container">
            <div class="header">
                <h2>Histórico de Votos</h2>
                <p>
                    Caro eleitor(a) <span>{{ $page.props.user.name }}</span
                    >, aqui você tem acesso a todos os seus votos anteriores.
                    Qualquer irregularidade, por favor nos avise.
                </p>
            </div>
            <div v-if="db_data.length > 0">
                <listing-cards
                    :static_list="false"
                    :pautas_data="pauta_data[0]"
                    :list_name="0"
                    :total_pautas="total_pautas"
                />
            </div>
            <h3 class="warn" v-else>
                Votos não encontrados. Participe de votações para vê-los aqui!
            </h3>
        </div>
    </profile-container>
</template>

<script>
import Profile from "@/Pages/admin/Profile";
import ListageVotePautas from "@/Components/geral/ListageVotePautas";

export default {
    data() {
        return {
            pauta_data: [],
        };
    },
    methods: {
        refresh() {
            if (this.db_data && this.pauta_data != this.db_data) {
                this.pauta_data = this.db_data;
            }
        },
    },
    created() {
        console.log(this.db_data);
        this.refresh();
    },
    updated() {
        this.refresh();
    },
    props: {
        db_data: Array,
        total_pautas: Number,
    },
    components: {
        "profile-container": Profile,
        "listing-cards": ListageVotePautas,
    },
};
</script>

<style lang="scss" scoped>
.meusvotos_container {
  display: flex;
  flex-direction: column;
  gap: 40px;

    .header {
      width: 80%;
      margin: auto;

        h2 {
            @include Title4;
            font-size: 30px;
            color: $blue;
        }
        p {
            @include Font1;
            font-size: 15px;
            color: $blue1;

            span {
                text-transform: capitalize;
                @include Font0;
            }
        }
    }
    .warn {
        width: 80%;
        margin: auto;
        @include Title4;
        font-size: 20px;
        color: $blue;
    }
}
</style>
