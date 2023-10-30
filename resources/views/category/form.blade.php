@extends('layout')


@push('breadcrumb')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('category')}}">Listagem de categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if(isset($id))
                    Edicao
                @else
                    Nova categoria
                @endif
            </li>
        </ol>
    </nav>
@endpush


@section('content')
    <div class="card col-8 mt-3 m-auto">
        <h5 class="card-header py-4">
            @if(isset($id))
                Edicao de categoria
            @else
                Cadastro de categoria
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
                        <input name="name" type="text" id="name" class="form-control  @if($errors->has('name')) is-invalid @endif" placeholder="Nome da categoria" value="{{ old('name', isset($item) ? $item['name'] : '') }}">
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
                        <label for="status"  class="form-label">Status</label>
                        <select  class="form-control @if($errors->has('status')) is-invalid @endif" id="status" name="status">
                            <option @if(old('status' , isset($item) ? $item['status'] : '') == true) selected @endif value="true">Ativo</option>
                            <option @if(old('status' , isset($item) ? $item['status'] : '') == false) selected @endif   value="false">Inativo</option>
                        </select>
                        @if($errors->has('status'))
                            <div  class="invalid-feedback">
                                {{ $errors->first('status') }}
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
