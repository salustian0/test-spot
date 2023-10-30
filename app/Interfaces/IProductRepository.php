<?php

namespace App\Interfaces;

use App\Models\ProductModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductRepository
{
    public function Create(array $product): ProductModel;
    public function Update(ProductModel $product, array $data): ProductModel;
    public function GetAll(): LengthAwarePaginator;
    public function GetById(int $id): ?ProductModel;
    public function Delete(int $id): bool;
}
