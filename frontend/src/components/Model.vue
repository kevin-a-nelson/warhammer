<script setup>
import { reactive, computed } from 'vue'

// props
const props = defineProps({
  xCordinate: Number,
  yCordinate: Number,
  test: String,
})

const modelStyle = computed(() => {
    return { left: `${props.xCordinate}px`, top: `${props.yCordinate}px` }
})

</script>


<template>
    <div class="model" :style="modelStyle">
        <img src="../assets/spaceMarine.jpg">
    </div>
</template>

<style>

.model {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.3);
}

.model img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>