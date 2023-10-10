<script setup>

</script>

<template>
  <div class="container" style="margin-top: 50px">
    <div class="card">
      <div class="card-header">
        <h4>Posts</h4>
        <RouterLink to="/posts/create" class="btn btn-primary float-end">Add Post</RouterLink>
      </div>
      <div class="card-body">
        <table class="table table-bordered text-center">
          <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(student,index) in students" :key="index">

            <td>{{ student.id }}</td>
            <td>{{ student.title }}</td>
            <td>{{ student.content }}</td>
            <td>
              <RouterLink :to="{path:'/posts/'+student.id+'/edit'}" class="btn btn-success ">
                edit
              </RouterLink>
              <button type="button" @click="deletePost(student.id)" class="btn btn-danger">Delete</button>
            </td>

          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "students",
  data() {
    return {
      students: [],
    }
  },
  mounted() {
    this.getStudents();
  },
  methods: {
    getStudents() {
      axios.get('http://127.0.0.1:8000/api/posts', {
        pagination: false,
        limit: 10
      }).then(res => {
        this.students = res.data.data
      })
    },
    deletePost(id) {
      if (confirm("are you sure ?")) {
        axios.delete(`http://localhost:8000/api/posts/delete?id=${id}`).then((res) => {
          this.getStudents();
        }).catch((error) => {
          console.log(error)
        })
      }
    }
  }
}
</script>