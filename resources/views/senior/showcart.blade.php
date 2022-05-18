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
          <a class="navbar-brand" href="{{ url('seniorhome') }}"><h2>Senjorui.lt</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                <a class="nav-link" href="{{ url('seniorhome') }}">Pradžia
                  
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{url('choosecategory')}}">Prekės</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('aboutsenior')}}">Apie mus</a>
              </li>
              
                    <li class="nav-item active">
                <a class="nav-link" href="{{url('showcart')}}"> 
                <i class="fas fa-shopping-cart"></i>  
                Krepšelis[{{$count}}]
                <span class="sr-only">(current)</span></a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('seniorlogout')}}">Atsijungti</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      
    </header>
    @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert">X</button>
                     {{session()->get('message')}}

                </div>
                
                @endif
    <div class="divcarttable">
        <table class="divcarttable2">
            <tr class="divcartrow">
                <td class="divcarttd">Pavadinimas</td>
                <td class="divcarttd">Kaina €, 1vnt.</td>
                <td class="divcarttd">Kiekis</td>
                <td class="divcarttd">Keisti kiekį</td>
                <td class="divcarttd">Pašalinti</td>
            </tr>
            @foreach ($result as $item)
            <tr>
            
                <td class="divcartproduct">{{ $item['product']->title }}</td>
                <td class="divcartproduct">{{ $item['product']->price }}</td>
                
                <td class="divcartproduct">{{ $item['count'] }}</td>
                <td class="divcartproduct">
                <form action="{{url('changequantity',$item['cartproduct_id'])}}" method="POST">
                @csrf
                <input class="quantitychange" name="quantity" required type="number" value="{{$item['count']}}" min="1" max="10"  >
                <button class="btn-warning">Keisti</button>
                </form>
                </td>
                <td class="divcartproduct">
                  <a href="{{url('deletecartproduct',$item['cartproduct_id'])}}"  class=" btn-danger">Pašalinti </a>  
                </td>
           
            @endforeach
            
            </tr>
            
        </table>
        <table>
        <tr>
            <td class="cartprice">Bendra krepšelio suma </td>
            <td class="cartprice">{{$price}} €</td>  
            </tr>
        </table>
        @if($count>0)
        <form method="post" action="{{url('confirmcart')}}">
          @csrf
          <button style="font-size:40px;" type="submit" class="btn btn-success btn-lg" value="Pateikti užsakymą">Pateikti užsakymą</button>
        </form>
        @endif
        
    </div>



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
