<template>
  <div>
    <b-row align-h="center">

      <b-card v-if="hasSelectedNote">
        <h4>{{selectedNote.Category}}</h4>
        <b-img
          v-if="isImage"
          :src="selectedNote.Note"
          fluid
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
    <b-row align-h="center">
      <b-table
        hover
        sticky-header
        :items="items"
        selectable
        @row-selected="getSelected($event)"
        select-mode="single"
        style="width:100%"
      ></b-table>

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

        })
    }
  }

}
</script>