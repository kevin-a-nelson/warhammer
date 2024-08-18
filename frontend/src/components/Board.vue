<script setup>
import { ref, reactive, onMounted, toRefs } from 'vue'
import Minature from './Minature.vue'

// const Minatures = toRef('miniatures')

const props = defineProps({
  minatures: Array
})

const activeModelId = ref(null)
const boardElement = ref(null)

// Methods
function setActiveModel(id) {
  activeModelId.value = id;
}

// Lifecycle hooks
onMounted(() => {
  boardElement.value = document.getElementById('board');
})

function moveModel(e) {
  if (!activeModelId.value) {
    return
  }

  const activeModelIndex = minatures.findIndex(minature => minature.id === activeModelId.value);

  if (activeModelIndex === -1) {
    return
  }

  var rect = boardElement.value.getBoundingClientRect();

  var x = e.clientX - rect.left - models[activeModelIndex].size / 2;
  var y = e.clientY - rect.top - models[activeModelIndex].size / 2;

  models[activeModelIndex].xCordinate = x;
  models[activeModelIndex].yCordinate = y;

  activeModelId.value = null; // Reset active model after moving
}
</script>

<template>
  <div id="board" @click="moveModel">
    <Minature v-for="minature in minatures" :key="minature.id" :minature="minature" @setActiveModel="setActiveModel" />
  </div>
</template>

<style>
#board {
  height: 90vh;
  width: 1000px;
  position: relative;
  border: 1px solid;
  margin: 0 auto;
}
</style>