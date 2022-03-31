<?php

namespace SmartSolucoes\Model;

use PDO;
use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class User extends Model
{

  public function cadastrar(array $data)
  {
    $create = $this->PDO()->prepare("INSERT INTO user (     
      acesso, 
      nome, 
      user,
      supervisor,
      meta,
      comissao,
      com_bater_meta,
      data_nascimento, 
      cpf, 
      rg, 
      telefone,
      celular, 
      endereco, 
      numero, 
      complemento, 
      bairro, 
      cep, 
      cidade, 
      estado, 
      banco, 
      agencia, 
      conta, 
      op_vr,
      tipo_conta, 
      email, 
      senha) VALUES (  
        :acesso,      
        :nome,
        :user,
        :supervisor,
        :meta,
        :comissao,
        :com_bater_meta,
        :data_nascimento,
        :cpf,
        :rg,
        :telefone,
        :celular,
        :endereco,
        :numero,
        :complemento,
        :bairro,
        :cep,
        :cidade,
        :estado,
        :banco,
        :agencia,
        :conta,
        :op_vr,
        :tipo_conta,
        :email,
        :senha)");

    $create->bindValue(':nome', $data['u_nome'], PDO::PARAM_STR);
    $create->bindValue(':acesso', $data['u_type_user'], PDO::PARAM_STR);
    $create->bindValue(':user', $data['u_user'], PDO::PARAM_STR);
    $create->bindValue(':supervisor', $data['u_supervisor'], PDO::PARAM_STR);
    $create->bindValue(':meta', $data['u_meta'], PDO::PARAM_STR);
    $create->bindValue(':comissao', $data['u_comissao'], PDO::PARAM_STR);
    $create->bindValue(':com_bater_meta', $data['u_comissao_b_meta'], PDO::PARAM_STR);
    $create->bindValue(':data_nascimento', $data['u_nasc'], PDO::PARAM_STR);
    $create->bindValue(':cpf', $data['u_cpf'], PDO::PARAM_STR);
    $create->bindValue(':rg', null, PDO::PARAM_STR);
    $create->bindValue(':telefone', $data['u_telefone'], PDO::PARAM_STR);
    $create->bindValue(':celular', $data['u_celular'], PDO::PARAM_STR);
    $create->bindValue(':endereco', $data['u_rua'], PDO::PARAM_STR);
    $create->bindValue(':numero', $data['u_numero'], PDO::PARAM_STR);
    $create->bindValue(':complemento', $data['u_complemento'], PDO::PARAM_STR);
    $create->bindValue(':bairro', $data['u_bairro'], PDO::PARAM_STR);
    $create->bindValue(':cep', $data['u_cep'], PDO::PARAM_STR);
    $create->bindValue(':cidade', $data['u_cidade'], PDO::PARAM_STR);
    $create->bindValue(':estado', $data['u_estado'], PDO::PARAM_STR);
    $create->bindValue(':banco', null, PDO::PARAM_STR);
    $create->bindValue(':agencia', null, PDO::PARAM_STR);
    $create->bindValue(':conta', null, PDO::PARAM_STR);
    $create->bindValue(':op_vr', null, PDO::PARAM_STR);
    $create->bindValue(':tipo_conta', null, PDO::PARAM_STR);
    $create->bindValue(':email', $data['u_email'], PDO::PARAM_STR);
    $create->bindValue(':senha', $data['password'], PDO::PARAM_STR);
    $create->execute();

    return $this->PDO()->lastInsertId();
  }

  public function createPermissao(array $data)
  {
    $create = $this->PDO()->prepare("INSERT INTO permissao (
      userid, 
      supervisor,
      administrador,
      gerente,
      financeiro,
      fotografo,
      suporte,
      vendedor,
      pos_venda, 
      viewer,
      edit,
      del) VALUES (
        :userid,
        :supervisor,
        :administrador,
        :gerente,
        :financeiro,
        :fotografo,
        :suporte,
        :vendedor,
        :pos_venda,
        :viewer,
        :edit,
        :del)");

    $create->bindValue(':userid', $data['userid'], PDO::PARAM_INT);
    $create->bindValue(':supervisor', $data['supervisor'], PDO::PARAM_INT);
    $create->bindValue(':administrador', $data['administrador'], PDO::PARAM_INT);
    $create->bindValue(':gerente', $data['gerente'], PDO::PARAM_INT);
    $create->bindValue(':financeiro', $data['financeiro'], PDO::PARAM_INT);
    $create->bindValue(':fotografo', $data['fotografo'], PDO::PARAM_INT);
    $create->bindValue(':suporte', $data['suporte'], PDO::PARAM_INT);
    $create->bindValue(':vendedor', $data['vendedor'], PDO::PARAM_INT);
    $create->bindValue(':pos_venda', $data['pos_venda'], PDO::PARAM_INT);
    $create->bindValue(':viewer', $data['viewer'], PDO::PARAM_INT);
    $create->bindValue(':edit', $data['edit'], PDO::PARAM_INT);
    $create->bindValue(':del', $data['del'], PDO::PARAM_INT);
    $create->execute();

    return 'ok';
  }

  public function read()
  {
    $query = $this->PDO()->prepare("SELECT * FROM user");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readPermissao()
  {
    $query = $this->PDO()->prepare("SELECT us.*, us.id as id_user, pm.*, pm.supervisor as pm_supervisor FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) ORDER BY nome");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readSupervisores()
  {
    $query = $this->PDO()->prepare("SELECT us.*, us.id as id_user, pm.*, pm.supervisor as pm_supervisor FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE pm.supervisor = :supervisor ORDER BY nome");
    $query->bindValue(':supervisor', 1, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readMeusSupervisores(string $nome)
  {
    $query = $this->PDO()->prepare("SELECT us.*, us.id as id_user, pm.*, pm.supervisor as pm_supervisor FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE us.supervisor = :supervisor ORDER BY nome");
    $query->bindValue(':supervisor', $nome, PDO::PARAM_STR);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readVendedores()
  {
    $query = $this->PDO()->prepare("SELECT us.nome, pm.userid FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE pm.vendedor = :vendedor AND us.status = :status ORDER BY nome");
    $query->bindValue(':vendedor', 1, PDO::PARAM_INT);
    $query->bindValue(':status', 1, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  

  public function readVendedor($vendedor)
  {
    $query = $this->PDO()->prepare("SELECT * FROM user WHERE nome = :vendedor AND status = :status OR id = :id AND status = :status");
    $query->bindValue(':vendedor', $vendedor, PDO::PARAM_STR);
    $query->bindValue(':id', $vendedor, PDO::PARAM_INT);
    $query->bindValue(':status', 1, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function readFotografos()
  {
    $query = $this->PDO()->prepare("SELECT us.nome, pm.userid FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE pm.fotografo = :fotografo AND us.status = :status ORDER BY nome");
    $query->bindValue(':fotografo', 1, PDO::PARAM_INT);
    $query->bindValue(':status', 1, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readVendedoresIn($supervisor)
  {
    $query = $this->PDO()->prepare("SELECT us.nome, pm.userid FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE pm.vendedor = :vendedor AND us.supervisor = :supervisor AND us.status = :status ORDER BY nome");
    $query->bindValue(':vendedor', 1, PDO::PARAM_INT);
    $query->bindValue(':supervisor', $supervisor, PDO::PARAM_STR);
    $query->bindValue(':status', 1, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function readPermissaoId($id)
  {
    $query = $this->PDO()->prepare("SELECT us.*, us.id as id_user, us.supervisor as us_supervisor, pm.*, pm.supervisor as pm_supervisor FROM user us INNER JOIN permissao pm ON (us.id = pm.userid) WHERE us.id = :userid ORDER BY nome");
    $query->bindValue(':userid', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public function updateUser(array $data)
  {
    $query = $this->PDO()->prepare("UPDATE user SET 
      acesso = :acesso, 
      nome = :nome, 
      user = :user,
      supervisor = :supervisor,
      data_nascimento = :data_nascimento, 
      cpf = :cpf, 
      telefone = :telefone,
      celular = :celular, 
      endereco = :endereco, 
      numero = :numero, 
      complemento = :complemento, 
      bairro = :bairro, 
      cep = :cep, 
      cidade = :cidade, 
      estado = :estado,        
      email = :email

      WHERE id = :id");
    $query->bindValue(':acesso', $data['u_type_user'], PDO::PARAM_STR);
    $query->bindValue(':nome', $data['u_nome'], PDO::PARAM_STR);
    $query->bindValue(':user', $data['u_user'], PDO::PARAM_STR);
    $query->bindValue(':supervisor', $data['u_supervisor'], PDO::PARAM_STR);
    $query->bindValue(':data_nascimento', $data['u_nasc'], PDO::PARAM_STR);
    $query->bindValue(':cpf', $data['u_cpf'], PDO::PARAM_STR);
    $query->bindValue(':telefone', $data['u_telefone'], PDO::PARAM_STR);
    $query->bindValue(':celular', $data['u_celular'], PDO::PARAM_STR);
    $query->bindValue(':endereco', $data['u_rua'], PDO::PARAM_STR);
    $query->bindValue(':numero', $data['u_numero'], PDO::PARAM_STR);
    $query->bindValue(':complemento', $data['u_complemento'], PDO::PARAM_STR);
    $query->bindValue(':bairro', $data['u_bairro'], PDO::PARAM_STR);
    $query->bindValue(':cep', $data['u_cep'], PDO::PARAM_STR);
    $query->bindValue(':cidade', $data['u_cidade'], PDO::PARAM_STR);
    $query->bindValue(':estado', $data['u_estado'], PDO::PARAM_STR);
    $query->bindValue(':email', $data['u_email'], PDO::PARAM_STR);
    $query->bindValue(':id', $data['userid'], PDO::PARAM_INT);

    $query->execute();
  }

  public function updatePermissao(array $data)
  {

    $query = $this->PDO()->prepare("UPDATE permissao SET 
    
      supervisor = :supervisor,
      administrador = :administrador,
      gerente = :gerente,
      financeiro = :financeiro,
      fotografo = :fotografo,
      suporte = :suporte,
      vendedor = :vendedor,
      pos_venda = :pos_venda,
      viewer = :viewer,
      edit = :edit,
      del = :del     

      WHERE userid = :userid");

    $query->bindValue(':userid', $data['userid'], PDO::PARAM_INT);
    $query->bindValue(':supervisor', $data['supervisor'], PDO::PARAM_INT);
    $query->bindValue(':administrador', $data['administrador'], PDO::PARAM_INT);
    $query->bindValue(':gerente', $data['gerente'], PDO::PARAM_INT);
    $query->bindValue(':financeiro', $data['financeiro'], PDO::PARAM_INT);
    $query->bindValue(':fotografo', $data['fotografo'], PDO::PARAM_INT);
    $query->bindValue(':suporte', $data['suporte'], PDO::PARAM_INT);
    $query->bindValue(':vendedor', $data['vendedor'], PDO::PARAM_INT);
    $query->bindValue(':pos_venda', $data['pos_venda'], PDO::PARAM_INT);
    $query->bindValue(':viewer', $data['viewer'], PDO::PARAM_INT);
    $query->bindValue(':edit', $data['edit'], PDO::PARAM_INT);
    $query->bindValue(':del', $data['del'], PDO::PARAM_INT);
    $query->execute();

    $query->execute();

    return 'ok';
  }

  public function updateStatus($status, $userid)
  {

    $query = $this->PDO()->prepare("UPDATE user SET 
         
      status = :status     

      WHERE id = :userid");

    $query->bindValue(':userid', $userid, PDO::PARAM_INT);
    $query->bindValue(':status', $status, PDO::PARAM_INT);

    $query->execute();

    return 'ok';
  }

  public function deleteUser($userid)
  {

    $query = $this->PDO()->prepare("DELETE FROM permissao WHERE userid = :userid");
    $query->bindValue(':userid', $userid, PDO::PARAM_INT);

    $query->execute();

    $query = $this->PDO()->prepare("DELETE FROM user WHERE id = :userid");
    $query->bindValue(':userid', $userid, PDO::PARAM_INT);

    $query->execute();

    return 'ok';
  }
}
