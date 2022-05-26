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
                        <td class="tableData">Užsakymo numeris</td>
                        <td class="tableData">Bendra suma</td>
                        <td class="tableData">Data</td>
                        <td class="tableData">Senjoras</td>
                        <td class="tableData">Globėjas</td>
                        <td class="tableData">Adresas</td>
                        <td class="tableData">Būsena</td>
                        <td class="tableData">Pristatytas</td>
                    </tr>
                    @foreach ($orders as $order)
                    @if ($order->status=="Apmokėtas")
                    <tr align="center" style="background-color:black;">
                        <td class="productTableElement">{{$order->id}}</td>
                        <td class="productTableElement">{{$order->price}}</td>
                        <td class="productTableElement">{{$order->order_date}}</td>
                        <td class="productTableElement">{{$order['senior']['login']}}</td>
                        <td class="productTableElement">{{$order['user']['email']}}</td>
                        <td class="productTableElement">{{$order['senior']['address']}}</td>
                        <td class="productTableElement">{{$order->status}}</td>
                        <td class="productTableElement">
                        <a class="btn btn-primary" href="{{url('updateorder',$order->id)}}">Pristatytas</a>
                        </td>
                        
                    </tr>
                    @endif
                    @endforeach
                    @foreach ($orders as $order)
                    @if ($order->status=="Pristatytas")
                    <tr align="center" style="background-color:black;">
                        <td class="productTableElement">{{$order->id}}</td>
                        <td class="productTableElement">{{$order->price}}</td>
                        <td class="productTableElement">{{$order->order_date}}</td>
                        <td class="productTableElement">{{$order['senior']['login']}}</td>
                        <td class="productTableElement">{{$order['user']['email']}}</td>
                        <td class="productTableElement">{{$order['senior']['address']}}</td>
                        <td class="productTableElement">{{$order->status}}</td>
                        <td class="productTableElement">
                        
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