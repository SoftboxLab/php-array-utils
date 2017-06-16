<?php

namespace ArrayUtils;


class ValidatorTest extends \PHPUnit_Framework_TestCase  {

    public function testArray() {
        $validator = new Validator();
        $validator
            ->addRules([
                "*.id" => "required|numeric",
                "*.ok" => "required|boolean",
            ])
            ->addRule("*.msg", "present");

        $this->assertEmpty($validator->validate([["id" => "1", "ok" => false, "msg" => null]]));
        $this->assertEmpty($validator->validate([["id" => 1, "ok" => true, "msg" => ""]]));
        $this->assertEmpty($validator->validate([["id" => 1, "ok" => true, "msg" => "Err"]]));
        $this->assertEmpty($validator->validate([]));

        $this->assertNotEmpty($validator->validate([["id" => null, "ok" => true, "msg" => "Err"]]));
        $this->assertNotEmpty($validator->validate([["ok" => true, "msg" => "Err"]]));
        $this->assertNotEmpty($validator->validate([["id" => 1, "ok" => true]]));
        $this->assertNotEmpty($validator->validate(["id" => 1, "ok" => true, "msg" => "Err"]));
        $this->assertNotEmpty($validator->validate(null));
    }

    public function testJSON() {
        $json = '{
          "id": "49",
          "id_parceiro_loja": "3",
          "id_parceiro": "3",
          "id_unidade_negocio": "236",
          "id_loja_status": "1",
          "nome_loja": "Loja Pernambucanas",
          "logomarca": "3b6e84fdcc5fad72fb55fed8d797fb34.png",
          "historia_marca": null,
          "politica_frete": null,
          "politica_trocadevolucao": null,
          "usuario_token": null,
          "senha_token": null,
          "secret_token": null,
          "telefone_comercial": "11325874556",
          "site": "http:\/\/pernambucanas.com.br",
          "email_contato": null,
          "soma_prazo_entrega": "0",
          "url_frete": "http:\/\/pernambucanas.com.br\/frete",
          "tipo_frete": "1",
          "estoque_minimo": "0",
          "ativa_promocao": "0",
          "status_online": "1",
          "data_criacao": "2017-05-20 11:31:01",
          "id_usuario_criacao": "9",
          "data_alteracao": "2017-06-13 16:44:08",
          "id_usuario_alteracao": "9",
          "id_usuario_alteracao_dados": "9",
          "data_alteracao_dados": "2017-05-20 11:31:46",
          "id_usuario_validacao": "9",
          "data_validacao": "2017-05-20 11:31:17",
          "id_usuario_aprovacao": "9",
          "data_aprovacao": "2017-05-20 11:31:31",
          "comissao": "12.00",
          "ind_permite_produto_sem_ean": "1",
          "codigo_loja": "3",
          "margem_reducao_preco": null,
          "email_comercial": "comercial@pernambucanas1.br",
          "contato_comercial": "Comercial",
          "cnpj": "61099834000190",
          "razao_social": "Pernambucanas",
          "cep": "38400600",
          "logradouro": null,
          "numero": "850",
          "complemento": null,
          "bairro": "Nossa Senhora Aparecida",
          "cidade": null,
          "estado": "MG",
          "prazo_agendamento_minimo": null,
          "prazo_agendamento_maximo": null,
          "unidade_negocio_integracao": [
            "1"
          ]
        }';

        $validator = new Validator();
        $validator->addRules(array(
            "id_parceiro_loja"             => "numeric",
            "id_parceiro"                  => "numeric",
            "id_unidade_negocio"           => "numeric",
            "nome_loja"                    => "string",
            "logomarca"                    => "string",
            "historia_marca"               => "present",
            "politica_frete"               => "present",
            "politica_trocadevolucao"      => "present",
            "telefone_comercial"           => "string",
            "site"                         => "string",
            "email_comercial"              => "present",
            "ativa_promocao"               => "in:0,1",
            "status_online"                => "in:0,1",
            "cnpj"                         => "numeric",
            "razao_social"                 => "string",
            "cep"                          => "numeric",
            "logradouro"                   => "string:nullable",
            "numero"                       => "string",
            "complemento"                  => "present",
            "bairro"                       => "string:nullable",
            "cidade"                       => "string:nullable",
            "estado"                       => "string",
            "comissao"                     => "numeric",
            "prazo_agendamento_minimo"     => "numeric:nullable",
            "prazo_agendamento_maximo"     => "numeric:nullable",
            "unidade_negocio_integracao.*" => "numeric"
        ));

        $fails = $validator->validate(json_decode($json, true));

        $this->assertEmpty($fails, implode(PHP_EOL, $fails));
    }

    public function atestValidator() {
        //Loader::load(Validator::class);

        $validator = new Validator();
        $validator
            //->addRule('c', 'required')
            //->addRule('a.b.c', 'required')
            //->addRule('d.e', 'required')
            //->addRule('f.x.*', 'numeric')
            //->addRule('w.x.*.a', 'required|numeric|max:5')
            //->addRule('y.*.a', 'required|numeric|max:5')
            //->addRule('*', 'required|numeric|max:5')
            ->addRule("a.b.*.c", 'present|required')
        ;

        $valores = [];

        for ($i = 0; $i < 10; $i++) {
            //$valores[] = ["a" => $i];
            $valores[] = $i;
        }

        //$ret = $validator->validate([
        //    'c' => 10,
        //    'a' => ['b' => 1],
        //    'd' => ['e' => []],
        //    'f' => ['x' => [1, 2, 3, '23x']],
        //    'w' => ['x' => [["a" => "1"], ["a" => "1"], ["a" => "20"]]],
        //    'y' => $valores
        //]);
        //$ret = $validator->validate($valores);

        $ret = $validator->validate(["a" => ["b" => [["c" => null]]]]);

        print_r($ret);

        $this->assertTrue(empty($ret));
    }
}
