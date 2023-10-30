@extends('layout')


@push('breadcrumb')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('product')}}">Listagem de produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if(isset($id))
                    Edicao
                @else
                    Novo produto
                @endif
            </li>
        </ol>
    </nav>
@endpush


@section('content')

    @if(isset($message))
        <div class="p-2">
            <div class="alert alert-{{$message['type']}}">
                {{$message['message']}}
            </div>
        </div>
    @endif


    <div class="card col-8 mt-3 m-auto">
        <h5 class="card-header py-4">
            @if(isset($id))
                Edicao de produto
            @else
                Cadastro de produto
            @endif
        </h5>
        <div class="card-body">
            <form id="frm-create" method="POST" action="{{$action}}">
                @csrf

                @if(isset($id))
                    @method('PUT')
                @endif


                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input name="name" type="text" id="name" class="form-control  @if($errors->has('name')) is-invalid @endif" placeholder="Nome do produto" value="{{ old('name', isset($item) ? $item['name'] : '') }}">
                        @if($errors->has('name'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description"  class="form-label">Descricao</label>
                        <textarea  id="description" name="description"  class="form-control @if($errors->has('description')) is-invalid @endif">{{old('description' , isset($item) ? $item['description'] : '') }}</textarea>
                        @if($errors->has('description'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label for="category_id"  class="form-label">Categoria</label>
                        <select  class="form-control @if($errors->has('category_id')) is-invalid @endif" id="category_id" name="category_id">
                            @if(isset($paginatorCategories) && count($paginatorCategories->items()) )
                                @foreach($paginatorCategories->items() as $category)
                                    <option @if(old('category_id' , isset($item) ? $item->category_id : '') == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('category_id'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('category_id') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
