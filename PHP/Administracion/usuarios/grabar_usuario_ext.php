x�Umo�H���+�H�*xC{�ĦjI���Su:Ek{�V�]���}�v
4w����=3���	���~�ޖy�e����DV8mh@�\����%���	���q�\y��f�	��S��Ȼ�rk�U�?>�ק�o�:�k#2a�TӘ�L��œD(Xy�8����팦����~A{2-R��ȨRpA�Nά-�%q��7/[j)��P+���%�h�+�ݧ����u	7��t#�0\ҼJ`Cm z�Z�knɁ��>Bp3���^{EX�*�fŞ�U)�ܭ�a�����+h8�9���ƕ/��)��A��v�� ׍�(T>X��D'������R
*�J�(	�v��*� ��a�c��u�_�>�_�z������%&��c��3v��j~Oia���CӸdl2`�0�v�\��N�
'�hΛ�"֜x��p�n�@�U_�`�1���R�6�������,n�pq喃3~���Zāщvv�R�c�턔n&�1��z�܈e�kb늅���2��Jas!\@���
̣d-�(�ٶN"`���c��V�?�Z����D�����[���5xQ�_Ӧp9ȶ�%jɲ������w��"}rS�Q����0j\��Ndw<��&=�Yx9�q�B9��Dr��;�l)F�*���)�rK�N+�N[ӿ]U	�~Ґ��4��}l"[�4"Ŗۆ]ư� WeEE+8��6����]@=xY��� ^m�+���մG�l�'lN8=�ޏ�a�.����So7�G����O:K^IG_����#�����~��a�����u�O��@�V�u�O;�	��d���8x.P@�x_t�{�#e%6���{?p{^yOw���Y��C�@����.�:R���Z�ڡ�D�X+鋮����rG�jM��e��%�Gb���0b�%?�x��:�o�N��Գۉ
UV�%��.0�u7���Y�8�C���5�����r8W                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          tiva']==null)){
    //Si se va ha desactivar el ciudadano se modifica el numero de cedula y el login
    $tmp_cedula = substr($tmp_cedula,0,10)."-$ciu_codigo";
    $ciu_estado = "0";

    $record["CIU_ESTADO"]       = $ciu_estado;
    $record["CIU_CEDULA"]       = $db->conn->qstr(limpiar_sql(trim($tmp_cedula)));

}
else
{
    //$tmp_cedula = substr($tmp_cedula,0,10);
    $ciu_estado = "1";

    $record["CIU_ESTADO"]       = $ciu_estado;
    $record["CIU_CEDULA"]       = $db->conn->qstr(limpiar_sql(trim($tmp_cedula)));
    $record["CIU_DOCUMENTO"]    = $db->conn->qstr(limpiar_sql(trim($ciu_documento)));
    
    if (trim($ciu_nombre)=='') 
        $grabar_ciu=0;
    $record["CIU_NOMBRE"]       = $db->conn->qstr(limpiar_sql(trim($ciu_nombre)));
    
    if (trim($ciu_apellido)=='') 
        $grabar_ciu=0;
    
    $record["CIU_APELLIDO"]     = $db->conn->qstr(limpiar_sql(trim($ciu_apellido)));
    $record["CIU_TITULO"]       = $db->conn->qstr(limpiar_sql(trim($ciu_titulo)));
    $record["CIU_ABR_TITULO"]   = $db->conn->qstr(limpiar_sql(trim($ciu_abr_titulo)));
    $record["CIU_EMPRESA"]      = $db->conn->qstr(limpiar_sql(trim($ciu_empresa)));
    $record["CIU_CARGO"]        = $db->conn->qstr(limpiar_sql(trim($ciu_cargo)));
    $record["CIU_DIRECCION"]    = $db->conn->qstr(limpiar_sql(trim($ciu_direccion)));
    $record["CIU_EMAIL"]        = $db->conn->qstr(limpiar_sql(trim($ciu_email)));
    $record["CIU_TELEFONO"]     = $db->conn->qstr(limpiar_sql(trim($ciu_telefono)));

    if(isset($ciu_ciudad))
        $record["CIUDAD_CODI"] = $ciu_ciudad;
    else
        $record["CIUDAD_CODI"] = "0";

    if (trim($ciu_nuevo)!="")  $record["CIU_NUEVO"] = "$ciu_nuevo";
}

