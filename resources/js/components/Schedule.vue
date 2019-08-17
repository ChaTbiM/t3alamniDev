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
                first:'',
                last:'',
                month:'',
                weekNumber:'',
                currentWeek:'',
                weekDays:["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                months:['janvier' , 'fevrier' , 'mars' , 'avril' , 'mai' , 'juin' , 'juillet' , 'auot' , 'septembre' , 'octobre' ,'novembre' , 'decembre'],
            }   
        },
        methods:{
            getCurrentWeek(){
                let curr = new Date; // get current date
                
                this.currentDay = new Date(curr.getFullYear(),curr.getMonth(),curr.getDate());
            
                let first = curr.getDate() - (curr.getDay() === 6 ? 0 : curr.getDay() ); // First day is the day of the month - the day of the week
                let last = first + 6; // last day is the first day + 6
                this.first = first;
                this.last = last; 

               
            

                let firstDay = new Date(curr.setDate(first)).getDay();
                let lastDay = new Date(curr.setDate(last)).getDay();

                let firstDayYear = new Date(curr.setDate(first)).getFullYear();
                let lastDayYear = new Date(curr.setDate(last)).getFullYear();

                let firstDayMonth = new Date(curr.setDate(first)).getMonth();
                this.month = firstDayMonth;
                let lastDayMonth = new Date(curr.setDate(last)).getMonth();


                

                this.currentWeek = first.toString();
                this.currentWeek += ' ' + this.weekDays[firstDay];
                this.currentWeek += ' ' + this.months[ firstDayMonth ];
                this.currentWeek += ' ' + firstDayYear + ' - ';

                this.currentWeek += last.toString();
                this.currentWeek += ' ' + this.weekDays[lastDay];
                this.currentWeek += ' ' + this.months[ lastDayMonth ];
                this.currentWeek += ' ' + lastDayYear;

                // console.log('first',first);
                // console.log('firstDay',firstDay);
                // console.log(this.currentWeek)

            },
            getNextWeek (){
               
                // console.log(this.currentDay);
                let curr = this.currentDay;
                // console.log(curr);
                curr = new Date(curr.setDate(this.last + 1 ));
                this.currentDay = curr;
                // this.curr = curr;
                
                // console.log(curr);
                

                let first = curr.getDate();
                this.first = first ; 

                let firstDay = new Date(curr.setDate(first)).getDay();
                let firstDayMonth = curr.getMonth().toString();
                let firstDayYear = new Date(curr.setDate(first)).getFullYear();
            




                let last = new Date(curr.setDate(first +6 )).getDate();
                this.last = last;
                
                let lastDay = new Date(curr.setDate(last)).getDay();
                let lastDayMonth = new Date(curr.setDate(last)).getMonth();
                let lastDayYear = new Date(curr.setDate(last)).getFullYear();
                
                
            
                
                // // this.curr = curr ;

                this.currentWeek = first.toString();
                this.currentWeek += ' ' + this.weekDays[firstDay];
                this.currentWeek += ' ' + this.months[ firstDayMonth ];
                this.currentWeek += ' ' + firstDayYear + ' - ';

                this.currentWeek += last.toString();
                this.currentWeek += ' ' + this.weekDays[lastDay];
                this.currentWeek += ' ' + this.months[ lastDayMonth ];
                this.currentWeek += ' ' + lastDayYear;
                
            }


        },
        mounted() {
            this.getCurrentWeek();
            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();

            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();

            this.getNextWeek();
            this.getNextWeek();

            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();

            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();

            this.getNextWeek();
            this.getNextWeek();
            this.getNextWeek();

            


            //  setTimeout(this.getNextWeek,2000);
            //  setTimeout(this.getNextWeek,2000);

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
