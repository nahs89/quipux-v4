x�V�O�F߯�_�f�9tĆv?TAH)j
QI;U��}�=�;�>C����>�.!	����������ӫ����z�eV��mzAo�d�]Q�&�$#�ZR��^(#+%^gƔ�a���L�{����rQ��Pg�K/��_u����T2�U�h�"�y%�q,�X0��tx~qI�����z���(O��eJ��
2ֹj^���P�a�T�~�Ռ
'P�0��M��L�z�T� �/?ҹT���2�4D�dU�Z�KB܅@��a��x���6�m$a��@W�pe7��E��y�mm$����hp������-�5�^����������AΝ"(XB�w!�'J8�<����b^�J1�R�۹J�&�/B|�]�~�v�}�o�~>�L>���v�~D㏧��a���A�M�܋߂}�TBչA�D��K�\�~��ˤH��������α^��0�\aKە6�C�4�^��dQJ��y<![8Bg���&j̴��WZ���ȫt�M�!�t�6��GJ��u"E��)��4��6cARC��E��fQ�:��xd����Z�uR��|��x�
�i�N�z���@se��,'�B�F�D�n��v�AT��k�(�I3G&��4�B��tq�v�O��H�Y���>q�Zd+���g��sp� �Bą\Qj�m�p�$M�ݫ�]�,���M7l��~%�:>~�/x���������r�h$�th��Æ�H�Ó���C;j���3���i���:bK���7�T���qǻO.�.�T�[Vk��ցHӎv
8��\���DpeV.^����j��i*EK�ga2��)�+�͈��ǠЉ���հ�\
��8�1w@�ḥ��q
]�0��i��:]ؾ��Fz�vp_"�K�0�$�krCEu�k�1��*��r�����'?�=�*k�p�R"��D�j"o�����9���b!����!��e!C����/*�K�����Z�W;�<���q�H+�
��.�AȮ�w��#���~����/��PcG� �IX� YT*umd�
#Fkdf~1�$* D��Ũ�=/�!�4F��	�� |'�֭RĢ�=a2�S��l���ҼB�t��a�k
��OS�i�
j�=X�г
��-/���$7AS�F�l�#p��{�{������U��1���^W�OG-�n���R9Ma�NZ�ީ7t��]?|~��ѯ8������-���kSuhMܣ�=��&{�y�_���e%װ���:�y�w+еaF�|
D�q�1���������oa�wŖ,�i>���gX/�a^^�m+��(�wt�w��\�6$ �e�_�:~԰���?dח
5f����a%z�W�W]�}D=�G�Y�5|M��9Z@�uC��h;n�nv�o\%�7!ܧCom�P�^X�ٝ-_v]t���}�7��^��fu!@3�s��m�Ȼv�v�C�q�z��T`��9����h                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              *  if ($accion == 2) { //Editar
	$tituloForm = "MODIFICACI&Oacute;N DE USUARIOS";


    }
    if ($accion == 3) {	//Consultar
    	$read = "readonly";
	$read2 = "disabled";
	$tituloForm = "CONSULTA DE USUARIOS";
    }*/

include_once "$ruta_raiz/funciones_interfaz.php";
echo "<html>".html_head();

?>

 <script language="JavaScript" src="<?=$ruta_raiz?>/js/prototype.js" type ="text/javascript"></script> 
<script language="JavaScript" src="<?=$ruta_raiz?>/js/general1.js"  type="text/javascript"></script> 
<script language="javascript">
function ltrim(s) {
   return s.replace(/^\s+/, "");
}

function ValidarInformacion()
{
	if(ltrim(document.forms[0].usr_depe.value)=='0')
	{	alert("Seleccione el Area del Usuario.");
		return false;
	}
	if(ltrim(document.forms[0].usr_login.value)=='')
	{	alert("El campo Login del Usuario es obligatorio.");
		return false;
	}
	if(ltrim(document.forms[0].usr_nombre.value)=='' || ltrim(document.forms[0].usr_apellido.value)=='')
	{	alert("Los campos de Nombres y Apellidos son obligatorios.");
		return false;
	}
	if (document.forms[0].usr_estado.checked) {
	    if (!validarCedula(document.forms[0].usr_cedula.value)) 
	    	return false;
	}
	if (!isEmail(document.forms[0].usr_email.value,true))
	{	alert("El campo mail del Usuario no tiene formato correcto.");
		return false;
	}
	return true;
}
</script>
<body>
  <!-- <form name='frmCrear' id='frmCrear'  action="listadoUsuariosinarea.php?accion=<?//=$accion?>" method="post"> -->
    <table width="100%" border="1" align="center" class="t_bordeGris">
  	<tr>
    	    <td  class="titulos4">
		<center>
		<p><B><span class=etexto>Administración de Usuarios y Permisos</span></B> </p>
		<p><B><span class=etexto> <?=$tituloForm ?></span></B> </p></center>
	    </td>
	</tr>
    </table>

    <br/>
    
    <table border=0 width="100%" class="borde_tab" cellpadding="0" cellspacing="0" name="usr_datos" id="usr_datos">
	<tr>
         <td class="listado5"  >
         <td title="usuarios" class="listado5" align="center" >
         <select name="Usuarios" id="Usuarios" size="20"  id="usuarios" multiple  class="listado5" >
         <option  selected >---Elegir Usuario---</option>
         <? 
           $i=1;
	   while (!$rsusuarios->EOF) {
            echo "<option id='usuario".$i. "' value='".$rsusuarios->fields['USUA_CODI']."'>".$rsusuarios->fields['USUA_NOMBRE']."</option>" ;
            $rsusuarios->MoveNext();
            $i=$i+1;
	 }

        ?>      

       </select>
</td>
<td class="listado5"    > 
<input align="center"  class="listado5" name="btn_asignar" id="btn_asignar" type="submit" value="    Asignar Área >>  " onclick="asignar_area(<?=$_SESSION['inst_codi']?>);"  /> <div id="cargando_div" style="display:none"><img src="<?=$ruta_raiz?>/imagenes/progress_bar.gif" /></div> </td>
<td class="listado5"  >
<select name="Area" id="Area" size="20"  align="center" class="listado5">
      		<option selected>---Elegir Área---</option>
             <? 
               $i=1;
	       while (!$rsarea->EOF) {
                echo "<option id='area".$i."'     value='".$rsarea->fields['DEPE_CODI']."'>".$rsarea->fields['DEPE_NOMB']."</option>" ;
                $rsarea->MoveNext();
                $i=$i+1;
	        }
            ?>      
            </select>
</td>
	    <!-- <td class="titulos2" width="20%">* <?//=$_SESSION["descDependencia"]?></td> -->
             
	</tr>
    	
    </table>
     
    <table width="100%" class="borde_tab" align="center"  name="usr_permisos" id="usr_permisos">
     <tr><br> </tr> 
     <Tr > <h3> Listado de usuarios </h3> </Tr>
     <Tr>      
      <TH > Cédula</TH>
      <TH > Nombre</TH>
      <TH > Área Asignada</TH>
      <TH >Acción
      <div id="cargando_div1" style="display:none"><img src="<?=$ruta_raiz?>/imagenes/progress_bar.gif" /></div> </TH>
     </Tr>
    
     
    <? 
	$sq = "select u.usua_codi, u.usua_nombre, u.usua_cedula, u.depe_nomb, u.inst_codi 
            from usuario u where u.usua_esta = 1 and coalesce(u.depe_codi,-1)<>-1 
            and u.inst_codi = ".$_SESSION['inst_codi'];
        if ($depe_codi_admin!=0)
            $sq.=" and depe_codi in ($depe_codi_admin)";
        $sq.=" order by u.usua_nombre";
	
	$rsusuarea = $db->conn->Execute($sq);
    $i=0;
        while (!$rsusuarea->EOF) {
            if($i==1)
            {
         $regis = "<tr class='listado1'    >"."<td>";
         $i=0;
            }
         else
         {
         $regis= "<tr class='listado2'    >"."<td>";
 $i=1;
         }
       //  echo '-'.$i.'-';
	      $regis =  $regis . $rsusuarea->fields['USUA_CEDULA']."</td><td>".	$rsusuarea->fields['USUA_NOMBRE']."</td><td>".
              $rsusuarea->fields['DEPE_NOMB'] ."</td> ";
             echo  $regis;
//          $sn="select depe_codi from dependencia where dep_sigla = 'SN' and inst_codi = ". $_SESSION['inst_codi'];
//          $rsn = $db->conn->Execute($sn);
         //$i=$i+1;
         echo "<td> <input align='center'  class='listado2' name='btn_quitar' id='btn_quitar' type='submit' value='Quitar Área ' onclick='quitar_area(".$rsusuarea->fields['USUA_CODI'].",null,".$_SESSION["inst_codi"].");'  /></tr>";
	 $rsusuarea->MoveNext();
	}
 ?>


    </table>
    <br/>
    <br/>
    <center><input  name="btn_accion" type="button" class="botones" value="Regresar" onClick="location='./mnuUsuarios.php'"/></center>

    <br/>
    <br/>
<!--   </form> -->

    <script>
	function asignar_area(id_institucion) {
           var i = 1;
	   var indexarea;
           var usuario="usuario";
           var id_usuario;
           //var id_institucion;
           var id_area ;
           var data;
           var clazz = "usuario";  
           var action = "update_usuarioarea";
  
  
          //alert(frmCrear.Usuarios.value);
           //alert(document.getElementById("Area").selectedIndex);
           //alert(document.getElementById("Area").options[document.getElementById("Area").selectedIndex]);
            Element.show("cargando_div");
            indexarea = document.getElementById("Area").selectedIndex;
            indexarea="area"+indexarea;
           // alert(indexarea);
           
           if (document.getElementById("Area").selectedIndex  == 0 ){
               alert("No ha seleccionando el Area");
               Element.hide("cargando_div");
            }
            if (document.getElementById("Usuarios").selectedIndex  == 0 ){
               alert("No ha seleccionando Usuarios");
               Element.hide("cargando_div");
            } 
          if ( document.getElementById("Area").selectedIndex > 0 && document.getElementById("Usuarios").selectedIndex > 0 ){
          	for (i=1;i< document.getElementById("Usuarios").length;i++) {
            	     usuario="usuario"+i;
            	     //alert(usuario);
            	if (document.getElementById(usuario).selected ) {
	                //alert(document.getElementById(usuario).selected);
                        //alert(document.getElementById(indexarea).selected);
                	if (document.getElementById(indexarea).selected  ) {
                       	    id_usuario = document.getElementById(usuario).value; 
                            id_area = document.getElementById(indexarea).value;
                             //data="id_usuario="+id_usuario+"&id_area="+id_area+"&id_inistitucion="+5; 
                 	     //data='data=[id_usuario='+id_usuario+';id_area='+id_area+';id_institucion='+5+']';
			     data=id_usuario+','+id_area+','+id_institucion; 					 					
                             //data[1]='id_area='+id_area;
                             //data[2]='id_institucion='+5;
//id_institucion;
			     //alert(data);
                            ajax_call ( data, clazz, action, ver_datos );
                        
                            
                	}
			
		    }
          	}
	   }
          

	}
        function quitar_area(id_usuario,id_area,id_institucion){
        Element.show("cargando_div1");
	var data;
        var clazz = "usuario";  
        var action = "update_usuarioarea";         
        data=id_usuario+','+id_area+','+id_institucion; 	
        
        ajax_call ( data, clazz, action, ver_datos );
}
        function ver_datos(result,resp){	


	if (resp!="")  	{
	//alert("error en ajax ");
        Element.hide("cargando_div");
 	alert(resp);// si hay errores se mostrar� el alert
	}
	else {	  
	       
	Element.hide("cargando_div");
          Element.hide("cargando_div1");
	   //alert("Los usuarios fueron asignados al area seleccionada");
           window.location.reload();
	}

 

       }
    </script>

</body>
</html>
