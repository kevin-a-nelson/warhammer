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
const zoomLevel = ref(1);

// Methods
function onSetActiveMinature(id) {
  if(activeMinatureId.value != null) {
    activeMinatureId.value = null;
    clickPosition.value = null;
    return;
  }
  activeMinatureId.value = id;
}

function handleMinatureClick(event, minature) { // Add this method
  if(activeMinatureId.value) {
    clickPosition.value = { x: minature.xCord, y: minature.yCord }
  }
}

function handleBoardClick(event) {
  if(activeMinatureId.value) {
    activeMinatureId.value = null;
    clickPosition.value = null;
  }
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

const zoomIn = () => {
  zoomLevel.value = Math.min(zoomLevel.value + 0.1, 3); // Max zoom level 3
};

const zoomOut = () => {
  zoomLevel.value = Math.max(zoomLevel.value - 0.1, 0.5); // Min zoom level 0.5
};

// Lifecycle hooks
onMounted(() => {
  boardElement.value = document.getElementById('board-container');
  
    boardElement.value.addEventListener('wheel', (e) => {
    if (e.deltaY < 0) {
      // zoomIn();
    } else {
      // zoomOut();
    }
  });

  window.addEventListener('wheel', (e) => {
      e.preventDefault();
  }, { passive: false });

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
    minatureMovement.value = 283;
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
  <div id="board-container">
    <div id="board" @click="handleBoardClick($event)">
        <div class="circle" v-show="clickPosition" :style="{ 
            top: `${clickPosition?.y - minatureSize + circleOffset}px`, 
            left: `${clickPosition?.x - minatureSize + circleOffset}px`,
            width: `${minatureMovement}px`,
            height: `${minatureMovement}px`
          }"></div>
        <Minature v-for="minature in minatures" :key="minature.id" :minature="minature"
          :isActive="activeMinatureId === minature.id" @setActiveMinature="onSetActiveMinature" @click="handleMinatureClick($event, minature)"/>
    </div>
  </div>
</template>

<style>

.circle {
  position: absolute;
  background: #ddd;
  border-radius: 50%;
}

#board {
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

#board-container {
  height: 90vh;
  width: 1000px;
  position: relative;
  border: 1px solid;
  margin: 0 auto;
}

</style>