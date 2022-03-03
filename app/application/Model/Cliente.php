<?php

namespace SmartSolucoes\Model;

use PDO;
use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class Cliente extends Model
{

    /**
     * Cadastrar cliente
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $sql = "INSERT INTO clientes (vendedor, cliente_nome, cliente_email, cliente_celular1,cliente_celular2,cliente_cpf,cliente_nascimento,cliente_obs,empresa_fantasia,empresa_cnpj,empresa_email,empresa_telefone,empresa_categoria,empresa_pagina,empresa_cep,empresa_rua,empresa_numero,empresa_bairro,empresa_complemento,empresa_cidade_estado,empresa_obs) 

        VALUES (:vendedor, :cliente_nome, :cliente_email,:cliente_celular1,:cliente_celular2,:cliente_cpf,:cliente_nascimento,:cliente_obs, :empresa_fantasia, :empresa_cnpj, :empresa_email, :empresa_telefone, :empresa_categoria, :empresa_pagina, :empresa_cep, :empresa_rua, :empresa_numero, :empresa_bairro, :empresa_complemento, :empresa_cidade_estado, :empresa_obs)";

        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $data['cl_vendedor'], PDO::PARAM_STR);
        $query->bindValue(':cliente_nome', $data['cl_nome'], PDO::PARAM_STR);
        $query->bindValue(':cliente_email', $data['cl_email'], PDO::PARAM_STR);
        $query->bindValue(':cliente_celular1', $data['cl_celular'], PDO::PARAM_STR);
        $query->bindValue(':cliente_celular2', $data['cl_celular_op'], PDO::PARAM_STR);
        $query->bindValue(':cliente_cpf', $data['cl_cpf'], PDO::PARAM_STR);
        $query->bindValue(':cliente_nascimento', $data['cl_data_nascimento'], PDO::PARAM_STR);
        $query->bindValue(':cliente_obs', $data['cl_observacao'], PDO::PARAM_STR);
        $query->bindValue(':empresa_fantasia', $data['cl_nome_fantasia'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cnpj', $data['cl_cnpj'], PDO::PARAM_STR);
        $query->bindValue(':empresa_email', $data['cl_email_comercial'], PDO::PARAM_STR);
        $query->bindValue(':empresa_telefone', $data['cl_telefone_comercial'], PDO::PARAM_STR);
        $query->bindValue(':empresa_categoria', $data['cl_categoria'], PDO::PARAM_STR);
        $query->bindValue(':empresa_pagina', $data['cl_google_page'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cep', $data['cl_cep'], PDO::PARAM_STR);
        $query->bindValue(':empresa_rua', $data['cl_rua'], PDO::PARAM_STR);
        $query->bindValue(':empresa_numero', $data['cl_numero'], PDO::PARAM_STR);
        $query->bindValue(':empresa_bairro', $data['cl_bairro'], PDO::PARAM_STR);
        $query->bindValue(':empresa_complemento', $data['cl_complemento'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cidade_estado', $data['cl_cidade_estado'], PDO::PARAM_STR);
        $query->bindValue(':empresa_obs', $data['cl_observacao_empresa'], PDO::PARAM_STR);
        $query->execute();


        return 'ok';
    }

    public function readAll()
    {
        $sql = "SELECT * FROM clientes ORDER BY cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Exibe todos os clientes cadastrados
     *
     * @return void
     */
    public function readClienteVendedor($vendedor)
    {
        $sql = "SELECT * FROM clientes WHERE vendedor = :vendedor ORDER BY cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $vendedor, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readCliente($clienteid)
    {
        $sql = "SELECT * FROM clientes WHERE id = :clienteid";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':clienteid', $clienteid, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data)
    {
        $sql = "UPDATE clientes SET vendedor = :vendedor, cliente_nome = :cliente_nome, cliente_email = :cliente_email, cliente_celular1 = :cliente_celular1 ,cliente_celular2 = :cliente_celular2, cliente_cpf = :cliente_cpf,cliente_nascimento = :cliente_nascimento,cliente_obs = :cliente_obs,empresa_fantasia = :empresa_fantasia,empresa_cnpj = :empresa_cnpj,empresa_email = :empresa_email,empresa_telefone = :empresa_telefone,empresa_categoria = :empresa_categoria,empresa_pagina = :empresa_pagina,empresa_cep = :empresa_cep,empresa_rua = :empresa_rua,empresa_numero = :empresa_numero,empresa_bairro = :empresa_bairro,empresa_complemento = :empresa_complemento,empresa_cidade_estado = :empresa_cidade_estado,empresa_obs = :empresa_obs WHERE id = :id";

        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $data['cl_vendedor'], PDO::PARAM_STR);
        $query->bindValue(':cliente_nome', $data['cl_nome'], PDO::PARAM_STR);
        $query->bindValue(':cliente_email', $data['cl_email'], PDO::PARAM_STR);
        $query->bindValue(':cliente_celular1', $data['cl_celular'], PDO::PARAM_STR);
        $query->bindValue(':cliente_celular2', $data['cl_celular_op'], PDO::PARAM_STR);
        $query->bindValue(':cliente_cpf', $data['cl_cpf'], PDO::PARAM_STR);
        $query->bindValue(':cliente_nascimento', $data['cl_data_nascimento'], PDO::PARAM_STR);
        $query->bindValue(':cliente_obs', $data['cl_observacao'], PDO::PARAM_STR);
        $query->bindValue(':empresa_fantasia', $data['cl_nome_fantasia'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cnpj', $data['cl_cnpj'], PDO::PARAM_STR);
        $query->bindValue(':empresa_email', $data['cl_email_comercial'], PDO::PARAM_STR);
        $query->bindValue(':empresa_telefone', $data['cl_telefone_comercial'], PDO::PARAM_STR);
        $query->bindValue(':empresa_categoria', $data['cl_categoria'], PDO::PARAM_STR);
        $query->bindValue(':empresa_pagina', $data['cl_google_page'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cep', $data['cl_cep'], PDO::PARAM_STR);
        $query->bindValue(':empresa_rua', $data['cl_rua'], PDO::PARAM_STR);
        $query->bindValue(':empresa_numero', $data['cl_numero'], PDO::PARAM_STR);
        $query->bindValue(':empresa_bairro', $data['cl_bairro'], PDO::PARAM_STR);
        $query->bindValue(':empresa_complemento', $data['cl_complemento'], PDO::PARAM_STR);
        $query->bindValue(':empresa_cidade_estado', $data['cl_cidade_estado'], PDO::PARAM_STR);
        $query->bindValue(':empresa_obs', $data['cl_observacao_empresa'], PDO::PARAM_STR);
        $query->bindValue(':id', $data['cl_cliente_id'], PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }

    public function delete($clienteid)
    {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':id', $clienteid, PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }
}
