<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <h1>User Profile</h1>
      <div class="form-group">
        <label for="title">Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          v-model="user.name"
          disabled
          name="name"
        />
      </div>
      <div class="form-group">
        <label for="title">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          required
          disabled
          v-model="user.email"
          name="email"
        />
      </div>
      <div class="form-group">
        <label for="description">Role</label>
        <input
          type="role"
          class="form-control"
          id="role"
          required
          disabled
          v-model="user.role"
          name="role"
        />
      </div>
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
        email: "",
        role: "",
        name: "",
        published: false,
      },
      submitted: false,
    };
  },
  methods: {
    getProfile() {
      axios
        .get(process.env.VUE_APP_API_BASE_URL + "/user-information", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((response) => {
          this.user.id = response.data.user.id;
          this.user.name = response.data.user.name;
          this.user.email = response.data.user.email;
          this.user.role = response.data.user.role ?? "No Role Assigned";
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  mounted() {
    this.message = "";
    this.getProfile();
    console.log(localStorage.getItem("login"));
    if (!localStorage.getItem("login")) {
      window.location.reload();
      localStorage.setItem("login", "true");
    }
  },
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>