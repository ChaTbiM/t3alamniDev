<template>
  <!-- <div class="container"> -->
  <!-- <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <router-link to="/teacher/groups"></router-link>
          <div class="card-body">I'm an example component. for teachersssss</div>
        </div>
      </div>
  </div>-->

  <!-- </div> -->
  <div id="app">
    hhh
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "Example",
  mounted() {
    console.log("Component mounted. for teachers");
  }
};
</script>
