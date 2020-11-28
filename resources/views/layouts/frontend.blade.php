<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mems App</title>
      <!-- Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600;700&display=swap" rel="stylesheet">

      <script>
        var base_url = '{{ url('/admin') }}'; 
        

        <!-- Lecture 34 -->
        <?php
        if (isset($_COOKIE['scroll_val'])) {

            echo 'var scroll_val=' . '"' . (int) $_COOKIE['scroll_val'] . '";';

            setcookie('scroll_val', '', -3000);
        }
        ?>

        </script>
</head>
<body>

        <nav class="navbar navbar-expand-lg  navbar-dark sticky-top mb-5">
            <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">MemsApp</a>
            <div id="navbar" class="navbar w-100">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @auth
                            <a class="nav-link primary-color" href="{{ route('addmem') }}">+ Add Mem</a>
                            @else
                            <a class="nav-link primary-color" href="{{ route('login') }}">+ Add Mem</a>
                            @endauth
                        </li>
                        <li class="nav-item dropdown">                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach ($categories as $category)
                                <a  class="dropdown-item" href="{{ route('memsByCategory', ['id'=>$category->id]) }}" class="dropdown-item">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @auth                       
                        <li class="nav-item"><a class="nav-link" href="{{ route('addmem') }}">Admin panel</a></li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                            </form>
                        </li>
                        @endauth
                        @guest
                
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign up</a></li>
                    </ul>
                </div>
                @endguest
            </div>
        </div>
    </nav>
<div class="container">        

    <div class="row">
        <div class="col-md-8">
            @yield('content')
        </div>
        <div class="col-md-4">
            <h2>Most Popular</h2>
            @foreach($popularmems as $mem) 
 <div class="mem">  
 
        <h2 class="mem__title"> 
            <a  class="mem__title-link" href="{{ route('mem', ['id'=>$mem->id]) }}" alt="">{{ $mem->title }}</a>
        </h2>
        
        <p class="mem__category">
            <a href="{{ route('memsByCategory', ['id'=>$mem->category->id]) }}" class="mem__category-link">{{ $mem->category->name }}</a>
            
        </p>
  
        <div>
            <a href="{{ route('mem', ['id'=>$mem->id]) }}" alt="">
            <img src="{{ $mem->photos->first()->path ?? null }}" alt="" class="img-full">
            </a>
            <div class="mem__likes-count">
            Likes: {{ $mem->likes->count  () }}
        </div>
        </div>


     
    


            </div>
            @endforeach
        </div>
    </div>
</div>

<footer class="page-footer">
    <div class="container"><p class="text-center">Copyright {{ now()->year }} Marcin Kośka</p></div>
</footer>
     
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="{{ asset('js/app.js') }}"></script> 

     <script>

        $(function () {


        if (typeof scroll_val !== 'undefined') {

            $(window).scrollTop(scroll_val);
        }

        });


        function scroll_value()
        {
            document.cookie = 'scroll_val' + '=' + $(window).scrollTop();
        }


        $(document).on('click', '.keep_position', function (e) {
       
            scroll_value();
        });

        </script>
</body>
</html>