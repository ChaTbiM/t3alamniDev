<template>
  <div class="container">
    <div class="close" @click.prevent="showAddSimpleSessions">X</div>
    <form
      class="form"
      @submit.prevent="submitSimpleSessions"
      enctype="multipart/form-data"
      :value="csrf"
    >
      <fieldset class="form__content">
        <legend class="legend">Add Session</legend>
        <label for="title">titre</label>
        <input type="text" v-model="title" name="titre" id="titre" class="titre" />
        <br />
        <label for="module">module</label>
        <input type="text" v-model="module" name="module" id="module" class="module" />
        <br />
        <label for="title">niveau</label>
        <input type="text" v-model="grade" name="niveau" id="niveau" class="niveau" />
        <br />
        <label for="title">specialite</label>
        <input type="text" v-model="specialty" name="specialite" id="specialite" class="specialite" />
        <br />
        <label for="title">annee</label>
        <input type="text" v-model="year" name="annee" id="annee" class="annee" />
        <br />
        <label for="title" class="description">description</label>
        <!-- <input type="text" name="title" id="title" class="title"> -->
        <textarea name="description" v-model="description" id="description" cols="30" rows="10"></textarea>
        <br />
        <br />
        <label for="document">document attache</label>
        <input
          type="file"
          @change="addFile()"
          ref="file"
          name="document"
          id="document"
          class="document"
        />
        <br />
        <label for="title">date</label>
        <vc-calendar
          ref="calendar"
          :key="index"
          @dayclick="changeDate"
          :attributes="attrs"
          :locale="{ id: 'fr', firstDayOfWeek: 7, masks: { weekdays: 'WW' } }"
        ></vc-calendar>
        <!-- <input type="text" name="date" id="date" class="date" /> -->
        <br />

        <label for="temps">temps</label>
        <vue-timepicker
          :minute-interval="0"
          v-model="time"
          :hour-range="[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]"
          hide-disabled-hours
        ></vue-timepicker>
        <!-- <input type="time" name="temps" id="temps" class="temps" /> -->
        <br />

        <!-- <select name="temps" id="temps"></select> -->
        <br />
        <label for="nombre">nombre de place</label>
        <input type="text" v-model="numberOfPlaces" name="nombre" id="nombre" class="nombre" />
        <br />

        <label for="prix">prix</label>
        <input type="text" v-model="price" name="prix" id="prix" class="prix" />
        <br />

        <button type="submit">Add</button>
        <button type="reset">Reset</button>
      </fieldset>
    </form>
  </div>
</template>

<script>
export default {
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
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),

      title: "",
      module: "",
      grade: "",
      specialty: "",
      year: "",
      description: "",
      file: "",
      index: "",
      attrs: [],
      numberOfPlaces: "",
      price: ""
    };
  },
  methods: {
    showAddSimpleSessions(e) {
      this.$parent.showAddSimpleSessions(e);
    },

    addFile() {
      this.file = this.$refs.file.files[0];
    },
    submitSimpleSessions() {
      let time = this.$store.getters.time.HH;
      time += ":00:00";
      let id = this.$store.getters.simpleSessionID + 1;

      let simpleSessions = this.$store.getters.simpleSessions;
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
        title: this.title,
        subject: this.module,
        cycle: this.grade,
        year: this.year,
        specialty: this.specialty,
        description: this.description,
        id: id,
        nb_places: this.numberOfPlaces,
        price: this.price,
        mark: null,
        date: String(date), // test DAte
        time: time,
        duration: this.$store.getters.duration,
        state: "en attente",
        teacher_id: this.$store.getters.teacherId,
        type: "simple"
        // created_at: null,
      };

      simpleSessions.push(data);
      this.$store.commit("initSimple", JSON.stringify(simpleSessions));
      this.$store.commit("setSimpleSessionID", id);

      let formData = new FormData();

      Object.keys(data).map(e => {
        formData.append(e, data[e]);
      });

      if (this.file) {
        formData.append("file", this.file, this.file.name);
        formData.append("fileName", this.file.name);
      }
      console.log(data);
      axios
        .post(route("addSimpleSessions"), formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
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

<style scoped >
/* body {
  position: relative;
} */

.container {
  position: absolute;
  /* top: 10%; */
  top: 10%;
  left: 50%;
  right: 50%;
  transform: translateX(-50%);
  width: 50%;
  /* margin: 0 auto; */
  background-color: rgba(243, 242, 235, 1);
  display: flex;
  flex-direction: column;
}

.form {
  flex-basis: 100%;
}
/* 
    .form__content{
        flex-basis: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }  */

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
  top: -3%;
  z-index: -1; */
  padding: 5px;
  font-size: 1.2rem;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
}
</style>