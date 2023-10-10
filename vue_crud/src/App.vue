<script setup>
import {RouterLink, RouterView} from 'vue-router';

</script>

<template>
  <header>
    <div class="wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">


          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <RouterLink class="nav-link active" aria-current="page" to="/">Home</RouterLink>
              </li>

              <li class="nav-item">
                <RouterLink class="nav-link " aria-current="page" to="/posts">Posts</RouterLink>
              </li>


            </ul>

          </div>
        </div>
      </nav>

    </div>
  </header>

  <RouterView/>
</template>

<style scoped>

</style>
