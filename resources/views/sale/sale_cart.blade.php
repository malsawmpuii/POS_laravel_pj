@extends('backend_template')
@section('content')
<div class="container row">
  <div class="col-lg-7 col-md-12">
    <div class="row col-md-12">
      <ul class="product-category">
        <li>
          <a href="{{route('sale/item')}}" class="btn btn-lg">All</a>
          <div class="dropdown">
            <button class="dropbtn btn btn-lg border-0">Category</button>
            <div class="dropdown-content">
              @foreach($categories as $row)
              <a href="{{route('category_detail',$row->id)}}">{{$row->name}}</a>
              @endforeach
            </div>
          </div>
          <div class="dropdown">
            <button class="dropbtn btn border-0">Brand</button>
            <div class="dropdown-content">
             @foreach($brands as $row)
             <a href="{{route('brand_detail',$row->id)}}">{{$row->name}}</a>
             @endforeach
           </div>
         </div></li>
       </ul>
     </div>
     <div class="row py-5">
      @foreach($items as $row)
      <div class="col-md-6 col-lg-4 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod"><img class="img-fluid" src="{{$row->photo}}" alt="Colorlib Template">
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="">{{$row->codeno}}</a></h3>
            <h3><a href="#">{{$row->name}}</a></h3>
            <div class="d-flex">
              <div class="pricing">
                <p class="price"><span class="mr-2 price-dc"></span><span class="price-sale">$80.00</span></p>
              </div>
            </div>
            <div class="bottom-area d-flex px-3">
              <div class="m-auto d-flex">
                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                  <span><i class="ion-ios-menu"></i></span>
                </a>
                <a href="javascript:void(0)" class="addSaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="{{$row->id}}" data-name="{{$row->name}}" data-perprice="" data-photo="{{$row->photo}}">
                  <span><i class="ion-ios-cart"></i></span>
                </a>
                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                  <span><i class="ion-ios-heart"></i></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <div class="block-27">
          <ul>
            <li><a href="#">&lt;</a></li>
            <li class="active"><span>1</span></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&gt;</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="text-center">Sale List</h3>
      </div>
      <div class="card-body">
        <div class="container salecart_div">
          <div class="row">
            <div class="sale__cart__table">
              <table>
                <thead>
                  <tr>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="">
              <h5>Sale Total</h5>
              <ul>

                <li>Total <span class="totality"></span></li>
              </ul>
              <a href="" class="btn btn-outline-success">Ok</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection