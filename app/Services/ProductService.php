<?php

namespace App\Services;
use App\Interfaces\IProductService;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

/**
 * @author Renan Salustiano <renansalustiano2020@gmail.com>
 */
class ProductService implements IProductService
{

    public function __construct(private readonly ProductRepository $productRepository)
    {}

    public function Create(array $product): ProductModel
    {
        $product = array_filter($product);


        $validator = $this->validateCreate($product);
        if($validator->fails()){
            throw new ValidationException($validator);
        }

       return $this->productRepository->Create($product);
    }

    public function Update(array $product, int $id): ProductModel
    {
        $product = array_filter($product);

        $currentProduct = $this->productRepository->GetById($id);

        if(!$currentProduct){
            throw new NotFoundHttpException('product not found');
        }

        $validator = $this->validateUpdate($product, $id);
        if($validator->fails()){
            throw new ValidationException($validator);
        }

        return $this->productRepository->Update($currentProduct, $product);
    }

    public function GetAll(): LengthAwarePaginator
    {
       return $this->productRepository->GetAll();
    }

    public function GetById(int $id): ?ProductModel
    {
        $product =  $this->productRepository->GetById($id);
        if(!$product){
            throw new NotFoundHttpException("produto inexistente");
        }

        return $product;
    }

    public function Delete(int $id): bool
    {
        $product =  $this->productRepository->GetById($id);
        if(!$product){
            throw new NotFoundHttpException("produto inexistente");
        }

        return $this->productRepository->Delete($id);
    }

    private function validateCreate(array $data) : \Illuminate\Validation\Validator{

        $rules = [
            'name' => ['required','string', 'max:255',  Rule::unique(ProductModel::class, 'name')],
            'description'=>  'max:255',
            'category_id' => 'numeric|required',
        ];

        $messages = [
            'name.required' => 'O campo nome é obrigatório' ,
            'name.max' => 'O campo nome deve ter no maximo :max caracteres',
            'name.unique' => 'Já existe um produto com esse nome',
            'description.max' => 'O campo descricao deve ter no maximo :max caracteres',
        ];

        return Validator::make($data, $rules, $messages);
    }

    private function validateUpdate(array $data, int $id) : \Illuminate\Validation\Validator {

        $rules = [];

        $messages = [
            'name.required' => 'O campo nome é obrigatório' ,
            'name.max' => 'O campo deve ter no maximo :max caracteres',
            'name.unique' => 'Já existe um produto com esse nome',
            'description.max' => 'O campo descricao deve ter no maximo :max caracteres',
        ];

        if(array_key_exists('name', $data)){
            $rules['name']  =  ['required','string', 'max:255',  Rule::unique(ProductModel::class, 'name')->ignore($id)];
        }

        if(array_key_exists('description', $data)){
            $rules['description']  =  'string|max:255';
        }

        if(array_key_exists('category_id', $data)){
            $rules['category_id']  =  'numeric';
        }


        return Validator::make($data, $rules, $messages);
    }
}
