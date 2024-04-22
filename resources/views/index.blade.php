@extends('layouts.clear')

@section('title', 'Formulário para Agenda de Castração de Cães e Gatos')

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
                <h3>Formulário para Agenda de Castração de Cães e Gatos</h3>
                <h5>Secretaria Municipal de Saúde de Contagem</h5>
            </div>
        </div>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show py-3" role="alert">
            <h2 class="text-center py-3">{{ session('message') }}</h2>
            <h4 class="text-center">Em breve entraremos em contato para agendar o pedido.</h4>
            <h5 class="text-center">O prazo de espera poderá variar de acordo com a demanda.</h5>
            <h5 class="text-center">Cabe ao solicitante acompanhar o andamento de sua solicitação no site.</h5>
            <p class="text-center"><a class="btn btn-warning btn-lg" role="button" aria-disabled="true"
                    href="{{ route('busca') }}"><x-icon icon='search' /> Consultar Pedidos</a></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container py-2">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span><x-icon icon='exclamation-triangle' /></span><strong> Atenção</strong> O solicitante deve ser maior de
            <span class="text-decoration-underline">18 anos</span>
            e residir no município de <span class="text-decoration-underline">Contagem/MG</span>!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="container py-3">

        <form method="POST" action="{{ route('pedidos.store') }}">
            @csrf
            <div class="row g-3">

                <div class="col-md-5">
                    <label for="nome" class="form-label">{{ __('Name') }} <strong
                            class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome"
                        id="nome" value="{{ old('nome') ?? '' }}" maxlength="180">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="nascimento" class="form-label">Nascimento <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('nascimento') is-invalid @enderror" name="nascimento"
                        id='nascimento' value="{{ old('nascimento') ?? '' }}" autocomplete="off">
                    @error('nascimento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="cpf" class="form-label">CPF <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf"
                        id="cpf" value="{{ old('cpf') ?? '' }}">
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="email" class="form-label">E-mail <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" value="{{ old('email') ?? '' }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="cel" class="form-label">Celular <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cel') is-invalid @enderror" name="cel"
                        id="cel" value="{{ old('cel') ?? '' }}" maxlength="20">
                    @error('cel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="tel" class="form-label">Telefone <strong class="text-info">(Opcional)</strong></label>
                    <input type="text" class="form-control" name="tel" id="tel"
                        value="{{ old('tel') ?? '' }}" maxlength="20">
                </div>

                <div class="col-md-2">
                    <label for="cep" class="form-label">CEP <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cep') is-invalid @enderror" name="cep"
                        id="cep" value="{{ old('cep') ?? '' }}">
                    @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="logradouro" class="form-label">Logradouro <strong
                            class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('logradouro') is-invalid @enderror"
                        name="logradouro" id="logradouro" value="{{ old('logradouro') ?? '' }}" maxlength="100">
                    @error('logradouro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="numero" class="form-label">Número <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero"
                        id="numero" value="{{ old('numero') ?? '' }}" maxlength="10">
                    @error('numero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento <strong
                            class="text-info">(Opcional)</strong></label>
                    <input type="text" class="form-control" name="complemento" id="complemento"
                        value="{{ old('complemento') ?? '' }}" maxlength="100">
                </div>

                <div class="col-md-3">
                    <label for="bairro" class="form-label">Bairro <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro"
                        id="bairro" value="{{ old('bairro') ?? '' }}" maxlength="80">
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="cidade" class="form-label">Cidade <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade"
                        id="cidade" value="{{ old('cidade') ?? 'Contagem' }}" maxlength="80">
                    @error('cidade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="uf" class="form-label">UF <strong class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('uf') is-invalid @enderror" name="uf"
                        id="uf" value="{{ old('uf') ?? 'MG' }}" maxlength="2">
                    @error('uf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="cns" class="form-label">Cartão Nacional de Saúde <strong
                            class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cns') is-invalid @enderror" name="cns"
                        value="{{ old('cns') ?? '' }}" id="cns" maxlength="15">
                    @error('cns')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="beneficio" class="form-label">Possui Benefício <strong
                            class="text-danger">(*)</strong></label>
                    <select class="form-select" id="beneficio" name="beneficio">
                        <option value="" selected>Selecione ...</option>
                        <option value="S" @selected(old('beneficio') == 'S')>Sim</option>
                        <option value="N" @selected(old('beneficio') == 'N')>Não</option>
                    </select>
                    @if ($errors->has('beneficio'))
                        <div class="text-danger">
                            {{ $errors->first('beneficio') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-7">
                    <label for="beneficioQual" class="form-label">Se sim, qual(is)? <strong
                            class="text-info">(Opcional)</strong></label>
                    <input type="text" class="form-control" name="beneficioQual" id="beneficioQual"
                        value="{{ old('beneficioQual') ?? '' }}" maxlength="100">
                </div>

                <div class="co-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span><x-icon icon='exclamation-triangle' /></span><strong> Observação!</strong> O número do seu
                        Cartão Nacional de Saúde <strong>(CNS)</strong> pode
                        ser
                        obtido em uma unidade de saúde mais próxima de sua residência.<br>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="nomeAnimal" class="form-label">Nome do Animal <strong
                            class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('nomeAnimal') is-invalid @enderror"
                        name="nomeAnimal" id="nomeAnimal" value="{{ old('nomeAnimal') ?? '' }}" maxlength="100">
                    @error('nomeAnimal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="genero" class="form-label">Sexo <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="" selected>Selecione ...</option>
                        <option value="M" @selected(old('genero') == 'M')>Macho</option>
                        <option value="F" @selected(old('genero') == 'F')>Fêmea</option>
                    </select>
                    @if ($errors->has('genero'))
                        <div class="text-danger">
                            {{ $errors->first('genero') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-2">
                    <label for="porte" class="form-label">Porte <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="porte" name="porte">
                        <option value="" selected>Selecione ...</option>
                        <option value="pequeno" @selected(old('porte') == 'pequeno')>Pequeno</option>
                        <option value="medio" @selected(old('porte') == 'medio')>Médio</option>
                        <option value="grande" @selected(old('porte') == 'grande')>Grande</option>
                    </select>
                    @if ($errors->has('porte'))
                        <div class="text-danger">
                            {{ $errors->first('porte') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="idade" class="form-label">Idade do Animal <strong class="text-danger">(*)</strong>
                    </label>
                    <input type="number" class="form-control @error('idade') is-invalid @enderror" name="idade"
                        id="idade" value="{{ old('idade') ?? '' }}">
                    @error('idade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="idadeEm" class="form-label">Idade em <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="idadeEm" name="idadeEm">
                        <option value="" selected>Selecione ...</option>
                        <option value="mes" @selected(old('idadeEm') == 'mes')>Anos</option>
                        <option value="ano" @selected(old('idadeEm') == 'ano')>Meses</option>
                    </select>
                    @if ($errors->has('idadeEm'))
                        <div class="text-danger">
                            {{ $errors->first('idadeEm') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="cor" class="form-label">Cor(es) do Animal <strong
                            class="text-danger">(*)</strong></label>
                    <input type="text" class="form-control @error('cor') is-invalid @enderror" name="cor"
                        id="cor" value="{{ old('cor') ?? '' }}" maxlength="80">
                    @error('cor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="especie" class="form-label">Espécie <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="especie" name="especie">
                        <option value="" selected>Selecione ...</option>
                        <option value="felino" @selected(old('especie') == 'felino')>Felino</option>
                        <option value="canino" @selected(old('especie') == 'canino')>Canino</option>
                    </select>
                    @if ($errors->has('especie'))
                        <div class="text-danger">
                            {{ $errors->first('especie') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="raca_id" class="form-label">Raça <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="raca_id" name="raca_id">
                        <option value="" selected>Selecione ...</option>
                        @foreach ($racas as $raca)
                            <option value="{{ $raca->id }}" @selected(old('raca_id') == $raca->id)>
                                {{ $raca->nome }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('raca_id'))
                        <div class="text-danger">
                            {{ $errors->first('raca_id') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="procedencia" class="form-label">Origem <strong class="text-danger">(*)</strong></label>
                    <select class="form-select" id="procedencia" name="procedencia">
                        <option value="" selected>Selecione ...</option>
                        <option value="Vive na rua / comunitário" @selected(old('procedencia') == 'Vive na rua / comunitário')>Vive na rua / comunitário
                        </option>
                        <option value="Resgatado" @selected(old('procedencia') == 'Resgatado')>Resgatado</option>
                        <option value="Adotado" @selected(old('procedencia') == 'Adotado')>Adotado</option>
                        <option value="Comprado" @selected(old('Comprado') == 'canino')>Comprado</option>
                        <option value="ONG" @selected(old('procedencia') == 'ONG')>ONG</option>
                    </select>
                    @if ($errors->has('procedencia'))
                        <div class="text-danger">
                            {{ $errors->first('procedencia') }}
                        </div>
                    @endif
                </div>


                <div class="col-12">
                    <label for="criterios_e_e_prerequisitos_texto">Leia todos os critérios e pré-requisitos com
                        atenção!</label>
                    <textarea class="form-control" name="criterios_e_e_prerequisitos_texto" id="criterios_e_e_prerequisitos_texto"
                        rows="8" readonly disabled>{{ $texto }}</textarea>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="declaro" name="declaro">
                        <label class="form-check-label" for="declaro">
                            <strong>Declaro que li, aceito os termos e condições referentes ao cadastro para esterilização
                                de animais e que as informações declaradas neste formulário são verdadeiras.</strong>
                        </label>
                        @if ($errors->has('declaro'))
                            <div class="text-danger">
                                {{ $errors->first('declaro') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-lg"><x-icon icon='send-plus' />
                        Enviar Formulário</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container py-2">
        <p class="text-center bg-primary text-white">
            <strong>Documentos para baixar (download)</strong>
        </p>
    </div>

    <div class="container py-2">
        <ul>
            <li>
                <a href="{{ asset('docs/criterios_pre_rquisitos_para_esterilizaco_dos_animais.pdf') }}"
                    target="_blank">Critérios e pré-requisitos para o cadastro de esterilização</a>
            </li>
            <li>
                <a href="{{ asset('docs/termo_autorizacao_cirurgia.pdf') }}" target="_blank">Termo de
                    autorização para realização do procedimento</a>
            </li>
        </ul>
    </div>

    <div class="container py-2">
        <p class="text-center bg-primary text-white">
            <strong>Consultas</strong>
        </p>
    </div>

    <div class="container py-2">
        <ul>
            <li>
                <a href="{{ route('busca') }}">Formulário para Consulta de Pedidos</a>
            </li>
        </ul>
    </div>

    <div class="container py-2">
        <p class="text-center bg-primary text-white">
            <strong>Contatos</strong>
        </p>
    </div>

    <div class="container py-2 text-center">
        <a href="https://portal.contagem.mg.gov.br/" target="_blank">Prefeitura Municipal de Contagem</a><br>
        <strong>Centro de Controle de Zoonoses</strong><br>
        Telefones: 3351-3751 / 3361-7703<br>
        E-mail: cczcontagem@yahoo.com.br
    </div>
@endsection

@section('script-footer')
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#cel").inputmask({
                "mask": "(99) 99999-9999"
            });
            $("#tel").inputmask({
                "mask": "(99) 9999-9999"
            });
            $("#cep").inputmask({
                "mask": "99.999-999"
            });
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

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

@endsection
