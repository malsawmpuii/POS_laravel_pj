@extends('backend_template')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg subtitle">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Success</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<section class="product-details spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 shadow p-3 mb-5 bg-white rounded">
               <div class="row">
                  <div class="col-12">
                     <img src="{{ asset('Backend/img/sale.gif') }}" class="img-fluid">
                 </div>
             </div>
         </div>
     </div>
 </div>
</section>
@endsection
