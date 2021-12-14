<template>
  <b-navbar
    toggleable
    type="dark"
    variant="dark"
  >
    <b-navbar-brand href="#">NoteZ</b-navbar-brand>

    <b-navbar-toggle target="navbar-toggle-collapse">
      <template #default="{ expanded }">
        <b-icon
          v-if="expanded"
          icon="chevron-bar-up"
        ></b-icon>
        <b-icon
          v-else
          icon="chevron-bar-down"
        ></b-icon>
      </template>
    </b-navbar-toggle>

    <b-collapse
      id="navbar-toggle-collapse"
      is-nav
    >
      <b-navbar-nav class="ml-auto">
        <b-nav-item href="/">Login</b-nav-item>
        <b-nav-item href="/note_z">All Notes</b-nav-item>
        <b-nav-item href="/new_note">New Notes</b-nav-item>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>
<script>
export default {
  name: 'NBar'
}
</script>