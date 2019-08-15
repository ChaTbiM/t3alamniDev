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
 
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 
     <!-- Styles -->
     <link href="{{ asset('css/teacher.css') }}" rel="stylesheet">

    <title>Dashboard</title>
</head>
<body>

    <nav class="nav">
        <div class="nav__left">
            <ul class="nav__list">
                <li class="nav__list__item"><a href="#" class="nav__list__item__link">img</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link">all demand session</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link">packs session</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link">abonnement</a></li>
                <li class="nav__list__item"><a href="#" class="nav__list__item__link">plus <span class="arrow">
                    &#8594;</span></a></li>
                    
                </ul>
        </div>
        <div class="nav__right">
            <li class="messages"><a href="" class="messages__link">Me</a></li>
            <li class="notifications"><a href="" class="notifications__link">Me</a></li>
            <li class="avatar"><a href="" class="avatar__link">Me </li>
            <li class="user"><a href="" class="user__link">User  <span class="arrow2">
                    &#8594;</span> </a> </li>
                
               

        </div>

        
    </nav>

    <div class="nav__bottom">
            <ul class="nav__list">
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">schedule</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">groupes</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">sessions</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">all my students</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">demandes interqissees</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">mes offres</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">add group</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">add offre</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">statistique</a> </li>
                <li class="nav__list__item"> <a href="#" class="nav__list__item__link">notifications</a> </li>
            </ul>
        </div>

    <div id="teacher">
        @yield('content')
    </div>

    <footer class="footer">
        <a class="footer__link" href="#">twitter</a>
        <a class="footer__link" href="#">instagram</a>
        <a class="footer__link" href="#">facebook</a>
    </footer>

</body>
</html>