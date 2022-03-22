<?php

namespace SmartSolucoes\Core;

use PDO;
use PDOException;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use SmartSolucoes\Libs\Helper;

class Model
{
    static $PDO;

    static function PDO()
    {
        if (!self::$PDO) {
            try {
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
                self::$PDO = new PDO($dsn, DB_USER, DB_PASS);
                self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$PDO->exec("SET time_zone='" . date('P') . "';");
            } catch (PDOException $e) {
                // Normally, we would log this
                die('Connection error: ' . $e->getMessage() . '<br/>');
            }
        }
        return self::$PDO;
    }

    public function find($table, $id)
    {
        $sql = "SELECT * FROM " . $table . " WHERE id = :id LIMIT 1";
        $query = $this->PDO()->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function createPDF($path)
    {

        $options = new Options();
        $options->setChroot(URL_DOMAIN);
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsPhpEnabled(true);
        // $options->setDefaultFont('Arial');

        $pdf = new Dompdf($options);

        $pdf->loadHtmlFile($path['pagina_1']);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf;
    }

    public function sendMail(array $data)
    {

        $config = $this->find('configuracao', 1);

        $mail = new PHPMailer(true);
        try {
            //Configurações do servidor
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();    // Enviar usando SMTP
            $mail->Host       = $config['mail_host']; // Defina o servidor SMTP para enviar através
            $mail->SMTPAuth   = $config['mail_auth']; // Ativar autenticação SMTP
            $mail->Username   = $config['mail_user']; // Nome de usuário SMTP
            $mail->Password   = $config['mail_pass']; // Senha SMTP
            $mail->SMTPSecure = $config['mail_secure'];
            $mail->Port       = $config['mail_port']; // Porta SMTP

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom($config['mail_user'], $config['app_title']);
            $mail->addAddress(urldecode($data["email"]));

            $mail->isHTML(true);                     // Definir formato de email para HTML
            $mail->Subject = 'Proposta Comercial';

            $empresa = $data['empresa'];
            $valor = ($data['parcela']);
            $vendedor = $data['vendedor'];
            $contatoVendedor = $data['contato'];

            include dirname(__DIR__) . DIRECTORY_SEPARATOR . "view/admin/_templates/mail_proposta.php";

            $mail->Body = $email_template;
            $mail->AltBody = 'Este email contém html.';

            // $danfe = urlencode(URL_PUBLIC . "/uploads/propostas/" . $data['propostaid'] . ".pdf");

            $mail->addStringAttachment(file_get_contents($data['arquivo']), 'Proposta Comercial.pdf');

            $mail->send();
            return 'ok';

        } catch (Exception $e) {
            return "Não foi possível enviar a mensagem. Erro na correspondência: {$mail->ErrorInfo}";
        }
    }

    // public function create($table, $fields, $exception = [])
    // {
    //     $PDO = $this->PDO();
    //     $set = [];
    //     $setValue = [];
    //     foreach ($fields as $field => $value) {
    //         if (!in_array($field, $exception)) {
    //             $set[] = $field . ' = :' . $field;
    //             $setValue[':' . $field] = $value;
    //         }
    //     }
    //     if (@$_SESSION['id_user']) $setAdmin = "id_update_user = '" . (@$_SESSION['id_user'] ? @$_SESSION['id_user'] : 0) . "', ";
    //     $sql = "INSERT INTO " . $table . " SET " . @$setAdmin . implode(', ', $set);
    //     $query = $PDO->prepare($sql);
    //     if ($query->execute($setValue)) {
    //         $return = $PDO->lastInsertId();
    //     } else {
    //         $return = false;
    //     }
    //     return $return;
    // }

    /*public function save($table, $fields, $exception = [])
    {
        $set = [];
        $setValue = [];
        foreach ($fields as $field => $value) {
            if (!in_array($field, $exception)) {
                $set[] = $field . ' = :' . $field;
                $setValue[':' . $field] = $value;
            }
        }
        if (@$_SESSION['id_user']) $setAdmin = "id_update_user = '" . (@$_SESSION['id_user'] ? @$_SESSION['id_user'] : 0) . "', ";
        $sql = "UPDATE " . $table . " SET " . @$setAdmin . implode(', ', $set) . " WHERE id = :id LIMIT 1";
        $query = $this->PDO()->prepare($sql);
        return $query->execute($setValue);
    }

    public function delete($table, $field = false, $value = false, $limit = 1)
    {
        try {
            $PDO = self::PDO();
            $where = $limit = '';
            if (is_array($field)) {
                foreach ($field as $key => $item) {
                    $where .= " AND " . $item . " = '" . $value[$key] . "'";
                }
            } elseif ($field) {
                $where = "AND " . $field . " = '" . $value . "'";
            }
            if (is_numeric($limit)) $limit = "LIMIT $limit";
            if ($where) {
                $sql = "DELETE FROM " . $table . " WHERE 1=1 $where $limit";
                $query = $PDO->prepare($sql);
                $query->execute();
            }
        } catch (\PDOException $Exception) {
            echo '<script>if(!alert("Existem outros itens que dependem desse para funcionar.\rApague primeiro eles para depois realizar essa ação.")) { window.history.back(); }</script>';
            die();
        }
    }

    public function status($table, $id, $status)
    {
        $sql = "UPDATE " . $table . " SET status = " . $status . " WHERE id = :id LIMIT 1";
        $query = $this->PDO()->prepare($sql);
        $query->execute([':id' => $id]);
    }*/

    public function all($table, $order = 'id', $field = false, $value = false)
    {

        $where = '';
        if (is_array($field)) {
            foreach ($field as $key => $item) {
                $where .= " AND " . $item . " = '" . $value[$key] . "'";
            }
        } elseif ($field) {
            $where = "AND " . $field . " = '" . $value . "'";
        }
        $sql = "SELECT * FROM " . $table . " WHERE 1=1 " . $where . " ORDER BY status DESC, " . $order;
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }



    /*  public function defineOrder($table, $id, $order, $id_categoria = false, $id_cadastro = false)
    {

        $where = '';
        if ($id_categoria) $where .= " AND id_categoria = '" . $id_categoria . "'";
        if ($id_cadastro) $where .= " AND id_cadastro = '" . $id_cadastro . "'";

        $PDO = $this->PDO();
        $PDO->query("SET @a := -1; UPDATE " . $table . " SET ordem = @a := @a+1 WHERE 1=1 " . $where . " AND id <> " . $id . " AND (ordem <= " . $order . " OR ordem IS NULL) ORDER BY ordem;");
        $PDO->query("SET @a := " . $order . "; UPDATE " . $table . " SET ordem = @a := @a+1 WHERE 1=1 " . $where . " AND id <> " . $id . " AND (ordem >= " . $order . " OR ordem IS NULL) ORDER BY ordem;");
    } */

    public function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function getCNPJ($cnpj)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://receitaws.com.br/v1/cnpj/{$cnpj}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }
}
