<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
   

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>
 
     <!-- Scripts -->
     <script src="{{ asset('js/teacher.js') }}" defer></script>

 

 
     <!-- Styles -->
     <link href="{{ asset('css/teacher.css') }}" rel="stylesheet">
    
    <title>Dashboard </title>
</head>
<body>
    <nav class="nav">
        <div class="nav__top">
            <ul class="nav__top__left">
                <li class="nav__list__item"><a href="#" class="nav__list__item__link top__link logo">Logo</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link top__link first__li">All demand session</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link top__link">Packs session</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link top__link">Abonnement</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link top__link plus__link">Plus <span class="arrow">
                    <img src={{asset("/arrow-down-solid.svg")}} alt="plus" class="plus__img"> </span></a></li>
            </ul>
            <div class="nav__top__right">
                    <li class="messages last"><a href="" class="messages__link">
                    <svg class="RequestsIcon-b8jpio-1 cLSHxs" data-name="Layer 1" viewBox="0 0 17.36 18.78"><path fill="#8a959e" d="M6 18.78a1.31 1.31 0 0 1-.53-.12 1.31 1.31 0 0 1-.75-1.18v-2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h13.32a2 2 0 0 1 2 2l.06 11.49a2 2 0 0 1-2 2h-4.86l-3.63 3a1.33 1.33 0 0 1-.89.29zM2 1.3a.68.68 0 0 0-.7.7l.06 11.47a.68.68 0 0 0 .68.68H6v3.32l-.27.6.27-.59 4-3.33h5.33a.68.68 0 0 0 .68-.68L16 2a.68.68 0 0 0-.68-.68H2z"></path></svg>    
                    </a></li>
                    <li class="notifications"><a href="" class="notifications__link"> 
                            <svg class="RequestsIcon-b8jpio-1 cLSHxs" data-name="Layer 1" viewBox="0 0 17.36 18.78"><path fill="#8a959e" d="M6 18.78a1.31 1.31 0 0 1-.53-.12 1.31 1.31 0 0 1-.75-1.18v-2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h13.32a2 2 0 0 1 2 2l.06 11.49a2 2 0 0 1-2 2h-4.86l-3.63 3a1.33 1.33 0 0 1-.89.29zM2 1.3a.68.68 0 0 0-.7.7l.06 11.47a.68.68 0 0 0 .68.68H6v3.32l-.27.6.27-.59 4-3.33h5.33a.68.68 0 0 0 .68-.68L16 2a.68.68 0 0 0-.68-.68H2z"></path></svg>     
                    </a></li>
                    <li class="avatar"><a href="" class="avatar__link">
                            <img src={{asset("man.svg")}} alt="avatar" class="avatar__img">   
                    
                    </li>
                    

                    <li class="user"><a href="" class="user__link plus__link">User<span class="arrow">
                            <img src={{asset("arrow-down-solid.svg")}} alt="plus" class="plus__img"> </span> </a> </li>
            </div>
        </div>

        <div class="nav__bottom">
            <ul class="nav__bottom__list">
                <li class="nav__list__item"> <a href="/teacher" class="nav__list__item__link bottom__link">Schedule</a> </li>
                <li class="nav__list__item"> <a href="teacher/groups" class="nav__list__item__link bottom__link">Groupes</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Sessions</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link ">All my students</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Demandes interqissees</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Mes offres</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Add group</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Add offre</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Statistique</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link bottom__link">Notifications</a> </li>
            </ul>
        </div>
    </nav>

   

        @yield('content')
        

    <footer class="footer">
        <a class="footer__link" href="#">twitter</a>
        <a class="footer__link" href="#">instagram</a>
        <a class="footer__link" href="#">facebook</a>
    </footer>

</body>
</html>