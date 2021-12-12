<template>
  <b-container>
    <b-row>
      <b-card>
        <login-form></login-form>
      </b-card>
    </b-row>
  </b-container>
</template>
<script>
import LoginForm from '../components/login/LoginForm.vue'
export default {
  name: 'Login',
  components: { LoginForm }
}
</script>