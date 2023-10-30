<?php

namespace App\Interfaces;


use App\Models\CategoryModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryService
{

    public function Create(array $category): CategoryModel;

    public function Update(array $category, int $id): CategoryModel;

    public function GetAll(): LengthAwarePaginator;

    public function GetById(int $id): ?CategoryModel;

    public function Delete(int $id): bool;
}
