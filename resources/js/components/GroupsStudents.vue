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
                <a @click.prevent="deleteUser($event,index,student.student_id)" href="#">
                  <i class="fas fa-times-circle"></i>
                </a>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot class="tfoot">
          <tr class="tr last_tr">
            <th colspan="5" rowspan="2" class="addStudent">
              <i class="fas fa-plus"></i>
            </th>
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

    <div class="modal" v-show="chooseStudentOpen">
      <div class="close">X</div>
      <div class="content">
        <form action="#">
          <label for="search">search</label>
          <input
            @keyup.prevent="searchStudent"
            ref="search-input"
            type="text"
            id="search"
            v-model="search"
          />
        </form>
        <table>
          <thead>
            <tr class="tr">
              <td class="tdd">Nom:</td>
              <td class="tdd">Prénom:</td>
              <td class="tdd">Ajouter</td>
            </tr>
          </thead>
          <tbody id="tbody" ref="search-tbody">
            <tr
              class="tr"
              v-show="searchedStudents"
              v-bind:key="i"
              v-for="(student,i) in searchedStudents"
            >
              <td class="tdd">{{student.first_name}}</td>
              <td class="tdd">{{student.last_name}}</td>
              <td @click.prevent="addStudent($event,i)" class="add tdd">
                <i class="fas fa-plus"></i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="create">
        <form ref="createStudent" id="createStudent" @submit.prevent="createStudent" action="#">
          <label for="user_name">
            user_name
            <input type="text" name="user_name" id="user_name" />
          </label>
          <label for="password">
            mot de pass:
            <input type="password" name="password" id="password" />
          </label>
          <label for="email">
            Email:
            <input type="email" name="email" id="email" />
          </label>
          <label for="first_name">
            Nom:
            <input type="text" name="first_name" id="first_name" />
          </label>
          <label for="last_name">
            Prenom:
            <input id="last_name" name="last_name" type="text" />
          </label>
          <label for="age">
            Age:
            <input type="text" id="age" name="age" />
          </label>
          <label for="cycle">
            Niveau
            <select name="cycle" id="cycle">
              <option value="cem">cem</option>
              <option value="lycee">lycee</option>
              <option value="university">university</option>
            </select>
          </label>
          <label for="year">
            Annee:
            <input type="text" name="year" id="year" />
          </label>
          <label for="specialty">
            Specialite:
            <input type="text" name="specialty" id="specialty" />
          </label>
          <label for="group_id">
            Groupe
            <select name="group_id" id="group_id">
              <option
                v-for="(module,index) in modules"
                v-bind:key="index"
                :value="module.groupId"
              >{{module.groupName}}</option>
            </select>
          </label>

          <button type="submit">create student</button>
          <button type="reset">reset</button>
        </form>
      </div>
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
      currentMonthAbsentees: null,

      search: null,
      chooseStudentOpen: true,

      searchedStudents: null
      // groupStudents: null,
      // groups: []
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
      let newVal = this.$refs[`number-${index}`][0].value;
      this.allStudents[index].nb_absences = newVal;
      let id = this.allStudents[index].id;

      this.abcenseIndex.forEach(el => {
        this.$refs[`number-${el}`][0].setAttribute("readonly", "readonly");
      });

      axios
        .put(route("updateAbsencesFixed", [id]), { newVal })
        .then(res => (this.allStudents[index].nb_absences = newVal));

      this.editAble = null;
    },

    updatePaidState(e, index) {
      let newVal = Number(this.$refs[`paid-${index}`][0].value);

      let id = this.allStudents[index].id;

      axios
        .put(route("updatePaidFixed", [id]), { newVal })
        .then(res => this.$set(this.allStudents[index], "is_paid", newVal));
      this.editAble = false;
    },
    //deleteUser should be changed
    deleteUser(event, index, condition) {
      if (this.editAble) {
        if (this.selectedGroup) {
          let foundArr = this.groupStudents.findIndex(
            el => el[0].group_id == this.selectedGroup
          );
          foundArr++;
          if (foundArr) {
            let foundElement = this.groupStudents[foundArr - 1].findIndex(
              el => el.student_id === condition
            );
            foundElement++;
            if (foundElement--) {
              let id = this.groupStudents[foundArr - 1][foundElement].id;
              axios
                .delete(route("deleteEnrolled", [id]))
                .then(res =>
                  res.status === 200
                    ? this.$delete(
                        this.groupStudents[foundArr - 1],
                        foundElement--
                      )
                    : null
                );
            }
            if (this.groupStudents[foundArr - 1].length === 0) {
              this.$delete(this.groupStudents, foundArr - 1);
            }
          }
        } else {
          let foundElement = this.groupStudents[0].findIndex(
            el => el.student_id === condition
          );
          foundElement++;
          if (foundElement--) {
            let id = this.groupStudents[0][foundElement].id;
            axios
              .delete(route("deleteEnrolled", [id]))
              .then(res =>
                res.status === 200
                  ? this.$delete(this.groupStudents[0], foundElement--)
                  : null
              );
          }
          if (this.groupStudents[0].length === 0) {
            this.$delete(this.groupStudents, 0);
          }
        }
      }
    },
    searchStudent: function(e) {
      // let name = this.$refs["search-input"].value;
      let name = e.target.value;
      let selectedGroup = this.selectedGroup || this.modules[0].groupId;
      const vm = this;
      axios
        .get(route("searchStudents"), {
          params: {
            search: name,
            selectedGroup: selectedGroup
          }
        })
        .then(function(res) {
          vm.searchedStudents = res.data;
        });
    },
    addStudent(e, index) {
      let date = new Date();

      let addTo = group => {
        return {
          // created_at: null,
          first_name: this.searchedStudents[index].first_name,
          last_name: this.searchedStudents[index].last_name,
          group_id: Number(group),
          is_paid: 0,
          is_validated: 0,
          nb_absences: 0,
          student_id: this.searchedStudents[index].id,
          date: `${date.getFullYear()}-0${date.getUTCMonth() +
            1}-${date.getDate()}`,
          time: `${date.getHours()}:00:00`
          // updated_at: null
        };
      };

      if (this.groupStudents.length) {
        if (this.selectedGroup) {
          let found = this.groupStudents.findIndex(
            el => el[0].group_id == this.selectedGroup
          );
          found++;

          if (found) {
            let enroll = addTo(this.selectedGroup);
            this.groupStudents[found - 1].push(enroll);
            this.enrollStudent(enroll);
          } else {
            let enroll = addTo(this.selectedGroup);
            this.groupStudents.push([enroll]);
            this.enrollStudent(enroll);
          }
        } else {
          let enroll = addTo(this.groupStudents[0][0].group_id);
          this.groupStudents[0].push(enroll);
          this.enrollStudent(enroll);
        }
      } else {
        // if there is no joined students
        if (this.selectedGroup) {
          let enroll = addTo(this.selectedGroup);
          this.groupStudents.push([enroll]);
          this.enrollStudent(enroll);
        } else {
          let enroll = addTo(this.modules[0].groupId);
          this.groupStudents.push([enroll]);
          this.enrollStudent(enroll);
        }
      }
    },

    createStudent(e) {
      let date = new Date();

      const formData = new FormData(this.$refs["createStudent"]);

      // const month = `${date.getFullYear()}-0${date.getUTCMonth + 1}-${
      //   date.getDate
      // }`;
      const year = date.getFullYear();
      const month =
        date.getMonth() < 9
          ? "0" + String(date.getMonth() + 1)
          : date.getMonth() + 1;
      const day = date.getDate();

      const hours = `${date.getHours()}:00:00`;
      date = year + "-" + month + "-" + day;

      const is_paid = 0;
      const is_validated = 0;
      const nb_absences = 0;
      const group_id = this.selectedGroup || this.modules[0].groupId;

      formData.append("time", hours);
      formData.append("date", date);
      formData.append("group_id", group_id);
      // formData.append("is_paid", is_paid);
      // formData.append("is_validated", is_validated);
      // formData.append("nb_absences", nb_absences);

      console.log(formData);
      axios
        .post(route("createStudent"), formData)
        .then(res => console.log(res));
    },
    enrollStudent(enroll) {
      axios.post(route("enrollStudent"), enroll).then(res => console.log(res));
    }
  },
  computed: {
    modules: {
      get() {
        return this.$store.getters.modules;
      }
    },
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
        // if (this.groupStudents[0].length !== 0) {
        return this.groupStudents[0]
          ? this.groupStudents[0].filter(el => {
              return (
                el.date.split("-")[0] == this.currentMonthAll.getFullYear() &&
                el.date.split("-")[1] == this.currentMonthAll.getMonth() + 1
              );
            })
          : null;
        // }
      } else if (this.selectedGroup && this.groupStudents) {
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

      if (this.groupStudents.length === 0) {
        this.groupStudents = null;
      }
    },
    nonPaid: function() {
      if (this.groupStudents && !this.selectedGroup) {
        return this.groupStudents[0]
          ? this.groupStudents[0].filter(el => {
              return (
                el.date.split("-")[0] ==
                  this.currentMonthNonPaid.getFullYear() &&
                el.date.split("-")[1] ==
                  this.currentMonthNonPaid.getMonth() + 1 &&
                !el.is_paid
              );
            })
          : null;
      } else if (
        this.selectedGroup
        //  &&
        // this.groupStudents[this.selectedGroup - 1]
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
        return this.groupStudents[0]
          ? this.groupStudents[0].filter(el => {
              return (
                el.date.split("-")[0] ==
                  this.currentMonthAbsentees.getFullYear() &&
                el.date.split("-")[1] ==
                  this.currentMonthAbsentees.getMonth() + 1 &&
                !el.is_paid
              );
            })
          : null;
      } else if (
        this.selectedGroup
        //  &&
        // this.groupStudents[this.selectedGroup - 1]
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

    axios.defaults.headers.common["X-CSRF-TOKEN"] = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content");
  },
  mounted() {
    this.$store.dispatch("SET_GROUP_STUDENTS");
  }
};
</script>

<style  scoped>
.fa-check,
.fa-plus {
  color: green;
  cursor: pointer;
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
