<script setup>
import Board from '../components/Board.vue'
import axios from 'axios'

import { ref, onMounted } from 'vue'

const minatures = ref([]);

onMounted(async () => {

  const boardId = window.location.pathname.split('/').pop();

  await axios.get("http://localhost:8000/api/minatures", { params: { board_id: boardId } })
    .then((response) => {
      minatures.value = response.data
    })
    .catch((error) => {
      console.log(error)
    })
})

const handleNewRecruitFileChange = async (e) => {
  e.preventDefault()
  const reader = new FileReader()
  reader.onload = async (e) => {
    const text = (e.target.result)
    const boardId = window.location.pathname.split('/').pop();
    await axios.post('http://localhost:8000/api/newRecruit/upload', {
      "text": text, "board_id": boardId 
    })
  };

  reader.readAsText(e.target.files[0])
}

</script>

<template>
  <main>
    <form action="/action_page.php">
      <input ref="newRecruitFile" v-on:change="handleNewRecruitFileChange" type="file">
    </form>
    <Board :minatures=minatures></Board>
  </main>
</template>
