<template>
  <div>
    <b-form
      @submit.prevent="saveAudioNote($event)"
      enctype="multipart/form-data"
    >
      <b-form-group>
        <select-category></select-category>
      </b-form-group>
      <b-form-group>
        <b-form-file
          accept="audio/*"
          capture
          placeholder="Add Audio Note"
          drop-placeholder="Drop file here..."
          @change="handleFileUpload"
        ></b-form-file>
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
  name: 'AudioNote',
  data () {
    return {
      audioNote: '',
    }
  },
  methods: {
    handleFileUpload (event) {
      var reader = new FileReader()
      reader.readAsDataURL(event.target.files[0])
      let baseFile = ''
      //convert to base64
      reader.onload = () => {
        baseFile = reader.result
        this.audioNote = baseFile
      }
    },
    saveAudioNote: async function () {
      console.log(this.$store.state.selectedCat)
      var data = {
        'cat': this.$store.state.selectedCat,
        'type': 'audio',
        'note': this.audioNote
      }

      axios.post('http://localhost/note_z/notez/saveNote', data, {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response.data)
          this.flashMessage.show({
            status: 'success',
            title: 'Note Saved!'
          })
          this.$router.push({ path: 'note_z' });

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