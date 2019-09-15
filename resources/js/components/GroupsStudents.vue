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
      <table class="table" :tt="tt">
        <thead class="thead">
          <tr class="tr">
            <td @click.prevent="changeEdit" class="tdd">
              <a href>modifier ...</a>
            </td>
            <td class="tdd">nombre d 'absence</td>
            <td class="tdd">paiment</td>
            <td class="tdd">contacter</td>
            <td class="tdd">delete</td>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr
            class="tr"
            v-for="(student,index) in allStudents"
            v-bind:key="index"
            :re-render="index"
          >
            <td class="tdd">{{student.first_name + ' ' + student.last_name}}</td>
            <td class="td">
              <input
                @click.prevent="editNumberOfAbsences($event,index)"
                :ref="`number-${index}`"
                type="number"
                :class="{editAble: editAble , notEditAble:!editAble}"
                :value="student.nb_absences"
                readonly
              />
              <div
                class="changeBtn"
                v-if="editAble"
                @click.prevent="updateNumberOfAbsences($event,index)"
              >ok</div>
            </td>
            <td v-if="editAble" class="tdd">
              <select :ref="`paid-${index}`" name="paid" id="paid" :value="student.is_paid">
                <option value="1">payé</option>
                <option value="0">non-payé</option>
              </select>
              <div class="changeBtn" @click.prevent="updatePaidState($event,index)">ok</div>
            </td>
            <td v-if="!editAble" :ref="`icon-${index}`" class="tdd">
              <div>
                <i :class="[student.is_paid ? 'fas fa-check' : 'fas fa-times']"></i>
              </div>
            </td>
            <td class="tdd">contacter</td>
            <td class="tdd">
              <div v-if="!editAble">
                <i class="fas fa-times-circle"></i>
              </div>
              <div v-else>
                <a @click.prevent="deleteUser($event,index,'all')" href="#">
                  <i class="fas fa-times-circle"></i>
                </a>
              </div>
            </td>
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
            <td class="tdd"></td>
            <td class="tdd">notifier</td>
            <td class="tdd">delete</td>
          </tr>
        </thead>
        <tbody class="tbody">
          <tr class="tr" v-for="(student,index) in nonPaid" v-bind:key="`non-paid-${index}`">
            <td class="tdd">{{student.first_name + ' ' + student.last_name}}</td>
            <td class="tdd">notifier</td>
            <td class="tdd">
              <a @click.prevent="deleteUser($event,index,student.student_id)" href="#">
                <i class="fas fa-times-circle"></i>
              </a>
            </td>
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
            <td class="td"></td>
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
      editAble: true,
      abcenseIndex: [],
      index: 0,
      tt: 0,
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
    },
    changeEdit() {
      if (this.editAble) {
        this.editAble = null;
      } else {
        this.editAble = true;
      }
    },

    editNumberOfAbsences(e, index) {
      e.preventDefault();
      if (this.editAble) {
        this.$refs[`number-${index}`][0].removeAttribute("readonly");
        this.abcenseIndex.push(index);
      }
    },
    updateNumberOfAbsences(e, index) {
      e.preventDefault();
      // console.log(this.$refs[`number-${index}`][0].value);
      this.allStudents[index].nb_absences = this.$refs[
        `number-${index}`
      ][0].value;
      this.abcenseIndex.forEach(el => {
        this.$refs[`number-${el}`][0].setAttribute("readonly", "readonly");
      });
      this.editAble = null;
    },

    updatePaidState(e, index) {
      let newVal = Number(this.$refs[`paid-${index}`][0].value);
      this.$set(this.allStudents[index], "is_paid", newVal);
      this.editAble = false;
    },
    deleteUser(event, index, condition) {
      if (condition === "all") {
        if (this.selectedGroup === null) {
          this.$delete(this.groupStudents[0], index);
        } else {
          this.$delete(this.groupStudents[this.selectedGroup - 1], index);
        }
        this.editAble = null;
      } else {
        if (this.selectedGroup === null) {
          for (let i = 0; i < this.groupStudents[0].length; i++) {
            if (this.groupStudents[0][i].student_id === condition) {
              this.$delete(this.groupStudents[0], i);
              break;
            }
          }
        } else {
          for (
            let i = 0;
            i < this.groupStudents[this.selectedGroup - 1].length;
            i++
          ) {
            if (
              this.groupStudents[this.selectedGroup - 1][i].student_id ===
              condition
            ) {
              this.$delete(this.groupStudents[this.selectedGroup - 1], i);
              break;
            }
          }
        }
      }
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
      } else if (
        this.selectedGroup &&
        this.groupStudents[this.selectedGroup - 1]
      ) {
        let group = this.groupStudents.filter(el => {
          if (el.length !== 0) {
            return el[0].group_id == this.selectedGroup;
          }
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
      } else {
        return null;
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
      } else if (
        this.selectedGroup &&
        this.groupStudents[this.selectedGroup - 1]
      ) {
        let group = this.groupStudents.filter(el => {
          if (el.length !== 0) {
            return el[0].group_id == this.selectedGroup;
          }
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
      } else {
        return null;
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
      } else if (
        this.selectedGroup &&
        this.groupStudents[this.selectedGroup - 1]
      ) {
        let group = this.groupStudents.filter(el => {
          if (el.length !== 0) {
            return el[0].group_id == this.selectedGroup;
          }
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
      } else {
        return null;
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
.fa-check {
  color: green;
}
.fa-times {
  color: red;
}
.fa-times-circle {
  color: red;
  font-size: 1.1rem;
}

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

.tdd {
  padding: 0.5rem;

  /* padding-right: 3rem; */
  border-right: solid 2px #bbbcbd;
}

.td {
  border-right: solid 2px #bbbcbd;
  text-align: left;
}

.notEditAble {
  background-color: transparent;
  border: none;
  width: 100%;
  padding: 0.5rem;

  text-align: center;
}

.editAble {
  background-color: white;
  border: none;
  width: 100px;
  height: 100%;
  margin-right: 1rem;
  margin-left: 2rem;
  padding: 0.5rem;
  text-align: center;
  display: inline-block;
}

.changeBtn {
  display: inline-block;
  border: solid 1px #bbbcbd;
  padding: 0.5rem;
  background-color: white;
}
</style>
