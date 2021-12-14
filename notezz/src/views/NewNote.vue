<template>
  <div>
    <b-container fluid>
      <b-row
        align-h="center"
        align-v="center"
      >
        <b-col>
          <b-button
            variant="warning"
            @click.prevent="selectAudioNote()"
          >Audio</b-button>
        </b-col>
        <b-col>
          <b-button
            variant="warning"
            @click.prevent="selectImageNote()"
          >Image</b-button>
        </b-col>
        <b-col>
          <b-button
            variant="warning"
            @click.prevent="selectTextNote()"
          >Text</b-button>
        </b-col>
      </b-row>
      <br>
      <b-row
        align-h="center"
        align-v="center"
      >
        <audio-note v-if="isAudioNote"></audio-note>
        <image-note v-if="isImageNote"></image-note>
        <text-note v-if="isTextNote"></text-note>
      </b-row>
    </b-container>
    <b-row>

      <b-form>

      </b-form>
    </b-row>
  </div>
</template>
<script>
import AudioNote from '../components/notez/AudioNote.vue'
import ImageNote from '../components/notez/ImageNote.vue'
import TextNote from '../components/notez/TextNote.vue'

export default {
  components: { AudioNote, ImageNote, TextNote },
  name: 'NewNote',
  data () {
    return {
      note: '',
      isAudioNote: false,
      isImageNote: false,
      isTextNote: false
    }
  },
  methods: {
    selectAudioNote: function () {
      if (this.isAudioNote === false) {
        this.isAudioNote = true
        this.isImageNote = false
        this.isTextNote = false
      }
      else {
        this.isAudioNote = false
      }
    },
    selectImageNote: function () {
      if (this.isImageNote === false) {
        this.isAudioNote = false
        this.isImageNote = true
        this.isTextNote = false
      }
      else {
        this.isImageNote = false
      }
    },
    selectTextNote: function () {
      if (this.isTextNote === false) {
        this.isAudioNote = false
        this.isImageNote = false
        this.isTextNote = true
      }
      else {
        this.isTextNote = false
      }
    }
  }
}
</script>