<template>
    <svg
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px"
        y="0px"
        viewBox="0 0 50 50"
        xml:space="preserve"
    >
        <circle cx="25" cy="25" r="25" />
        <line x1="25" y1="37" x2="25" y2="39" />
        <path
            d="M18,16
	c0-3.899,3.188-7.054,7.1-6.999c3.717,0.052,6.848,3.182,6.9,6.9c0.035,2.511-1.252,4.723-3.21,5.986
	C26.355,23.457,25,26.261,25,29.158V32"
        />
    </svg>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
svg {
    circle {
        fill: $blue;
        transition: fill 200ms;
    }
    transition: transform 500ms;

    &:hover {
        transform: scale(1.1);
        circle {
            fill: $blue1;
        }
    }

    line {
        fill: none;
        stroke: #ffffff;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-miterlimit: 10;
    }
    path {
        fill: none;
        stroke: #ffffff;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-miterlimit: 10;
    }
}
</style>
