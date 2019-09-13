<template>
  <div class="container">
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
    <div class="students__list">
      <table>
        <thead>
          <tr>
            <td>edit...</td>
            <td>nombre d 'absence</td>
            <td>paiment</td>
            <td>contacter</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Name</td>
            <td>0</td>
            <td>true</td>
            <td>contacter</td>
            <td>delete</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "GroupStudents",
  data() {
    return {
      months: [
        "janvier",
        "fevrier",
        "mars",
        "avril",
        "mai",
        "juin",
        "juillet",
        "auot",
        "septembre",
        "octobre",
        "novembre",
        "decembre"
      ],
      currentMonth: null
    };
  },
  methods: {
    getCurrentMonth() {
      let currentMonth = new Date();
      this.currentMonth = currentMonth;
    },

    getPreviousMonth() {
      let currentMonth = new Date(this.currentMonth);
      currentMonth.setMonth(currentMonth.getUTCMonth() - 1);

      this.currentMonth = currentMonth;
    },
    getNextMonth() {
      let currentMonth = new Date(this.currentMonth);
      currentMonth.setMonth(currentMonth.getUTCMonth() + 1);

      this.currentMonth = currentMonth;
    }
  },
  computed: {
    selectedGroup: {
      get() {
        console.log(this.$store.getters.groupID, "laaast");
        return this.$store.getters.groupID;
      }
    }
    // modules: {
    //   get() {
    //     return this.$store.getters.modules;
    //   }
    // }
  },
  // life Cycle Hooks
  created() {
    this.getCurrentMonth();
  },
  mounted() {
    let year = this.currentMonth.getFullYear();
    let month = this.currentMonth.getUTCMonth() + 1;
    let date = {
      year,
      month
    };
    this.$store.dispatch("currentMonthStudents");
  }
};
</script>

<style  scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
}
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
}
</style>
