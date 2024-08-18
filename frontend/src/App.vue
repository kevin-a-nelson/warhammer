<template>
  <p @click="logOut">Logout</p>
  <RouterView />
</template>

<script>
import AuthService from '@/services/AuthService';

export default {
  name: 'App',
  data() {
    return {
    }
  },

  methods: {
    async logOut() {
      try {
        const response = await AuthService.logout();
        console.log('Login successful:', response);
        this.$router.push('/login');
      } catch (error) {
        console.error('Logout failed:', error);
      }
    }
  },
  mounted() {
    if(localStorage.getItem('user') === null) {
      this.$router.push('/login');
    }
  }
}

</script>

<style scoped>
</style>
