<template>
  <div></div>
</template>
<script>
require("dotenv").config();
export default {
  name: "add-tutorial",
  data() {
    return {
      
    };
  },
  methods: {
   
  },

  mounted() {
   localStorage.clear()
   this.$router.go('/'); 
  },
  beforeDestroy () {
      this.$router.go()
    }
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>