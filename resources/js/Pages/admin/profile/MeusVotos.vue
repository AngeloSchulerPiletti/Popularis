<template>
    <profile-container>
        <div class="meusvotos_container">
            <div class="header"></div>
            <div v-if="db_data.length > 0">
                <listing-cards
                    :static_list="false"
                    :pautas_data="pauta_data[0]"
                    :list_name="0"
                    :total_pautas="total_pautas"
                />
            </div>
                <h3 class="warn" v-else>
                    Votos não encontrados. Participe de votações para vê-los
                    aqui!
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
.warn{
  width: 80%;
  margin: auto;
  @include Title4;
  font-size: 20px;
  color: $blue;
}
</style>
