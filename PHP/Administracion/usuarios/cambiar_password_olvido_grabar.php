x�So�H�ɧ\ݵE؛�C�4�tu�P5M"pA���ڞ�+6���!�陵�*�C�R�xfg�{�#�:�����?���Z�a�:�.�k,��BHK�_��%Y��C�Б�t��3��n�e����˧It�3bU:8IN��}��\,Ј\C�e��p�V<�PQ��c�O�f0�JƳwc2����QY,`�(���Y[�K�j�_޶�R�P+�M��`�7Ƨ�KM�~��DLf�0A��KXl2��ޣ�B+8�-9��L���g�sP���Dڬ���*�n-�G�����W�Q�G�������7�?!%����c����n�B�
�_Hч:�����q��u%*�J�:�����<I?.��&�������A�؇	c�t�8������p�.ςag�;�<��z?8�$��A��ꅶ��g���Y��uC�w#��A�iƕ�]���W�M`𜦈�.޸e��x�(��80:��D*-hd�>���lB�P��4���(b��N�[�4(����D["� Qi���ZՃL��D���t����u/hO��%�
*TM��]�Nfy���!Ϩ�[Q�2z��d��B�IF)m�sZ�8��]����G��S��N����|���W�7i������t��GE}����z�v~;�{�a2�VPq��W�K���u�/���yR���#R�s���!mw����$����ɗ�↯�s�:����QɎOO����G��p)V���`�c��|D8\
c���e�̚�wUl��-�G�k���`��"MbAYZ!-k������C���	��zC�Z�L                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              dula!=$usr_cedula or $txt_email!="a@b.c")) { // Si es ciudadano y cambió su cédula o su email
    // Traemos los datos del ciudadano desde el registro civil
    $datos_ciudadano = &ws_validar_datos_ciudadano($txt_cedula);
    
    $txt_titulo = "Señor";
    $txt_abr_titulo = "Sr.";
    if ($datos_ciudadano["genero"] == "Femenino") {
        if (substr($datos_ciudadano["estado_civil"],0,3) == "Sol") {
            $txt_titulo = "Señorita";
            $txt_abr_titulo = "Srta.";
        } else {
            $txt_titulo = "Señora";
            $txt_abr_titulo = "Sra.";
        }
    }

    $record = array();
    $record["CIU_CODIGO"]       = $cambio_pass_usr_codigo;
    $record["CIU_CEDULA"]       = $db->conn->qstr($txt_cedula);
    $record["CIU_NOMBRE"]       = "initcap(".$db->conn->qstr(limpiar_sql(trim($datos_ciudadano["nombre"]))).")";
    $record["CIU_APELLIDO"]     = $db->conn->qstr("DATOS TRAIDOS DEL REGISTRO CIVIL");
    $record["CIU_TITULO"]       = $db->conn->qstr($txt_titulo);
    $record["CIU_ABR_TITULO"]   = $db->conn->qstr($txt_abr_titulo);
    $record["CIU_ESTADO"]   = 1;
    $record["CIU_DIRECCION"]    = $db->conn->qstr(limpiar_sql(trim($datos_ciudadano["domicilio"])));
    if ($txt_email!='a@b.c') $record["CIU_EMAIL"] = $db->conn->qstr($txt_email);
    $ok1 = $db->conn->Replace("CIUDADANO_TMP", $record, "CIU_CODIGO", false,false,false,false);
    $db->query("update ciudadano set ciu_nuevo=0 where ciu_codigo=".$cambio_pass_usr_codigo);

    if($ok1)
    {
        //Enviar correo al Super Administrador para verificar datos del ciudadano actualizado
        $mail = "<html><title>Informaci&oacute;n Quipux</title>";
        $mail .= "Estimado(a) Administrad@r:";
        $mail .= "<body><center><h1>QUIPUX</h1><br /><h2>Sistema de Gesti&oacute;n Documental</h2><br /><br /></center>";
        $mail .= "El ciudadano $usr_nombre solicit&oacute; que se reinicie su contrase&ntilde;a y "
                ."sus datos fueron validados con el Registro Civil; por favor, verificar la informaci&oacute;n.";
        $mail .= "<br /><br />Saludos cordiales,<br /><br />Soporte Quipux.";
        $mail .= "<br /><br /><b>Nota: </b>Este mensaje fue enviado autom&aacute;ticamente por el sistema, por favor no lo responda.";
        $mail .= "<br />Si tiene alguna inquietud respecto a este mensaje, comun&iacute;quese con <a href='mailto:$cuenta_mail_soporte'>$cuenta_mail_soporte</a>";
        $mail .= "</body></html>";
        enviarMail($mail, "Quipux: Actualización de datos de ciudadano.", $amd_email, "Administrador", $ruta_raiz);
    }

    if ($pass_mensaje=="") { //Mensaje en el caso que se haya cambiado la cuenta de correo electrónico
        $pass_mensaje = "Su cuenta de correo electr&oacute;nico ha sido registrada.<br><br>
                   En unos minutos recibir&aacute; un email en su cuenta de correo electr&oacute;nico &quot;$txt_email&quot; 
                   con las instrucciones para que pueda ingresar su nueva contrase&ntilde;a, 
                   previa autorizaci&oacute;n del Administrador del Sistema.<br><br>
                   Si la direcci&oacute;n de correo electr&oacute;nico que se muestra no le pertenece, por favor escriba un email a
                   &quot;$cuenta_mail_soporte&quot; en el que indique sus datos personales y una cuenta de correo electr&oacute;nico v&aacute;lida. $boton";
    }
}
if ($pass_mensaje=="") {
    $pass_mensaje = "Lo sentimos, no se pudo reiniciar su contrase&ntilde;a por favor coun&iacute;quese con soporte t&eacute;cnico
                enviando un mensaje a la cuenta de correo electr&oacute;nico &quot;$cuenta_mail_soporte&quot;
                en el que indique sus datos personales y una cuenta de correo electr&oacute;nico v&aacute;lida. $boton";
}

die(html_error($pass_mensaje));
?>
