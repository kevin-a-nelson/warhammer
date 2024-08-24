<script setup>
import { ref, reactive, onMounted, toRefs } from 'vue'
import Minature from './Minature.vue'

// const Minatures = toRef('miniatures')

const props = defineProps({
  minatures: Array
})

const activeMinatureId = ref(null)
const boardElement = ref(null)
const clickPosition = ref(null)

// Methods
function onSetActiveMinature(id) {

  if(activeMinatureId.value != null) {
    activeMinatureId.value = null;
    clickPosition.value = null;
    return;
  }
  activeMinatureId.value = id;
}

function handleClick(event, minature) { // Add this method
  clickPosition.value = { x: minature.xCord, y: minature.yCord }
}

const movementRadius = reactive({
  name: 'John Doe',
  books: [
    'Vue 2 - Advanced Guide',
    'Vue 3 - Basic Guide',
    'Vue 4 - The Mystery'
  ]
})

// Lifecycle hooks
onMounted(() => {
  boardElement.value = document.getElementById('board');

  boardElement.value.addEventListener('mousemove', (e) => {
    if (!activeMinatureId.value) {
      return
    }

    const activeMinatureIndex = props.minatures.findIndex(minature => minature.id === activeMinatureId.value);

    if (activeMinatureIndex === -1) {
      return
    }

    var rect = boardElement.value.getBoundingClientRect();

    var minatureSize = props.minatures[activeMinatureIndex].size;
    var minatureMovement = parseInt(props.minatures[activeMinatureIndex].movement, 10);

    var x = e.clientX - rect.left - minatureSize / 2;
    var y = e.clientY - rect.top - minatureSize / 2;

    var xDiff = x - clickPosition.value.x;
    var yDiff = y - clickPosition.value.y;

    var distance = Math.sqrt(xDiff * xDiff + yDiff * yDiff);

    var maxRadius = 150 - minatureSize / 2;

    if(distance > 150) { // 150 is half of the circle's diameter
      var angle = Math.atan2(yDiff, xDiff);
      x = clickPosition.value.x + 150 * Math.cos(angle);
      y = clickPosition.value.y + 150 * Math.sin(angle);
    }

    props.minatures[activeMinatureIndex].xCord = x;
    props.minatures[activeMinatureIndex].yCord = y;
  });
})

</script>

<template>
  <div id="board">
    <div class="circle" v-show="clickPosition" :style="{ top: `${clickPosition?.y - 100}px`, left: `${clickPosition?.x - 100}px` }"></div>
    <Minature v-for="minature in minatures" :key="minature.id" :minature="minature"
      :isActive="activeMinatureId === minature.id" @setActiveMinature="onSetActiveMinature" @click="handleClick($event, minature)"/>
  </div>
</template>

<style>

.circle {
  position: absolute;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle at center, rgba(0,255,255,0.4) 0%, rgba(0,255,255,0) 70%);
  border: 2px solid aqua;
  border-radius: 50%;
  box-shadow: 0 0 10px aqua, 0 0 5px darkcyan;
}

#board {
  height: 90vh;
  width: 1000px;
  position: relative;
  border: 1px solid;
  margin: 0 auto;
}
</style>