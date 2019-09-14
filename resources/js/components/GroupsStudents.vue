<template>
  <div class="container">
    <!-- <div class="schedule__header">
      <div class="prevWeek" @click="getPreviousMonth">
        <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
      </div>
      <div class="nextWeek" @click="getNextMonth">
        <img src="arrow-right-solid.svg" alt="next week" class="next" />
      </div>
      <h2
        class="schedule__header__date"
      >{{ this.months[currentMonth.getUTCMonth()] }} {{currentMonth.getFullYear()}}</h2>
    </div>-->
    <div class="students__list">
      <div class="title">
        <h1 class="header">liste d’etudiant :</h1>
        <hr class="line" />
      </div>
      <div class="schedule__header">
        <div class="prevWeek" @click=" getPreviousMonth('currentMonthAll')">
          <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
        </div>
        <div class="nextWeek" @click="getNextMonth('currentMonthAll')">
          <img src="arrow-right-solid.svg" alt="next week" class="next" />
        </div>
        <h2
          class="schedule__header__date"
        >{{ this.months[currentMonthAll.getUTCMonth()] }} {{currentMonthAll.getFullYear()}}</h2>
      </div>
      <table class="table">
        <thead class="thead">
          <tr class="tr">
            <td class="td">edit...</td>
            <td class="td">nombre d 'absence</td>
            <td class="td">paiment</td>
            <td class="td">contacter</td>
            <td class="td">studentID</td>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr class="tr" v-for="(student,index) in allStudents" v-bind:key="index">
            <td class="td">{{student.first_name + ' ' + student.last_name}}</td>
            <td class="td">{{ ' '+student.nb_absences}}</td>
            <td class="td">{{student.is_paid ? 'true': 'false' }}</td>
            <td class="td">contacter</td>
            <td class="td">{{student.student_id}}</td>
          </tr>
        </tbody>
        <tfoot class="tfoot">
          <tr class="tr last_tr">
            <th colspan="5" rowspan="2" class="addStudent">Add Student</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="nonPaid">
      <div class="title">
        <h1 class="header">
          Etudiant non payé
          :
        </h1>
        <hr class="line" />
      </div>
      <div class="schedule__header">
        <div class="prevWeek" @click="getPreviousMonth('currentMonthNonPaid')">
          <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
        </div>
        <div class="nextWeek" @click="getNextMonth('currentMonthNonPaid')">
          <img src="arrow-right-solid.svg" alt="next week" class="next" />
        </div>
        <h2
          class="schedule__header__date"
        >{{ this.months[currentMonthNonPaid.getUTCMonth()] }} {{currentMonthNonPaid.getFullYear()}}</h2>
      </div>
      <table class="table">
        <thead class="thead">
          <tr class="tr">
            <td class="td">edit...</td>
            <td class="td">notifier</td>
            <td class="td"></td>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr class="tr" v-for="(student,index) in nonPaid" v-bind:key="`non-paid-${index}`">
            <td class="td">{{student.first_name + ' ' + student.last_name}}</td>
            <td class="td">notifier</td>
            <td class="td">delete</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="absentees">
      <div class="title">
        <h1 class="header">Absenses :</h1>
        <hr class="line" />
      </div>
      <div class="schedule__header">
        <div class="prevWeek" @click="getPreviousMonth('currentMonthAbsentees')">
          <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
        </div>
        <div class="nextWeek" @click="getNextMonth('currentMonthAbsentees')">
          <img src="arrow-right-solid.svg" alt="next week" class="next" />
        </div>
        <h2
          class="schedule__header__date"
        >{{ this.months[currentMonthAbsentees.getUTCMonth()] }} {{currentMonthAbsentees.getFullYear()}}</h2>
      </div>
      <table class="table">
        <thead class="thead">
          <tr class="tr">
            <td class="td">edit...</td>
            <td class="td">nombre d 'absence</td>
            <td class="td">notifier</td>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr class="tr" v-for="(student,index) in Absentees" v-bind:key="`absent-${index}`">
            <td class="td">{{student.first_name + ' ' + student.last_name}}</td>
            <td class="td">{{student.nb_absences}}</td>
            <td class="td">notifier</td>
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
      currentMonth: null,
      currentMonthAll: null,
      currentMonthNonPaid: null,
      currentMonthAbsentees: null

      // groupStudents: null
    };
  },
  methods: {
    getCurrentMonth() {
      let currentMonth = new Date();
      return currentMonth;
    },

    getPreviousMonth(storeAt) {
      let currentMonth = new Date(this[storeAt]);
      currentMonth.setMonth(currentMonth.getUTCMonth() - 1);

      this[storeAt] = currentMonth;
    },
    getNextMonth(storeAt) {
      let currentMonth = new Date(this[storeAt]);
      currentMonth.setMonth(currentMonth.getUTCMonth() + 1);

      this[storeAt] = currentMonth;
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
            el.date.split("-")[0] == this.currentMonthAll.getFullYear() &&
            el.date.split("-")[1] == this.currentMonthAll.getMonth() + 1
          );
        });
      } else if (this.groupStudents && this.selectedGroup) {
        let group = this.groupStudents.filter(el => {
          return el[0].group_id == this.selectedGroup;
        });

        return group[0]
          ? group[0].filter(element => {
              return (
                element.date.split("-")[0] ==
                  this.currentMonthAll.getFullYear() &&
                element.date.split("-")[1] ==
                  this.currentMonthAll.getMonth() + 1
              );
            })
          : null;
      }
    },
    nonPaid: function() {
      if (this.groupStudents && !this.selectedGroup) {
        return this.groupStudents[0].filter(el => {
          return (
            el.date.split("-")[0] == this.currentMonthNonPaid.getFullYear() &&
            el.date.split("-")[1] == this.currentMonthNonPaid.getMonth() + 1 &&
            !el.is_paid
          );
        });
      } else if (this.groupStudents && this.selectedGroup) {
        let group = this.groupStudents.filter(el => {
          return el[0].group_id == this.selectedGroup;
        });

        return group[0]
          ? group[0].filter(element => {
              return (
                element.date.split("-")[0] ==
                  this.currentMonthNonPaid.getFullYear() &&
                element.date.split("-")[1] ==
                  this.currentMonthNonPaid.getMonth() + 1 &&
                !element.is_paid
              );
            })
          : null;
      }
    },
    Absentees: function() {
      if (this.groupStudents && !this.selectedGroup) {
        return this.groupStudents[0].filter(el => {
          return (
            el.date.split("-")[0] == this.currentMonthAbsentees.getFullYear() &&
            el.date.split("-")[1] ==
              this.currentMonthAbsentees.getMonth() + 1 &&
            !el.is_paid
          );
        });
      } else if (this.groupStudents && this.selectedGroup) {
        let group = this.groupStudents.filter(el => {
          return el[0].group_id == this.selectedGroup;
        });

        return group[0]
          ? group[0].filter(element => {
              return (
                element.date.split("-")[0] ==
                  this.currentMonthAbsentees.getFullYear() &&
                element.date.split("-")[1] ==
                  this.currentMonthAbsentees.getMonth() + 1 &&
                !element.is_paid
              );
            })
          : null;
      }
    }
  },
  // life Cycle Hooks
  created() {
    this.currentMonthAll = this.getCurrentMonth();
    this.currentMonthNonPaid = this.getCurrentMonth();
    this.currentMonthAbsentees = this.getCurrentMonth();
  },
  mounted() {
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

.students__list,
.nonPaid,
.absentees {
  margin-top: 2rem;
}

.title {
  /* width: 68%; */
  width: 100%;
  margin: 0 auto;
}

.header,
.line {
  display: inline-block;
}

.header {
  width: 10%;
}

.line {
  font-size: 15px;
  width: 54%;
  vertical-align: middle;
}

/* Styling Tables */
.table {
  text-align: center;
  background-color: #dadfe1;
  width: 65%;
}

.tr {
  text-align: center;
  border: solid 2px #bbbcbd;
}

.tfoot {
  width: 100%;
}
.last_tr {
  width: 100%;
  text-align: right;
}

.addStudent {
  padding: 1rem;
}

.td {
  padding: 0.5rem;
  /* padding-right: 3rem; */
  border-right: solid 2px #bbbcbd;
}
</style>
