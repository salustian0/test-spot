@extends('layout')

@section('content')
    <!-- MODAL DELETE -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Exclusão de contato</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir esse registro?
                </div>
                <form id="frm-delete" method="POST" action="" >
                    @csrf
                    @method('DELETE')

                    <div class="modal-footer">
                        <button type="submit"  id="btn-yes"  class="btn btn-success" data-bs-dismiss="modal">
                            Sim
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Não
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DELETE -->


    <div class="container py-3 col-10">
        @if(isset($message))
            <div class="p-2">
                <div class="alert alert-{{$message['type']}}">
                    {{$message['message']}}
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <i class="fas fa-list"></i>
                <span>Listagem de categorias</span>
            </div>
            <a href="{{url('category/create')}}" id="btn-add" class="btn btn-success actions" title="Novo registro">
                <span class="fas fa-plus"></span>
            </a>
        </div>
    </div>

    <div class="col-10 mx-auto">
        <table class="table table-bordered rounded">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Data de cadastro</th>
                    <th></th>
                </tr>
            </thead>
            <tbody >
            @if(isset($paginator) && count($paginator->items()))
                @foreach($paginator->items() as $item)
                    <tr class="text-center">
                        <th class="align-middle" scope="row" class="">{{$item->id}}</th>
                        <td class="align-middle">{{$item->name}}</td>
                        <td>
                            @if($item->status == true)
                                <i class="text-success fa-solid fa-circle-check"></i>
                            @else
                                <i class="text-danger fa-solid fa-circle-xmark"></i>
                           @endif
                        <td class="align-middle">{{$item->parsedDate}}</td>
                        <td class="d-flex justify-content-end gap-3">
                            <a class="text-dark text-decoration-none" href="{{url('/category', $item->id)}}">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                            <a   href="{{url('category')}}/{{$item->id}}/edit" class="btn-edit text-dark text-decoration-none">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                            <a  id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#modalDelete"  class="text-danger text-decoration-none btn-delete">
                                <i class="fas fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        @include('paginator')
    </div>
@endsection

@push('breadcrumb')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Listagem de categorias
            </li>
        </ol>
    </nav>
@endpush

@push('scripts')@endpush
