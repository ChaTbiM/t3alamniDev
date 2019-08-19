<template>
    <div class="container">
        <div class="close">X</div>
        <form class="form" action="" method="post">
            <fieldset class="form__content" > 
                <legend class="legend">Add Session</legend>
                
                
                <label for="title">date
                </label>
                <input type="text" name="date" id="date" class="date"><br>
                <label for="temps">temps
                </label>
                <input type="time" name="temps" id="temps" class="temps"><br>

                <!-- <select name="temps" id="temps"></select> -->
                <br>
                <label for="duree">duree
                </label>
                <select name="duree" id="duree">
                    <option value="1">1 hour</option>
                    <option value="2">2 hour</option>
                </select><br>

                <label for="document">document attache
                </label>
                <input type="file" name="document" id="document" class="document"><br>

                

                <button type="submit">Add</button>
                <button type="reset">Reset</button>
            </fieldset>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted. for teachers')
        }
    }
</script>

<style scoped>

    .container {
        position:absolute;
        top:10%;
        left: 50%;
        right: 50%;
        transform: translateX(-50%);
        width: 50%;

        /* margin: 0 auto; */
        background-color:  rgba(243, 242, 235, 1);
        display: flex;
    }

    .form{
        flex-basis: 100%;
        
    }


    label {
        display:inline-block;
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
        padding:  .7rem;
    }

    .close {
        background-color:  rgba(243, 242, 235, 1);
        color: black;
        position: absolute;
        right: 0;
        top:-6%;
        z-index: -1;
        padding: 5px;
        font-size: 1.2rem;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;

    }

</style>