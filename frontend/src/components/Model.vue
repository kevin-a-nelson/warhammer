<script setup>
import { reactive, computed, defineProps, defineEmits } from 'vue'

// props
const props = defineProps({
  model: Object
})

const emits = defineEmits(['setActiveModel'])

const modelStyle = computed(() => {
    return { left: `${props.model.xCordinate}px`, top: `${props.model.yCordinate}px`, width: `${props.model.size}px`, height: `${props.model.size}px` }
})

function handleClick() {
  emits('setActiveModel', props.model.id)
}
</script>


<template>
    <div class="model" :style="modelStyle" @click.stop="handleClick">
        <img src="../assets/spaceMarine.jpg">
    </div>
</template>

<style>

.model {
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    position: absolute;
    box-sizing: border-box;
    border: 1px solid rgba(0, 0, 0, 0.3);
    /* box-shadow: 0 0 0 5px black inset;  */
    cursor: pointer; /* Added to indicate clickable */
}

.model img {
    width: 150%;
    height: 150%;
    object-fit: cover;
}

</style>