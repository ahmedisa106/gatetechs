<template>

  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Edit post</h4>
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

          <button type="button" @click="updatePost()" class="btn btn-success">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "postsEditVue",
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
  mounted() {
    this.getPost(this.$route.params.id);
  },
  methods: {

    getPost(id) {
      axios.get(`http://localhost:8000/api/posts/show?id=${id}`).then((res) => {
        this.model.post = res.data.data
      }).catch(function (error) {
        if (error.response.status === 422) {
          alert(error.response.data.message)
        }
      })
    },

    updatePost() {

      let myThis = this;
      axios.put(`http://localhost:8000/api/posts?id=${this.$route.params.id}`,
          this.model.post
      ).then(res => {
        alert(res.data.message);
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