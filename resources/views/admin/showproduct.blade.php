<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style>
       .tableData{
           padding:20px;
       }
       .productTableElement{
           border-color:white;
           border-width:1px;
       }
   </style>
  </head>
  <body>
     @include('admin.sidebar')
      <!-- partial -->
        @include('admin.navbar')


        <div style="padding-bottom:30px;" class="container-fluid page-body-wrapper">

            <div class="container" align="center">

                @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert">X</button>
                     {{session()->get('message')}}

                    </div>

                @endif

               <table>
                    <tr style="background-color:grey;">
                        <td class="tableData">Pavadinimas</td>
                        <td class="tableData">Kaina</td>
                        <td class="tableData">Aprašymas</td>
                        <td class="tableData">Nuotrauka</td>
                        <td class="tableData">Atnaujinti duomenis</td>
                        <td class="tableData">Deaktyvuoti</td>
                    </tr>
                    @foreach ($data as $product)
                    @if ($product->product_status=="Aktyvi")
                    <tr align="center" style="background-color:black;">
                        <td class="productTableElement">{{$product->title}}</td>
                        <td class="productTableElement">{{$product->price}}</td>
                        <td class="productTableElement">{{$product->description}}</td>
                        <td class="productTableElement">
                            <img height="100" width="100" src="/productimage/{{$product->image}}" >
                        </td>
                        <td class="productTableElement">
                            <a class= "btn btn-primary" href="{{url('updateview',$product->id)}}">Atnaujinti</a>
                        </td>
                        <td class="productTableElement">
                        <a class="btn btn-danger" href="{{url('deleteproduct',$product->id)}}">Deaktyvuoti</a>
                        </td>
                        
                    </tr>
                    @endif
                    @endforeach
               </table> 
            </div>

        </div>
          <!-- partial -->
        @include('admin.script')
  </body>
</html>