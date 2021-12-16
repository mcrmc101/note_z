<template>
  <div>
    <note-list
      :notez="notez"
      v-if="hasnotez"
    ></note-list>
    <h3 v-else>No Notes Yet</h3>
  </div>
</template>
<script>
import axios from 'axios'
import NoteList from '../components/notez/NoteList.vue'
export default {
  components: { NoteList },
  name: 'Notez',
  data () {
    return {
      notez: '',
      hasnotez: false
    }
  },
  created () {
    axios.get('http://localhost/note_z/notez/getNotez', {
      headers: {
        Authorization: `Bearer ${this.$store.state.usertoken}`
      }
    })
      .then((response) => {
        console.log(response.data)
        this.notez = response.data
        this.hasnotez = true
      })
      .catch((error) => {
        console.log(error)
        this.hasnotez = false
        this.flashMessage.show({
          status: 'error',
          title: 'You need to Login!'
        })
        this.$router.push({ path: 'login' });
      })
  }
}
</script>