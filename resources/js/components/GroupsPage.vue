<template>
  <div class="container">
    <div class="left">
      <div v-for="(module, index) in modules" v-bind:key="index">
        <a
          :name="`group${index + 1}`"
          :id="`group${index + 1}`"
          :value="index + 1"
          @click.prevent="getGroupInfo"
          href="#"
        >{{module.groupName}}</a>
      </div>
      <!-- <label v-for="(module, index) in modules" v-bind:key="index" :for="`group${index + 1}`">
        {{module.module}} groupe {{ index + 1 }}
        <input
          type="checkbox"
          :name="`group${index + 1}`"
          :id="`group${index + 1}`"
          :value="index + 1"
          @click="getGroupInfo"
        />
      </label>-->
    </div>
    <div class="right">
      <schedule :filters="filters"></schedule>

      <!-- below -->
      <!-- <div>
        <div class="schedule__header">
          <div class="prevWeek" @click="getPreviousMonth">
            <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
          </div>
          <div class="nextWeek" @click="getNextMonth">
            <img src="arrow-right-solid.svg" alt="next week" class="next" />
          </div>
          <h2
            class="schedule__header__date"
          >{{ this.months[currentMonth.getUTCMonth()] }} {{currentMonth.getFullYear()}}</h2>
        </div>
      </div>-->

      <groups-students></groups-students>
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
      this.filters.checkedGroups.pop();
      this.filters.checkedGroups.push(e.target.getAttribute("value"));
      this.$store.commit("changeGroupID", e.target.getAttribute("value"));
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
  created() {},
  mounted() {
    // this.getCurrentMonth();
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
  top: 10px;
}
/* 
.schedule__header {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  align-content: center;
  margin-bottom: 0.5rem;
}

.previous,
.next {
  width: 15px;
  padding: 0.5rem;
  text-align: center;

  border-top: solid 1px grey;
  border-bottom: solid 1px grey;

  border-right: solid 1px grey;
}

.previous {
  border-left: solid 1px grey;
}

.schedule__header__date {
  margin-left: 1.4rem;
  color: red;
  font-size: 16px;
  color: rgb(56, 64, 71);
  font-weight: 500;
}

.line {
  font-size: 5px;
} */
</style>