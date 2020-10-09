@extends('backend_template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
           <a href="{{route('item.index')}}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>
   </div>
   <form>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$item->photo}}" alt="Item Photo" class="img-fluid w-50">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <h3>Code No: {{$item->codeno}}</h3>
                <h3>Name: {{$item->name}}</h3>
                <h3>Supplier Name: {{$item->supplier->name}}</h3>
                <h3>Category Name: {{$item->category->name}}</h3>
                <h3>Brand Name: {{$item->brand->name}}</h3>
            </div>
        </div>
    </div>
</form>

</div>
@endsection