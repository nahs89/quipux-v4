x�Vmo�6�W�W܄`v�ZL�a(R��⸩Q7j7CQ%���D*�7�k�ٰ�L����s�Lg???�.yY�U�=��x5z#
�L����⠥,�:�N�Z8�.���[���"�<1^����6�\���c8;9y6��sxU�B�270����F�,�H0M�b|5���d4������Le.�4U����+f\o�h��YK�,p�Ԥ>/R�[�����Z�\�M�����V�Vg�q+�qC�,DW7�蘴��^���M�d[�lY��t+uhm*�EU�e4>������U��5H����x����r�@���� ������/p�W�P�1%�ە:WM!�Q3��P�x���E�尛|�n4�x3���S��p�Ȁh�د�F�]�/��O�	�k��tX4�_G(Nv;I)x�ߝ�I��p������Y	�}i��F>��� ��7�� oiD����D��pi���hx�E�H��d��=Im$���S�& 6�(��"��X��8�(Y�F�m���.���x�mڼ��ۿ��?�@E�E�sJЮ���鑡�8�o;}���:p����y�5d��P��Ya&�pc%�x��}��ln��0=��u�P��U#P4L���e�	_c��|��2�J���zx�מ����hu���^�w'@aֱ29�pc�)���\qWR��G�^�����z�XO�Hhb-������� S7�op�������5/��PU��Y[��"�`8~��öu & ��7�x����*^8���!�����=35�G�"!Ļ���?�fB�1B4�\P��?��VX:d[��db��,�h��"�N9(�À �_D��F����b2��?�C)�B��*5�G��L]�o�=�Ű�$,0��]p+�h迾a�*���� ���|�}��@����;зde�E��iT΋�`N����k�4����[�`��8�B@�\��3oh����g�Ґt%Щ���ۻ`�B!k���7q�1�ш(�4V,��Ӣ�ꢞV(�_p����U��ɷ�Q�N��Pai��='�G��P6�������;����$��U���/g�=�{:��f������z�+x���}�&?�Mf]݇�)�<E՘�Cr�MP�Ç�Ow�ytY��n��{_�:���A�;äQ.����1�?���?�ڑ���6��-��7�N;�V"�XrZ��o۩�K���T&H0z���v��
BLZM�XU�f�[�/���)�-���X��Z	��8aՐf�A(#�n�v#S����$RW�v�`�V����,��Nb�CxJX��8�Z�{Q                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   a_actualiza,$db);                    
                        $log_cambio = $rs->fields['LOGC_OBSERVACION'];                    
                        $log_cambio = str_replace('<br>',' /&nbsp;',$log_cambio);
                        $institucion=$datosUsr['institucion'];
                        $nombre=$datosUsr['nombre'];
                        $fecha_cambio=$rs->fields['FECHA_CAMBIO'];  
                        $tabla=$rs->fields['LOGC_TABLA_MODIFICADA'];
                        $tipo_transaccion=$rs->fields['ID_TRANSACCION'];
                        if ($tipo_transaccion==1)
                            $descTransaccion = "Edición";
                        else
                            $descTransaccion = "Nuevo";
                        if (trim(mensajeLog($log_cambio,$tabla,$ciud))!='')
                        $html.="<tr class='listado2'><td>$institucion</td><td>".$nombre."</td><td>".substr($fecha_cambio,0,19)." ".$descZonaHoraria."</td>
                            <td>".$descTransaccion."</td>
                            <td>".mensajeLog($log_cambio,$tabla,$ciud)."</td></tr>";

                        $rs->MoveNext();
                 }
             }else
                 $html.="<table width='100%' border='0' class='border_tab'>
                     <tr><td align='center'>No Existe Registros</td></tr>";
             //foreach (=> $error) {
             $html.= "</table>";
        }else 
            return 0;
            
