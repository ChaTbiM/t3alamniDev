<template>
  <div class="container">
    <div ref="schedule" class="schedule">
      <div class="schedule__header">
        <div class="prevWeek" @click="getPreviousWeek">
          <img src="arrow-left-solid.svg" alt="previous week" class="previous" />
        </div>
        <div class="nextWeek" @click="getNextWeek">
          <img src="arrow-right-solid.svg" alt="next week" class="next" />
        </div>
        <h2 class="schedule__header__date">{{ currentWeek }}</h2>
      </div>

      <div class="days">
        <div class="day" v-for="(day, index) in days" v-bind:key="index">{{ day }}</div>
      </div>
      <hr class="line" />

      <div class="calender">
        <div class="column">
          <div class="hour" v-for="(cell,   index) in sessions.time" v-bind:key="index">{{ cell }}</div>
        </div>

        <div class="column" v-for="(day, index) in days" v-bind:key="index">
          <div
            class="cell block"
            @mousedown="startSelect($event, index, ind)"
            @mouseenter="duringSelect($event, index, ind)"
            @mouseup="endOfSelect($event, index, ind)"
            v-for="(cell, ind) in filterSessions[index]"
            v-bind:key="ind"
            :style="{backgroundColor:cell.backgroundColor}"
            :ref="`cell${index}-${ind}`"
          >
            <span v-if="cell.type === 'fixed'">groupe {{ cell.groupId }} {{ cell.module }}</span>
            <span v-if="cell.type == 'simple'">
              {{
              cell.subject
              }}
            </span>
          </div>
        </div>

        <div id="model" class="model" v-show="addSessionsOpen">
          <div class="model__close" @click="closeAddSessions">X</div>
          <div class="model__info">
            <span class="model__day">
              <span>{{ this.selected.date }}</span>
              <span>{{this.days[this.selected.dayIndex]}}</span>
            </span>
            <span class="model__hours">{{this.selected.hours.min}} -> {{this.selected.hours.max}}</span>
          </div>
          <div class="model__add__fix btn" @click="showChooseGroup">add fix session</div>
          <div class="model__add__simple btn" @click="showAddSimpleSessions">add simple session</div>
        </div>
      </div>
    </div>

    <add-simple-session v-show="AddSimpleSessionOpen"></add-simple-session>
    <add-group v-show="addGroupOpen"></add-group>
    <add-fixed-session v-show="AddFixedSessionOpen"></add-fixed-session>
  </div>
</template>

