@extends('backend_template')
@section('content')

 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> 
           Create New Item 
           <a href="{{ route('item.index') }}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i> </a>

       </h6>

   </div>
   <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="name"> Name </label>
                <input type="text" class="form-control" id="name" placeholder="Item Name" name="name">
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="photo"> Photo </label>
                <input type="file" id="photo" name="photo" class="form-control-file">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="supplier"> Supplier </label>
                <select class="form-control" name="supplier">
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"> {{ $supplier->name }}  </option>
                    @endforeach
                </select>
            </div>              
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="category"> Category </label>
                <select class="form-control" name="category">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}  </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="brand"> Brand </label>
                <select class="form-control" name="brand">
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="perprice"> price(per) </label>
                <input type="text" id="perprice" name="perprice" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="quantity"> Quantity </label>
                <input type="number" id="quantity" name="quantity" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="date">Date </label>
                <input type="Date" id="date" name="date" class="form-control">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="reset" class="btn btn-secondary text-uppercase mr-2"> 
            <i class="fas fa-times mr-2"></i> Cancel 
        </button>
        <button type="submit" class="btn btn-primary text-uppercase"> 
            <i class="fas fa-save mr-2"></i> Save 
        </button>
    </div>
</form>

</div>
@endsection