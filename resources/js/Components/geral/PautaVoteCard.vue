<template>
    <div>
        <div>
            <div>
                <h2>{{pauta[0]}}</h2>
                <link-icon @click="copy_text"/>
            </div>
            <p>{{pauta[1]}}</p>
        </div>
        <div>
            <ul>
                <li v-for="(value, title) in pauta[4]" :key="title">
                    {{title}}<span>{{value}}</span>
                </li>
            </ul>
            <span>{{pauta[2]}}</span>
        </div>
    </div>
</template>

<script>
import LinkIcon from "@/Components/SVGs/icons/LinkIcon";

export default {
    methods:{
        copy_text(){
            this.pauta[3].select();
            document.execCommand('copy');
        },
    },
    props:{
        pauta: Array, // [[Pauta format], [title, resume, id, url, {'titulo de prop1': prop1, ...}]]
    },
    components:{
        LinkIcon,
    }
}
</script>

<style>

</style>