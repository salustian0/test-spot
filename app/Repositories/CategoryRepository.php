<?php

namespace App\Repositories;

use App\Consts\TestSpotAppConsts;
use App\Interfaces\ICategoryRepository;
use App\Models\CategoryModel;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements ICategoryRepository
{

    public function Create(array $category) : CategoryModel
    {
       return CategoryModel::create($category);
    }

    public function Update(CategoryModel $category, array $data): CategoryModel
    {
       $category->update($data);
       return $category;
    }

    public function GetAll(): LengthAwarePaginator
    {
        return CategoryModel::paginate(TestSpotAppConsts::DEFAULT_PER_PAGE);
    }

    public function GetById(int $id): ?CategoryModel
    {
        return CategoryModel::find($id);
    }

    public function Delete(int $id): bool
    {
        return CategoryModel::destroy($id);
    }
}
