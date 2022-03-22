<?php

namespace SmartSolucoes\Model;

use SmartSolucoes\Core\Model;
use PDO;

class Produtos extends Model
{


    public function create($data)
    {
        $valida = $this->PDO()->prepare("SELECT produto FROM produtos WHERE produto = :produto");
        $valida->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
        $valida->execute();
        if ($valida->rowCount() > 0) {
            $retorno = 'Esse produto já está cadastrado!';
        } else {

            $sql = "INSERT INTO produtos (produto) VALUES (:produto)";
            $query = $this->PDO()->prepare($sql);
            $query->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
            $query->execute();

            $retorno = 'ok';
        }
        return $retorno;
    }

    public function read()
    {
        $sql = "SELECT * FROM produtos ORDER BY produto";
        $query = $this->PDO()->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readProduto($produtoid)
    {
        $sql = "SELECT id,produto FROM produtos WHERE id = :id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':id', $produtoid, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $valida = $this->PDO()->prepare("SELECT produto FROM produtos WHERE produto = :produto");
        $valida->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
        $valida->execute();
        if ($valida->rowCount() > 0) {
            $retorno = 'Esse produto já está cadastrado!';
        } else {

            $sql = "UPDATE produtos SET produto = :produto WHERE id = :id";
            $query = $this->PDO()->prepare($sql);
            $query->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
            $query->bindValue(':id', $data['produtoid'], PDO::PARAM_INT);
            $query->execute();

            $retorno = 'ok';
        }
        return $retorno;
    }

    public function delete($produtoid)
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $query = $this->PDO()->prepare($sql);
        $query->bindValue(':id', $produtoid, PDO::PARAM_INT);
        $query->execute();

        return 'ok';
    }
}
