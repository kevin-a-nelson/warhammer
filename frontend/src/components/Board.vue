<script setup>
import { ref, reactive, onMounted } from 'vue'
import Model from './Model.vue'

// Data
const models = reactive([
  { id: 1, xCordinate: 0, yCordinate: 0, size: 50},
  { id: 2, xCordinate: 50, yCordinate: 0, size: 50}
])

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

  const activeModelIndex = models.findIndex(model => model.id === activeModelId.value);

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
    <Model v-for="model in models" :key="model.id" :model="model" @setActiveModel="setActiveModel" />
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