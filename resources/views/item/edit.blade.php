@extends('backend_template')
@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> 
         Edit Existing Item 

         <a href="{{ route('item.index') }}" class="btn btn-outline-success btn-sm float-right"> <i class="fas fa-backward"></i>Back</a>

     </h6>

 </div>
 <form action="{{ route('item.update',$item->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <input type="hidden" name="oldphoto" value="{{ $item->photo }}">
    <div class="card-body">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label"> Photo </label>
            <div class="col-sm-10">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-oldphoto-tab" data-toggle="tab" href="#nav-oldphoto" role="tab" aria-controls="nav-oldphoto" aria-selected="true"> Old Photo </a>
                        <a class="nav-link" id="nav-newphoto-tab" data-toggle="tab" href="#nav-newphoto" role="tab" aria-controls="nav-newphoto" aria-selected="false"> New Photo </a>
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-oldphoto" role="tabpanel" aria-labelledby="nav-oldphoto-tab">
                        <img src="{{ asset($item->photo) }}" class="img-fluid">
                    </div>
                    <div class="tab-pane fade" id="nav-newphoto" role="tabpanel" aria-labelledby="nav-newphoto-tab">
                        <input type="file" id="nav-newphoto" name="photo">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="name"> Name </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="supplier">Supplier Name </label>
                <select name="supplier" class="form-control">
                  <optgroup label="Choose Supplier">
                    @foreach($suppliers as $row)
                    <option value="{{$row->id}}"
                      @if($row->id== $item->supplier_id)
                      {{'selected'}}
                      @endif
                      >{{$row->name}}</option>
                    }
                    @endforeach
                  </optgroup>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="category">Category Name </label>
                <select name="category" class="form-control">
                  <optgroup label="Choose Category">
                    @foreach($categories as $row)
                    <option value="{{$row->id}}"
                      @if($row->id== $item->category_id)
                      {{'selected'}}
                      @endif
                      >{{$row->name}}</option>
                    }
                    @endforeach
                  </optgroup>
                </select>
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="brand">Brand Name </label>
                <select name="brand" class="form-control">
                  <optgroup label="Choose Brand">
                    @foreach($brands as $row)
                    <option value="{{$row->id}}"
                      @if($row->id== $item->brand_id)
                      {{'selected'}}
                      @endif
                      >{{$row->name}}</option>
                    }
                    @endforeach
                  </optgroup>
                </select>
            </div>
        </div>
       {{--   <div class="form-row">
            <div class="form-group col-md-12 ">
                <label for="perprice"> Price (per) </label>
                <input type="text" class="form-control" id="perprice" name="perprice" value="{{ $item->stock->perprice }}">
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
                <input type="date" class="form-control" id="date" name="date" value="{{ $stock->date }}">
            </div>
        </div> --}}
    </div>
    <div class="card-footer">
        <button type="reset" class="btn btn-secondary text-uppercase mr-2"> 
            <i class="fas fa-times mr-2"></i> Cancel 
        </button>
        <button type="submit" class="btn btn-primary text-uppercase"> 
            <i class="fas fa-edit"></i>Update 
        </button>
    </div>
</form>

</div>
@endsection