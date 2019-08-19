<template>

    <div class="container">
        
        <div class="left">
            <div class="left__calender"></div>
            <div class="left__add__fix"> add fix session </div>
            <div class="left__add__simple"> add simple session </div>
            <label for="fix"> all fix sessions
                <input type="checkbox" name="fix" id="fix">    
            </label>

           <label for="simple"> all simple sessions
                <input type="checkbox" name="simple" id="simple">    
            </label>

        </div>

    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        schedule 
                    </div>
                </div>
            </div>
        </div>
    </div> -->

   
    <div class="schedule" >
         <div> {{addSessionsOpen}} </div>
        <div class="schedule__header">
            <div>left</div>
            <div>right  </div>
            <div class="schedule__header__date">{{ currentWeek }}</div>
        </div>
        <hr class="line">
        

        
        
        <div class="calender">
            <!-- <div class="column">
                <div class="hour"></div>
                <div class="hour">07:00</div>
                <div class="hour">08:00</div>
                <div class="hour">09:00</div>
                <div class="hour">10:00</div>
                <div class="hour">11:00</div>
                <div class="hour">12:00</div>
                <div class="hour">13:00</div>
                <div class="hour">14:00</div>
                <div class="hour">15:00</div>
                <div class="hour">16:00</div>
                <div class="hour">17:00</div>
                <div class="hour">18:00</div>
                <div class="hour">19:00</div>
                <div class="hour">20:00</div>
                <div class="hour">21:00</div>

            </div> -->
            <div class="column">
                <div class="hour" v-for="(cell, index) in sessions.time" v-bind:key="index"  > {{cell}} </div>
            </div>

            <div class="column">
                <div class="cell day">Samedi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.samedi" v-bind:key="index"  > {{cell}} block</div>
            </div>
            <div class="column">
                <div class="cell day">Dimanche</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.dimanche" v-bind:key="index"  > {{cell}} block</div>
            </div>
             <div class="column">
                <div class="cell day">Lundi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.lundi" v-bind:key="index"  > {{cell}} block</div>
            </div>
             <div class="column">
                <div class="cell day">Mardi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.mardi" v-bind:key="index"  > {{cell}} block</div>
            </div>
             <div class="column">
                <div class="cell day">Mercredi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.mercredi" v-bind:key="index"  > {{cell}} block</div>
            </div>
             <div class="column">
                <div class="cell day">Jeudi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.jeudi" v-bind:key="index"  > {{cell}} block</div>
            </div>
             <div class="column">
                <div class="cell day">Vendredi</div> 
                <div class="cell block" @click="showAddSessions" v-for="(cell, index) in sessions.vendredi" v-bind:key="index"  > {{cell}} block</div>
            </div>

            <div id="model" v-show="addSessionsOpen"   > 
                <div class="model__close"  >X</div>
                <div class="model__add__fix btn">add fix session</div>
                <div class="model__add__simple btn">add simple session</div>

            </div>      

            <add-simple-session v-show="AddSimpleSessionOpen" ></add-simple-session>
            <add-group v-show="addGroupOpen"></add-group>
            <add-fixed-session v-show="AddFixedSessionOpen"></add-fixed-session>

            <!-- <div class="column">
                <div class="cell day">Sunday</div>                
                <div class="cell block" >{{mess}}</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
                <div class="cell block">block</div>
            </div> -->
            
        </div>
        
    </div>
    </div>

</template>

