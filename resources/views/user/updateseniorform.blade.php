<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Senjorui</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="navbar flex-row ml-md-auto d-none d-md-flex">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('home') }}"><h2>Senjorui.lt</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                <a class="nav-link" href="{{ url('home') }}">Pradžia
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{ url('allproductsuser') }}">Prekės</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('about') }}">Apie mus</a>
              </li>
              <li class="nav-item">
              @if (Route::has('login')) 
                    @auth
                    <li class="nav-item">
                <a class="nav-link" href="{{url('registersenior')}}">Užregistruoti senjorą</a>
              </li>
              </li>
                    <li class="nav-item active">
                <a class="nav-link" href="{{url('showsenior')}}">Senjorai </a>
                
              </li>

                    <x-app-layout>

                    </x-app-layout>
                    @else
                    <li> <a href="{{ route('login') }}" class="nav-link">Prisijungti</a></li>

                        @if (Route::has('register'))
                        <li>  <a href="{{ route('register') }}" class="nav-link" >Registruotis</a></li>
                        @endif
                    @endauth
            @endif
              </li>

            </ul>
          </div>
        </div>
      </nav>
      
    </header>

    <!-- Page Content -->
    
    <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <h1 style="font-size:25px;">Atnaujinti senjoro duomenis</h1>
        <x-jet-validation-errors class="mb-4" />

        <form action="{{url('updatesenior', $data->senior_id)}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mt-4">
                <label for="address" value="{{ __('Adresas') }}" >Pakeisti adresą</label>
                <input value="{{$data->address}}" required id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>
            <div class="mt-4">
                <label for="limit" value="{{ __('Limitas') }}" >Pakeisti limitą</label>
                <input value="{{$data->senior_limit}}" required id="limit" class="block mt-1 w-full" type="number" min="0" step="0.01" name="limit" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <input type="submit">
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
@if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert">X</button>
                     {{session()->get('message')}}

                </div>
                
                @endif


    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; 2020 Sixteen Clothing Co., Ltd.
            
            - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
