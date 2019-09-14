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
            <td>studentID</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(student,index) in allStudents" v-bind:key="index">
            <td>{{student.first_name + ' ' + student.last_name}}</td>
            <td>{{ ' '+student.nb_absences}}</td>
            <td>{{student.is_paid ? 'true': 'false' }}</td>
            <td>contacter</td>
            <td>{{student.student_id}}</td>
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

      // groupStudents: null
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
        return this.$store.getters.groupID;
      }
    },
    groupStudents: {
      get() {
        return this.$store.getters.groupStudents;
      }
    },
    allStudents: function() {
      if (this.groupStudents && !this.selectedGroup) {
        return this.groupStudents[0].filter(el => {
          return (
            el.date.split("-")[0] == this.currentMonth.getFullYear() &&
            el.date.split("-")[1] == this.currentMonth.getMonth() + 1
          );
        });
      } else if (this.groupStudents && this.selectedGroup) {
        let group = this.groupStudents.filter(el => {
          return el[0].group_id == this.selectedGroup;
        });

        return group[0]
          ? group[0].filter(element => {
              return (
                element.date.split("-")[0] == this.currentMonth.getFullYear() &&
                element.date.split("-")[1] == this.currentMonth.getMonth() + 1
              );
            })
          : null;
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

    // this.$store.watch(
    //   (state, getters) => getters.groupStudents,
    //   (newValue, oldValue) => {
    //     this.fixedSessions = newValue;

    //     this.groupStudents=this.$store.getters.groupStudents;
    //   },
    //   { deep: true, immediate: true }
    // );
  },
  mounted() {
    let year = this.currentMonth.getFullYear();
    let month = this.currentMonth.getUTCMonth() + 1;
    let date = {
      year,
      month
    };
    this.$store.dispatch("SET_GROUP_STUDENTS");
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
