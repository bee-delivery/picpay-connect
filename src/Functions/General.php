<?php

namespace BeeDelivery\PicPayConnect\Functions;

use BeeDelivery\PicPayConnect\Connection;

class General
{

    public $http;

    public function __construct()
    {
        $this->http = new Connection();
    }

    /**
     * Escopo: Qualquer usuário
     * 
     * Para cada usuário de sua aplicação, este método deve ser chamado uma única
     * vez, antes de sua primeira interação com a API PicPay, relacionada a este usuário. Serão
     * criadas e retornadas as credenciais de seu usuário (o qual chamaremos de “Customer”),
     * que serão necessárias para identificá-lo em nossa plataforma, sendo “id” uma string para
     * referenciar o mesmo nos métodos GET ou POST que requerem este atributo, e
     * “customer_key” uma chave (que deve ser mantida privada) para autenticar todas as
     * requisições que acessam ou enviem informações em favor deste usuário.
     *
     * @return Array
     */
    public function register()
    {
        return $this->http->get('/register');
    }

    /**
     * Escopo: Qualquer usuário
     * 
     * Realiza a transferência de valores entre a conta Picpay de sua aplicação e a
     * conta Picpay de um "customer".
     *
     * @param string $value
     * @param string $destination "customer.id" ou "email@customer.com"
     * @return Array
     */
    public function transfer($value, $destination) 
    {
        $params = [
            'value' => $value, 
            'destination' => $destination
        ];

        return $this->http->post('/transfer', ['json' => $params]);
    }

    /**
     * Escopo: Qualquer usuário
     * 
     * Cancela uma transferência de valores entre a conta Picpay de sua aplicação e a
     * conta Picpay de um "customer". Operação possível apenas enquanto transferência estiver
     * pendente.
     *
     * @param string $id
     * @return Array
     */
    public function voidTransfer($id) 
    {
        $params = [
            'id' => $id
        ];

        return $this->http->post('/voidTransfer', ['json' => $params]);
    }

    /**
     * Escopo: Qualquer um.
     * 
     * Obtém lista de estabelecimentos afiliados do marketplace.
     *
     * @return Array
     */
    public function afilliates() 
    {
        return $this->http->get('/affiliates');
    }

    /**
     * Escopo: Qualquer um.
     * 
     * Retorna o saldo da conta picpay associada ao client_id / api_key utilizado na
     * requisição.
     *
     * @return Array
     */
    public function getBalance() 
    {
        return $this->http->get('/balance');
    }
}