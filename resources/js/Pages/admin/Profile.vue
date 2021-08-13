<template>
    <app-admin area="eleitor" :links="links" :window_content="window_content">
        <div id="profile_container">
            <slot></slot>
        </div>
    </app-admin>
</template>

<script>
import AppAdmin from "@/Layouts/AppAdmin";

export default {
    data() {
        return {
            links: {
                "Pautas Fedeirais": [
                    "pautasfederais",
                    route('pautas.federal.all'),
                    {
                        'P. F. Atuais': route('pautas.federal', { type: 'atuais' }),
                        'P. F. Passadas': route('pautas.federal', { type: 'passadas' }),
                        'P. F. Futuras': route('pautas.federal', { type: 'futuras' }),
                    }
                ],
                "Pautas Estaduais": [
                    "pautasfederais",
                    route('pautas.estadual.all'),
                    {
                        'P. E. Atuais': route('pautas.estadual', { type: 'atuais' }),
                        'P. E. Passadas': route('pautas.estadual', { type: 'passadas' }),
                        'P. E. Futuras': route('pautas.estadual', { type: 'futuras' }),
                    }
                ],
                "Entenda": [
                    "entenda",
                    route('pautas.all'),
                ],
                "Meus Votos": [
                    "meusvotos",
                    route('profile.votes'),
                ],
            },
        };
    },
    props:{
        window_content: Object,
    },
    components: {
        AppAdmin,
    },
};
</script>

<style lang="scss" scoped>
#profile_container{
    @include page_bottom;
}
</style>
