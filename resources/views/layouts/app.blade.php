<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

        <header class="container">
            <nav> {{-- navigation -> menu used to navegate the website --}} 

            <ul>
                    @auth {{-- if the user is authenticated, show the following menu items --}} 
                    <li> 
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                    </li>
                    @else {{-- if the user is not authenticated, show the following menu items --}} 

                    @if(!Route::is('login')) {{-- if the current route is not login, show the login link --}}
                    <li><a href="{{ route('login') }}" role="button" class="outline">Login</a></li>
                    @endif

                    @if(!Route::is('register')) {{-- if the current route is not register, show the register link --}}
                    <li><a href="{{ route('register') }}" role="button" class="outline">Register</a></li>
                    @endif

                    @endauth
            </ul>

            </nav>
            </header>

            <main class="container">
                @yield('content') {{-- this is where the content of the page will be displayed --}} 
            </main>


            </body>
</html>