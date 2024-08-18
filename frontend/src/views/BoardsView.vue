<script setup>
import BoardService from '@/services/BoardService.js';
import { onMounted, ref } from 'vue';

let boards = ref([]);

 onMounted(async () => {
  let userId = JSON.parse(localStorage.getItem('user')).id;
  await BoardService.getBoards(userId)
    .then(response => {
      boards.value = response;
    })
    .catch(error => {
    });
});

</script>

<template>
  <main>
    <h1>Boards</h1>

    <ul>
      <li v-for="board in boards" :key="board.id">
        <RouterLink :to="{ name: 'board', params: { boardId: board.id } }">
          {{ board.name }} {{ board.id }}
        </RouterLink>
      </li>
    </ul> 
  </main>
</template>