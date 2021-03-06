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
        $sql = "INSERT INTO clientes (vendedor, cliente_nome, cliente_email, cliente_celular1,cliente_celular2,cliente_cpf,cliente_nascimento,cliente_obs,empresa_fantasia,empresa_cnpj, empresa_use_cpf,empresa_email,empresa_telefone,empresa_categoria,empresa_pagina,empresa_cep,empresa_rua,empresa_numero,empresa_bairro,empresa_complemento,empresa_cidade_estado,empresa_obs, seg_ini, seg_end, ter_ini, ter_end, qua_ini, qua_end, qui_ini, qui_end, sex_ini, sex_end, sab_ini, sab_end, dom_ini, dom_end) 

        VALUES (:vendedor, :cliente_nome, :cliente_email,:cliente_celular1,:cliente_celular2,:cliente_cpf,:cliente_nascimento,:cliente_obs, :empresa_fantasia, :empresa_cnpj, :empresa_use_cpf, :empresa_email, :empresa_telefone, :empresa_categoria, :empresa_pagina, :empresa_cep, :empresa_rua, :empresa_numero, :empresa_bairro, :empresa_complemento, :empresa_cidade_estado, :empresa_obs, :seg_ini, :seg_end, :ter_ini, :ter_end, :qua_ini, :qua_end, :qui_ini, :qui_end, :sex_ini, :sex_end, :sab_ini, :sab_end, :dom_ini, :dom_end)";

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
        $query->bindValue(':empresa_use_cpf', $data['empresa_use_cpf'], PDO::PARAM_STR);
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
        $query->bindValue(':seg_ini', $data['seg_ini'], PDO::PARAM_STR);
        $query->bindValue(':seg_end', $data['seg_end'], PDO::PARAM_STR);
        $query->bindValue(':ter_ini', $data['ter_ini'], PDO::PARAM_STR);
        $query->bindValue(':ter_end', $data['ter_end'], PDO::PARAM_STR);
        $query->bindValue(':qua_ini', $data['qua_ini'], PDO::PARAM_STR);
        $query->bindValue(':qua_end', $data['qua_end'], PDO::PARAM_STR);
        $query->bindValue(':qui_ini', $data['qui_ini'], PDO::PARAM_STR);
        $query->bindValue(':qui_end', $data['qui_end'], PDO::PARAM_STR);
        $query->bindValue(':sex_ini', $data['sex_ini'], PDO::PARAM_STR);
        $query->bindValue(':sex_end', $data['sex_end'], PDO::PARAM_STR);
        $query->bindValue(':sab_ini', $data['sab_ini'], PDO::PARAM_STR);
        $query->bindValue(':sab_end', $data['sab_end'], PDO::PARAM_STR);
        $query->bindValue(':dom_ini', $data['dom_ini'], PDO::PARAM_STR);
        $query->bindValue(':dom_end', $data['dom_end'], PDO::PARAM_STR);

        $query->execute();

        return $this->PDO()->lastInsertId();
    }

    public function readAll()
    {
        $sql = "SELECT cl.*, cl.id as clienteid FROM clientes cl ORDER BY cl.cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readLikeCliente($texto)
    {
        $sql = "SELECT cl.*, cl.id as clienteid FROM clientes cl WHERE cl.cliente_nome LIKE :texto ORDER BY cl.cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':texto', "%$texto%", PDO::PARAM_STR);
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
        $sql = "SELECT cl.*, cl.id as clienteid FROM clientes cl WHERE cl.vendedor = :vendedor ORDER BY cl.cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $vendedor, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Exibe todos os clientes cadastrados
     *
     * @return void
     */
    public function readClienteVendedorSup($vendedor)
    {
        $sql = "SELECT cl.*, cl.id as clienteid, u.supervisor FROM clientes cl INNER JOIN user u ON (cl.vendedor = u.nome) WHERE u.id = :vendedor ORDER BY cl.cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $vendedor, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Exibe todos os clientes cadastrados
     *
     * @return void
     */
    public function readClienteSupervisor($supervisor)
    {
        $sql = "SELECT cl.*, cl.id as clienteid, us.* FROM clientes cl INNER JOIN user us ON (us.nome = cl.vendedor) WHERE us.supervisor = :supervisor ORDER BY cl.cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':supervisor', $supervisor, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readCliente($cliente)
    {
        $sql = "SELECT * FROM clientes WHERE id = :clienteid OR cliente_nome = :cliente_nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':clienteid', $cliente, PDO::PARAM_INT);
        $query->bindValue(':cliente_nome', $cliente, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data)
    {
        $sql = "UPDATE clientes SET vendedor = :vendedor, cliente_nome = :cliente_nome, cliente_email = :cliente_email, cliente_celular1 = :cliente_celular1 ,cliente_celular2 = :cliente_celular2, cliente_cpf = :cliente_cpf,cliente_nascimento = :cliente_nascimento,cliente_obs = :cliente_obs,empresa_fantasia = :empresa_fantasia,empresa_cnpj = :empresa_cnpj, empresa_use_cpf = :empresa_use_cpf, empresa_email = :empresa_email,empresa_telefone = :empresa_telefone,empresa_categoria = :empresa_categoria,empresa_pagina = :empresa_pagina,empresa_cep = :empresa_cep,empresa_rua = :empresa_rua,empresa_numero = :empresa_numero,empresa_bairro = :empresa_bairro,empresa_complemento = :empresa_complemento,empresa_cidade_estado = :empresa_cidade_estado,empresa_obs = :empresa_obs, seg_ini = :seg_ini, seg_end = :seg_end, ter_ini = :ter_ini, ter_end = :ter_end, qua_ini = :qua_ini, qua_end = :qua_end, qui_ini = :qui_ini, qui_end = :qui_end, sex_ini = :sex_ini, sex_end = :sex_end, sab_ini = :sab_ini, sab_end = :sab_end, dom_ini = :dom_ini, dom_end = :dom_end WHERE id = :id";

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
        $query->bindValue(':empresa_use_cpf', $data['empresa_use_cpf'], PDO::PARAM_STR);
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
        $query->bindValue(':seg_ini', $data['seg_ini'], PDO::PARAM_STR);
        $query->bindValue(':seg_end', $data['seg_end'], PDO::PARAM_STR);
        $query->bindValue(':ter_ini', $data['ter_ini'], PDO::PARAM_STR);
        $query->bindValue(':ter_end', $data['ter_end'], PDO::PARAM_STR);
        $query->bindValue(':qua_ini', $data['qua_ini'], PDO::PARAM_STR);
        $query->bindValue(':qua_end', $data['qua_end'], PDO::PARAM_STR);
        $query->bindValue(':qui_ini', $data['qui_ini'], PDO::PARAM_STR);
        $query->bindValue(':qui_end', $data['qui_end'], PDO::PARAM_STR);
        $query->bindValue(':sex_ini', $data['sex_ini'], PDO::PARAM_STR);
        $query->bindValue(':sex_end', $data['sex_end'], PDO::PARAM_STR);
        $query->bindValue(':sab_ini', $data['sab_ini'], PDO::PARAM_STR);
        $query->bindValue(':sab_end', $data['sab_end'], PDO::PARAM_STR);
        $query->bindValue(':dom_ini', $data['dom_ini'], PDO::PARAM_STR);
        $query->bindValue(':dom_end', $data['dom_end'], PDO::PARAM_STR);
        $query->bindValue(':id', $data['cl_cliente_id'], PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }

    public function updateVendedor(array $data)
    {
        $valida = $this->PDO()->prepare("SELECT vendedor FROM clientes WHERE id = :id");
        $valida->bindValue(':id', $data['vnd_cliente'], PDO::PARAM_INT);
        $valida->execute();

        $vendedor = $valida->fetch(PDO::FETCH_ASSOC);
        if ($vendedor['vendedor'] != $data['vendedor_nome']) {
            $sql = "UPDATE clientes SET vendedor = :vendedor WHERE id = :id";

            $query = $this->PDO()->prepare($sql);
            $query->bindValue(':vendedor', $data['vendedor_nome'], PDO::PARAM_STR);
            $query->bindValue(':id', $data['vnd_cliente'], PDO::PARAM_INT);
            $query->execute();
        }
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
