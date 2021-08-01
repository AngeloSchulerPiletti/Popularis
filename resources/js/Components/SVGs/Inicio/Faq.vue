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
                    <circle  :class="int" cx="32" cy="32" r="30" />
                    <path
                         :class="int"
                        d="M20.5,12.2c8.7-5.2,20.2-4,27.7,3.5c4.4,4.4,6.6,10.1,6.7,15.9"
                    />
                    <path  :class="int" d="M9.4,33.1c-0.1-1.8,0-3.7,0.4-5.5" />
                    <path
                         :class="int"
                        d="M38.1,53.7C30.5,55.8,22,53.8,16,47.8c-2.6-2.6-4.4-5.6-5.5-8.8"
                    />
                    <path
                         :class="int"
                        d="M51.7,43.3c-1,1.6-2.1,3.1-3.5,4.5c-1,1-2.2,2-3.4,2.8"
                    />
                </g>
                <g>
                    <path
                         :class="int"
                        d="M28.8,45.8V31.2c0-1.8,1.4-3.2,3.2-3.2h0c1.8,0,3.2,1.4,3.2,3.2v14.6c0,1.8-1.4,3.2-3.2,3.2h0     C30.2,49,28.8,47.6,28.8,45.8z"
                    />
                    <path
                         :class="int"
                        d="M28.8,19v-0.8c0-1.8,1.4-3.2,3.2-3.2h0c1.8,0,3.2,1.4,3.2,3.2V19c0,1.8-1.4,3.2-3.2,3.2h0     C30.2,22.3,28.8,20.8,28.8,19z"
                    />
                </g>
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
svg path, svg circle {
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