//Datos del usuario que modifico al ciudadano la ultima ves.
$record["USUA_CODI_ACTUALIZA"] = $_SESSION['usua_codi'];
$record["CIU_FECHA_ACTUALIZA"] = "CURRENT_TIMESTAMP";

//Armar observacion de campos modificados
if($accion == 1)
    $record["CIU_OBS_ACTUALIZA"] =  "'Registro Nuevo'";
else
    $record["CIU_OBS_ACTUALIZA"] = "'".ObtenerObservacionCiudadano($ciu_codigo, $record, $db)."'";
if ($grabar_ciu==1)
$ok1 = $db->conn->Replace("CIUDADANO", $record, "CIU_CODIGO", false,false,true,false);
//Si son ciudadanos con nombre homónimos no modificar el ciudadano existente crear nuevo y eleminar de la tabla tmp.

$upSql="update ciudadano_tmp set ciu_estado = 0 where ciu_codigo=$ciu_codigo";

$db->conn->query($upSql);

// Cambiamos la contraseña del usuario y le mandamos un mail
if ($ciu_nuevo==0 and trim($ciu_email)!="") {
    $usr_tipo = 2;
    $usr_codigo = $ciu_codigo;
    $usr_nombre = $ciu_nombre . " " . $ciu_apellido;
    $usr_login = "U".$tmp_cedula;
    $usr_cedula = $tmp_cedula;
    $usr_email = $ciu_email;
    include "cambiar_password_mail.php";

}

if (isset($pagina_anterior) and trim($ciu_email)!="") {
    $mail = "<html><title>Informaci&oacute;n Quipux</title>";
    $mail .= "<body><center><h1>QUIPUX</h1><br /><h2>Sistema de Gesti&oacute;n Documental</h2><br /><br /></center>";
    $mail .= "Estimado(a) $ciu_nombre $ciu_apellido.<br /><br />";
    $mail .= "Se han realizado los siguientes cambios en la informaci&oacute;n personal de su usuario:<br /><br />";
    $mail .= "<table border='0'>
              <tr><td><b>C&eacute;dula:</b></td><td>$tmp_cedula</td></tr>
              <tr><td><b>Nombre:</b></td><td>$ciu_nombre</td></tr>
              <tr><td><b>Apellido:</b></td><td>$ciu_apellido</td></tr>
              <tr><td><b>Abr. T&iacute;tulo:</b></td><td>$ciu_abr_titulo</td></tr>
              <tr><td><b>T&iacute;tulo:</b></td><td>$ciu_titulo</td></tr>
              <tr><td><b>Instituci&oacute;n:</b></td><td>$ciu_empresa</td></tr>
              <tr><td><b>Cargo:</b></td><td>$ciu_cargo</td></tr>
              <tr><td><b>Direcci&oacute;n:</b></td><td>$ciu_direccion</td></tr>
              <tr><td><b>E-mail:</b></td><td>$ciu_email</td></tr>
              </table>";
    $mail .= "<br /><br />Le recordamos que para acceder al sistema deber&aacute; hacerlo con el usuario &quot;$tmp_cedula&quot;
              ingresando a <a href='$nombre_servidor' target='_blank'>$nombre_servidor</a>";
    $mail .= "<br /><br />Saludos cordiales,<br /><br />Soporte Quipux.";
    $mail .= "<br /><br /><b>Nota: </b>Este mensaje fue enviado autom&aacute;ticamente por el sistema, por favor no lo responda.";
    $mail .= "<br />Si tiene alguna inquietud respecto a este mensaje, comun&iacute;quese con <a href='mailto:$cuenta_mail_soporte'>$cuenta_mail_soporte</a>";
    $mail .= "</body></html>";
    enviarMail($mail, "Quipux: Actualización de datos.", $ciu_email, "$ciu_nombre $ciu_apellido", $ruta_raiz);
}

