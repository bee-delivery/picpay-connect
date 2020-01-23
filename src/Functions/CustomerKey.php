<?php

namespace BeeDelivery\PicPayConnect\Functions;

use BeeDelivery\PicPayConnect\Connection;
use BeeDelivery\PicPayConnect\Models\Address;
use BeeDelivery\PicPayConnect\Models\Card;
use BeeDelivery\PicPayConnect\Models\Customer;
use BeeDelivery\PicPayConnect\Models\Risk;
use BeeDelivery\PicPayConnect\Models\Split;

class CustomerKey
{

    public $http;

    public function __construct($customer_id)
    {
        $this->http = new Connection($customer_id);
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Salva ou atualiza as informações cadastrais associadas a um "customer"
     * registrado (via /register) por sua aplicação. Obrigatório enviar estas informações antes de
     * realizar uma chamada ao método "transaction". Obs.: uma vez validados em nossa
     * plataforma, cpf e birth_date de um "customer" não poderão ser atualizados.
     *
     * @param Customer $customer
     * @return Array
     */
    public function customer(Customer $customer)
    {
        $params = [
            'customer' => $customer->toObject()
        ];

        return $this->http->post('/customer', ['json' => $params]);
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Caso um ‘customer’ opte por realizar transações dentro de seu aplicativo
     * utilizando as informações e meios de pagamento cadastrados em uma conta PicPay, é
     * preciso realizar um processo de autorização para associar o ‘customer’ registrado por sua
     * aplicação a uma conta PicPay. Este processo se dará por meio da autenticação do usuário
     * PicPay via browser. Para dar inicio à autorização, seu aplicativo deve requisitar este método
     * e abrir uma nova janela no navegador padrão do dispositivo do usuário, direcionando-o para
     * a url que será retornada. Quando o usuário terminar o processo (que pode resultar na
     * autorização ou recusa de associação), iremos redirecioná-lo de volta para sua aplicação,
     * para a tela/link de retorno que deverá estar previamente cadastrado no painel de controle
     * do PicPay.
     *
     * @return Array
     */
    public function authLink()
    {
        return $this->http->get('/authlink');
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição) e
     * com associação (“link”) a conta PicPay válida.
     * 
     * Obtém informações do usuário PicPay que associou sua conta a um “customer”
     * registrado por sua aplicação.
     *
     * @return Array
     */
    public function picpayUserData()
    {
        return $this->http->get('/picpayuserdata');
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Salva um cartão de crédito associado a um "customer" registrado por sua
     * aplicação.
     *
     * @param Card $card
     * @return Array
     */
    public function card(Card $card)
    {
        $params = [
            'card' => $card->toObject()
        ];
        
        return $this->http->post('/card', ['json' => $params]);
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Remove um cartão de crédito associado a um "customer" registrado por sua
     * aplicação.
     *
     * @param string $id
     * @return Array
     */
    public function deleteCard($id)
    {
        $params = [
            'card' => (object) ['id' => $id]
        ];

        return $this->http->post('/deletecard', ['json' => $params]);
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Obtem lista de cartões de crédito associados a um "customer" registrado por sua
     * aplicação.
     *
     * @return Array
     */
    public function cards() 
    {
        return $this->http->get('/cards');
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Realiza uma transação para um "customer" registrado por sua aplicação,
     * utilizando fundos de um cartão de crédito previamente cadastrado ou não, ou da carteira
     * PicPay de um usuário que autorizou o ‘link’ com seu aplicativo.
     *
     * @param string $value
     * @param Card|string $source
     * @param bool $save_card
     * @param string $shippingName
     * @param string $shippingEmail
     * @param string $shippingCpf
     * @param Address $shippingAddress
     * @param array $products
     * @param Split $split
     * @param string $value_shipping
     * @param string $id_internal
     * @param Risk $risk
     * @return Array
     */
    public function transaction($value, $source, bool $save_card = null, $shippingName = null, $shippingEmail = null, $shippingCpf = null, Address $shippingAddress = null, array $products = null, Split $split = null, $value_shipping = null, $id_internal = null, Risk $risk = null) 
    {
        $productsFormatted = [];

        if ($products)
            foreach ($products as $p)
                $productsFormatted [] = $p->toObject();

        $params = [
            'value'             => $value,
            'source'            => $source instanceof Card? $source->toObject() : $source,
            'save_card'         => $save_card,
            'shipping'          => (object) [
                'name'          => $shippingName,
                'email'         => $shippingEmail,
                'cpf'           => $shippingCpf,
                'address'       => $shippingAddress? $shippingAddress->toObject() : null,
            ],
            'products'          => $productsFormatted,
            'split'             => $split? $split->toObject() : null,
            'value_shipping'    => $value_shipping,
            'id_internal'       => $id_internal,
            'risk'              => $risk? $risk->toObject() : null,
        ];
        
        return $this->http->post('/transaction', ['json' => $params]);
    }

    /**
     * Escopo: Usuários registrados (requer envio de "customer_key" em header da requisição).
     * 
     * Realiza o cancelamento de uma transação para um "customer" registrado por
     * sua aplicação, desde que dentro do período permitido. Após 2 dias o token para
     * cancelamento expira.
     *
     * @param string $id
     * @param string $cancel_token
     * @return Array
     */
    public function cancelTransaction($id, $cancel_token) 
    {
        $params = [
            'id' => $id, 
            'cancel_token' => $cancel_token
        ];

        return $this->http->post('/canceltransaction', ['json' => $params]);
    }
}