<template>
  <div>
    <!--<b-button @click.prevent="checkUser()">Check User</b-button>-->
    <h4>Login</h4>
    <br>
    <b-form @submit.prevent="loginUser()">
      <b-form-group
        id="useremailGroup"
        label="User Email"
        label-for="loginemail"
      >
        <b-form-input
          id="loginemail"
          type="email"
          v-model="email"
        ></b-form-input>
      </b-form-group>
      <b-form-group
        id="userpassGroup"
        label="Password"
        label-for="loginpass"
      >
        <b-form-input
          id="loginpass"
          type="password"
          v-model="password"
        ></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-button
          variant="success"
          type="submit"
        >Login</b-button>
      </b-form-group>
    </b-form>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'LoginForm',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    loginUser: function () {
      var data = {
        email: this.email,
        password: this.password
      }
      axios.post('http://localhost/note_z/notez/api/login', data)
        .then((response) => {
          console.log(response)
          this.$store.commit('settoken', response.data.token)
          this.flashMessage.show({
            status: 'success',
            title: 'Logged In'
          })
          this.$router.push({ path: 'note_z' });
        })
        .catch((error) => {
          console.log(error)
          this.flashMessage.show({
            status: 'error',
            title: 'Email or Password are incorrect'
          })
        })
    },
    checkUser: function () {
      axios.get('http://localhost/note_z/notez/checkUser', {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
}
</script>