<template>
  <div class="container">
    <div class="left">
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

    <div class="schedule">
      <div class="schedule__header">
        <div class="prevWeek" @click="getPreviousWeek">
          <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
        </div>
        <div class="nextWeek" @click="getNextWeek">
          <img src="arrow-right-solid.svg" alt="next week" class="next" />
        </div>
        <h2 class="schedule__header__date">{{ currentWeek }}</h2>
      </div>

      <!-- <div class="column" v-for="(day,index) in days" v-bind:key="index" >
                <div class=" day">{{day}}</div>
      <div>-->
      <div class="days">
        <div class="day" v-for="(day, index) in days" v-bind:key="index">{{ day }}</div>
      </div>
      <hr class="line" />

      <div class="calender">
        <div class="column">
          <!-- <div class="hours"></div>  -->
          <div class="hour" v-for="(cell,   index) in sessions.time" v-bind:key="index">{{ cell }}</div>
        </div>

        <div class="column" v-for="(day, index) in days" v-bind:key="index">
          <!-- <div class=" day">{{day}}</div> -->
          <div
            class="cell block"
            @click="showAddSessions"
            @mousedown="logIt($event, index, ind)"
            v-for="(cell, ind) in filterSessions[index]"
            v-bind:key="ind"
          >
            <span v-if="cell.type === 'fixed'">groupe {{ cell.groupId }} {{ cell.module }}</span>
            <span v-if="cell.type == 'simple'">
              {{
              cell.subject
              }}
            </span>
          </div>
        </div>

        <div id="model" v-show="addSessionsOpen">
          <div class="model__close" @click="closeAddSessions">X</div>
          <div class="model__add__fix btn">add fix session</div>
          <div class="model__add__simple btn">add simple session</div>
        </div>

        <add-simple-session v-show="AddSimpleSessionOpen"></add-simple-session>
        <add-group v-show="addGroupOpen"></add-group>
        <add-fixed-session v-show="AddFixedSessionOpen"></add-fixed-session>
      </div>
    </div>
  </div>
</template>

<script>
import { setTimeout } from "timers";

