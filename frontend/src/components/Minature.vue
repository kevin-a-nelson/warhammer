<script setup>
import { computed, defineProps, defineEmits, onMounted } from 'vue'

// props
const props = defineProps({
  minature: Object,
  isActive: Boolean
})

const emit = defineEmits(['setActiveMinature'])

const minatureStyle = computed(() => {
  return { width: `${props.minature.size}px`, height: `${props.minature.size}px`, left: `${props.minature.xCord}px`, top: `${props.minature.yCord}px`  }
})


function handleClick() {
  emit('setActiveMinature', props.minature.id)
}
</script>


<template>
    <div class="minature" :style="minatureStyle" @click.stop="handleClick">
      <img :src=minature.image>
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
  cursor: pointer;
  /* z-index: 99; */
  /* Added to indicate clickable */
}

.minature img {
  width: 150%;
  height: 150%;
  object-fit: cover;
}
</style>