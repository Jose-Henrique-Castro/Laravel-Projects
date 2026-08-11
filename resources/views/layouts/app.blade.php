<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Aplication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

        <header>
            <nav> // navigation -> menu used to navegate the website

            <ul>
                    @auth // if the user is authenticated, show the following menu items
                        <li><a href="{{ route('post.index') }}" role="button" class="outline">Timeline</a></li>
                    <li> 
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @crsf
                        <button type="submit">logout</button>
                    </form>
                    </li>
                    @else // if the user is not authenticated, show the following menu items

                    <li><a href="{{ route('login') }}" role="button" class="outline">Login</a></li>
                    <li><a href="{{ route('register') }}" role="button" class="outline">Register</a></li>

                    @endauth
            </ul>

            </nav>
            </header>

            <main class="container">
                @yield('content') // this is where the content of the page will be displayed
            </main>


            </body>
</html>