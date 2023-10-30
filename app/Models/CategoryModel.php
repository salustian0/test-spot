<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Category';
    protected $fillable = ["id", "name", "description", "status"];
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id');
    }
}
