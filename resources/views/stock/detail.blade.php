@extends('backend_template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
           <a href="{{route('stock.index')}}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>
   </div>
   <form>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$stock->item->photo}}" alt="Item Photo" class="w-30">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <h3>Code No: {{$stock->item->codeno}}</h3>
                <h3>Name: {{$stock->item->name}}</h3>
                <h3>Price (per) : {{$stock->perprice}}</h3>
                <h3>Quantity: {{$stock->quantity}}</h3>
                <h3>Date: {{$stock->in_date}}</h3>
            </div>
        </div>
    </div>
</form>

</div>
@endsection