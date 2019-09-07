<template>
  <div class="container">
    <div class="close" @click="showAddFixedSessions">X</div>
    <form
      @submit.prevent="submitFixedSessions"
      class="form"
      enctype="multipart/form-data"
      :value="csrf"
    >
      <fieldset class="form__content">
        <legend class="legend">Add Session</legend>
        <label for="title">date</label>
        <vc-calendar
          ref="calendar"
          :key="index"
          @dayclick="changeDate"
          :attributes="attrs"
          :locale="{ id: 'fr', firstDayOfWeek: 7, masks: { weekdays: 'WW' } }"
        ></vc-calendar>
        <!-- <input v-model="date" type="text" name="date" id="date" class="date" /> -->
        <br />
        <label for="temps">temps</label>
        <vue-timepicker
          :minute-interval="0"
          v-model="time"
          :hour-range="[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]"
          hide-disabled-hours
        ></vue-timepicker>

        <!-- <input v-model="time" type="time" name="temps" id="temps" class="temps" /> -->
        <br />

        <!-- <select name="temps" id="temps"></select> -->
        <br />
        <label for="duree">duree</label>
        <!-- <input
          type="text"
          disabled
          :value="this.$store.getters.duration === 1 ? `${this.$store.getters.duration} heure`: ` ${this.$store.getters.duration} heures ` "
        />-->
        <select v-model="duration" name="duree" id="duree">
          <option
            v-for="(value,index) in 15"
            :value="value"
            v-bind:key="index"
          >{{value}} {{value === 1 ? 'heure' : 'heures'}}</option>
          <!-- <option value="1">1</option> -->
        </select>
        <br />

        <label for="document">document attache</label>
        <input type="file" name="document" id="document" class="document" />
        <br />
      </fieldset>
      <button type="submit">Add</button>
      <button type="reset">Reset</button>
    </form>
  </div>
</template>

<script>
export default {
  updated() {},
  mounted() {
    this.$store.watch(
      (state, getters) => getters.date,
      (newValue, oldValue) => {
        // Do whatever makes sense now
        if (this.attrs.length >= 1) {
          this.attrs.pop();
        }
        this.attrs.push({
          key: "date",
          highlight: "red",
          dates: new Date(newValue)
        });
        this.index++;

        setTimeout(() => {
          const calendar = this.$refs.calendar;
          const target = this.attrs[0].dates;

          calendar.showPageRange(target);
        }, 0);
      },
      { deep: true, immediate: false }
    );
  },
  data() {
    // let id = this.$store.getters.fixedSessionID + 1;
    return {
      clicked: {
        event: this.consoled
      },
      index: "",
      attrs: [],
      document: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },

  methods: {
    showAddFixedSessions() {
      this.$parent.showAddFixedSessions();
    },
    submitFixedSessions() {
      let time = this.$store.getters.time.HH;
      time += ":00:00";
      let id = this.$store.getters.fixedSessionID + 1;
      let groupId = Number(
        this.$store.getters.choosedGroup[
          this.$store.getters.choosedGroup.length - 1
        ]
      );

      let fixedTest = this.$store.getters.fixedSessions;
      let date = this.$store.getters.date;

      let day =
        date.getUTCDate() <= 9 ? "0" + date.getUTCDate() : date.getUTCDate();
      let month =
        date.getUTCMonth() < 9
          ? "0" + (date.getUTCMonth() + 1)
          : date.getUTCMonth() + 1;
      let year = date.getFullYear();

      date = year + "-" + month + "-" + day;

      let data = {
        created_at: null,
        date: String(date), // test DAte
        duration: this.$store.getters.duration,
        group_id: groupId,
        id: id,
        mark: null,
        state: "en attente",
        teacher_id: this.$store.getters.teacherId,
        time: time,
        type: "fixed",
        updated_at: null
      };

      console.log(data);

      fixedTest.push(data);
      this.$store.commit("initFixed", JSON.stringify(fixedTest));
      this.$store.commit("setFixedSessionID", id);

      axios
        .post(route("addFixedSessions"), data)
        .then(response => {
          console.log(response.data, "res");
        })
        .catch(err => {
          console.log(err);
        });
    },
    changeDate(payload) {
      this.attrs.pop();
      // let attrs = [];
      let date = {
        key: "today",
        dates: new Date(payload.date),
        highlight: "red"
      };

      // attrs.push(date);
      this.attrs.push(date);

      // this.$store.commit("setAttrs", attrs); // store the wanted date
      this.index++;
      this.$store.commit("setDate", date.dates);
      setTimeout(() => {
        const calendar = this.$refs.calendar;
        const target = this.attrs[0].dates;

        calendar.showPageRange(target);
      }, 0);
    }
  },

  computed: {
    // ...mapState({
    //   duration: state => state.duration
    //   // weatherData: state=>state.yearData
    // })
    duration: {
      get() {
        return this.$store.getters.duration;
      },
      set(val) {
        this.$store.commit("setDuration", val);
      }
    },
    time: {
      get() {
        return this.$store.getters.time;
      },
      set(val) {
        this.$store.commit("setTime", val);
      }
    }
  }
};
</script>

<style scoped>
.container {
  position: absolute;
  top: 25%;
  left: 50%;

  transform: translate(-50%, -25%);

  /* margin: 0 auto; */
  background-color: rgba(243, 242, 235, 1);
  display: flex;
  flex-direction: column;
}

.form {
  flex-basis: 100%;
}

label {
  display: inline-block;
  width: 20%;
  margin-right: 2rem;
  vertical-align: baseline;
  margin-top: 2rem;
  margin-left: 3rem;
}

.description {
  vertical-align: top;
}

input,
textarea {
  width: 50%;
  margin-top: 2rem;
  padding: 0.7rem;
}

.close {
  background-color: rgba(243, 242, 235, 1);
  color: black;
  /* position: absolute;
        right: 0;
        top:-6%;
        z-index: -1; */
  padding: 5px;
  font-size: 1.2rem;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
}
</style>