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
const zoomOrigin = ref({ x: 0, y: 0 });

// Methods
function onSetActiveMinature(id) {
  if (activeMinatureId.value != null) {
    activeMinatureId.value = null;
    clickPosition.value = null;
    return;
  }
  activeMinatureId.value = id;
}

function handleMinatureClick(event, minature) { // Add this method
  if (activeMinatureId.value) {
    clickPosition.value = { x: minature.xCord, y: minature.yCord }
  }
}

function handleBoardClick(event) {
  if (activeMinatureId.value) {
    activeMinatureId.value = null;
    clickPosition.value = null;
  }
}


const zoomIn = (x, y) => {
  zoomLevel.value = Math.min(zoomLevel.value + 0.1, 3); // Max zoom level 3
  zoomOrigin.value = { x, y };
};

const zoomOut = (x, y) => {
  zoomLevel.value = Math.max(zoomLevel.value - 0.1, 0.5); // Min zoom level 0.5
  zoomOrigin.value = { x, y };
};

const onMouseover = (event) => {
  var rect = boardElement.value.getBoundingClientRect();
  var realX = event.x - rect.left;
  var realY = event.y - rect.top;
  console.log(event.x, event.y, realX, realY);
}

// Lifecycle hooks
onMounted(() => {
  boardElement.value = document.getElementById('board-container');

  boardElement.value.addEventListener('wheel', (e) => {
    var rect = boardElement.value.getBoundingClientRect();
    var realX = e.x - rect.left;
    var realY = e.y - rect.top;
    if (e.deltaY < 0) {
      zoomIn(realX, realY);
    } else {
      zoomOut(realX, realY);
    }
  });

  boardElement.value.addEventListener('mousemove', (e) => {
    var rect = boardElement.value.getBoundingClientRect();
    var realX = e.x - rect.left;
    var realY = e.y - rect.top;
    console.log(realX, realY);
    if (!activeMinatureId.value) {
      return
    }
  });

  //   const activeMinatureIndex = props.minatures.findIndex(minature => minature.id === activeMinatureId.value);

  //   if (activeMinatureIndex === -1) {
  //     return
  //   }

  //   var rect = boardElement.value.getBoundingClientRect();
  //   var minatureSize = props.minatures[activeMinatureIndex].size;
  //   minatureMovement.value = 283;
  //   circleOffset.value = (((300 - minatureMovement.value) / 100 * minatureSize / 2))
  //   var x = e.clientX - rect.left - minatureSize / 2;
  //   var y = e.clientY - rect.top - minatureSize / 2;
  //   var xDiff = x - clickPosition.value.x;
  //   var yDiff = y - clickPosition.value.y;
  //   var distance = Math.sqrt(xDiff * xDiff + yDiff * yDiff);

  //   if(distance > (minatureMovement.value / 2 - minatureSize / 2)) { 
  //     var angle = Math.atan2(yDiff, xDiff);
  //     x = clickPosition.value.x + (minatureMovement.value / 2 - minatureSize / 2) * Math.cos(angle);
  //     y = clickPosition.value.y + (minatureMovement.value / 2 - minatureSize / 2) * Math.sin(angle);
  //   }

  //   props.minatures[activeMinatureIndex].xCord = x;
  //   props.minatures[activeMinatureIndex].yCord = y;
  // });
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
        :isActive="activeMinatureId === minature.id" @setActiveMinature="onSetActiveMinature"
        @click="handleMinatureClick($event, minature)" />
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
  margin: 0 auto;
  overflow: scroll;
  background: blue;
  transition: transform 0.2s ease;
}
</style>