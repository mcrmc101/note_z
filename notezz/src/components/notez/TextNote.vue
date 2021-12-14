<template>
  <div>
    <b-form @submit.prevent="saveTextNote($event)">
      <b-form-group>
        <select-category></select-category>
      </b-form-group>
      <b-form-group>
        <b-form-textarea
          id="textarea"
          v-model="textNote"
          placeholder="Enter something..."
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>
      <b-form-group>
        <b-button
          type="submit"
          variant="success"
        >Save</b-button>
      </b-form-group>
    </b-form>
  </div>
</template>
<script>
import axios from 'axios'
import SelectCategory from './SelectCategory.vue'
export default {
  components: { SelectCategory },
  name: 'TextNote',
  data () {
    return {
      textNote: '',
    }
  },
  methods: {
    saveTextNote: async function () {
      console.log(this.$store.state.selectedCat)
      var data = {
        'cat': this.$store.state.selectedCat,
        'type': 'text',
        'note': this.textNote
      }

      axios.post('http://localhost/note_z/notez/saveNote', data, {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response.data)

        })
        .catch((error) => {
          console.log(error)
          this.flashMessage.show({
            status: 'error',
            title: 'Not Authorized!'
          })
          this.$router.push({ path: 'login' });
        })

    }
  }
}
</script>