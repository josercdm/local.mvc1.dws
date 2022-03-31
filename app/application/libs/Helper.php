<?php

namespace SmartSolucoes\Libs;

use SmartSolucoes\Libs\Upload;
use SmartSolucoes\Core\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use sysborg\autentiquev2\createDoc;
use sysborg\autentiquev2\autentique;

class Helper
{

  static public function splitUrl()
  {
    if (isset($_GET['url'])) {
      $url = trim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }

  static public function view($view, $response = [])
  {
    if (!$view) {
      $view = 'error/index';
    }
    require APP . 'view/' . $view . '.php';
  }

  static public function ajax($nomecontroller, $action, $param)
  {
    $getController = '\SmartSolucoes\Controller\\' . $nomecontroller . 'Controller';
    $controller = new $getController();
    $controller->{$action}($param);
  }

  static public function upload($arquivo, $nome_arquivo, $caminho, $formato = false, $largura = false, $altura = false, $ratio = true)
  {
    $foo = new Upload($arquivo);
    if ($foo->uploaded) {
      $foo->file_overwrite = true;
      $foo->file_new_name_body = $nome_arquivo;
      if ($largura) {
        $foo->image_convert = $formato;
      }
      if ($largura) {
        $foo->image_resize = true;
        $foo->image_ratio = $ratio;
        $foo->image_x = $largura;
        $foo->image_y = $altura;
      }
      $foo->Process($caminho);
      if ($foo->processed) {
        $foo->Clean();
        return true;
      } else {
        //                return $foo->error;
        return false;
      }
    } else {
      //            return $foo->error;
      return false;
    }
  }

  static public function rearrange($arr)
  {
    foreach ($arr as $key => $all) {
      foreach ($all as $i => $val) {
        $new[$i][$key] = $val;
      }
    }
    return $new;
  }

  static public function iconFile($file)
  {
    $file = explode('.', $file);
    $ext = end($file);
    switch ($ext) {
      case 'doc':
      case 'docx':
        $icon = 'fa fa-file-word-o';
        break;
      case 'xls':
      case 'xlsx':
      case 'csv':
        $icon = 'fa fa-file-excel-o';
        break;
      case 'ppt':
      case 'pptx':
        $icon = 'fa fa-file-powerpoint-o';
        break;
      case 'pdf':
        $icon = 'fa fa-file-pdf-o';
        break;
      case 'psd':
      case 'cdr':
      case 'ai':
      case 'bmp':
      case 'gif':
      case 'jpeg':
      case 'jpg':
      case 'png':
        $icon = 'fa fa-file-image-o';
        break;
      case 'zip':
      case 'rar':
      case '7z':
        $icon = 'fa fa-file-archive-o';
        break;
      case 'mp3':
      case 'wma':
      case 'aac':
      case 'ogg':
      case 'ac3':
      case 'wav':
        $icon = 'fa fa-file-audio-o';
        break;
      case 'mpeg':
      case 'mov':
      case 'avi':
      case 'rmvb':
      case 'mkv':
      case 'mxf':
      case 'pr':
        $icon = 'fa fa-file-movie-o';
        break;
      case 'txt':
        $icon = 'fa fa-file-text-o';
        break;
      case 'php':
      case 'html':
      case 'css':
      case 'js':
        $icon = 'fa fa-file-code-o';
        break;
      default:
        $icon = 'fa fa-file-o';
        break;
    }
    return $icon;
  }

  static public function dataHora($data, $gravar = false)
  {
    if ($gravar) {
      $data = str_replace('/', '-', $data);
      $data = date('Y-m-d H:i:s', strtotime($data));
    } else {
      $data = date('d/m/Y H:i', strtotime($data));
    }

    return $data;
  }

  static public function data($data, $gravar = false)
  {
    if ($data) {
      if ($gravar) {
        $data = str_replace('/', '-', $data);
        $data = date('Y-m-d', strtotime($data));
      } else {
        $data = date('d/m/Y', strtotime($data));
      }
    }
    return $data;
  }

  static public function hora($hora)
  {
    $hora = substr($hora, 0, -3);
    return $hora;
  }

  static public function valor($valor, $gravar = false)
  {
    if ($gravar) {
      $valor = str_replace(',', '.', str_replace(['.', 'R$', ' '], '', $valor));
    } else {
      $valor = number_format($valor, 2, ',', '.');
    }
    return $valor;
  }

  static public function cleanToUrl($valor)
  {
    return mb_strtolower(str_replace(" ", "+", preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($valor)))));
  }

  static public function methodPagto()
  {
    return array(
      'Link de Pagamento',
      'Boleto Bancário',
      'Permuta',
      'Transferência Bancária',
      'Pix',
      'Dinheiro',
      'Débito',
      'Crédito à Vista',
      'Crédito - 2x',
      'Crédito - 3x',
      'Crédito - 4x',
      'Crédito - 5x',
      'Crédito - 6x',
      'Crédito - 7x',
      'Crédito - 8x',
      'Crédito - 9x',
      'Crédito - 10x',
      'Crédito - 11x',
      'Crédito - 12x',
    );
  }

  public function createContrato($token, $data = [])
  {
    $l = new createDoc();
    $l->name = $data['title'];
    $l->file = ASSETS . '/uploads/contratos/' . $data['contrato'];
    $signer = $l->addSigners($data['signer']);
  
    $t = new autentique($l);
    $t->debug = true;
    $t->token = $token;
    $r = $t->transmit();
    return $r;
  }
}
