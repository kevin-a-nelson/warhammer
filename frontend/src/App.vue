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
</style>
