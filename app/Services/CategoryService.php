<?php

namespace App\Services;
use App\Interfaces\ICategoryService;
use App\Models\CategoryModel;
use App\Repositories\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

/**
 * @author Renan Salustiano <renansalustiano2020@gmail.com>
 */
class CategoryService implements ICategoryService
{

    public function __construct(private readonly CategoryRepository $categoryRepository)
    {}

    public function Create(array $category): CategoryModel
    {
        $category = array_filter($category);


        if(isset($category['status']))
            $category['status'] = filter_var($category['status'], FILTER_VALIDATE_BOOL);

        $validator = $this->validateCreate($category);
        if($validator->fails()){
            throw new ValidationException($validator);
        }

       return $this->categoryRepository->Create($category);
    }

    public function Update(array $category, int $id): CategoryModel
    {
        $category = array_filter($category);

        if(isset($category['status']))
            $category['status'] = filter_var($category['status'], FILTER_VALIDATE_BOOL);

        $currentCategory = $this->categoryRepository->GetById($id);

        if(!$currentCategory){
            throw new NotFoundHttpException('category not found');
        }

        $validator = $this->validateUpdate($category);
        if($validator->fails()){
            throw new ValidationException($validator);
        }

        return $this->categoryRepository->Update($currentCategory, $category);
    }

    public function GetAll(): LengthAwarePaginator
    {
       return $this->categoryRepository->GetAll();
    }

    public function GetById(int $id): ?CategoryModel
    {
        $category =  $this->categoryRepository->GetById($id);
        if(!$category){
            throw new NotFoundHttpException("categoria inexistente");
        }

        return $category;
    }

    public function Delete(int $id): bool
    {
        $category =  $this->categoryRepository->GetById($id);
        if(!$category){
            throw new NotFoundHttpException("categoria inexistente");
        }

        return $this->categoryRepository->Delete($id);
    }

    private function validateCreate(array $data) : \Illuminate\Validation\Validator{

        $rules = [
            'name' => 'required|string|max:255',
            'description'=>  'max:255',
            'status' => 'boolean|required'
        ];

        $messages = [
            'name.required' => 'O campo nome é obrigatório' ,
            'name.max' => 'O campo deve ter no maximo :max caracteres',
            'status.boolean' => 'O campo status precisa ser boleano'
        ];

        return Validator::make($data, $rules, $messages);
    }

    private function validateUpdate(array $data) : \Illuminate\Validation\Validator {

        $rules = [];

        $messages = [
            'name.required' => 'O campo nome é obrigatório' ,
            'name.max' => 'O campo deve ter no maximo :max caracteres',
            'status.boolean' => 'O campo status precisa ser boleano'
        ];

        if(array_key_exists('name', $data)){
            $rules['name']  =  'required|string|max:255';
        }

        if(array_key_exists('description', $data)){
            $rules['description']  =  'string|max:255';
        }

        if(array_key_exists('status', $data)){
            $data['status'] = filter_var($data['status'], FILTER_VALIDATE_BOOL);
            $rules['status']  =  'boolean';
        }

        return Validator::make($data, $rules, $messages);
    }
}
