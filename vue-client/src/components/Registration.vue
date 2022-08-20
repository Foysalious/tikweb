<template>
  <div class="submit-form">
    <div v-if="!submitted">
    <h1>Registration</h1>
     <div class="form-group">
        <label for="title">Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="user.name"
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
      <button @click="Registration" class="btn btn-success">Submit</button>
    </div>
    <div v-else>
      <h4>You submitted successfully!</h4>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
require('dotenv').config()
export default {
    
  name: "add-tutorial",
  data() {
    
    return { 
      user: {
        id: null,
        email: "", 
        password: "",
        name: "",
        published: false
      },
      submitted: false
    };
  },
  methods: {
    Registration(){
        var data = {
            name: this.user.name, 
            email: this.user.email, 
            password: this.user.password
        };
        axios.post(process.env.VUE_APP_API_BASE_URL +'/register', data)
            .then(response => {
                this.user.id = response.data.id; 
                this.submitted = true;
            })
            .catch(e => {
                console.log(e);
            });
    }
  }
};
</script>
<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>