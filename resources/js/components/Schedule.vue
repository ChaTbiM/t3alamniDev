<template>
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
        <div class="schedule__header">
            <div>left</div>
            <div>right  </div>
            <div class="schedule__header__date">{{ currentWeek }}</div>
        </div>
        <hr class="line">

        
        
        <div class="calender">
            <div class="column">
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

            </div>
            <div class="column">
                <div class="cell">Sunday</div>                
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
            </div>
            <div class="column">
                <div class="cell">Monday</div>                
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
                <div class="cell block">block</div>
            </div>
            <div class="column">
                <div class="cell">Tuesday</div>                
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
                <div class="cell block">block</div>
            </div>
            <div class="column">
                <div class="cell">Wednesday</div>                
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
                <div class="cell block">block</div>
            </div>
            <div class="column">
                <div class="cell">Thursday</div>                
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
                <div class="cell block">block</div>
            </div>
            <div class="column">
                <div class="cell">Friday</div>                
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
                <div class="cell block">block</div>
            </div>
            <div class="column">
                <div class="cell">Saturday</div>                
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
                <div class="cell block">block</div>
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

            }


        },
        mounted() {
           
            this.getCurrentWeek();
            this.getPreviousWeek();

            this.getPreviousWeek();
            this.getPreviousWeek();



           


            console.log('Component mounted. for teachers')
        }
    }
</script>

<style >
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
}

.hour , 
.cell {
    margin: 1rem;
}

.cell ,
.hour {
    display: block;
    width: 50px;
    height:50px;
}

.block {
    background-color: grey;
}

</style>
