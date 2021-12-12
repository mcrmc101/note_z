<template>
  <div>
    <b-row>
      <b-col sm>
        <b-card
          v-if="hasSelectedNote"
          :title="selectedNote[0].cat"
        >

        </b-card>
      </b-col>
      <b-col sm>
        <b-table
          striped
          hover
          sticky-header
          :items="items"
          selectable
          @row-selected="getSelected($event)"
          select-mode="single"
        ></b-table>
      </b-col>
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
      dcodedNote: ''
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
          this.hasSelectedNote = true
        })
        .catch((error) => {
          console.log(error)

        })
    }
  }

}
</script>