<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <h1>Assign Role</h1>

      <div class="form-group">
        <label for="role">Role: </label>
        <select
          required
          v-model="user.role"
          class="form-select"
          aria-label="Default select example"
        >
          <option v-for="role in roles" :key="role.id" :value="role.role">
            {{ role.role }}
          </option>
        </select>
      </div>

      <button @click="updateRole" class="btn btn-success">Submit</button>
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
      user: {
        id: null,
        role: "",
        published: false,
      },

      roles: [],

      submitted: false,
    };
  },
  methods: {
    updateRole() {
      var data = {
        id: this.$route.params.id,
        role: this.user.role,
      };

      axios
        .put(process.env.VUE_APP_API_BASE_URL + "/user-update", data, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then(() => {
          this.$router.push("/user-list");
        })
        .catch((e) => {
          console.log(e);
        });
    },
    getRoles() {
      axios
        .get(process.env.VUE_APP_API_BASE_URL + "/roles", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((response) => {
          this.roles = response.data.roles;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  mounted() {
    this.getRoles();
  },
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>