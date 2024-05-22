@extends('layouts.clear')

@section('title', 'Formulário para Agenda de Castração de Cães e Gatos - Consulta')

@section('css-header')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')

    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('index') }}"><img src="{{ asset('logo.png') }}" alt="Logo" width="340"
                        class="d-inline-block align-text-top"></a>
            </div>
            <div class="col-md-8">
                <h3>Formulário para Cadastro de Castração de Cães e Gatos</h3>
                <h5>Secretaria Municipal de Saúde de Contagem</h5>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row g-3 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Consulta de Pedidos
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('search') }}" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF <strong class="text-danger">(*)</strong></label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf"
                                    name="cpf" value="{{ old('cpf') ?? '' }}">
                                @error('cpf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nascimento" class="form-label">Data de Nascimento <strong class="text-danger">(*)</strong></label>
                                <input type="text" class="form-control @error('nascimento') is-invalid @enderror" id="nascimento" name="nascimento" value="{{ old('nascimento') ?? '' }}">
                                @error('nascimento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary"><x-icon icon='search' /> Consultar</button>
                                <a href="{{ route('index') }}" class="btn btn-warning" role="button"><x-icon
                                        icon='file-plus' />
                                    Novo Pedido</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>      
    </div>

    @if (isset($pedidos))
    <div class="container py-3">
        <div class="row g-3 justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @if (count($pedidos) > 0)


                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº Pedido</th>
                                        <th scope="col">Data Pedido</th>
                                        <th scope="col">Nome do Animal</th>
                                        <th scope="col">Data de Agenda</th>
                                        <th scope="col">Turno</th>
                                        <th scope="col">Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td>{{ $pedido->codigo . '/' . $pedido->ano}}</td>
                                            <td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>
                                            <td>{{ $pedido->nomeAnimal }}</td>
                                            <td>{{  isset($pedido->agendaQuando) ? date('d/m/Y', strtotime($pedido->agendaQuando)) : '-' }}</td>
                                            <td>{{ $pegido->agendaTurno ?? '-' }}</td>
                                            <td>{{ $pedido->situacao->descricao }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <strong>Nenhum registro encontrado!</strong>
                            </div>
                        @endif

                    </div>
                </div>                
            </div>
        </div>
    </div>
    @endif            
@endsection

@section('script-footer')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var reloadButton = document.getElementById('reload');
            reloadButton.addEventListener('click', function() {
                location.reload();
                return false;
            });
        });
    </script>
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#cpf").inputmask({
                "mask": "999.999.999-99"
            });
            $('#nascimento').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                language: "pt-BR",
                autoclose: true,
                todayHighlight: true
            });

        });
    </script>
@endsection
