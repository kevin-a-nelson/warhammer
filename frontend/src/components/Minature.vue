<script setup>
import { reactive, computed, defineProps, defineEmits, onMounted } from 'vue'

onMounted(() => {
  console.log(props.minature)
})

// props
const props = defineProps({
  minature: Object
})

const emits = defineEmits(['setActiveMinature'])

const minatureStyle = computed(() => {
    return { left: `${props.minature.xCord}px`, top: `${props.minature.yCord}px`, width: `${40}px`, height: `${40}px` }
})

function handleClick() {
  emits('setActiveMinature', props.minature.id)
}
</script>


<template>
    <div class="minature" :style="minatureStyle" @click.stop="handleClick">
        <img src="../assets/spaceMarine.jpg">
    </div>
</template>

<style>

.minature {
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

.minature img {
    width: 150%;
    height: 150%;
    object-fit: cover;
}

</style>