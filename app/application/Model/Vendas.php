<?php

namespace SmartSolucoes\Model;

use PDO;
use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class Vendas extends Model
{

    /**
     * Cadastrar Venda
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $sql = "INSERT INTO vendas (cliente_id, vendedor_id, fotografo_id, valor, meio_pagamento, engajamento, clausulas) 

        VALUES (:cliente_id, :vendedor_id, :fotografo_id, :valor, :meio_pagamento, :engajamento, :clausulas)";

        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':cliente_id', $data['vnd_cliente'], PDO::PARAM_INT);
        $query->bindValue(':vendedor_id', $data['vnd_vendedor'], PDO::PARAM_INT);
        $query->bindValue(':fotografo_id', $data['vnd_fotografo'], PDO::PARAM_INT);
        $query->bindValue(':valor', $data['vnd_contrato_price']);
        $query->bindValue(':meio_pagamento', $data['vnd_pagamento'], PDO::PARAM_STR);
        $query->bindValue(':engajamento', $data['vnd_engajamento']);
        $query->bindValue(':clausulas', $data['vnd_clausula']);

        $query->execute();

        return $this->PDO()->lastInsertId();
    }

    /**
     * Cadastrar Items
     *
     * @param array $data
     * @return void
     */
    public function createItems(array $data)
    {
        $sql = "INSERT INTO venda_items (venda_id, produto_id) 

        VALUES (:venda_id, :produto_id)";

        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':venda_id', $data['venda_id'], PDO::PARAM_INT);
        $query->bindValue(':produto_id', $data['produto_id'], PDO::PARAM_INT);

        $query->execute();

        return 'ok';
    }

    public function readAll()
    {
        $sql = "SELECT vnd.*, vnd.id as vnd_id, vnd.data as vnd_data, u.nome as vendedor, u2.nome as fotografo, cl.cliente_nome FROM vendas vnd INNER JOIN user u ON (vnd.vendedor_id = u.id) INNER JOIN user u2 ON (vnd.fotografo_id = u2.id) INNER JOIN clientes cl ON (vnd.cliente_id = cl.id) ORDER By u.nome";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readVendedores($vendedor)
    {
        $sql = "SELECT vnd.*, vnd.id as vnd_id, vnd.data as vnd_data, u.nome as vendedor, u2.nome as fotografo, cl.cliente_nome FROM vendas vnd INNER JOIN user u ON (vnd.vendedor_id = u.id) INNER JOIN user u2 ON (vnd.fotografo_id = u2.id) INNER JOIN clientes cl ON (vnd.cliente_id = cl.id) WHERE cl.vendedor = :vendedor ORDER By u.nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $vendedor, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readSupervisor($supervisor)
    {
        $sql = "SELECT vnd.*, vnd.id as vnd_id, vnd.data as vnd_data, u.nome as vendedor, u2.nome as fotografo, u.supervisor, cl.cliente_nome FROM vendas vnd INNER JOIN user u ON (vnd.vendedor_id = u.id) INNER JOIN user u2 ON (vnd.fotografo_id = u2.id) INNER JOIN clientes cl ON (vnd.cliente_id = cl.id) WHERE u.supervisor = :supervisor ORDER By u.nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':supervisor', $supervisor, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readVenda($vendaid)
    {
        $sql = "SELECT vnd.*, vnd.id as vnd_id, vnd.data as vnd_data, u.nome as vendedor, u2.nome as fotografo, cl.cliente_nome FROM vendas vnd INNER JOIN user u ON (vnd.vendedor_id = u.id) INNER JOIN user u2 ON (vnd.fotografo_id = u2.id) INNER JOIN clientes cl ON (vnd.cliente_id = cl.id) WHERE vnd.id = :venda_id ORDER By u.nome";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':venda_id', $vendaid, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function readItems($vendaid)
    {
        $sql = "SELECT vnd_i.*, pdt.produto FROM venda_items vnd_i INNER JOIN produtos pdt ON (vnd_i.produto_id = pdt.id)  WHERE vnd_i.venda_id = :venda_id ORDER BY pdt.produto";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':venda_id', $vendaid, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(array $data)
    {
        $sql = "UPDATE vendas SET cliente_id = :cliente_id, vendedor_id = :vendedor_id, fotografo_id = :fotografo_id, valor = :valor, meio_pagamento = :meio_pagamento, engajamento = :engajamento, clausulas = :clausulas WHERE id = :id";

        $query = $this->PDO()->prepare($sql);

        $query->bindValue(':cliente_id', $data['vnd_cliente'], PDO::PARAM_INT);
        $query->bindValue(':vendedor_id', $data['vnd_vendedor'], PDO::PARAM_INT);
        $query->bindValue(':fotografo_id', $data['vnd_fotografo'], PDO::PARAM_INT);
        $query->bindValue(':valor', $data['vnd_contrato_price']);
        $query->bindValue(':meio_pagamento', $data['vnd_pagamento'], PDO::PARAM_STR);
        $query->bindValue(':engajamento', $data['vnd_engajamento']);
        $query->bindValue(':clausulas', $data['vnd_clausula']);
        $query->bindValue(':id', $data['vnd_id'], PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }

    public function updateItems(array $data)
    {

        $valida = $this->PDO()->prepare("SELECT produto_id FROM venda_items WHERE venda_id = :venda_id AND produto_id = :produto_id");
        $valida->bindValue(':venda_id', $data['venda_id'], PDO::PARAM_INT);
        $valida->bindValue(':produto_id', $data['produto_id'], PDO::PARAM_INT);
        $valida->execute();
        if ($valida->rowCount() > 0) {
            $sql = "DELETE FROM venda_items WHERE venda_id = :id";
            $query = $this->PDO()->prepare($sql);
            $query->bindValue(':id', $data['venda_id'], PDO::PARAM_INT);
            $query->execute();
        }
        $this->createItems($data);

        return 'ok';
    }

    public function delete($vendaid)
    {

        $sql = "DELETE FROM venda_items WHERE venda_id = :id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':id', $vendaid, PDO::PARAM_INT);
        $query->execute();

        $sql = "DELETE FROM vendas WHERE id = :id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':id', $vendaid, PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }
}
