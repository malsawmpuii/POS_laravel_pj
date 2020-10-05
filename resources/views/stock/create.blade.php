@extends('backend_template')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> 
          Add Stock 
           {{-- Error --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
           <a href="{{ route('stock.index') }}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward">Back</i> </a>
       </h6>

   </div>
    <div class="card-body">
        <div class="col-md-6 mb-4">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" id="codeNo" class="form-control bg-light border-0 small" placeholder="Search by Code No..." aria-label="Search" aria-describedby="basic-addon2">
             {{--  <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div> --}}
            </div>
          </form>
      </div>
        <form id="stockSearch" action="{{ route('stock.store') }}" method="POST">  
         @csrf
         <div class="card">
          <div class="card-header">
            <h4 class="text-center">Stock</h4>
          </div>
           <div class="card-body">
             <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="codeno">Code</label>
                  <input type="text" class="form-control" id="codeno" name="codeno">
                </div>
                <div class="form-group col-md-3">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price">
                    <input type="hidden" name="item_id" id="item_id">
                </div>
                <div class="form-group col-md-3">
                  <label for="qty">Quantity</label>
                  <input type="number" class="form-control" id="qty" name="qty">
                </div>
                <div class="form-group col-md-3">
                  <label for="date">Date</label>
                  <input type="Date" class="form-control" id="in_date" name="in_date"> 
                </div>
              </div>
           </div>
           <div class="card-footer"> 
              <input type="submit" class="btn btn-lg btn-success float-right" value="Save">

           </div>
         </div>
       </form>
    </div>
</div>
<style type="text/css">
    .search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: rgb(61, 104, 142);
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}
</style>
<script type="text/javascript">
  $(document).ready(function (argument) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#stockSearch').hide();
    $('#codeNo').change(function () {
      var codeno = $(this).val();
      $.post("getitem",{codeno:codeno},function (response) {
        console.log(response)
        $('#stock').show();
        //$('#item_name').text(response.name)
        $('#price').val(response.perprice);
        $('#qty').val(response.quantity);
        $('#date').val(response.in_date);
        $('#item_id').val(response.id);
      })
    })
  })
</script>
@endsection