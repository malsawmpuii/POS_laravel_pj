@extends('backend_template')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> 
      Add Stock Testing
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
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="input-group">
          <input type="text" id="codeNo" class="form-control bg-light border-0 small" placeholder="Search by Code No..." aria-label="Search" aria-describedby="basic-addon2">
        </div>
      </div>
    </div>
    <form id="stockForm" action="{{ route('stock.store') }}" method="POST">  
      @csrf
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemName" name="itemName" readonly="">
            <input type="hidden" name="item_id" id="item_id">

          </div>
          <div class="form-group col-md-3">
            <label for="perprice">Price</label>
            <input type="number" class="form-control" id="perprice" name="perprice">
          </div>
          <div class="form-group col-md-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity">

          </div>
          <div class="form-group col-md-3">
            <label for="date">Date</label>
            <input type="Date" class="form-control" id="date" name="date"> 

          </div>
        </div>
          <input type="submit" class="btn btn-lg btn-success float-right" value="Save">
    </form>
    <form id="noStockForm">
      <div class="form-row">
        <h3 class="text-center text-uppercase text-danger">Wrong Search</h3>
      </div>
    </form>
  </div>

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function (argument) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $('#stockForm').hide();
  $('#noStockForm').hide();
  $('#codeNo').change(function () {
    var codeno = $(this).val();
    //console.log(codeno);
    $.post("{{route('getitem') }}",{codeno:codeno},function (response) {
   // console.log(response)
    $('#stockForm').show();
    $('#itemName').val(response.name);
    $('#item_id').val(response.id);
    })
  })
})
</script>
@endsection