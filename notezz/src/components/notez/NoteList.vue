<template>
  <div>
    <b-row align-h="center">

      <b-card
        v-if="hasSelectedNote"
        bg-variant="light"
        :header="selectedNote.Category"
      >

        <b-img
          v-if="isImage"
          :src="selectedNote.Note"
          style="max-height:50vh"
        ></b-img>
        <audio
          v-if="isAudio"
          :src="selectedNote.Note"
          controls
        ></audio>

        <b-card-text v-if="isText">{{ selectedNote.Note }}</b-card-text>
        <br>
      </b-card>
    </b-row>

    <b-row
      align-h="center"
      class="padme"
    >
      <b-form-group
        label="All Notes"
        label-for="notetable"
      >
        <b-table
          hover
          sticky-header
          small
          bordered
          :items="items"
          selectable
          @row-selected="getSelected($event)"
          select-mode="single"
          style="width:95%"
          id="notetable"
        ></b-table>
      </b-form-group>
    </b-row>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'NoteList',
  props: ['notez'],
  data () {
    return {
      items: this.notez,
      selectedNote: '',
      hasSelectedNote: false,
      isImage: false,
      isAudio: false,
      isText: true
    }
  },
  methods: {
    getSelected: function (value) {
      var data = {
        noteid: value[0].id
      }
      axios.post('http://localhost/note_z/notez/getSelectedNote', data, {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response.data)
          this.selectedNote = response.data
          if (response.data.Type === 'image') {
            this.isImage = true
            this.isText = false
            this.isAudio = false
          }
          else if (response.data.Type === 'audio') {
            this.isImage = false
            this.isText = false
            this.isAudio = true
          }
          else {
            this.isImage = false
            this.isText = true
            this.isAudio = false
          }
          this.hasSelectedNote = true
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