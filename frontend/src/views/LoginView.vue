<template>
  <div class="login">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import AuthService from '@/services/AuthService';

export default {
  name: 'LoginView',
  data() {
    return {
      email: '',
      password: ''
    }
  },

  methods: {
    async login() {
      try {
        const response = await AuthService.login(this.email, this.password);
        console.log('Login successful:', response);
        this.$router.push('/board');
        // Redirect to a protected route or handle successful login
      } catch (error) {
        console.error('Login failed:', error);
        // Handle login error
      }
    }
  }
}
</script>

<style scoped>
.login {
  max-width: 300px;
  margin: 0 auto;
  padding: 1em;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.login h1 {
  text-align: center;
}

.login div {
  margin-bottom: 1em;
}

.login label {
  display: block;
  margin-bottom: 0.5em;
}

.login input {
  width: 100%;
  padding: 0.5em;
  box-sizing: border-box;
}

.login button {
  width: 100%;
  padding: 0.5em;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login button:hover {
  background-color: #0056b3;
}
</style>