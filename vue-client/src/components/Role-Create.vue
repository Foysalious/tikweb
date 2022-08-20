<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <h1>Role Creation</h1>
      <div class="form-group">
        <label for="title">Role Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="role.name"
          name="name"
        />
      </div>
      <button @click="Registration" class="btn btn-success">Submit</button>
    </div>
    <div v-else>
      <h4>You submitted successfully!</h4>
    </div>
  </div>
</template>
<script>
import axios from "axios";
require("dotenv").config();
export default {
  name: "add-tutorial",
  data() {
    return {
      role: {
        id: null,
        name: "",
        published: false,
      },
      submitted: false,
    };
  },
  methods: {
    Registration() {
      var data = {
        role: this.role.name,
      };
      axios
        .post(process.env.VUE_APP_API_BASE_URL + "/roles", data, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((response) => {
          console.log(response.data);
          this.submitted = true;
        })
        .catch((e) => {
          console.log(e,localStorage.getItem("token"));
        });
    },
  },
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>