@extends('layout')

@section('content')
    <div class="d-flex align-items-center justify-content-center flex-column">
        <p>Na barra de navegacao a cima é possivel gerenciar as categorias e produtos.</p>
        <p>Basta clicar em: <a href="{{url('category')}}">Categorias</a> ou <a href="{{url('product')}}">Produtos</a> </p>
    </div>
@endsection
