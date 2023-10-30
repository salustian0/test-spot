<?php

namespace App\Repositories;

use App\Consts\TestSpotAppConsts;
use App\Interfaces\IProductRepository;
use App\Models\ProductModel;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements IProductRepository
{

    public function Create(array $product) : ProductModel
    {
       return ProductModel::create($product);
    }

    public function Update(ProductModel $product, array $data): ProductModel
    {
       $product->update($data);
       return $product;
    }

    public function GetAll(): LengthAwarePaginator
    {
        return ProductModel::paginate(TestSpotAppConsts::DEFAULT_PER_PAGE);
    }

    public function GetById(int $id): ?ProductModel
    {
        return ProductModel::find($id);
    }

    public function Delete(int $id): bool
    {
        return ProductModel::destroy($id);
    }
}
