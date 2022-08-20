<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="title">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          required
          v-model="user.email"
          name="email"
        />
      </div>
      <div class="form-group">
        <label for="description">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          required
          v-model="user.password"
          name="password"
        />
      </div>
      <button @click="Userlogin" class="btn btn-success">Submit</button>
    </div>
    <div v-else>
      <Profile></Profile>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Profile from "./Profile.vue";
require("dotenv").config();
export default {
  name: "add-tutorial",
  data() {
    return {
      user: {
        id: null,
        email: "",
        password: "",
        published: false,
      },
      submitted: false,
    };
  },
  methods: {
    Userlogin() {
      var data = {
        email: this.user.email,
        password: this.user.password,
      };
      console.log(process.env.VUE_APP_API_BASE_URL);
      axios
        .post(process.env.VUE_APP_API_BASE_URL + "/login", data)
        .then((response) => {
          this.user.id = response.data.id;
          localStorage.setItem("token", response.data.authorisation.token);
        
          this.submitted = true;
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  components: { Profile },
 
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>