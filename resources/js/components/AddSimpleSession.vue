<template>
  <div class="container">
    <div class="close">X</div>
    <form class="form" action method="post">
      <fieldset class="form__content">
        <legend class="legend">Add Session</legend>
        <label for="title">titre</label>
        <input type="text" name="titre" id="titre" class="titre" />
        <br />
        <label for="module">module</label>
        <input type="text" name="module" id="module" class="module" />
        <br />
        <label for="title">niveau</label>
        <input type="text" name="niveau" id="niveau" class="niveau" />
        <br />
        <label for="title">specialite</label>
        <input type="text" name="specialite" id="specialite" class="specialite" />
        <br />
        <label for="title">annee</label>
        <input type="text" name="annee" id="annee" class="annee" />
        <br />
        <label for="title" class="description">description</label>
        <!-- <input type="text" name="title" id="title" class="title"> -->
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br />
        <br />
        <label for="document">document attache</label>
        <input type="file" name="document" id="document" class="document" />
        <br />
        <label for="title">date</label>
        <input type="text" name="date" id="date" class="date" />
        <br />
        <label for="temps">temps</label>
        <input type="time" name="temps" id="temps" class="temps" />
        <br />

        <!-- <select name="temps" id="temps"></select> -->
        <br />
        <label for="nombre">nombre de place</label>
        <input type="text" name="nombre" id="nombre" class="nombre" />
        <br />

        <label for="prix">prix</label>
        <input type="text" name="prix" id="prix" class="prix" />
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
    console.log("Component mounted. for teachers");
  }
};
</script>

<style  scoped>
.container {
  position: absolute;
  top: 10%;
  left: 50%;
  right: 50%;
  transform: translateX(-50%);
  width: 50%;

  /* margin: 0 auto; */
  background-color: rgba(243, 242, 235, 1);
  display: flex;
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
  position: absolute;
  right: 0;
  top: -3%;
  z-index: -1;
  padding: 5px;
  font-size: 1.2rem;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
}
</style>