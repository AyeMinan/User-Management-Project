<?php

namespace Modules\Product\App\Services;

use Modules\Product\App\Interfaces\ProductRepositoryInterface;

class ProductService{
    protected $ProductRepository;


    public function __construct(ProductRepositoryInterface $ProductRepository)
    {
      $this->ProductRepository = $ProductRepository;
    }

    public function storeProduct($validatedData)
    {

      return $this->ProductRepository->storeProduct($validatedData);
    }

    public function updateProduct($request, $id){
        return $this->ProductRepository->updateProduct($request, $id);
    }

    public function deleteProduct($id){
        return $this->ProductRepository->deleteProduct($id);
    }
}
