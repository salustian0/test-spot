<?php

namespace App\Http\Controllers;

use App\Interfaces\IController;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * @author Renan Salustiano <renansalustiano2020@gmail.com>
 *
 */
class ProductController extends Controller implements IController
{

    public function __construct(private ProductService $productService, private CategoryService $categoryService)
    {}

    public function index()
    {
        $data  = array();

        try {
            $paginator = $this->productService->GetAll();

            if(count($paginator->items())){
                $paginator->setCollection($paginator->map(function($v){
                    $v->parsedDate = date('d/m/Y H:i', strtotime($v->created_at));
                    return $v;
                }));
            }

            $data = array(
                'paginator'  => $paginator,
            );

            $data['message'] = session('message');
        }catch (\Exception $ex){
            $message = $ex->getMessage() ?? 'Houve um erro desconhecido';
            $data['message'] = array('type' => 'danger','message' => $message);
        }

        return view('product/listing', $data);
    }


    public function store(Request $request)
    {
        try{
            $data = $request->only(['name', 'description', 'category_id']);
            $data['message'] = session('message');

            $this->productService->Create($data);

            return redirect()->route('product.index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => 'Novo registro adicionado com sucesso.'
                ));

        }catch (\Exception $ex){
            if($ex instanceof ValidationException){
                return redirect()->back()
                    ->withErrors($ex->errors())
                    ->withInput();
            }

            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function show(int $id)
    {
        $data  = array();

        try{
            $item = $this->productService->GetById($id);
            $item->parsedDate = date('d/m/Y H:i', strtotime($item->created_at));

            $data['item'] = $item;
        }catch (\Exception $ex){
            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }

        return view('product/show', $data);
    }

    public function update(Request $request, int $id)
    {
        try{
            $data =  $request->only(['name', 'description', 'status', 'category_id']);

            $this->productService->Update($data, $id);

            return redirect()->route('product.index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => "Registro #{$id} atualizado com sucesso."
                ));
        }catch (\Exception $ex){
            if($ex instanceof ValidationException){
                return redirect()->back()->withErrors($ex->errors())->withInput();
            }

            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function destroy(int $id)
    {
        try{
            $this->productService->Delete($id);
            return redirect()->back()
                ->with('message', array(
                    'type' => 'success',
                    'message' => "Registro #{$id} deletado com sucesso."
                ));
        }catch (\Exception $ex){
            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }
    }

    public function create()
    {
        $data = array('method' => 'POST', 'action' => url('product'));

        $paginatorCategories = $this->categoryService->GetAllActive();

        if(!count($paginatorCategories->items())){
            return redirect()->back()->with('message', array(
                'type' => 'danger',
                'message' => 'Não foram encotradas categorias ativas disponíveis para vínculo.'));
        }

        $data['paginatorCategories'] = $paginatorCategories;

        $data['message'] = session('message');
        return view('product/form', $data);
    }

    public function edit(int $id)
    {
        try{
            $item = $this->productService->GetById($id);
            $data = array('id' => $id,'method' => 'PUT', 'action' => url('product', $id));
            $data['message'] = session('message');
            $paginatorCategories = $this->categoryService->GetAllActive();
            $data['paginatorCategories'] = $paginatorCategories;

            $data['item'] = $item;
            return view('product/form', $data);
        }catch (\Exception $ex){

        }
    }
}