if (isset($_POST["ciu_codigo_eliminar"])) {
    if ($_POST["ciu_codigo_eliminar"]!=$ciu_codigo) {
        $ciu_codigo_eliminar = limpiar_sql($_POST["ciu_codigo_eliminar"]);
        //movemos los documentos en los que el ciudadano es el remitente
        $sql = "select radi_nume_radi, radi_usua_rem from radicado where radi_usua_rem like '%-$ciu_codigo_eliminar-%';";
        $rs = $db->conn->query($sql);
        while (!$rs->EOF) {
            unset ($record);
            $record["RADI_NUME_RADI"] = $rs->fields["RADI_NUME_RADI"];
            $record["RADI_USUA_REM"] = $db->conn->qstr(str_replace("-$ciu_codigo_eliminar-","-$ciu_codigo-",$rs->fields["RADI_USUA_REM"]));
            $ok1 = $db->conn->Replace("RADICADO", $record, "RADI_NUME_RADI", false,false,true,false);
            $rs->MoveNext();
        }

        //movemos los documentos en los que el ciudadano es el destinatario
        $sql = "select radi_nume_radi, radi_usua_dest from radicado where radi_usua_dest like '%-$ciu_codigo_eliminar-%';";
        $rs = $db->conn->query($sql);
        while (!$rs->EOF) {
            unset ($record);
            $record["RADI_NUME_RADI"] = $rs->fields["RADI_NUME_RADI"];
            $record["RADI_USUA_DEST"] = $db->conn->qstr(str_replace("-$ciu_codigo_eliminar-","-$ciu_codigo-",$rs->fields["RADI_USUA_DEST"]));
            $ok1 = $db->conn->Replace("RADICADO", $record, "RADI_NUME_RADI", false,false,true,false);
            $rs->MoveNext();
        }

        //movemos los documentos en los que el ciudadano tiene copias (cca)
        $sql = "select radi_nume_radi, radi_cca from radicado where radi_cca like '%-$ciu_codigo_eliminar-%';";
        $rs = $db->conn->query($sql);
        while (!$rs->EOF) {
            unset ($record);
            $record["RADI_NUME_RADI"] = $rs->fields["RADI_NUME_RADI"];
            $record["RADI_CCA"] = $db->conn->qstr(str_replace("-$ciu_codigo_eliminar-","-$ciu_codigo-",$rs->fields["RADI_CCA"]));
            $ok1 = $db->conn->Replace("RADICADO", $record, "RADI_NUME_RADI", false,false,true,false);
            $rs->MoveNext();
        }
        // desactivamos el usuario

        $sql = "select ciu_cedula, ciu_email from ciudadano where ciu_codigo=$ciu_codigo_eliminar";
        $rs = $db->conn->query($sql);
        $old_cedula = $rs->fields["CIU_CEDULA"];

        unset ($record);
        $record["CIU_CODIGO"] = "$ciu_codigo_eliminar";
        $record["CIU_ESTADO"] = "0";
        $record["CIU_CEDULA"] = $db->conn->qstr("$old_cedula-$ciu_codigo_eliminar");

        //Datos del usuario que modifico al ciudadano la ultima ves.
        $record["USUA_CODI_ACTUALIZA"] = $_SESSION['usua_codi'];
        $record["CIU_FECHA_ACTUALIZA"] = "CURRENT_TIMESTAMP";

        $ok1 = $db->conn->Replace("CIUDADANO", $record, "CIU_CODIGO", false,false,true,false);

        $mail = "<html><title>Informaci&oacute;n Quipux</title>";
        $mail .= "<body><center><h1>QUIPUX</h1><br /><h2>Sistema de Gesti&oacute;n Documental</h2><br /><br /></center>";
        $mail .= "Estimado(a) $ciu_nombre $ciu_apellido.<br /><br />";
        $mail .= "Se ha unificado la información de los usuarios &quot;$old_cedula&quot; y &quot;$tmp_cedula&quot; en uno solo.<br /><br />";
        $mail .= "Todos los documentos pertenecientes al usuario &quot;$old_cedula&quot; fueron movidos a las bandejas del usuario &quot;$tmp_cedula&quot; y el usuario &quot;$old_cedula&quot; ha sido desactivado.<br /><br />";
        $mail .= "Le recordamos que para acceder al sistema deber&aacute; hacerlo con el usuario &quot;$tmp_cedula&quot;
                  ingresando a <a href='$nombre_servidor' target='_blank'>$nombre_servidor</a>";
        $mail .= "<br /><br />Saludos cordiales,<br /><br />Soporte Quipux.";
        $mail .= "<br /><br /><b>Nota: </b>Este mensaje fue enviado autom&aacute;ticamente por el sistema, por favor no lo responda.";
        $mail .= "<br />Si tiene alguna inquietud respecto a este mensaje, comun&iacute;quese con <a href='mailto:$cuenta_mail_soporte'>$cuenta_mail_soporte</a>";
        $mail .= "</body></html>";
        if (trim($ciu_email)!="")
            if ($grabar_ciu==1)
            enviarMail($mail, "Quipux: Actualización de datos.", $ciu_email, "$ciu_nombre $ciu_apellido", $ruta_raiz);
        if (trim($rs->fields["CIU_EMAIL"])!="" && $rs->fields["CIU_EMAIL"]!=$ciu_email)
                 if ($grabar_ciu==1)
            enviarMail($mail, "Quipux: Actualización de datos.", $rs->fields["CIU_EMAIL"], "$ciu_nombre $ciu_apellido", $ruta_raiz);
    }
}

