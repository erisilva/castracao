<?php

namespace App\Rules;

use App\Models\Pedido;

use Illuminate\Contracts\Validation\Rule;

class MaxPedidosRule implements Rule
{
    public $totalPedidosMax = 3;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($total)
    {
        $this->totalPedidosMax = $total;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);
        (int) $total_pedidos_sql = Pedido::whereIn('situacao_id', [1, 3, 5])
            ->where('cpf', $cpf)
            ->count();
        (int) $temp = $this->totalPedidosMax;

        //dd($total_pedidos_sql . ' <= ' . $temp);
        /*
            problema de lógica       
         0 <= 3   primeiro cadastro
        "1 <= 3" segundo cadastro
        "2 <= 3" terceiro cadastro
        "3 <= 3" quarto cadastro () erro fica aqui, por isso tem de ser menor apenas
        */

        return ((int)$total_pedidos_sql) < ((int)$temp);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Você só pode ter  ' . $this->totalPedidosMax . ' pedidos cadastrado!';
    }
}