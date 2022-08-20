<template>
  <div>
    <div v-if="!submitted">
      <h1>User List</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Remove Role</th>
            <th scope="col">Assign a Role</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role ?? "No Role Given" }}</td>
            <td>
              <button
                @click="removeUser(user.id)"
                type="submit"
                class="btn btn-danger"
              >
                Remove Role
              </button>
            </td>
            <td>
              <button
                @click="assignRole(user.id)"
                type="submit"
                class="btn btn-primary"
              >
                Assign Role
              </button>
            </td>
          </tr>
        </tbody>
      </table>
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
      users: [],
      index: 0,
      submitted: false,
    };
  },
  methods: {
    getUsers() {
      axios
        .get(process.env.VUE_APP_API_BASE_URL + "/users", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((response) => {
          this.users = response.data.users;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    removeUser(id) {
      axios
        .put(process.env.VUE_APP_API_BASE_URL + "/user-role-remove",{id: id}, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
          
        })
        .then(() => {
          this.getUsers();
        })
        .catch((e) => {
          console.log(e);
        });
    },
    assignRole(id) {
    this.$router.push('/user-role/'+id); 
    }, 
  },

  mounted() {
    this.message = "";
    this.getUsers();
  },
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>