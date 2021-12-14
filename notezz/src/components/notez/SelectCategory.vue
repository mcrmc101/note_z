<template>
  <div>
    <b-form-select @change="selectCat($event)">
      <b-form-select-option
        v-for="cat in this.$store.state.cats"
        :key="cat.cid"
        :value="cat.cat"
      >{{ cat.cat }}</b-form-select-option>
    </b-form-select>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'SelectCategory',

  created () {
    if (this.$store.state.hascats === 0) {
      axios.get('http://localhost/note_z/notez/getCats', {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response.data)
          this.$store.commit('setcats', response.data)
          this.$store.commit('sethascats', 1)
        })
        .catch((error) => {
          console.log(error)
        })
    }
  },
  methods: {
    selectCat: function (value) {
      this.$store.commit('setSelectedCat', value)
    }
  }
}
</script>