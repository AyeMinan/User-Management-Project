@extends('product::layouts.master')

@section('content')

    {{-- <h1>Hello World</h1>

    <p>Module: {!! config('product.name') !!}</p> --}}

        <div style="padding: 20px  20px; max-width: 1200px; margin: 0 auto; border: solid black 1px;">
        <table class="table">
            @can('productCreatePermission')
            <a href="/product/create"> <button class="btn btn-primary">Create Product</button> </a>
            @endcan
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Type</th>
                <th scope="col">Product Code</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)


                <tr>
                    <th scope="row">1</th>
                    <td>{{$product->image}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->type}}</td>
                    <td>{{$product->code}}</td>
                    @can('productUpdatePermission')
                    <td><a href="{{route('product.edit', [$product->id] )}}" >
                        <button class="btn btn-primary">Edit</button>
                    </a></td>
                    @endcan

                    @can('productDeletePermission')

                    <form action="{{route('product.destroy', [$product->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <td><button class="btn btn-danger" type="submit">Delete</button></td>
                    </form>
                    @endcan


                  </tr>
                  @endforeach


            </tbody>
          </table>
        </div>

@endsection