<script>
import { setTimeout } from 'timers';
    
    export default {
        name:'schedule',
        data(){
            return{
                sessions:
                {
                    time : ['07:00','08:00','09:00', '10:00' , '11:00' ,'12:00', '13:00' ,'14:00' , '15:00' , '16:00' , '17:00' , '18:00' , '19:00' , '20:00' , '21:00' , '22:00' ],
                    samedi :  [  ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                    dimanche:[  ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                    lundi : [ ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                    mardi : [ ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ], 
                    mercredi : [ ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                    jeudi :[ ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                    vendredi : [ ' ' , ' ' , ' ' , ' ' , ' ' , ' ' ,' ' ,' ' , ' ' ,' ' , ' ' , ' ' ,' ' , ' ' ,' ' , ],
                },
                addSessionsOpen:false,
                AddSimpleSessionOpen:false,
                AddFixedSessionOpen:true,
                addGroupOpen:false,
                addGroup: '',
                mess:"Hi there",
                currentDay:'',
                wkStart:'',
                wkEnd:'',
                month:'',
                weekNumber:'',
                currentWeek:'',
                weekDays:["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                months:['janvier' , 'fevrier' , 'mars' , 'avril' , 'mai' , 'juin' , 'juillet' , 'auot' , 'septembre' , 'octobre' ,'novembre' , 'decembre'],
            }   
        },
        methods:{
            getCurrentWeek(){
                let newWeek;
                let curr = new Date(); // get current date
                this.currentDay = curr;

                

                let diff = function (){
                    if(curr.getDay() === 0) {
                        return -1;
                    }else if (curr.getDay() === 6){
                        return 0
                    }else {
                        return -(curr.getDay() + 1); 
                    }
                }

                let wkStart = new Date(curr.setDate(curr.getDate() + diff()));
                this.wkStart = wkStart;


                let wkEnd = new Date(curr.setDate(wkStart.getDate()+6));
                this.wkEnd = wkEnd;
        

                this.currentWeek = wkStart.getDate();
                this.currentWeek += ' ' + this.weekDays[wkStart.getDay()];
                this.currentWeek += ' ' + this.months[wkStart.getMonth()];
                this.currentWeek += ' ' + wkStart.getFullYear();


                this.currentWeek += ' - ' + wkEnd.getDate();
                this.currentWeek += ' ' + this.weekDays[wkEnd.getDay()];
                this.currentWeek += ' ' + this.months[wkEnd.getMonth()];
                this.currentWeek += ' ' + wkEnd.getFullYear();

            },
            getNextWeek (){
               
               let curr = new Date(this.wkEnd);
               
               let wkStart = new Date(curr.setDate(curr.getDate() + 1) );
               this.wkStart = wkStart; 
               console.log(' next Week start week',wkStart);
                

               let wkEnd = new Date(curr.setDate(wkStart.getDate()+6));
               this.wkEnd = wkEnd; 
                
            
                this.currentWeek = wkStart.getDate();
                this.currentWeek += ' ' + this.weekDays[wkStart.getDay()];
                this.currentWeek += ' ' + this.months[wkStart.getMonth()];
                this.currentWeek += ' ' + wkStart.getFullYear();


                this.currentWeek += ' - ' + wkEnd.getDate();
                this.currentWeek += ' ' + this.weekDays[wkEnd.getDay()];
                this.currentWeek += ' ' + this.months[wkEnd.getMonth()];
                this.currentWeek += ' ' + wkEnd.getFullYear();
                
            },
            getPreviousWeek(){
                let curr = new Date(this.wkStart);
                console.log(curr);

                let wkEnd = new Date(curr.setDate(curr.getDate() - 1) );
               this.wkEnd = wkEnd; 


               let wkStart = new Date(curr.setDate(wkEnd.getDate()-6));
               this.wkStart = wkStart;

               this.currentWeek = wkStart.getDate();
                this.currentWeek += ' ' + this.weekDays[wkStart.getDay()];
                this.currentWeek += ' ' + this.months[wkStart.getMonth()];
                this.currentWeek += ' ' + wkStart.getFullYear();


                this.currentWeek += ' - ' + wkEnd.getDate();
                this.currentWeek += ' ' + this.weekDays[wkEnd.getDay()];
                this.currentWeek += ' ' + this.months[wkEnd.getMonth()];
                this.currentWeek += ' ' + wkEnd.getFullYear();

            },

            showAddSessions: function(e){
                e.preventDefault();
                let top = e.target.offsetTop;
                let left = e.target.offsetLeft + 85 ;
                let model = document.getElementById('model');
                
                model.style.top = `${top}px`;
                model.style.left = `${left}px`;
                
                return  this.addSessionsOpen = !this.addSessionsOpen;
            }


        },
        mounted() {
            this.getCurrentWeek();
            // this.getPreviousWeek();

            // this.getPreviousWeek();
            // this.getPreviousWeek();
            console.log('Component mounted. for teachers')
        }
    }
</script>

<style scoped>

.container {
    display: flex;
    
}

.left {
    
}

.schedule{
    /* flex-basis:72%;
    height: 400px;
    overflow-y: scroll;
    margin: 0 auto;
    min-width: 950px; */
}
.schedule__header{
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.line {
    font-size: 5px;
}

.calender {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    font-weight: bold;

    flex-basis:72%;
    height: 400px;
    overflow-y: scroll;
    /* margin: 0 auto; */
    min-width: 950px;
    
}

.hour , 
.cell {
    margin: 1rem;
}

.cell ,
.hour {
    display: block;
    width: 85px;
    height:50px;
}

.block {
    background-color: #C4C4C4;
    
}

/* Model  */

#model {
    position: absolute;
    background-color:gray;
    text-align: center;
    background-color:  rgba(243, 242, 235, 0.74);

}


.model__close {
    text-align: right;
    position: absolute;
    bottom: 100%;
    color: black;
    background-color:  rgba(243, 242, 235, 1);
    border-top-left-radius: 100px;
    border-top-right-radius: 100px;
    padding: 5px;
    z-index: -1;
    /* display: inline-block;
    width: 100%;
    text-align: right; */
}

.btn {
    padding: 1rem;
}

</style>
