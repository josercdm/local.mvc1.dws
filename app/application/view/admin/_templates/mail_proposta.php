<?php

$email_template = ' 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Grupo Parceiros Brasil</title>
</head>

<body marginheight="0" rightmargin="0" topmargin="0" bottommargin="0" marginwidth="0" bgcolor="#ffffff">

  <table width="700px" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#f6f6f6">
    <tr align="center" height="85px">
      <td style="border-bottom:1px solid #e2e2e2">
        <img src="' . URL_PUBLIC . '/assets/img/logo.png" alt="Grupo Parceiros Brasil" style="width: 100px; padding: 5px 0;">
    </td>
    </tr>
    <tr align="center" height="120">
      <td>
        <br>
        <br>
        <font face="Arial, Helvetica, sans-serif" color="#616163" size="5"><strong>A proposta comercial da empresa <b>' . $empresa . '</b> no valor de 12x de R$ <b>' . $valor . '</b> está em anexo.</strong></font>
        <br>
        <br>
        <br>
      </td>
    </tr>
    <tr>
      <td><table width="532" border="0" align="center" cellspacing="0" cellpadding="15" bgcolor="#ffffff" style="background: #ffffff; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; border: 1px solid #e2e2e2 !important;">
        <tr>
        <td width="500"><table width="500" border="0" align="center" cellspacing="0" cellpadding="15" bgcolor="#ffffff" style="background: #ffffff; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;">
          <tr>
            <td colspan="2" align="center">
              <font face="Arial, Helvetica, sans-serif" color="#959595" size="2">
                <strong style="font-size:16px;color:#f19333;">Se tiver alguma dúvida entre em contato com <b>' . $vendedor . '</b> <br>
                através do telefone <b>' . $contatoVendedor . '</b></strong> <br> 
                Caso precise de atendimento, abra um chamado em nosso <a href="mailto:' . MAIL_CONTATO . '">canal de suporte</a>.
              </font>

            </td>
            </tr>
          </table></td>
        </tr>
      </table><br /><br /></td>
    </tr>
    <tr>
      <td style="padding:0 30px 15px;">
        <font face="Arial, Helvetica, sans-serif" color="#9d9d9d" size="2">Por favor, não responda esse e-mail.</font>
      </td>
    </tr>
    <tr>
      <td>
        <table width="700" border="0" align="center" cellspacing="15" cellpadding="30" bgcolor="#f19333">
           <tr>
                        <td>
                        </td>
                        <td align="right" valign="top">
                      <a href="' . URL_PROTOCOL . URL_PUBLIC . '" style="text-decoration:none;"><font face="Arial, Helvetica, sans-serif" color="#ffffff" size="2" style="line-height:22px;">Ir para o site</font></a>
                    </td>
                </tr>
        </table>
      </td>
    </tr>
  </table>

</body>

</html>';
