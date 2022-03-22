<?php

namespace SmartSolucoes\Model;

use SmartSolucoes\Core\Model;
use PDO;

class Propostas extends Model
{

    public function create(array $data)
    {
        $sql = "INSERT INTO propostas (cliente, email, vendedor_id, valor) VALUES (:cliente, :email, :vendedor_id, :valor)";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':cliente', $data['cliente'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':vendedor_id', $data['vendedor'], PDO::PARAM_INT);
        $query->bindValue(':valor', $data['valor']);
        $query->execute();

        return $this->PDO()->lastInsertId();
    }

    public function createItems(array $data)
    {
        $sql = "INSERT INTO proposta_items (item_id, proposta_id) VALUES (:item_id, :proposta_id)";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':item_id', $data['item_id'], PDO::PARAM_INT);
        $query->bindValue(':proposta_id', $data['proposta_id'], PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }

    public function read()
    {
        $sql = "SELECT ppt.id, ppt.cliente, ppt.email, ppt.vendedor_id, ppt.valor, ppt.data, u.nome, u.celular FROM propostas ppt INNER JOIN user u ON (ppt.vendedor_id = u.id) ORDER BY cliente";
        $query = $this->PDO()->prepare($sql);        
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readSupervisor($nome)
    {
        $sql = "SELECT ppt.id, ppt.cliente, ppt.email, ppt.vendedor_id, ppt.valor, ppt.data, u.nome, u.celular, u.supervisor FROM propostas ppt INNER JOIN user u ON (ppt.vendedor_id = u.id) WHERE u.supervisor = :nome ORDER BY cliente";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':nome', $nome, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readVendedor($vendedor)
    {
        $sql = "SELECT ppt.id, ppt.cliente, ppt.email, ppt.vendedor_id, ppt.valor, ppt.data, u.nome, u.celular, u.supervisor FROM propostas ppt INNER JOIN user u ON (ppt.vendedor_id = u.id) WHERE ppt.vendedor_id = :vendedor ORDER BY cliente";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':vendedor', $vendedor, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readPropostaItems($propostaid)
    {
        $sql = "SELECT ppt.cliente, ppt.email, ppt.valor, ppt.data, item.item_id, item.proposta_id, pdt.id as produtoid, pdt.produto, u.nome, u.celular FROM propostas ppt INNER JOIN proposta_items item ON (ppt.id = item.proposta_id) INNER JOIN produtos pdt ON (pdt.id = item.item_id) INNER JOIN user u ON (u.id = ppt.vendedor_id) WHERE item.proposta_id = :proposta_id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':proposta_id', $propostaid, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($propostaid){
        $sql = "DELETE FROM proposta_items WHERE proposta_id = :propostaid";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':propostaid', $propostaid, PDO::PARAM_INT);
        $query->execute();

        $sql = "DELETE FROM propostas WHERE id = :propostaid";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':propostaid', $propostaid, PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }
}
