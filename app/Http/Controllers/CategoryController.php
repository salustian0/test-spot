<?php

namespace App\Http\Controllers;

use App\Interfaces\IController;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * @author Renan Salustiano <renansalustiano2020@gmail.com>
 *
 */
class CategoryController extends Controller implements IController
{

    public function __construct(private CategoryService $categoryService)
    {}

    public function index()
    {
        $data  = array();

        try {
            $paginator = $this->categoryService->GetAll();
           $paginator->setCollection($paginator->map(function($v){
               $v->parsedDate = date('d/m/Y H:i', strtotime($v->created_at));
               return $v;
           }));

            $data = array(
                'paginator'  => $paginator,
            );

            $data['message'] = session('message');
        }catch (\Exception $ex){
            $message = $ex->getMessage() ?? 'Houve um erro desconhecido';
            $data['message'] = array('type' => 'danger','message' => $message);
        }

        return view('category/listing', $data);
    }


    public function store(Request $request)
    {
        try{
            $data = $request->only(['name', 'description', 'status']);
            $this->categoryService->Create($data);

            return redirect()->route('category.index')
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
        }
    }

    public function show(int $id)
    {
        $data  = array();

        try{
            $item = $this->categoryService->GetById($id);
            $data['item'] = $item;
        }catch (\Exception $ex){
            return redirect()->back()->with('message', array('type' => 'danger', 'message' => $ex->getMessage()));
        }

        return view('category/show', $data);
    }

    public function update(Request $request, int $id)
    {
        try{
            $data =  $request->only(['name', 'description', 'status']);
            $this->categoryService->Update($data, $id);
            return redirect()->route('category.index')
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
            $this->categoryService->Delete($id);
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
        $data = array('method' => 'POST', 'action' => url('category'));
        return view('category/form', $data);
    }

    public function edit(int $id)
    {
        try{
            $data['id'] = $id;
            $item = $this->categoryService->GetById($id);
            $data = array('id' => $id,'method' => 'PUT', 'action' => url('category', $id));
            $data['item'] = $item;
            return view('category/form', $data);
        }catch (\Exception $ex){

        }
    }
}
