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
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{url('choosecategory')}}">Prekės</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{url('aboutsenior')}}">Apie mus</a>
              </li>
              
                    <li class="nav-item">
                <a class="nav-link" href="{{url('showcart')}}"> 
                <i class="fas fa-shopping-cart"></i>  
                Krepšelis[{{$count}}]</a>
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

   <body>
  <h1>Apie mus</h1>  
  <p class="aboutpage">Senjorui.lt elektroninė parduotuvė, skirta palengvinti senjorų apsipirkimą internetu. XXI amžiuje apsipirkimas internetu tapo įprastu veiksmu. Pasirinkimas iš kur užsisakyti prekes yra platus, tačiau ne visiems lengvai suprantamas ir aiškus. Mokantys naudotis šiuolaikinėmis technologijomis lengvai užsisakys internetu ko tik panorėję, senjorams tai gali tapti iššūkiu.</p>
<h1>Kaip viskas veikia?</h1>   
<p class="aboutpage">
  Viskas labai paprasta! Senjoro globėjas užsiregistravęs gali užregistruoti senjorą (senjorui el. pašto turėti nereikia, prisijungimui naudojamas prisijungimo vardas). Globėjas gali nustatyti senjorui limitą - suma, kurią viršinus išsiunčiamas globėjui el. laiškas, kad reikia patvirtinti užsakymą. Taip pat, globėjas gali įnešti pinigų į senjoro kreditą ir jei ši suma nebus viršinama užsakymo pateikimo metu, pinigai bus automatiškai atskaičiuojami ir globėjus nereiks nieko tvirtinti.
</p>
<p class="aboutpage">
  Visi mygtukai, užrašai, produktai ir apskritai viskas - ką mato senjoras yra didelio šrifto, todėl yra paprasta ir nesudėtinga naudotis el. parduotuve.
</p>
<img src="https://storage.googleapis.com/lssliving-prod-assets/uploads/seniorfund2018.jpg" alt="">
</body>

    
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
