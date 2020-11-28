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

</head>
<body> 
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top mb-5">
    <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">MemsApp</a>

         <div id="navbar" class="navbar w-100">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                  
                <ul class="navbar-nav ml-auto">   
                    @auth               
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();                                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                        </li>          
                    @endguest
                </ul>            
            </div>           
           
         </div>
        </div>
    </nav>
    <div class="container">
        @if ($errors->any())
        <br>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar ">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('addmem') }}">Add Mem</a>
                        </li>  
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>

                        @if( Auth::user()->hasRole(['admin']))
                        <li>
                            <a class="nav-link" href="{{ route('memstopublish') }}">Mems to publish</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('category.index') }}">Add Category</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('usermemslist') }}">My mems</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        <div class="col-md-9"> 
            @yield('content')
        </div>
    </div>
    
   
</div>
     

 
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="{{ asset('js/app.js') }}"></script> <!-- Lecture 5 -->
</body>
</html>