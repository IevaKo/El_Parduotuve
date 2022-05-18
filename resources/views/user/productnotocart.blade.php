
<div style="margin:30px;;" class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2 style="font-size:80px;">Naujausios prekės</h2>
              <a href="{{ url('allproductsuser') }}" style="font-size:30px;">Visos prekės <i class="fa fa-angle-right"></i></a>
           
              <form action="{{url('search')}}" method="get" style=" padding:10px; display:flex;">
                @csrf

                <input style="font-size:25px;"  type="search" name="search" placeholder="Paieška">
                <input type="submit" value="Paieška" class="btn btn-outline-dark btn-lg">
              </form>
            </div>
          </div>
        @foreach($data as $product)
          
          <div class="col-md-12">
            <div class="product-item">
              <a href="#"><img height="600" width="300" src="/productimage/{{$product->image}}" alt=""></a>
              <div class="down-content">
                <a href="#" ><h4 style="font-size:50px;">{{$product->title}}</h4></a>
                <h6 style="font-size:50px; position: static;">{{$product->price}} €</h6>
                <p style="font-size:30px; margin:10px;" >{{$product->description}}</p>
                
              </div>
            </div>
          </div>

        @endforeach

        @if(method_exists($data,'links'))
        <div class="d-flex justify-content-center">
          {!! $data->links() !!}
        </div>
        @endif

        </div>
      </div>
    </div>

    