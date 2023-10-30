<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Product';
    protected $fillable = ["id", "name",  "description", "category_id"];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
