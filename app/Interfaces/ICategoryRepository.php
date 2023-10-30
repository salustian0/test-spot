<?php

namespace App\Interfaces;

use App\Models\CategoryModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryRepository
{
    public function Create(array $category): CategoryModel;
    public function Update(CategoryModel $category, array $data): CategoryModel;
    public function GetAll(): LengthAwarePaginator;
    public function GetById(int $id): ?CategoryModel;
    public function Delete(int $id): bool;
}
