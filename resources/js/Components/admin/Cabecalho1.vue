<template>
  <div>
      <h2>{{title}}</h2>
      <p>{{paragraph}}</p>
  </div>
</template>

<script>
export default {
    props:{
        title: String,
        paragraph: String,
    },
}
</script>

<style lang="scss" scoped>
div{
    width: 80%;
    margin: 0px auto 30px auto !important;

    h2{
        @include Title3();
        font-size: 29px;
        color: $blue;
    }
    p{
        @include Font0;
        font-size: 15px;
    }
}
</style>