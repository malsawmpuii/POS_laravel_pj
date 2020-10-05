@extends('backend_template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
           <a href="{{route('category.index')}}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>
   </div>
   <form>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <img src="{{$category->photo}}" alt="Category Photo" class="w-50">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 ">
                <h3>Name: {{$category->name}}</h3>
            </div>
        </div>
    </div>
</form>

</div>
@endsection