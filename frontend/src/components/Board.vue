<script setup>
import { ref } from 'vue'
import Model from './Model.vue'

// props

// data
const xCordinate = ref(10)
const yCordinate = ref(20)
const test = ref('test')

// computed

// methods
function moveModel(e) {
    console.log(e)
    xCordinate.value = e.x - 365 - 25;
    yCordinate.value = e.y - 53 - 25;
}
</script>

<template>
    <div class="board" @click="moveModel">
        <Model :test="test" :xCordinate="xCordinate" :yCordinate="yCordinate" />
    </div>
</template>

<style>
.board {
    height: 90vh;
    width: 1000px;
    border: 1px solid;
    /* overflow: scroll; */
    margin: 0px auto;
}
</style>