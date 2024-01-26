<?php

namespace Modules\Product\App\Interfaces;

use Illuminate\Http\Request;

interface ProductRepositoryInterface{

    public function storeProduct($validatedData);

    public function updateProduct(Request $request, $id);

    public function deleteProduct($id);
}
