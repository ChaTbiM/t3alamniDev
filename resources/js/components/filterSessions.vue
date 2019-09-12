<template>
  <div ref="left" class="left">
    <div class="left__calender"></div>
    <div class="left__add__fix">add fix session</div>
    <div class="left__add__simple">add simple session</div>

    <label for="fix">
      all fix sessions
      <input
        type="checkbox"
        name="fix"
        id="fix"
        value="fixed"
        v-model="filters.sessionsType"
      />
    </label>

    <label for="simple">
      all simple sessions
      <input
        type="checkbox"
        name="simple"
        id="simple"
        value="simple"
        v-model="filters.sessionsType"
      />
    </label>
    <br />

    <label v-for="(module, index) in modules" v-bind:key="index" :for="`group${index + 1}`">
      group {{ index + 1 }}
      <input
        type="checkbox"
        :name="`group${index + 1}`"
        :id="`group${index + 1}`"
        :value="index + 1"
        v-model="filters.checkedGroups"
      />
    </label>
  </div>
</template>

<script>
export default {
  name: "filterSessions",
  props: ["filters", "modules"],
  mounted() {
    console.log("Component mounted. for teachers");
  }
};
</script>


<style  scoped>
label {
  display: block;
}
</style>
