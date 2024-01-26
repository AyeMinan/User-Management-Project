<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckProductCreatePermission;
use App\Http\Middleware\CheckProductDeletePermission;
use App\Http\Middleware\CheckProductUpdatePermission;
use App\Http\Middleware\CheckProductViewPermission;
use Modules\Product\App\Services\ProductService;
use Illuminate\Http\Request;
use Modules\Product\App\Http\Requests\ProductRequest;
use Modules\Product\App\Models\Product;


// use App\Services\Product\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected  $productService;

     public function __construct(ProductService $productService)

     {

        $this->middleware(CheckProductViewPermission::class)->only(['index']);
        $this->middleware(CheckProductCreatePermission::class)->only(['create', 'store']);
        $this->middleware(CheckProductUpdatePermission::class)->only(['edit', 'update']);
        $this->middleware(CheckProductDeletePermission::class)->only(['destroy']);
        
         $this->productService = $productService;
     }
    public function index()
    {
        $this->middleware(CheckProductViewPermission::class);
        return view('product::index',[
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware(CheckProductCreatePermission::class);
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest){
        $this->middleware(CheckProductCreatePermission::class);
        $validatedData = $productRequest->validated();

        $this->productService->storeProduct($validatedData);

        return redirect('/product');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->middleware(CheckProductUpdatePermission::class);
        $product = Product::where('id', $id)->first();

    return view('product::edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, ProductRequest $productRequest)
    {
        $this->middleware(CheckProductUpdatePermission::class);
        $validatedData = $productRequest->validated();

        $this->productService->updateProduct($request, $id, $validatedData);

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->middleware(CheckProductDeletePermission::class);
        $this->productService->deleteProduct($id);

        return redirect()->back();


    }
}
