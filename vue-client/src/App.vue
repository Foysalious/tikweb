<template>
  <div id="app">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <div class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link to="/registration" class="nav-link"
            >Registration</router-link
          >
        </li>
        <li class="nav-item" v-if="token">
          <router-link to="/profile" class="nav-link">Profile</router-link>
        </li>
        <li class="nav-item" v-if="token">
          <router-link to="/user-list" class="nav-link">Users</router-link>
        </li>
        <li class="nav-item" v-if="token">
          <router-link to="/create-role" class="nav-link"
            >Role Create</router-link
          >
        </li>
        <li class="nav-item" v-if="token">
          <router-link to="/logout" class="nav-link">Logout</router-link>
        </li>
        <li class="nav-item" v-if="!token">
          <router-link to="/" class="nav-link">Login</router-link>
        </li>
      </div>
    </nav>
    <div class="container mt-3">
      <router-view />
    </div>
  </div>
</template>
<script>
require("dotenv").config();
export default {
  name: "add-tutorial",
  data() {
    return {
      token: localStorage.getItem("token"),
    };
  },
  methods: {},
  mounted() {
    
  },
};
</script>