echo "<html>".html_head();
?>
<body>
    <br><br>
    <?php
     if ($grabar_ciu==0){
         ?>
    <center><table width="40%" border="2" align="center" class="t_bordeGris">
	    <tr> 
                <td width="100%" height="30" class="listado2">
                    Existió un problema al guardar el ciudadano, comuníquese con el Administrador
                    del Sistema.
                    <center><input class="botones" type="button" name="Atras" value="Aceptar" onclick="window.location='./mnuUsuarios_ext.php';"/></center>
                </td>
            </tr>
    </table></center>
     <?php      
     }else{
    ?>
    <center>        
        <?=$mensaje?><br>
	<table width="40%" border="2" align="center" class="t_bordeGris">
	    <tr> 
		<td width="100%" height="30" class="listado2">
		<?
		    /**
		    * Mensaje en pantalla si el usuario fue creado o si sus datos fueron actualizados
		    * correctamente.
		    **/
		    if ($accion==1) {?>
		    <span class=etexto><center><B>El ciudadano <?="$ciu_nombre $ciu_apellido"?><br/>fue creado correctamente con el usuario &quot;<?=$tmp_cedula?>&quot;</B></center></span>
		<? } else {
                 
                 ?>
                <span class=etexto><center><B>Los cambios en el ciudadano <?="$ciu_nombre $ciu_apellido"?>
                            <br/> se realizaron correctamente</B></center></span>
		<? } ?>
		</td> 
	    </tr>
	    <tr>	
		<td height="30" class="listado2">
            <?php           
            if($codigo1=="ciu_s"){?>
                <center><input  name="btn_accion" type="button" class="botones" title="Cerrar" value="Cerrar" onclick="window.close();"></center>
            <?}elseif($accion==2){
                $cod_impresion = "'".$_GET['cod_impresion']."'";
                ?>
                <center><input class="botones" type="submit" name="Submit" value="Aceptar" onclick="<?php echo ($cerrar == 'Si') ? "window.opener.refrescar_pagina('OI',".$cod_impresion."); window.close();" : "location='./mnuUsuarios_ext.php?cerrar=$cerrar&accion=$accion'"?>"></center>
            <?}else{?>
                <center><input class="botones" type="submit" name="Submit" value="Aceptar" onclick="<?php echo ($cerrar == 'Si') ? "window.close()" : "location='./mnuUsuarios_ext.php?cerrar=$cerrar'"?>"></center>
            <?}?>
		</td> 
	    </tr>
	</table>
       
    </center>
<?php } ?>
</body>
</html>
