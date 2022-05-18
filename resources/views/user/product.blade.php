
<div style="margin:30px;;" class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <form action="{{url('search')}}" method="get" style=" padding:10px; display:flex;">
                @csrf

                <input style="font-size:25px;"  type="search" name="search" placeholder="Paieška">
                <input type="submit" value="Paieška" class="btn btn-outline-dark btn-lg">
              </form>
            </div>
          </div>
        @foreach($data as $product)
          
          <div class="col-md-4">
            <div class="product-item">
              <img class="product-photo" src="/productimage/{{$product->image}}" alt="">
              <div class="down-content">
                <h4 class="product-content">{{$product->title}}</h4>
                <h4 class="product-content">{{$product->price}} €</h4>
                <p class="product-content" >{{$product->description}}</p>
                <form style="font-size:50px; padding:10px;" action="{{url('addcart',$product->id)}}" method="POST">
                  @csrf
                  <p class="product-content" >Kiekis</p>
                  <input class="product-content-quantity" required name="quantity" type="number" value="1" min="1" max="10" required >
                  <br>
                  <input  type="submit" class="product-content btn btn-success " value="Pridėti į krepšelį">
                </form>
                
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

    