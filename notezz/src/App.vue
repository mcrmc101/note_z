<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Login</router-link> |
      <router-link to="/note_z">All Notes</router-link> |
      <router-link to="/new_note">New Note</router-link>
    </div>
    <FlashMessage></FlashMessage>
    <b-container>
      <router-view />
    </b-container>
  </div>
</template>

<style>
* {
  background-color: ghostwhite;
  color: black;
}
b-row {
  padding: 2%;
}
#app {
  font-family: "Courier New", Courier, monospace;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
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
