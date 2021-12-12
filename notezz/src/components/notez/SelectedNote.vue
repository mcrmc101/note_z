<template>
  <div>
    <h1>{{ selectedNote[0].cat }}</h1>
  </div>
</template>
<script>
export default {
  name: 'SelectedNote',
  props: ['selectedNote'],

}
</script>