<script>
export default {
  name: "ScheduleComponent",
  props: ["filters"],
  data() {
    return {
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
      days: [
        "samedi",
        "dimanche",
        "lundi",
        "mardi",
        "mercredi",
        "jeudi",
        "vendredi"
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
      ],
      ///
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
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ],
          [
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" },
            { backgroundColor: "rgb(218, 223, 225)" }
          ]
        ]
      },
      fixedSessions: null,
      simpleSessions: null,
      ///
      addSessionsOpen: this.$store.getters.addSessionsOpen,
      AddSimpleSessionOpen: this.$store.getters.AddSimpleSessionOpen,
      AddFixedSessionOpen: this.$store.getters.AddFixedSessionOpen,
      addGroupOpen: this.$store.getters.addGroupOpen,
      addGroup: "",
      //
      componentLoaded: null,
      ///
      clicked: false,
      targets: [],
      low: "",
      high: "",
      min: "",
      max: "",
      selected: {
        hours: {},
        dayIndex: "",
        date: ""
      }
    };
  },
  methods: {
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

      let wkStart = new Date(curr.setDate(curr.getUTCDate() + diff()));
      // wkStart.setHours(0, 0, 0);
      this.wkStart = wkStart;

      let wkEnd = new Date(curr.setDate(wkStart.getUTCDate() + 6));
      // wkEnd.setHours(23, 59, 0);
      this.wkEnd = wkEnd;

      this.currentWeek = wkStart.getDate();
      this.currentWeek += " " + this.weekDays[wkStart.getDay()];
      this.currentWeek += " " + this.months[wkStart.getMonth()];
      this.currentWeek += " " + wkStart.getFullYear();

      this.currentWeek += " - " + wkEnd.getDate();
      this.currentWeek += " " + this.weekDays[wkEnd.getDay()];
      this.currentWeek += " " + this.months[wkEnd.getMonth()];
      this.currentWeek += " " + wkEnd.getFullYear();

      // this.showSimpleSessions();
      // this.showFixedSessions();
    },
    getNextWeek() {
      let curr = new Date(this.wkEnd);

      let wkStart = new Date(curr.setDate(curr.getDate() + 1));
      // wkStart.setHours(0, 0, 0);
      this.wkStart = wkStart;

      let wkEnd = new Date(curr.setDate(wkStart.getDate() + 6));
      // wkEnd.setHours(0, 0, 0);
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
      this.clearSelections();
      if (this.addSessionsOpen) {
        this.$store.commit("changeState", "addSessionsOpen");
        this.addSessionsOpen = this.$store.getters.addSessionsOpen;
      }
      this.showSimpleSessions();
      this.showFixedSessions();
    },
    getPreviousWeek() {
      let curr = new Date(this.wkStart);

      let wkEnd = new Date(curr.setDate(curr.getDate() - 1));
      // wkEnd.setHours(0, 0, 0);
      this.wkEnd = wkEnd;

      let wkStart = new Date(curr.setDate(wkEnd.getDate() - 6));
      // wkStart.setHours(0, 0, 0);
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
      this.clearSelections();
      if (this.addSessionsOpen) {
        this.$store.commit("changeState", "addSessionsOpen");
        this.addSessionsOpen = this.$store.getters.addSessionsOpen;
      }
      this.showSimpleSessions();
      this.showFixedSessions();
    },
    ///
    startSelect(event, index, ind) {
      event.preventDefault();

      if (this.addSessionsOpen) {
        this.$store.commit("changeState", "addSessionsOpen");
        this.addSessionsOpen = this.$store.getters.addSessionsOpen;
      }
      this.clearSelections();
      if (event.target.style.backgroundColor === "rgb(218, 223, 225)") {
        this.clicked = true;
      } else {
        this.clicked = false;
      }

      if (this.clicked) {
        this.targets = [];
        this.low = 0;
        this.high = 0;
        this.max = 0;
        this.min = 0;

        this.targets.push(index);
        this.targets.push(ind);

        event.target.style.backgroundColor = "#ADD8E6";

        for (let i = this.targets[1]; i >= 0; i--) {
          let selector = `cell${index}-${i}`;
          if (
            this.$refs[selector][0].style.backgroundColor ===
              "rgb(42, 210, 49)" ||
            this.$refs[selector][0].style.backgroundColor ===
              "rgb(19, 123, 244)"
          ) {
            this.min = i + 1;
            break;
          } else {
            this.min = 0;
          }
        }

        for (let i = this.targets[1]; i < 16; i++) {
          let selector = `cell${index}-${i}`;
          if (
            this.$refs[selector][0].style.backgroundColor ===
              "rgb(42, 210, 49)" ||
            this.$refs[selector][0].style.backgroundColor ===
              "rgb(19, 123, 244)"
          ) {
            this.max = i - 1;
            break;
          } else {
            this.max = 15;
          }
        }
      }
    },
    duringSelect(event, index, ind) {
      event.preventDefault();

      if (
        event.target.style.backgroundColor === "rgb(42, 210, 49)" ||
        event.target.style.backgroundColor === "rgb(19, 123, 244)"
      ) {
        let day = this.filterSessions[index][ind].date;
        let time = this.filterSessions[index][ind].time;

        let thisMoment = new Date();
        let sessionTimeString = day + "T" + time + "Z";
        let sessionTime = new Date(sessionTimeString);
        sessionTime.setHours(time.split(":")[0], 0, 0);
        // Session State modal
        // console.log(this.filterSessions[index][ind]);
        // if (thisMoment < sessionTime) {
        //   console.log("en Attente");
        // } else if (thisMoment > sessionTime) {
        //   console.log("session terminer");
        // } else {
        //   console.log("en cour");
        // }
      }

      if (this.clicked && this.targets[0] === index) {
        // "rgb(218, 223, 225)" grey
        // light blue "#ADD8E6"
        // rgb(42, 210, 49) , rgb(19, 123, 244) .. green and blue
        // let selector = `cell${index}-${i}`;
        //   this.$refs[selector][0].style.backgroundColor = "#ADD8E6";
        let low;
        let high;

        let max = this.max;
        let min = this.min;

        if (this.targets[1] > ind) {
          high = this.targets[1];
          low = ind;
        } else {
          low = this.targets[1];
          high = ind;
        }

        for (let i = min; i <= max; i++) {
          let selector = `cell${index}-${i}`;

          if (i >= low && i <= high) {
            this.$refs[selector][0].style.backgroundColor = "#ADD8E6";
          } else {
            this.$refs[selector][0].style.backgroundColor =
              "rgb(218, 223, 225)";
          }
        }
        this.low = low + 1;
        this.high = high + 1;
      }
    },

    endOfSelect(event, index, ind) {
      event.preventDefault();
      //showing the add session in the right place
      if (this.high && this.low) {
        let targets = _.range(this.low - 1, this.high, 1);

        this.targets.push(...targets);
      }

      let hoursInfo = this.targets.slice(1);

      let minHours = Math.min(...hoursInfo);
      let maxHours = Math.max(...hoursInfo) + 1;

      let dayIndex = this.targets[0];
      this.selected.dayIndex = dayIndex;

      let day = new Date(JSON.parse(JSON.stringify(this.wkStart)));

      day.setDate(day.getDate() + dayIndex);

      let date = this.months[day.getUTCMonth()] + " " + day.getDate();
      this.selected.date = date;
      this.selected.hours.min = this.sessions.time[minHours];
      this.selected.hours.max = this.sessions.time[maxHours];

      this.clicked = false;
      if (this.targets.length === 2) {
        this.$store.commit("setDuration", 1);
      } else if (this.targets.length > 2) {
        let hours = this.targets.length - 2;
        this.$store.commit("setDuration", hours);
      }
      date =
        day.getFullYear() + "-" + day.getUTCMonth() + "-" + day.getUTCDate();
      this.$store.commit("setHour", this.selected.hours.min.split(":")[0]);

      this.$store.commit("setDate", day);
      this.showAddSessions(event);
    },

    clearSelections() {
      let len = this.targets.length;
      let low = this.low;
      let high = this.high;

      for (let i = 1; i < len; i++) {
        let selector;
        if (len === 2) {
          selector = `cell${this.targets[0]}-${this.targets[1]}`;
        } else {
          selector = `cell${this.targets[0]}-${this.targets[i]}`;
        }

        if (
          this.$refs[selector][0].style.backgroundColor === "rgb(173, 216, 230)"
        ) {
          this.$refs[selector][0].style.backgroundColor = "rgb(218, 223, 225)";
        }
      }
    },

    //sessions
    clearSessions() {
      this.sessions.data.forEach((el, index) => {
        this.$set(this.sessions.data, index, [
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" },
          { backgroundColor: "rgb(218, 223, 225)" }
        ]);
      });
    },
    showAddSessions: function(e) {
      e.preventDefault();
      let top;
      let left;
      //

      if (e.target.offsetLeft >= 700) {
        left = e.target.offsetLeft - 145;
      } else {
        left = e.target.offsetLeft + 145;
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
      if (
        this.$refs[`cell${this.targets[0]}-${this.targets[1]}`][0].style
          .backgroundColor === "rgb(173, 216, 230)"
        // event.target.style.backgroundColor === "rgb(173, 216, 230)"
        // ||
        // event.target.style.backgroundColor !== "rgb(19, 123, 244)"
      ) {
        this.$store.commit("changeState", "addSessionsOpen");
        this.addSessionsOpen = this.$store.getters.addSessionsOpen;
      }
    },
    closeAddSessions: function(e) {
      e.preventDefault();
      if (this.addSessionsOpen) {
        this.$store.commit("changeState", "addSessionsOpen");
        this.addSessionsOpen = this.$store.getters.addSessionsOpen;
      }
    },
    showAddSimpleSessions(e) {
      this.$store.commit("changeState", "AddSimpleSessionOpen");
      this.AddSimpleSessionOpen = this.$store.getters.AddSimpleSessionOpen;

      this.closeAddSessions(e);
    },

    showAddFixedSessions() {
      this.$store.commit("changeState", "AddFixedSessionOpen");
      this.AddFixedSessionOpen = this.$store.getters.AddFixedSessionOpen;
    },

    showChooseGroup(e) {
      this.closeAddSessions(e);

      this.$store.commit("changeState", "addGroupOpen");
      this.addGroupOpen = this.$store.getters.addGroupOpen;
    },

    showFixedSessions() {
      // console.log("here00");
      if (this.fixedSessions && this.modules) {
        const wkStart = this.wkStart;
        const wkEnd = this.wkEnd;
        let info = this.last;
        wkStart.setHours(0, 10, 0);
        wkEnd.setHours(23, 55, 59);
        this.fixedSessions.forEach(el => {
          const date = new Date(el.date + "T" + el.time);
          const day = date.getUTCDate();

          if (date >= wkStart && date <= wkEnd) {
            const diffTime = el.time.split(":")[0] - 7;
            let diffDay;
            const module = this.modules.find(function(element) {
              return element.groupId === el.group_id;
            });

            diffDay = new Date(date - wkStart).getUTCDate();

            diffDay--;
            this.sessions.data[diffDay][diffTime].groupId = el.group_id;
            this.sessions.data[diffDay][diffTime].date = el.date;
            this.sessions.data[diffDay][diffTime].time = el.time;
            this.sessions.data[diffDay][diffTime].type = el.type;
            this.sessions.data[diffDay][diffTime].module = module.module;
            this.sessions.data[diffDay][diffTime].backgroundColor = "#2AD231";
          }
        });
      }
    },

    showSimpleSessions() {
      if (this.simpleSessions.length !== 0) {
        const wkStart = this.wkStart;
        const wkEnd = this.wkEnd;
        wkStart.setHours(0, 0, 0);
        wkEnd.setHours(23, 59, 59);

        this.simpleSessions.forEach(el => {
          const date = new Date(el.date + "T" + el.time);
          const day = date.getUTCDate();

          if (date >= wkStart && date <= wkEnd) {
            const diffTime = el.time.split(":")[0] - 7;
            let diffDay;

            diffDay = new Date(date - wkStart).getUTCDate();
            diffDay--;

            this.sessions.data[diffDay][diffTime].subject = el.subject;
            this.sessions.data[diffDay][diffTime].type = el.type;
            this.sessions.data[diffDay][diffTime].backgroundColor = "#137BF4";

            this.sessions.data[diffDay][diffTime].date = el.date;
            this.sessions.data[diffDay][diffTime].time = el.time;
          }
        });
      }
    }
  },
  computed: {
    filterSessions: function() {
      const data = [];
      if (this.componentLoaded && this.fixedSessions) {
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
              dayData.push({ backgroundColor: "rgb(218, 223, 225)" });
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
    },

    modules: {
      get() {
        return this.$store.getters.modules;
      }
    }
  },

  //life cycle hooks
  created() {
    this.$store.dispatch("initFixed");
    this.$store.dispatch("initSimple");

    this.$store.watch(
      (state, getters) => getters.fixedSessions,
      (newValue, oldValue) => {
        this.fixedSessions = newValue;

        this.showFixedSessions();
      },
      { deep: true, immediate: true }
    );

    this.$store.watch(
      (state, getters) => getters.simpleSessions,
      (newValue, oldValue) => {
        this.simpleSessions = newValue;

        this.showSimpleSessions();
      },
      { deep: true, immediate: true }
    );

    this.getCurrentWeek();
  },
  mounted() {
    this.componentLoaded = true;
  }
};
</script>

<style  scoped>
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

/* .block {
  background-color: rgb(218, 223, 225);
} */

/* Model  */

#model {
  position: absolute;
  color: #7e8389;
  background-color: #fff;
  /*background-color: gray;
  text-align: center;
  background-color: rgba(243, 242, 235, 0.74); */
}

.model__close {
  text-align: right;
  /*position: absolute;
  bottom: 100%;
  color: black;
  background-color: rgba(243, 242, 235, 1);
  border-top-left-radius: 100px;
  border-top-right-radius: 100px;
  padding: 5px; */
  /* z-index: -1; */
  /* display: inline-block;
    width    : 100%;
    text-align: right; */
}

.btn {
  padding: 1rem;
}
</style>