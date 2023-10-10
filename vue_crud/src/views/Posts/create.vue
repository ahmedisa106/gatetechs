<template>

  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Add new post</h4>
      </div>
      <div class="card-body">
        <ul class="alert alert-warning" v-if="Object.keys(errorList).length > 0">
          <li class="mb-0 ms-3" v-for="(error , index) in this.errorList" :key="index">
            {{ error }}
          </li>
        </ul>
        <div class="mb-3">
          <label for="">Title</label>
          <input type="text" v-model="model.post.title" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Content</label>
          <textarea name="" id="" cols="30" v-model="model.post.content" rows="10" class="form-control"></textarea>
        </div>

        <div class="mb-3">

          <button type="button" @click="savePost()" class="btn btn-success">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "postsCreateVue",
  data() {
    return {
      model: {
        post: {
          title: "",
          content: "",

        }
      },
      errorList: []
    }
  },
  methods: {

    savePost() {
      let myThis = this;
      axios.post('http://localhost:8000/api/posts',
          this.model.post
      ).then(res => {


        alert(res.data.message);
        this.model.post = {
          title: "",
          content: "",
          photo: ""
        }
        myThis.errorList = [];

        this.$router.replace({
          path: "/posts"
        })
      }).catch(function (error) {
        console.log(error)
        if (error.response.status === 422) {
          myThis.errorList = error.response.data.errors;
        }
      })
      {

      }
    }
  }
}
</script>