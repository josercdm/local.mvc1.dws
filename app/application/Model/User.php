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
      senha, 
      session) VALUES (
        :acesso,
        :nome,
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
        :senha,
        :session)");

    $create->bindValue(':acesso', $data['u_type_user'], PDO::PARAM_STR);
    $create->bindValue(':nome', $data['u_nome'], PDO::PARAM_STR);
    $create->bindValue(':data_nascimento', $data['u_nasc'], PDO::PARAM_STR);
    $create->bindValue(':cpf', $data['u_cpf'], PDO::PARAM_STR);
    $create->bindValue(':rg', null, PDO::PARAM_STR);
    $create->bindValue(':telefone', $data['u_telefone'], PDO::PARAM_STR);
    $create->bindValue(':celular', $data['u_celular'], PDO::PARAM_STR);
    $create->bindValue(':endereco', $data['u_endereco'], PDO::PARAM_STR);
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
    $create->bindValue(':session', $data['u_status'], PDO::PARAM_STR);
    $create->execute();

    return 'ok';
  }

  public function read()
  {
    $query = $this->PDO()->prepare("SELECT * FROM user");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
