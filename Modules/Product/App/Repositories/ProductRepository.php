<?php

namespace Modules\Product\App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Product\App\Http\Requests\ProductRequest;
use Modules\Product\App\Interfaces\ProductRepositoryInterface;
use Modules\Product\App\Models\Product;

class ProductRepository implements ProductRepositoryInterface{


    public function storeProduct($validatedData){
       $imagePath ='/storage/'. request('image')->store('/products', 'public');

         Product::create([
            'image' => $imagePath,
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'code' => $validatedData['code']
        ]);

    }

    public function updateProduct($request, $id){

        $product = Product::find($id);

        if(request('image')){
            File::delete(public_path($product->image));
           $imagePath = '/storage/' . request('image')->store('/products', 'public');


                $product->image = $imagePath;
                $product->name = $request['name'];
                $product->type = $request['type'];
                $product->code = $request['code'];


                $product->save();

        }
        }

        public function deleteProduct($id){
            $product = Product::find($id);
            $product->delete();
            File::delete(public_path($product->image));
        }
}
