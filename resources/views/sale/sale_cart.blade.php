@extends('backend_template')
@section('content')
<div class="container-fluid row">
  <div class="col-lg-7 col-md-12">
    <div class="row">
      <ul class="product-category pl-0">

        <a href="#" class="dropbtn btn btn-lg border-0 allItem">All</a>
        <div class="dropdown">
          <button class="dropbtn btn border-0">Category</button>
          <div class="dropdown-content">
            @foreach($categories as $row)
            <a href="{{route('byCategory')}}" data-id="{{$row->id}}" class="byCategory">{{$row->name}}</a>
            @endforeach
          </div>
        </div>
        <div class="dropdown">
          <button class="dropbtn btn border-0">Brand</button>
          <div class="dropdown-content">
           @foreach($brands as $row)
           <a href="{{route('byBrand')}}" data-id="{{$row->id}}" class="byBrand">{{$row->name}}</a>
           @endforeach
         </div>
       </div>
      </ul>
    </div>

    <div class="row py-5" id="products">
      
    </div>
  </div>

  <div class="col-lg-5 col-md-12">
    <div class="row mySaleList">
      <h4 class="text-uppercase text-primary text-center">Sale List</h4>
      <table class="table my-3">
        <thead>
          <tr>
            <th>Items</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="salTable"></tbody>
      </table>
      <a href="" class="btn btn-lg btn-success float-right">Proceed</a>
    </div>
    <div class="container nosalelist">
      <div class="row">
        <div class="col-12 text-center my-5">
          <img src="{{asset('Backend/img/no.png')}}" class="img-fluid d-inline-block" style="width: 150px; height: 150px; object-fit: cover;">
          <h3 class="d-inline-block mx-2 my-2 text-secondary"> There is no item yet.</h3>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function (argument) {
    
    allItem(); //show all item on first page
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    //show items without loading
    function allItem() {
      $.get("{{route('getallitem') }}",function (response) {
      console.log(response);
      var html = "";
      for(row of response){
         html += `<div class="col-md-6 col-lg-4 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod"><img class="img-fluid" src="${row.photo}" alt="Colorlib Template">
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="">${row.codeno}</a></h3>
            <h3><a href="#">${row.name}</a></h3>
            <div class="d-flex">
              <div class="pricing">
                <p>
                  ${3000}
                </p>
              </div>
            </div>
            <div class="bottom-area d-flex px-3">
              <div class="m-auto d-flex">
                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                  <span><i class="ion-ios-menu"></i></span>
                </a>
                <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="" data-name="" data-perprice="" data-id="" data-photo="" onClick="alert('Hello I am alert')">
                  <span><i class="ion-ios-cart"></i></span>
                </a>
                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                  <span><i class="ion-ios-heart"></i></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>`;
      }
      $('#products').html(html);
      })
    }
    //event catch items to show on salepage
    $('.allItem').click(function(event){
      event.preventDefault();
      allItem();
    })
    $('.byCategory').click(function (event) {
      event.preventDefault();
      var category_id = $(this).data('id');
      $.post("{{route('byCategory')}}",{category_id:category_id},function (response) {
      console.log(response);
       var html = "";
       for(row of response){
         html += `<div class="col-md-6 col-lg-4 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod"><img class="img-fluid" src="${row.photo}" alt="Colorlib Template">
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="">${row.codeno}</a></h3>
            <h3><a href="#">${row.name}</a></h3>
            <div class="d-flex">
              <div class="pricing">
                <p>
                  ${3000}
                </p>
              </div>
            </div>
            <div class="bottom-area d-flex px-3">
              <div class="m-auto d-flex">
                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                  <span><i class="ion-ios-menu"></i></span>
                </a>
                <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="${row.id}" data-name="${row.name}" data-perprice="${row.perprice}" data-photo="${row.photo}">
                  <span><i class="ion-ios-cart"></i></span>
                </a>
                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                  <span><i class="ion-ios-heart"></i></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>`;
       }
        $('#products').html(html);
      })
    })

    $('.byBrand').click(function (event) {
      event.preventDefault();
      var brand_id = $(this).data('id');
      $.post("{{route('byBrand')}}",{brand_id:brand_id},function (response) {
        console.log(response);
       var html = "";
       for(row of response){
         html += `<div class="col-md-6 col-lg-4 ftco-animate">
        <div class="product">
          <a href="#" class="img-prod"><img class="img-fluid" src="${row.photo}" alt="Colorlib Template">
            <div class="overlay"></div>
          </a>
          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="">${row.codeno}</a></h3>
            <h3><a href="#">${row.name}</a></h3>
            <div class="d-flex">
              <div class="pricing">
                <p>
                  ${3000}
                </p>
              </div>
            </div>
            <div class="bottom-area d-flex px-3">
              <div class="m-auto d-flex">
                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                  <span><i class="ion-ios-menu"></i></span>
                </a>
                <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="${row.id}" data-name="${row.name}" data-perprice="${row.perprice}" data-photo="${row.photo}">
                  <span><i class="ion-ios-cart"></i></span>
                </a>
                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                  <span><i class="ion-ios-heart"></i></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>`;
       }
        $('#products').html(html);
      })
    })
  })
</script>
@endsection