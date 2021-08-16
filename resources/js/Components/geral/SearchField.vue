<template>
    <div id="wall" @click="close" style="display: none;"></div>
    <div id="field_container"
            data-anim="none">
        <input
            type="text"
            name="search_field"
            id="search_field"
            autocomplete="off"
            placeholder="Digite aqui"
        />
        <button @click="search()"><search-icon /></button>
    </div>
    
</template>

<script>
import SearchIcon from "@/Components/SVGs/icons/SearchIcon";
export default {
    data() {
        return {
        };
    },
    methods: {
        search() {
            var input = document.querySelector('#search_field'),
                container = document.querySelector('#field_container'),
                wall = document.querySelector('#wall');
            var state = container.dataset.anim;

            if(state == "on"){
                console.log(input.value);
            }
            else{
                wall.style.display = "block";
                container.dataset.anim = "on";
            }

        },
        close(){
            var input = document.querySelector('#search_field'),
                container = document.querySelector('#field_container'),
                wall = document.querySelector('#wall');

            wall.style.display = "none";
            container.dataset.anim = "off";
        }
    },
    components: {
        SearchIcon,
    },
};
</script>

<style lang="scss" scoped>


#wall{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}
#field_container {
    position: absolute;
    top: 35%;
    left: 0;
    padding: $padding;

    background-color: $darken-blue;
    border-radius: 0 6px 6px 0;

    display: flex;
    align-items: center;
    gap: $padding;

    box-shadow: 0 0 5px $black;
    transform: translateX($transform_calc);

    input {
        border: none;
        background-color: transparent;
        border-bottom: 1px solid $white;
        color: $white;
        @include Font0;

        width: $input;

        &:focus,
        &:active,
        &:target {
            outline: none;
            box-shadow: none;
        }
    }
    button {
        border-left: 1px solid $white;
        padding-left: $padding;

        svg {
            width: 30px;
            height: 30px;
        }
    }

    &[data-anim]{
        transition: transform 400ms;
    }
    &[data-anim="off"]{
        transform: translateX($transform_calc);
    }
    &[data-anim="on"]{
        transform: translateX(0);
    }
}
</style>
