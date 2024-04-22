<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Raca;
use App\Models\Situacao;
use App\Models\Param;
use App\Models\Pedido;

use App\Rules\Cpf; // validação de um cpf
use App\Rules\LegalAgeRule; // validação de idade
use App\Rules\MaxPedidosRule; // validação de quantidade de pedidos

use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index', [
            'situacaos' => Situacao::orderBy('nome', 'asc')->get(),
            'racas' => Raca::orderBy('nome')->get(),
            'texto' => Param::findorfail(2)->value,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cpf' => ['required', 'max:15', new Cpf, new MaxPedidosRule(3)],
            'nome' => 'required|max:80',
            'nascimento' => ['required', 'date_format:d/m/Y', new LegalAgeRule(18)],
            'logradouro' => 'required|max:100',
            'complemento' => 'max:100', // 'complemento is nullable
            'numero' => 'required|max:10',
            'bairro' => 'required|max:80',
            'cidade' => 'required|max:80',
            'uf' => 'required|max:2',
            'cep' => 'required|max:20',
            'email' => 'required|max:190|email',
            'cel' => 'required|max:20',
            'nomeAnimal' => 'required|max:100',
            'genero' => 'required|in:M,F',
            'porte' => 'required|in:pequeno,medio,grande',
            'idade' => 'required|integer',
            'idadeEm' => 'required|in:mes,ano',
            'cor' => 'required|max:80',
            'especie' => 'required|in:felino,canino',
            'procedencia' => 'required|max:100',
            'raca_id' => 'required|exists:racas,id|integer',
            'cns' => 'required|max:20',
            'beneficio' => 'required|max:100',
            'declaro' => 'accepted',
        ]);

        $request->merge(['situacao_id' => 1]); // em análise	

        $request->merge(['nascimento' => date('Y-m-d', strtotime(str_replace('/', '-', $request->nascimento)))]);

        $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);

        $newPedido = Pedido::create($request->all());

        $temp = pedido::findOrFail($newPedido->id);

        $texto = 'Pedido de castração do(a) ' . $temp->nomeAnimal . ' recebido com sucesso. Código: ' . $temp->codigo . '/' . $temp->ano;

        return redirect()->route('index')->with('message', $texto);
    }

    public function busca()
    {
        return view('busca');
    }

    public function busca_exec(Request $request)
    {

        $request->validate(
            [
                'cpf' => ['required', 'max:15', new Cpf],
                'nascimento' => ['required', 'date_format:d/m/Y'],
                'captcha' => ['required', 'captcha']

            ],
            [
                'captcha.required' => 'O campo código de verificação é obrigatório.',
                'captcha.captcha' => 'O código de verificação está incorreto.',
            ]
        );

        $request->merge(['nascimento' => date('Y-m-d', strtotime(str_replace('/', '-', $request->nascimento)))]);

        $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);

        $pedidos = Pedido::with('situacao')->where('cpf', $request->cpf)->where('nascimento', $request->nascimento)->get();

        return redirect()->route('busca', [
            'pedidos' => $pedidos
        ]);
    }

    public function search(Request $request)
    {

        # verify if request input nascimento and cpf is not empty
        if ($request->has('nascimento') && $request->has('cpf')) {

            $request->merge(['nascimento' => date('Y-m-d', strtotime(str_replace('/', '-', $request->nascimento)))]);

            $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);

            $pedidos = Pedido::with('situacao')->where('cpf', $request->cpf)->where('nascimento', $request->nascimento)->get();

            // Return the resluts 
            return view('busca', compact('pedidos'));
        } else {
            return view('busca', ['pedidos' => []]);
        }
    }
}
