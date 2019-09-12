<template>
  <div class="container">
    <div class="left">
      <label v-for="(module, index) in modules" v-bind:key="index" :for="`group${index + 1}`">
        {{module.module}} groupe {{ index + 1 }}
        <input
          type="checkbox"
          :name="`group${index + 1}`"
          :id="`group${index + 1}`"
          :value="index + 1"
          @click="getGroupInfo"
        />
      </label>
    </div>
    <div class="right">
      <schedule :filters="filters"></schedule>

      <h1>text</h1>
    </div>
  </div>
</template>

<script>
export default {
  name: "GroupsPage",
  data() {
    return {
      filters: {
        sessionsType: [],
        checkedGroups: []
      }
    };
  },
  methods: {
    getGroupInfo(e) {
      this.filters.checkedGroups.forEach(e => this.filters.checkedGroups.pop());

      this.filters.checkedGroups.push(e.target.value);
    }
  },
  computed: {
    modules: {
      get() {
        return this.$store.getters.modules;
      }
    }
  },
  //life cycle hooks
  mounted() {
    console.log("Groups PAge");
  }
};
</script>

<style scoped>
.container {
  display: flex;

  font-family: Roboto, "Helvetica Neue", "sans-serif";
}
.left {
  flex-basis: 19%;
  background-color: #edeff0;
  height: 500px;
  overflow-y: scroll;
  /* align-self: flex-end; */
  margin-right: 1rem;
  position: sticky;
  top: 200px;
}
</style>