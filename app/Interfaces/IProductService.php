<?php

namespace App\Interfaces;


use App\Models\ProductModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductService
{

    public function Create(array $product): ProductModel;

    public function Update(array $product, int $id): ProductModel;

    public function GetAll(): LengthAwarePaginator;

    public function GetById(int $id): ?ProductModel;

    public function Delete(int $id): bool;
}
