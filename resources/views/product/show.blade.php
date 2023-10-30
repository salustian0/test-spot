@extends('layout')

@push('breadcrumb')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('product')}}">Listagem de produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="col-6 m-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dados do produto</h5>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item py-3 ">
                    <label class="fs-6 fw-bold">Nome:</label> <span>{{$item->name}}</span>
                </li>
                <li class="list-group-item py-3">
                    <label class="fs-6 fw-bold">Descricao:</label> <span>{{$item->description}}</span>
                </li>
                <li class="list-group-item py-3">
                    <label class="fs-6 fw-bold">Categoria:</label> <span>{{isset($item->category) ? $item->category->name : 'nao possui'}}</span>
                </li>
                <li class="list-group-item py-3">
                    <label class="fs-6 fw-bold">Data de cadastro:</label> <span>{{$item->parsedDate}}</span>
                </li>
                <li class="list-group-item py-3">
                    <a href="/product" class="btn btn-primary">Voltar para a listagem</a>
                </li>
            </ul>
        </div>
    </div>

@endsection

