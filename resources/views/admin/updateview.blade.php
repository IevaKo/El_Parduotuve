<!DOCTYPE html>
<html lang="en">
  <head>
      <base href="/public">
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
            <div class="container" align="center">
                <h1  class="title">Pridėti produktą</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert">X</button>
                     {{session()->get('message')}}

                </div>
                

                @endif
                <form action="{{url('updateproduct', $data->id )}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div style="padding:15px;">
                    <label for="">Produkto pavadinimas</label>
                    <input style="color:black;" type="text" name="title" value="{{$data->title}}" required="">
                </div>

                <div style="padding:15px;">
                    <label for="">Kaina</label>
                    <input style="color:black;" type="text" name="price" value="{{$data->price}}" required="">
                </div>
                <div style="padding:15px;">
                    <label for="">Aprašymas</label>
                    <input style="color:black;" type="text" name="des" value="{{$data->description}}" required="">
                </div>

                <div style="padding:15px;">
                    <label for="">Nuotrauka</label>
                    <img height="200" width="200" src="/productimage/{{$data->image}}" >
                </div>

                <div style="padding:15px;">
                <label for="">Pakeisti nuotrauką</label>
                    <input style="color:black;" type="file" name="file">
                </div>
                <input  class ="btn btn-success" type="submit">
            </div>
            </form>

        </div>
          <!-- partial -->
        @include('admin.script')
  </body>
</html>