echo $html;
//funcion para filtrar palabras clave del log
function mensajeLog($log_cambio,$tabla,$ciud){
    $mensaje="";
    $log_cambio = str_replace('**','',$log_cambio);
    $log_cambio = str_replace('_',' ',$log_cambio);
    if ($tabla != 2)
     $arr_encontrar=array('SOL','CIU','CODIGO','USUA','CODI');
    else
        $arr_encontrar=array('USUA');
    $log_cambio = str_replace($arr_encontrar,'',$log_cambio);
    $log_cambio = str_replace('DAD','CIUDAD',$log_cambio);
    $log_cambio = str_replace('CIU CODI','CIUDAD',$log_cambio);
    
    switch ($tabla)
    {
        case '3':             
            $arr_buscar = explode(":", $log_cambio);           
            foreach ($arr_buscar as $tmp=>$value) {                
                        $mensaje.=$value;
                }
               
                break;
                default;                    
                    $mensaje=$log_cambio;
                    break;
    }
    //reemplazamos para que sea legible los datos
    $mensaje = str_replace('ESTADO de 1 a 2','ESTADO DE SOLICITUD de EDICIÓN A ENVIADO',$mensaje);
    $mensaje = str_replace('ESTADO de 2 a 0','ESTADO DE SOLICITUD de ENVIADO a RECHAZADO',$mensaje);
    $mensaje = str_replace('ESTADO de 0 a 2','ESTADO DE SOLICITUD de RECHAZADO a ENVIADO',$mensaje);
    $mensaje = str_replace('ESTADO de 2 a 3','ESTADO DE SOLICITUD de ENVIADO a AUTORIZADO',$mensaje);
    $mensaje = str_replace('ACUERDO de 1 a 0','ACUERDO DE REGISTRADO a ELIMINADO',$mensaje);
    $mensaje = str_replace('ACUERDO de 0 a 1','ACUERDO REGISTRADO',$mensaje);
    $mensaje = str_replace('ACUERDO ESTADO de 0 a 1','ACUERDO ACEPTADO',$mensaje);
    $mensaje = str_replace('ACUERDO ESTADO de 1 a 0','',$mensaje);
    $mensaje = str_replace('FIRMA de 1 a 2 /','',$mensaje);
    $mensaje = str_replace('FIRMA de 2 a 1 /','',$mensaje);    
    $mensaje = str_replace('CIUDAD 0 /','',$mensaje);
    $mensaje = str_replace('ESTADO: 1 /','',$mensaje);
    $mensaje = str_replace('INST : 2 /','',$mensaje);
    $mensaje = str_replace('NUEVO : 0 /','',$mensaje);
    $mensaje = str_replace('ESTADO: de 0 a 1 /','Se han actualizado datos temprales /',$mensaje);
    $mensaje = str_replace('ESTADO: de 1 a 0 /','Se han actualizado datos temprales /',$mensaje);
    $mensaje = str_replace('ACTUALIZA','',$mensaje);
    $mensaje = str_replace('NUEVO: 0','',$mensaje);
    $mensaje = str_replace('NUEVO: de 1 a 0','Se activa cambiar Contraseña',$mensaje);
    $mensaje = str_replace('/:','',$mensaje);     
    $mensaje = str_replace('PAIS','PAÍS',$mensaje);
    $mensaje = str_replace('CANTON','CANTÓN',$mensaje);
    $mensaje = str_replace('CEDULA','CÉDULA',$mensaje);
    $mensaje = str_replace('TITULO','TÍTULO',$mensaje);
    $mensaje = str_replace('INSTITUCION','INSTITUCIÓN',$mensaje);
    $mensaje = str_replace('TELEFONO','TELÉFONO',$mensaje);
    $mensaje = str_replace('DIRECCION','DIRECCIÓN',$mensaje);
    $mensaje = str_replace('CODI','',$mensaje);
    $mensaje = str_replace('DEPE','ÁREA',$mensaje);
    $mensaje = str_replace('ESTA: 1','',$mensaje);
    $mensaje = str_replace('ESTA: 0','',$mensaje);
    $mensaje = str_replace('ESTADO 1 -> 2','Solicitud Enviada',$mensaje);
    $mensaje = str_replace('ESTADO 0 -> 2','Solicitud Enviada',$mensaje);
    $mensaje = str_replace('ESTADO 2 -> 0','Solicitud Rechazada',$mensaje);
    $mensaje = str_replace('ESTADO: 0 -> 1','Activo',$mensaje);
    $mensaje = str_replace('ESTADO: 1 -> 0','Activo',$mensaje);
    $mensaje = str_replace('ESTA: 0 -> 1','Inactivo -> Activo',$mensaje);
    $mensaje = str_replace('ESTA: 1 -> 0','Activo -> Inactivo',$mensaje);
    $mensaje = str_replace('VISIBLE SUB: 1','',$mensaje);
    $mensaje = str_replace('VISIBLE SUB: 0','',$mensaje);
    $mensaje = str_replace('NUEVO: 1','',$mensaje);
    $mensaje = str_replace('CARGO TIPO: 0','',$mensaje);
    $mensaje = str_replace('CARGO TIPO: 1','',$mensaje);
    $mensaje = str_replace('TIPO IDENTIFICACION: 0','',$mensaje);
    $mensaje = str_replace('TIPO IDENTIFICACION: 1','',$mensaje);
    $mensaje = str_replace('-> 0','Cambio de contraseña',$mensaje);
    $posicion = strpos($mensaje,'PASW:');
    if ($posicion>0)
    $mensajePasw = substr($mensaje,$posicion,32);
    $mensaje = str_replace($mensajePasw,'',$mensaje);
    
    
    
    return $mensaje;
}


?>