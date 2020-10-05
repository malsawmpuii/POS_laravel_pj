@extends('backend_template')
@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> 
         Edit Existing Stock 

         <a href="{{ route('stock.index') }}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>

     </h6>

 </div>
 <form action="{{ route('item.update',$stock->item->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $stock->item_id }}">
    <div class="card-body">
       <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$stock->item->photo}}" alt="Item Photo" class="w-20">
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="perprice"> Price (per) </label>
                <input type="text" class="form-control" id="perprice" name="perprice" value="{{ $stock->perprice }}">
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="quantity"> Quantity </label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $stock->quantity }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="date"> Price (per) </label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $stock->in_date }}">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="reset" class="btn btn-secondary text-uppercase mr-2"> 
            <i class="fas fa-times mr-2"></i> Cancel 
        </button>
        <button type="submit" class="btn btn-primary text-uppercase"> 
            <i class="fas fa-edit"></i> Update 
        </button>
    </div>
</form>

</div>
@endsection