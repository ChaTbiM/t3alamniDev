<template>
  <div class="container">
    <div class="close" @click="showChooseGroup">X</div>
    <form action method="post">
      <fieldset>
        <legend>Add Fixed Session</legend>
        <label for="group">select groupe</label>
        <select v-model="choosedGroup" name="group" id="group">
          <option
            v-for="(group,index) in this.$store.getters.modules"
            :value="`groupe${group.groupId}`"
            v-bind:key="index"
          >groupe {{group.groupId}}</option>
          <!-- <option value="ex1">ex1</option>
          <option value="ex2">ex2</option>-->
        </select>
      </fieldset>
      <button type="submit" class="btn" @click.prevent="showAddFixedSessions">Ok</button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted. for teachers");
  },
  data() {
    return {
      choosedGroup: ""
    };
  },
  methods: {
    showAddFixedSessions(e) {
      this.$store.commit("chooseGroup", this.choosedGroup);
      this.choosedGroup = "";
      this.$parent.showAddFixedSessions();
      this.$parent.showChooseGroup(e);
    },
    showChooseGroup(e) {
      this.$parent.showChooseGroup(e);
    }
  }
};
</script>

<style scoped>
.container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -25%);
  background-color: rgba(243, 242, 235, 1);
  padding: 1rem;
}

.close {
  background-color: rgba(243, 242, 235, 1);
  color: black;
  position: absolute;
  right: 0;
  top: -26%;
  z-index: -1;
  padding: 5px;
  font-size: 1.2rem;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
}

label {
  margin-right: 1rem;
}

select {
  width: 180px;
}

.btn {
  margin-top: 1rem;
}
</style>