export default {
  name: "schedule",
  props: ["fixed", "simple", "module"],
  data() {
    return {
      sessions2: {
        time: [
          "07:00",
          "    08:00",
          "09:00",
          "10:00",
          "11:00",
          "12:00",
          "13:00",
          "14:00",
          "15:00",
          "16:00",
          "17:00",
          "18:00",
          "19:00",
          "20:00",
          "21:00",
          "22:00"
        ],
        data: [
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}]
        ]
      },
      sessions: {
        time: [
          "07:00",
          "08:00",
          "09:00",
          "10:00",
          "11:00",
          "12:00",
          "13:00",
          "14:00",
          "15:00",
          "16:00",
          "17:00",
          "18:00",
          "19:00",
          "20:00",
          "21:00",
          "22:00"
        ],
        data: [
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
          [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}]
        ]
      },
      days: [
        "samedi",
        "dimance",
        "lundi",
        "mardi",
        "mercredi",
        "jeudi",
        "vendredi"
      ],
      addSessionsOpen: this.$store.getters.addSessionsOpen,
      AddSimpleSessionOpen: this.$store.getters.AddSimpleSessionOpen,
      AddFixedSessionOpen: this.$store.getters.AddFixedSessionOpen,
      addGroupOpen: this.$store.getters.addGroupOpen,
      addGroup: "",

      componentLoaded: false,

      fixedSessions: JSON.parse(this.fixed),
      simpleSessions: JSON.parse(this.simple),
      modules: JSON.parse(this.module),

      filters: {
        sessionsType: [],
        checkedGroups: []
      },

      // filledIn:[],

      //selecting blocks
      clicked: false,
      target: [],
      //

      currentDay: "",
      wkStart: "",
      wkEnd: "",
      currentWeek: "",
      weekDays: [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
      ],
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
      ]
    };
  },
  methods: {
    logIt(event, index, ind) {
      event.preventDefault();
      console.log(index, ind);
      console.log(this.sessions.data[index][ind]);
      // console.dir(event.target)
      // event.target.style.backgroundColor = 'red';
      // console.log('hovered on index', index);
      // console.log(this.sessions.data[index][ind]);
    },

    log(event, index, ind) {
      event.preventDefault();
      console.dir(event.target);
    },

    getCurrentWeek() {
      let newWeek;
      let curr = new Date(); // get current date
      this.currentDay = curr;

      let diff = function() {
        if (curr.getDay() === 0) {
          return -1;
        } else if (curr.getDay() === 6) {
          return 0;
        } else {
          return -(curr.getDay() + 1);
        }
      };

      let wkStart = new Date(curr.setDate(curr.getDate() + diff()));
      this.wkStart = wkStart;

      let wkEnd = new Date(curr.setDate(wkStart.getDate() + 6));
      this.wkEnd = wkEnd;

      this.currentWeek = wkStart.getDate();
      this.currentWeek += " " + this.weekDays[wkStart.getDay()];
      this.currentWeek += " " + this.months[wkStart.getMonth()];
      this.currentWeek += " " + wkStart.getFullYear();

      this.currentWeek += " - " + wkEnd.getDate();
      this.currentWeek += " " + this.weekDays[wkEnd.getDay()];
      this.currentWeek += " " + this.months[wkEnd.getMonth()];
      this.currentWeek += " " + wkEnd.getFullYear();

      this.showSimpleSessions();
      this.showFixedSessions();
    },
    getNextWeek() {
      let curr = new Date(this.wkEnd);

      let wkStart = new Date(curr.setDate(curr.getDate() + 1));
      this.wkStart = wkStart;

      let wkEnd = new Date(curr.setDate(wkStart.getDate() + 6));
      this.wkEnd = wkEnd;

      this.currentWeek = wkStart.getDate();
      this.currentWeek += " " + this.weekDays[wkStart.getDay()];
      this.currentWeek += " " + this.months[wkStart.getMonth()];
      this.currentWeek += " " + wkStart.getFullYear();

      this.currentWeek += " - " + wkEnd.getDate();
      this.currentWeek += " " + this.weekDays[wkEnd.getDay()];
      this.currentWeek += " " + this.months[wkEnd.getMonth()];
      this.currentWeek += " " + wkEnd.getFullYear();

      this.clearSessions();
      this.showSimpleSessions();
      this.showFixedSessions();
    },
    getPreviousWeek() {
      let curr = new Date(this.wkStart);

      let wkEnd = new Date(curr.setDate(curr.getDate() - 1));
      this.wkEnd = wkEnd;

      let wkStart = new Date(curr.setDate(wkEnd.getDate() - 6));
      this.wkStart = wkStart;

      this.currentWeek = wkStart.getDate();
      this.currentWeek += " " + this.weekDays[wkStart.getDay()];
      this.currentWeek += " " + this.months[wkStart.getMonth()];
      this.currentWeek += " " + wkStart.getFullYear();

      this.currentWeek += " - " + wkEnd.getDate();
      this.currentWeek += " " + this.weekDays[wkEnd.getDay()];
      this.currentWeek += " " + this.months[wkEnd.getMonth()];
      this.currentWeek += " " + wkEnd.getFullYear();

      this.clearSessions();
      this.showSimpleSessions();
      this.showFixedSessions();
    },

    showAddSessions: function(e) {
      e.preventDefault();
      let top;
      let left;
      //

      if (e.target.offsetLeft >= 700) {
        left = e.target.offsetLeft - 180;
      } else {
        left = e.target.offsetLeft + 140;
      }

      if (e.target.offsetTop >= 1020) {
        top = e.target.offsetTop - 20;
      } else {
        top = e.target.offsetTop;
      }

      let model = document.getElementById("model");

      model.style.top = `${top}px`;
      model.style.left = `${left}px`;

      // return  this.addSessionsOpen = !this.addSessionsOpen;
      this.$store.commit("changeState", "addSessionsOpen");
      this.addSessionsOpen = this.$store.getters.addSessionsOpen;
    },

    closeAddSessions: function(e) {
      e.preventDefault();

      this.$store.commit("changeState", "addSessionsOpen");
      this.addSessionsOpen = this.$store.getters.addSessionsOpen;
    },

    showFixedSessions() {
      const firstDay = this.currentWeek.split(" ")[0];
      const date = new Date(this.wkStart);
      const firstDayMonth = date.getMonth() + 1;
      const firstDayYear = date.getFullYear();

      this.fixedSessions.forEach(el => {
        // const filled=[];
        const year = Number(el.date.split("-")[0]);
        const month = Number(el.date.split("-")[1]);
        const date = el.date.split("-")[2];
        const time = el.time.split(":")[0];

        const diffTime = time - 7;
        const diffDay = date - firstDay;

        const module = this.modules.find(function(element) {
          return element.groupId === el.group_id;
        });

        if (
          diffDay <= 6 &&
          diffDay >= 0 &&
          firstDayMonth === month &&
          firstDayYear === year
        ) {
          this.sessions.data[diffDay][diffTime].groupId = el.group_id;
          this.sessions.data[diffDay][diffTime].type = el.type;
          this.sessions.data[diffDay][diffTime].module = module.module;

          // filled.push(diffDay);
          // filled.push(diffTime);
        }

        // this.filledIn.push(filled);
      });
    },

    showSimpleSessions() {
      const firstDay = this.currentWeek.split(" ")[0];
      const date = new Date(this.wkStart);
      const firstDayMonth = date.getMonth() + 1;
      const firstDayYear = date.getFullYear();

      this.simpleSessions.forEach(el => {
        // const filled=[];

        const year = Number(el.date.split("-")[0]);
        const month = Number(el.date.split("-")[1]);
        const date = el.date.split("-")[2];
        const time = el.time.split(":")[0];

        const diffTime = time - 7;
        const diffDay = date - firstDay;
        if (
          diffDay <= 6 &&
          diffDay >= 0 &&
          firstDayMonth === month &&
          firstDayYear === year
        ) {
          console.log(true);
          this.sessions.data[diffDay][diffTime].subject = el.subject;
          this.sessions.data[diffDay][diffTime].type = el.type;
          // filled.push(diffDay);
          // filled.push(diffTime);
        }

        // this.filledIn.push(filled);
      });
    },

    clearSessions() {
      this.sessions.data.forEach((el, index) => {
        this.$set(this.sessions.data, index, [
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {},
          {}
        ]);
      });
    }
  },

  created() {
    this.getCurrentWeek();
  },

  mounted() {
    this.$store.commit("initFixed", this.fixed);
    this.fixedSessions = this.$store.getters.fixedSessions;

    this.$store.commit("initSimple", this.simple);
    this.simpleSessions = this.$store.getters.simpleSessions;

    this.$store.commit("initModules", this.module);
    this.modules = this.$store.getters.modules;

    this.componentLoaded = true;
  },

  computed: {
    filterSessions: function() {
      const data = [];

      if (this.componentLoaded) {
        let fixedType = this.filters.sessionsType.find(el => el === "fixed");
        let simpleType = this.filters.sessionsType.find(el => el === "simple");

        const groups = Object.assign([], this.filters.checkedGroups);
        // const groups = JSON.parse(JSON.stringify(this.filters.checkedGroups));

        this.sessions.data.forEach((el, i) => {
          const dayData = [];
          el.forEach((element, j) => {
            if (element.type === fixedType || element.type === simpleType) {
              dayData.push(element);
            } else {
              dayData.push({});
            }
          });

          data.push(dayData);
        });

        if (groups.length !== 0) {
          data.forEach((day, i) => {
            day.forEach((element, j) => {
              groups.forEach((gr, k) => {
                if (this.sessions.data[i][j].groupId == gr) {
                  data[i][j] = this.sessions.data[i][j];
                }
              });
            });
          });
        }

        if (
          this.filters.sessionsType.length ||
          this.filters.checkedGroups.length
        ) {
          return data;
        } else {
          return this.sessions.data;
        }
      }

      return this.sessions.data;
    }
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
  align-self: flex-end;

  margin-right: 1rem;
}

