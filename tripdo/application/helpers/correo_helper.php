<?php
/**
 * envia un correo para validar el registro
 * @param string $nickname nickname del usuario, contrasenia $contrasenia del usuario
 * @return string
 */
 function encryptar($nickname, $contrasenia){
	$retorno="";
    $retorno=$nickname.$contrasenia;
    $retorno = sha1($retorno);
    $retorno = substr($retorno, 0, -1*strlen($retorno)+10);
    return $retorno;
}

/**
 * envia un correo para validar el registro
 * @param string $destinatario correo del usuario que se quiere registrar
 * @return array
 */
  function enviarCorreoValidar($destinatario, $codigo){

    //***********----------------Cabeza del correo---------------***********
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= 'To: Usuario <'.$destinatario.'>. "\r\n"';
    $cabeceras .= 'From: Recordatorio <tripdo.uy@gmail.com>' . "\r\n";

    //***********----------------Asunto del correo---------------***********
    $asunto="Confirmar registro";

    //***********---------------Mensaje del correo---------------***********
   
    $mensaje = '
    <html>
    <body>
    <center class="wrapper">
        <div class="spacer">&nbsp;</div>

        <table style="font-family: Arial, Helvetica, sans-serif;
        background-color: rgb(15, 15, 39);
        color: white;
        padding: 20px;
        padding-bottom: 25px;
        border-radius: 1px;">
            <tbody>
            <tr>
                <td class="column">
                    
                    <table class="content">
                        <tbody>
                        <tr>
                            <td style="color: white;">
                            <h1>Confirmacion de Registro</h1>
                            <p>Este correo ha sido enviado por <strong style="color: rgb(224, 73, 73);">TripDo</strong> para confirmar el registro al sitio oficial.</p>
                            <p><strong style="color: rgb(224, 73, 73);">TripDo</strong> es un sitio destinado a la planeacion de viajes nacionales e internacionales.</p>
                            <p>Copie el siguiente codigo <strong style="color: rgb(224, 73, 73);">'. $codigo .'</strong></p>
							<p>Presione <strong style="color: rgb(224, 73, 73);">Confirmar</strong> para continuar.</p>
                            <div class="column-top">&nbsp;</div>
                            <p style="text-align:center;">
                                <a href="'.base_url('/loginValidar').'" class="strong">
                                    <button style=" background-color: rgb(216, 64, 64);
                                    border: none;
                                    color: white;
                                    padding: 15px 32px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;"><strong>Confirmar</strong></button>
                                </a>
                            </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </center>
    </body>
    </html>
    ';
    //***********---------------llamada de la funcion enviar correo---------------***********
    mail($destinatario,$asunto,$mensaje,$cabeceras);

  }

  /**
 * envia un correo al usuario que se desea agregar como colavorador
 * @param string $destinatario correo del usuario que se desea agregar como colavorador
 * @return array
 */
    function enviarCorreoAgregarColaborador($destinatario){

    }

  /**
 * envia un correo para agregar viajero
 * @param string $destinatario correo del usuario que se desea agregar
 * @return array
 */
    function enviarCorreoAgregarViajero($destinatario){

    }
