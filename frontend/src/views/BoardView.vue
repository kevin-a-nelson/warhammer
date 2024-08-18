<script setup>
import Board from '../components/Board.vue'
import axios from 'axios'

import { ref } from 'vue'

const newRecruitFile = ref(null);

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
    <Board />
  </main>
</template>
