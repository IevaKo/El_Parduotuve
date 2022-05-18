
<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style type="text/css">
       .title{
        color:white;
        padding-top:25px;
        font-size:25px
       }
       label{
           display: inline-block;
           width:200px;
       }
   </style>
  </head>
  <body>
     @include('admin.sidebar')
      <!-- partial -->
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            <div class="container">
                <h1  class="title">Pridėti produktą</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert">X</button>
                     {{session()->get('message')}}

                </div>
                

                @endif
                <div class="container">
                <form action="{{url('uploadproduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div style="padding:15px;">
                    <label for="">Produkto pavadinimas</label>
                    <input style="color:black;" type="text" name="title" placeholder="Pavadinimas" required="">
                </div>

                <div style="padding:15px;">
                    <label for="">Kaina</label>
                    <input style="color:black;" type="number" step="0.01" name="price" placeholder="Kaina" required="">
                </div>
                <div style="padding:15px;">
                    <label for="">Aprašymas</label>
                    <input style="color:black;" type="text" name="des" placeholder="Produkto aprašymas" required="">
                </div>

                <div style="padding:15px;">
                <label for="">Nuotrauka</label>
                    <input style="color:black;" type="file" name="file" multiple accept="image/*">
                </div>
                
            </div>
                 <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Subkategorija</legend>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" checked type="radio" name="gridRadios" id="1" value="1" >
                                    <label class="form-check-label" for="gridRadios1">
                                        Daržovės
                                    </label>
                                </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="2" value="2" >
                                <label class="form-check-label" for="gridRadios1">
                                    Vaisiai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="4" value="4" >
                                <label class="form-check-label" for="gridRadios1">
                                    Duona
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="5" value="5" >
                                <label class="form-check-label" for="gridRadios1">
                                    Bandelės ir spurgos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="6" value="6" >
                                <label class="form-check-label" for="gridRadios1">
                                Džiūvėsiai, riestainiai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="7" value="7" >
                                <label class="form-check-label" for="gridRadios1">
                                    Konditerijos gaminiai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="8" value="8" >
                                <label class="form-check-label" for="gridRadios1">
                                    Pienas
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="9" value="9" >
                                <label class="form-check-label" for="gridRadios1">
                                Kefyras, rūgpienis ir pasukos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="10" value="10" >
                                <label class="form-check-label" for="gridRadios1">
                                    Varškės produktai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="11" value="11" >
                                <label class="form-check-label" for="gridRadios1">
                                    Sūris
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="12" value="12" >
                                <label class="form-check-label" for="gridRadios1">
                                    Kiaušiniai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="13" value="13" >
                                <label class="form-check-label" for="gridRadios1">
                                    Produktai be laktozės
                                </label>
                            </div>
                            </div>

      </div>
    </div>
    </fieldset>
    <input  class ="btn btn-success" type="submit">
    </form>
    </div>
        </div>
          <!-- partial -->
        @include('admin.script')
  </body>
</html>