<template>
  <div class="navbar">
    <RouterLink class="navbar-item" to="/login" @click="logOut">
      Logout
    </RouterLink>
    <RouterLink class="navbar-item" to="/boards">boards</RouterLink>
  </div>
  <RouterView />
</template>

<script>
import AuthService from '@/services/AuthService';
import { RouterLink, RouterView } from 'vue-router';

export default {
  name: 'App',
  data() {
    return {
    }
  },

  methods: {
    async logOut() {
        await AuthService.logout();
    }
  },
  mounted() {
    if(localStorage.getItem('access_token') === null) {
      this.$router.push('/login');
    }
  }
}

</script>

<style scoped>


.navbar {
  display: flex;
}

.navbar-item {
  margin-right: 10px;
}

</style>
