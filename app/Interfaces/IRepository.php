<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @author RenanSalustiano <renansalustiano2020@gmail.com>
 */
interface IRepository
{
    public function Create(array $category): Model;
    public function Update($category, int $id): Model;
    public function GetAll(): Collection;
    public function GetById(int $id): ?Model;
    public function Delete(int $id): bool;
}
