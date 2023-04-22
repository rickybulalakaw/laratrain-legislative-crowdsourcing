<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        
        <!-- <link rel="stylesheet" href="resources/fontawesome/css/all.css"> -->
        <!-- <link rel="script" href="{{asset('fortawesome/fontawesome-free/js/all.js')}}"> -->
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between">
        <ul class="flex items-center">
            <li>
                <a href="" class="p-3">Home</a>
            </li>
            <li>
                <a href="" class="p-3">Search</a>
            </li>
            
            @auth
            <li>
                <a href="" class="p-3">Dashboard</a>
            </li>
            @endauth
            <li>
                <a href="{{ route('add-bill') }}" class="p-3">Upload</a>
            </li>
        </ul>

        <ul class="flex items-center">



            <!-- User is logged in  -->
            @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <!-- <a href="" class="p-3">Logout</a> -->
                <form action="{{ route('logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            </li>
            @endauth 

            <!-- User is not logged in  -->
            @guest

            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            @endguest


         
        </ul>

        
    </nav>


    @yield('content')


    
</body>
</html>