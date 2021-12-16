<template>
  <div>
    <br>
    <b-form @submit.prevent="addCat">
      <b-form-group>
        <b-form-input
          v-model="catName"
          placeholder="Category Name"
        ></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-button
          type="submit"
          variant="success"
        >Save Category</b-button>
        <b-button
          @click.prevent="closeAddCat"
          variant="error"
        >
          <b-icon-x-octagon-fill style="color:red"></b-icon-x-octagon-fill>
        </b-button>
      </b-form-group>
    </b-form>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'AddCategory',
  data () {
    return {
      catName: ''
    }
  },
  methods: {
    addCat: function () {
      let data = {
        'catName': this.catName
      }
      axios.post('http://localhost/note_z/notez/addCat', data, {
        headers: {
          Authorization: `Bearer ${this.$store.state.usertoken}`
        }
      })
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    },
    closeAddCat: function () {
      this.$parent.isShowAddCat = false
    }
  }
}
</script>