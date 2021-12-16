<template>
  <div id="app">
    <!--<div id="nav">
      <router-link to="/">Login</router-link> |
      <router-link to="/note_z">All Notes</router-link> |
      <router-link to="/new_note">New Note</router-link>
    </div>-->
    <n-bar></n-bar>
    <br>
    <FlashMessage></FlashMessage>
    <b-container>
      <router-view />
    </b-container>
  </div>
</template>
<script>
import axios from 'axios'
import NBar from './components/NBar.vue'
export default {
  components: { NBar },
  created () {
    axios.get('http://localhost/note_z/notez/checkUser', {
      headers: {
        Authorization: `Bearer ${this.$store.state.usertoken}`
      }
    })
      .catch((error) => {
        console.log(error)
        this.flashMessage.show({
          status: 'error',
          title: 'Not Authorized!'
        })
        this.$router.push({ path: '/' });
      })
  }
}
</script>

<style>
* {
  font-weight: bold;
}
b-row {
  padding: 2%;
}
.padme {
  padding: 5%;
}
.phatme {
  font-weight: 900;
  text-decoration: underline;
}
#app {
  font-family: "Courier New", Courier, monospace;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
