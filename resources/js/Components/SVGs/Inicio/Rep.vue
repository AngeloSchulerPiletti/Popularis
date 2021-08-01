<template>
   <svg
        style="enable-background: new 0 0 64 64"
        version="1.1"
        viewBox="0 0 64 64"
        xml:space="preserve"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
    >
        <g id="Layer_1" />
        <g id="Layer_2">
            <g>
                <g>
                    <path  :class="int" d="M42.1,13.4c0.9,1.3,1.5,2.7,1.8,4.3" />
                    <path
                         :class="int"
                        d="M43.5,24c-1.6,4.4-5.9,7.6-10.9,7.6c-6.4,0-11.5-5.2-11.5-11.5S26.2,8.4,32.6,8.4c2.7,0,5.2,0.9,7.2,2.5"
                    />
                </g>
                <path
                     :class="int"
                    d="M11.2,55.6c0-13.3,9.3-24,20.8-24s20.8,10.7,20.8,24"
                />
                <path
                     :class="int"
                    d="M22.3,45.7c2.4-3.1,5.8-5,9.7-5c1.1,0,2.1,0.2,3.1,0.4"
                />
                <path  :class="int" d="M19.1,55.6c0-1.4,0.2-2.7,0.5-4" />
            </g>
        </g>
    </svg>
</template>

<script>
export default {
    props:{
        int: String,
    }
};
</script>

<style lang="scss" scoped>
svg path {
    fill: none;
    stroke: $blue;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-miterlimit: 10;
}
.white{
    stroke: $white;
}
</style>
