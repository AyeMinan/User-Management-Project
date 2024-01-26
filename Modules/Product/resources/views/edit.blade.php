@extends('product::layouts.master')

@section('content')
    <div class="container my-3">
  <form action="{{ route('product.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <h3>Create Product</h3>
        <div class="form-group my-2">
            <label for="ProductImage">Product Image</label>
            <input type="file" name="image" class="form-control" id="productImage">
            <img src="{{$product->image}}"
            width="200px" height="200px"
            />
            @error('image')
            <p class="text-danger">{{$message}}</p>
             @enderror
          </div>
    <div class="form-group my-2">
      <label for="ProductName">Product Name</label>
      <input type="text" value="{{$product->name}}" name="name" class="form-control" id="productName"  placeholder="Enter name">
      @error('name')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>

    <div class="form-group my-2">
        <label for="ProductType">Product Type</label>
        <input type="text" value="{{$product->type}}" name="type" class="form-control" id="productType"  placeholder="Enter type">
        @error('type')
        <p class="text-danger">{{$message}}</p>
         @enderror
      </div>
    <div class="form-group">
      <label for="ProductCode">Product Code</label>
      <input type="text" value="{{$product->code}}" name="code" class="form-control" id="productCode"  placeholder="Enter Product Code">
      @error('code')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>
    </div>
    <div class="form-group my-3">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

  </div>

  @endsection
