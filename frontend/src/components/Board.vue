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
const minatureSize = ref(100);
const minatureMovement = ref(null);
const circleOffset = ref(0);

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

const circleStyle = reactive({
  left: `${clickPosition?.x - minatureSize}px`,
  top: `${clickPosition?.y - minatureSize}px`,
  width: `${minatureMovement.value}px`,
  height: `${minatureMovement.value}px`,
  background: '#ddd',
  borderRadius: '50%'
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
    minatureMovement.value = 200;
    circleOffset.value = (((300 - minatureMovement.value) / 100 * minatureSize / 2))
    var x = e.clientX - rect.left - minatureSize / 2;
    var y = e.clientY - rect.top - minatureSize / 2;
    var xDiff = x - clickPosition.value.x;
    var yDiff = y - clickPosition.value.y;
    var distance = Math.sqrt(xDiff * xDiff + yDiff * yDiff);

    if(distance > (minatureMovement.value / 2 - minatureSize / 2)) { 
      var angle = Math.atan2(yDiff, xDiff);
      x = clickPosition.value.x + (minatureMovement.value / 2 - minatureSize / 2) * Math.cos(angle);
      y = clickPosition.value.y + (minatureMovement.value / 2 - minatureSize / 2) * Math.sin(angle);
    }

    props.minatures[activeMinatureIndex].xCord = x;
    props.minatures[activeMinatureIndex].yCord = y;
  });
})

</script>

<template>
  <div id="board">
    <div class="circle" v-show="clickPosition" :style="{ 
        top: `${clickPosition?.y - minatureSize + circleOffset}px`, 
        left: `${clickPosition?.x - minatureSize + circleOffset}px`,
        width: `${minatureMovement}px`,
        height: `${minatureMovement}px`
      }"></div>
    <Minature v-for="minature in minatures" :key="minature.id" :minature="minature"
      :isActive="activeMinatureId === minature.id" @setActiveMinature="onSetActiveMinature" @click="handleClick($event, minature)"/>
  </div>
</template>

<style>

.circle {
  position: absolute;
  background: #ddd;
  border-radius: 50%;
}

#board {
  height: 90vh;
  width: 1000px;
  position: relative;
  border: 1px solid;
  margin: 0 auto;
}
</style>