@extends('backend_template')
@section('content')
<div class="container-fluid row">
  <div class="col-lg-7 col-md-12">
    <div class="row">
      <ul class="product-category pl-0">

        <a href="#" class="dropbtn btn btn-lg border-0 allItem"><i class="fas fa-hand-pointer"></i>All</a>
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

   <div class="row" id="products">

   </div>
 </div>
 <hr class="sidebar-divider">
 <div class="col-lg-5 col-md-12">
  <div class="row mySaleList">
    <h4 class="text-uppercase text-primary text-lg-center">Your Sale Cart</h4>
    <table class="table my-3">
      <thead>
        <tr>
          <th>Items</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Sub Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="salTable"></tbody>
    </table>
    <h5 class="text-dark mx-5 my-3">Cart Total: <span class="totalAmt text-danger"></span>  Ks</h5>

    <a href="#" class="form-control-lg btn btn-lg btn-info float-right my-5 checkoutBtn"><i class="fas fa-check"></i></i>Proceed</a>
  </div>
  <div class="container nosalelist">
    <div class="row">
      <div class="col-12 text-center my-5">
        <img src="{{asset('Backend/img/nothing.gif')}}" class="img-fluid d-inline-block" style="width: 160px; height: 160px; object-fit: cover;">
        <h3 class=" mx-2 my-4 text-danger"><marquee width="60%" direction="left" height="100px">There is no item yet!
        </marquee></h3>
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
         ${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}
         </p>
         </div>
         </div>
         <div class="bottom-area d-flex px-3">
         <div class="m-auto d-flex">
         <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
         <span><i class="ion-ios-menu"></i></span>
         </a>
         <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="${row.id}" data-codeno="${row.codeno}" data-name="${row.name}" data-perprice="${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}" data-photo="${row.photo}">
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

       $(document).ready(function(){
        showTable();

        $('.SaleBtn').on('click', function(event){
          event.preventDefault();
          showTable();
          var id = $(this).data('id');
          var name = $(this).data('name');
          var codeno = $(this).data('codeno');
          var photo = $(this).data('photo');
          var perprice = $(this).data('perprice');
          var quantity = 1;

          var mylist = {id:id, codeno:codeno,
            name:name, photo:photo,
            perprice:perprice,quantity:quantity};

            console.log(mylist);

            var sale = localStorage.getItem('sale');
            var saleArray;

            if (sale==null) {
              saleArray = Array();
            }
            else{
              saleArray = JSON.parse(sale);
            }

            var status=false;

            $.each(saleArray, function(i,v){
              if (id == v.id) {
                v.quantity++;
                status = true;
              }
            });

            if (!status) {
              saleArray.push(mylist);
            }

            var saleData = JSON.stringify(saleArray);
            localStorage.setItem("sale",saleData);
          });

        function showTable(){
          var sale = localStorage.getItem('sale');

          if (sale) {
            $('.mySaleList').show();
            $('.nosalelist').hide();

            var saleArray = JSON.parse(sale);
            var salecartData='';


            if (saleArray.length > 0) {
              var total = 0;
              $.each(saleArray, function(i,v){
                var id = v.id;
                var codeno = v.codeno;
                var name = v.name;
                var perprice = v.perprice;
                var photo = v.photo;
                var quantity = v.quantity;
                
                var str_perprice = perprice.toString();
                console.log(str_perprice);

                var price = perprice;
                var subtotal = price * quantity;
                var str_subtotal = subtotal.toString();


                salecartData += `<tr> 
                <td>
                <img src="${photo}" alt="" class="img-fluid" style="width:50px; height:50px; object-fit:cover">
                <h6> ${name} </h6>
                </td>`;
                salecartData += `<td>
                ${str_perprice}
                </td>`;
                
                salecartData += `<td>
                <a class="btn dec" data-id="${i}">-</a>
                ${quantity}
                <a class="btn inc" data-id="${i}">+</a> 
                </td>
                <td>
                ${str_subtotal} Ks
                </td>
                
                <td>
                <span class="btn remove_btn" data-id="${i}"><i class="fas fa-times-circle"></i></span>
                </td>
                </tr>`;
                total += subtotal ++;
              });
              var totalAmt = total;
              console.log(totalAmt);

              $('.salTable').html(salecartData);
              $('.totalAmt').html(totalAmt.toString())+' Ks';


            }
            else{
              $('.mySaleList').hide();
              $('.nosalelist').show();
            }
          }
          
        }

        // Remove Item
        $('.salTable').on('click','.remove_btn', function()
        {
          var id = $(this).data('id');

          console.log(id);

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);

          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              saleArray.splice(id,1);
            }
          })

          var saleData=JSON.stringify(saleArray);

          localStorage.setItem("sale",saleData);
          
          showTable();

        });

        // Add Quantity
        $('.salTable').on('click','.inc', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            console.log(i);
            if (i == id) 
            {
              v.quantity++;
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();

        });

        // Sub Quantity
        $('.salTable').on('click','.dec', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              v.quantity--;
              if (v.quantity == 0) 
              {
                saleArray.splice(id,1);
              }
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();
        });
        $('.checkoutBtn').click(function () {

          var saleCart=localStorage.getItem("sale"); //string
          console.log(saleCart);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          console.log(saleCart);
          if(saleCart){
            $.post("{{route('sale')}}",{
              data:saleCart
            },function(response){
              console.log(response);
              localStorage.clear();
                    location.href="salesuccess";

            });
        
            }
        });
      });
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
          ${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}
         </p>
         </div>
         </div>
         <div class="bottom-area d-flex px-3">
         <div class="m-auto d-flex">
         <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
         <span><i class="ion-ios-menu"></i></span>
         </a>
         <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="${row.id}" data-codeno="${row.codeno}" data-name="${row.name}" data-perprice="${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}" data-photo="${row.photo}">
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
       $(document).ready(function(){

        showTable();
        
        $('.SaleBtn').on('click', function(event){
          //alert('allert')
          event.preventDefault();
          showTable();
          var id = $(this).data('id');
          var name = $(this).data('name');
          var codeno = $(this).data('codeno');
          var photo = $(this).data('photo');
          var perprice = $(this).data('perprice');
          var quantity = 1;

          var mylist = {id:id, codeno:codeno,
            name:name, photo:photo,
            perprice:perprice,quantity:quantity};

            console.log(mylist);

            var sale = localStorage.getItem('sale');
            var saleArray;

            if (sale==null) {
              saleArray = Array();
            }
            else{
              saleArray = JSON.parse(sale);
            }

            var status=false;

            $.each(saleArray, function(i,v){
              if (id == v.id) {
                v.quantity++;
                status = true;
              }
            });

            if (!status) {
              saleArray.push(mylist);
            }

            var saleData = JSON.stringify(saleArray);
            localStorage.setItem("sale",saleData);
          });

        function showTable(){
          var sale = localStorage.getItem('sale');

          if (sale) {
            $('.mySaleList').show();
            $('.nosalelist').hide();

            var saleArray = JSON.parse(sale);
            var salecartData='';


            if (saleArray.length > 0) {
              var total = 0;
              $.each(saleArray, function(i,v){
                var id = v.id;
                var codeno = v.codeno;
                var name = v.name;
                var perprice = v.perprice;
                var photo = v.photo;
                var quantity = v.quantity;
                
                var str_perprice = perprice.toString();
                //console.log(str_perprice);

                var price = perprice;
                var subtotal = 3000 * quantity;
                var str_subtotal = subtotal.toString();


                salecartData += `<tr> 
                <td>
                <img src="${photo}" alt="" class="img-fluid" style="width:50px; height:50px; object-fit:cover">
                <h6> ${name} </h6>
                </td>`;
                salecartData += `<td>
                ${str_perprice}
                </td>`;
                
                salecartData += `<td>
                <a class="btn dec" data-id="${i}">-</a>
                ${quantity}
                <a class="btn inc" data-id="${i}">+</a> 
                </td>
                <td>
                ${str_subtotal} Ks
                </td>
                
                <td>
                <span class="btn-info remove_btn" data-id="${i}"><i class="fas fa-times-circle"></i></span>
                </td>
                </tr>`;
                total += subtotal ++;
              });
              var totalAmt = total;
              // console.log(total);
              console.log(totalAmt);

              $('.salTable').html(salecartData);
              $('.totalAmt').html(totalAmt.toString())+' Ks';


            }
            else{
              $('.mySaleList').hide();
              $('.nosalelist').show();
            }
          }
          
        }

        // Remove Item
        $('.salTable').on('click','.remove_btn', function()
        {
          var id = $(this).data('id');

          console.log(id);

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);

          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              saleArray.splice(id,1);
            }
          })

          var saleData=JSON.stringify(saleArray);

          localStorage.setItem("sale",saleData);
          
          showTable();

        });

        // Add Quantity
        $('.salTable').on('click','.inc', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            console.log(i);
            if (i == id) 
            {
              v.quantity++;
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();

        });

        // Sub Quantity
        $('.salTable').on('click','.dec', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              v.quantity--;
              if (v.quantity == 0) 
              {
                saleArray.splice(id,1);
              }
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();
        });
      });

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
     ${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}
     </p>
     </div>
     </div>
     <div class="bottom-area d-flex px-3">
     <div class="m-auto d-flex">
     <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
     <span><i class="ion-ios-menu"></i></span>
     </a>
     <a href="javascript:void(0)" class="SaleBtn buy-now d-flex justify-content-center align-items-center mx-1" data-id="${row.id}" data-codeno="${row.codeno}" data-name="${row.name}" data-perprice="${row.stocks.length>1?row.stocks[row.stocks.length-1].perprice:row.stocks[0].perprice}" data-photo="${row.photo}">
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
        //AddtoCart();
        $(document).ready(function(){

          showTable();
          
          $('.SaleBtn').on('click', function(event){
            event.preventDefault();
            showTable();
          //alert('allert')
          var id = $(this).data('id');
          var name = $(this).data('name');
          var codeno = $(this).data('codeno');
          var photo = $(this).data('photo');
          var perprice = $(this).data('perprice');
          var quantity = 1;

          var mylist = {id:id, codeno:codeno,
            name:name, photo:photo,
            perprice:perprice,quantity:quantity};

            console.log(mylist);

            var sale = localStorage.getItem('sale');
            var saleArray;

            if (sale==null) {
              saleArray = Array();
            }
            else{
              saleArray = JSON.parse(sale);
            }

            var status=false;

            $.each(saleArray, function(i,v){
              if (id == v.id) {
                v.quantity++;
                status = true;
              }
            });

            if (!status) {
              saleArray.push(mylist);
            }

            var saleData = JSON.stringify(saleArray);
            localStorage.setItem("sale",saleData);
          });

          function showTable(){
            var sale = localStorage.getItem('sale');

            if (sale) {
              $('.mySaleList').show();
              $('.nosalelist').hide();

              var saleArray = JSON.parse(sale);
              var salecartData='';


              if (saleArray.length > 0) {
                var total = 0;
                $.each(saleArray, function(i,v){
                  var id = v.id;
                  var codeno = v.codeno;
                  var name = v.name;
                  var perprice = v.perprice;
                  var photo = v.photo;
                  var quantity = v.quantity;
                  
                  var str_perprice = perprice.toString();
                //console.log(str_perprice);

                var price = perprice;
                var subtotal = 3000 * quantity;
                var str_subtotal = subtotal.toString();


                salecartData += `<tr> 
                <td>
                <img src="${photo}" alt="" class="img-fluid" style="width:50px; height:50px; object-fit:cover">
                <h6> ${name} </h6>
                </td>`;
                salecartData += `<td>
                ${str_perprice}
                </td>`;
                
                salecartData += `<td>
                <a class="btn dec" data-id="${i}">-</a>
                ${quantity}
                <a class="btn inc" data-id="${i}">+</a> 
                </td>
                <td>
                ${str_subtotal} Ks
                </td>
                
                <td>
                <span class="btn-info remove_btn" data-id="${i}"><i class="fas fa-times-circle"></i></span>
                </td>
                </tr>`;
                total += subtotal ++;
              });
                var totalAmt = total;
              // console.log(total);
              console.log(totalAmt);

              $('.salTable').html(salecartData);
              $('.totalAmt').html(totalAmt.toString())+' Ks';


            }
            else{
              $('.mySaleList').hide();
              $('.nosalelist').show();
            }
          }
          
        }

        // Remove Item
        $('.salTable').on('click','.remove_btn', function()
        {
          var id = $(this).data('id');

          console.log(id);

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);

          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              saleArray.splice(id,1);
            }
          })

          var saleData=JSON.stringify(saleArray);

          localStorage.setItem("sale",saleData);
          
          showTable();

        });

        // Add Quantity
        $('.salTable').on('click','.inc', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            console.log(i);
            if (i == id) 
            {
              v.quantity++;
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();

        });

        // Sub Quantity
        $('.salTable').on('click','.dec', function()
        {
          var id = $(this).data('id');

          var sale=localStorage.getItem("sale");
          var saleArray = JSON.parse(sale);
          
          $.each(saleArray,function (i,v) 
          {
            if (i == id) 
            {
              v.quantity--;
              if (v.quantity == 0) 
              {
                saleArray.splice(id,1);
              }
            }
          })
          
          var saleData = JSON.stringify(saleArray);
          localStorage.setItem('sale',saleData);
          showTable();
        });
      });

})
})
})

</script>
@endsection
