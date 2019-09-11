<template>
  <div class="container" id="teacher2">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">I'm an example component. for teacher iiiii</div>
        </div>
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
export default {
  name: "example-2",
  mounted() {
    console.log("Component mounted. for teachers");
    console.log(this.$router);
  }
};
</script>