.schedule {
  /* flex-basis:72%;
    height: 400px;
    overflow-y: scroll;
    margin: 0 auto;
    min-width: 950px; */
  flex-basis: auto;
  margin-top: 16px;
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

/* Calender */

.calender {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;

  flex-basis: 100%;
  height: 400px;
  overflow-y: scroll;
  /* margin: 0 auto; */
  min-width: 950px;

  /* for position .offsetTop*/
  position: relative;
}

.days {
  display: flex;
  width: auto;
  padding-left: 34px;
  border-top: solid 1px grey;
}

/* .day:first-child {
    margin-left: 36px;
} */
.day {
  flex-basis: 140px;
  text-align: center;
  margin-bottom: 0.5rem;
  margin-top: 0.5rem;
  color: rgb(131, 131, 131);
  height: 16px;
}

.hour {
  font-size: 12px;
  color: #384047;
  margin-right: 5px;
}

.cell {
  display: block;
  width: 145px;
  height: 80px;
  border-collapse: collapse;
  border-spacing: 0;
  /* margin: 1px; */
  border-right: solid 1px grey;
  /* border-left: solid 1px grey; */
  border-bottom: solid 1px grey;

  text-align: center;
}

.hour {
  display: block;
  height: 80px;
}

.block {
  background-color: rgb(218, 223, 225);
}

/* Model  */

#model {
  position: absolute;
  background-color: gray;
  text-align: center;
  background-color: rgba(243, 242, 235, 0.74);
}

.model__close {
  text-align: right;
  position: absolute;
  bottom: 100%;
  color: black;
  background-color: rgba(243, 242, 235, 1);
  border-top-left-radius: 100px;
  border-top-right-radius: 100px;
  padding: 5px;
  /* z-index: -1; */
  /* display: inline-block;
    width    : 100%;
    text-align: right; */
}

.btn {
  padding: 1rem;
}

label {
  display: block;
}
</style>



