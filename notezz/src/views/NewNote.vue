<template>
  <div>
    <b-container fluid>
      <b-row
        align-h="center"
        align-v="center"
      >
        <b-dropdown
          size="md"
          text="Select Type"
          class="m-2"
        >
          <b-dropdown-item-button @click.prevent="selectTextNote()">Text</b-dropdown-item-button>
          <b-dropdown-item-button @click.prevent="selectImageNote()">Image</b-dropdown-item-button>
          <b-dropdown-item-button @click.prevent="selectAudioNote()">Audio</b-dropdown-item-button>

        </b-dropdown>
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
      <br>
      <b-row
        align-h="center"
        align-v="end"
      >
        <b-button
          @click.prevent="showAddCat"
          v-if="!isShowAddCat"
        >Add Category</b-button>
        <add-category v-if="isShowAddCat"></add-category>
      </b-row>
    </b-container>
    <b-row>

      <b-form>

      </b-form>
    </b-row>
  </div>
</template>
<script>
import AddCategory from '../components/notez/AddCategory.vue'
import AudioNote from '../components/notez/AudioNote.vue'
import ImageNote from '../components/notez/ImageNote.vue'
import TextNote from '../components/notez/TextNote.vue'


export default {
  components: { AudioNote, ImageNote, TextNote, AddCategory },
  name: 'NewNote',
  data () {
    return {
      note: '',
      isAudioNote: false,
      isImageNote: false,
      isTextNote: false,
      isShowAddCat: false
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
    },
    showAddCat: function () {
      if (this.isShowAddCat === false) {
        this.isShowAddCat = true
      }
      else {
        this.isShowAddCat = false
      }
    }
  }
}
</script>