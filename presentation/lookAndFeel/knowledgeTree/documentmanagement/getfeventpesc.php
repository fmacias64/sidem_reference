<?php

require_once("../../../../config/dmsDefaults.php");



if (checkSession()) {

  //echo "hola";
$id_docactual=$_GET[idd];
$id_enlacesel=$_GET[cc];
 

KTUtil::extractGPC('fDocumentID');
require_once("../../../Html.inc");
require_once("$default->fileSystemRoot/lib/documentmanagement/Document.inc");
require_once("$default->fileSystemRoot/presentation/lookAndFeel/knowledgeTree/documentmanagement/viewUI.inc");
require_once("$default->fileSystemRoot/lib/documentmanagement/DocumentCollaboration.inc");

$letra = $_GET["letra"];

//if (!checkSession2()) {
//echo 'oh';
//   $cookietest = KTUtil::randomString();
//  setcookie("CookieTestCookie", $cookietest, false);


//  $dbAuth = new $default->authenticationClass;
//      $userDetails = $dbAuth->login("admin","admin");

//
//    $session = new Session();
//          $sessionID = $session->create($userDetails["userID"]);

            // initialise page-level authorisation array
//          $_SESSION["pageAccess"] = NULL;
//    echo $_SESSION["userID"];

            // check for a location to forward to
          
//echo 'eh';
//}           

//echo 'ah';
$id_docactual=256;
$id_enlacesel=34;
 
function userIsInGroup1($iGroupID2) {       
        global $default, $lang_err_user_group;
        $sql2 = $default->db;
        $sQuery2 = "SELECT id FROM " . $default->users_groups_table . " WHERE group_id = ? AND user_id = ?";/*ok*/
        $aParams2 = array($iGroupID2, $_SESSION["userID"]);
        $sql2->query(array($sQuery2, $aParams2));
        if ($sql2->next_record()) {
reset($_SESSION);          
  return true;
        }
else {
reset($_SESSION);
       return false;}

    
}
function stri_replace( $find, $replace, $string ) {
// Case-insensitive str_replace()

  $parts = explode( strtolower($find), strtolower($string) );

  $pos = 0;

  foreach( $parts as $key=>$part ){
    $parts[ $key ] = substr($string, $pos, strlen($part));
    $pos += strlen($part) + strlen($find);
  }

  return( join( $replace, $parts ) );
}


function txt2html($txt) {
// Transforms txt in html

  //Kills double spaces and spaces inside tags.
  while( !( strpos($txt,'  ') === FALSE ) ) $txt = str_replace('  ',' ',$txt);
  $txt = str_replace(' >','>',$txt);
  $txt = str_replace('< ','<',$txt);

  //Transforms accents in html entities.
  $txt = htmlentities($txt);

  //We need some HTML entities back!
  $txt = str_replace('&quot;','"',$txt);
  $txt = str_replace('&lt;','<',$txt);
  $txt = str_replace('&gt;','>',$txt);
  $txt = str_replace('&amp;','&',$txt);

  //Ajdusts links - anything starting with HTTP opens in a new window
  $txt = stri_replace("<a href=\"http://","<a target=\"_blank\" href=\"http://",$txt);
  $txt = stri_replace("<a href=http://","<a target=\"_blank\" href=http://",$txt);

  //Basic formatting
  $eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";
  $html = '<p>'.str_replace("$eol$eol","</p><p>",$txt).'</p>';
  $html = str_replace("$eol","<br />\n",$html);
  $html = str_replace("</p>","</p>\n\n",$html);
  $html = str_replace("<p></p>","<p>&nbsp;</p>",$html);

  //Wipes <br> after block tags (for when the user includes some html in the text).
  $wipebr = Array("table","tr","td","blockquote","ul","ol","li");

  for($x = 0; $x < count($wipebr); $x++) {

    $tag = $wipebr[$x];
    $html = stri_replace("<$tag><br />","<$tag>",$html);
    $html = stri_replace("</$tag><br />","</$tag>",$html);

  }

  return $html;
}



 

//=======MIKE======//
//== busqueda de todos aquellos individuos relacionados con el documento  y q su link sea de tipo individuo has individuo ==

function displayBotonEventosF($oDocument, $bEdit) {
	global $default;

	//=======>>>>  busqueda para encontrar el tipo de enlace =========>>>>

	$ONE= "SELECT A.`id` FROM `document_types_lookup` AS A, `document_types_lookup` AS B WHERE A.`enlazadoA`=B.`id` AND A.`enlazadoB`=".$oDocument->getDocumentTypeID()."  AND B.`name` LIKE 'Eventos'" ;
	$TWO = mysql_query($ONE);
	$tipoenlace = mysql_fetch_row($TWO);


 return displayButton("addDocument", "fFolderID=9&arch=2&botview=101&tipoen=".$tipoenlace[0]."&docqllama=".$oDocument->getID(), "Agregar Eventos");
     }





   $iddoc=$letra;
  
   // echo count($letrasar);
   // echo $letra;

 echo "<link rel=\"stylesheet\" href=\"$default->uiUrl/stylesheet.php\">\n";

 echo "<table style='text-align: left; width:60% ; ' border='1'  cellpadding='2' cellspacing='2' ><tbody>

<tr>
    <td><table width=100% height=70%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'><font size=1 face='Arial'><tbody>";

  


$iddoc = $_GET["letra"];

// $iddoc=$_GET('letra');

$oDocument = & Document::get($iddoc);
  
 
  echo "<tr><TH rowspan='1'><TH colspan='3'align='center' bgcolor='orange'><font size=1 face='Arial' color='white'>Datos del Evento</font></tr></th> <tr><td valign='center' height=40% align='left' bgcolor='lightgray'>";

  //======= se integra la imagen del individuo a los resultados de la busqueda ======
 
  // echo $iddoc;
   $docs="img/".$oDocument->getFileName();
 
if ($sectionName == "") {
    $sectionName = $default->siteMap->getSectionName(substr($_SERVER["PHP_SELF"], strlen($default->rootUrl), strlen($_SERVER["PHP_SELF"])));
}

 //====== BUSQUEDA DE CAMPOS DEL DOCUMENTO ===============>>>>>

$indv_rel= "SELECT * FROM `document_fields_link` WHERE `document_field_id`<> 1  AND `document_id`=".$iddoc;
$indv_rel1 = mysql_query($indv_rel);
//$indv_rel2 = mysql_fetch_row($indv_rel1);

 while ($indv_rel2 = mysql_fetch_row($indv_rel1))
{

 
 
 if ($indv_rel2[2]==109) {
    $date=$indv_rel2[3];
    
}
 if ($indv_rel2[2]==110 ){
   $region=$indv_rel2[3];

}
if ($indv_rel2[2]==161){
 //   $zcity=$indv_rel2[3];
 $lugar=$indv_rel2[3];
if ($lugar>0){

$linkA3 = "SELECT C.`dos` FROM  `Lugares`.`Lugares` as A, `Lugares`.`Pais` as C WHERE A.`cinco` = C.`id` AND A.`id`=".$lugar;
$linkB3 = mysql_query($linkA3);
$dato3=mysql_fetch_row($linkB3);

$linkA2 = "SELECT B.`dos` FROM   `Lugares`.`Lugares` as A, `Lugares`.`Estado` as B WHERE A.`cuatro` = B.`id` AND A.`id`=".$lugar;
$linkB2 = mysql_query($linkA2);
$dato2=mysql_fetch_row($linkB2);

$linkA1 = "SELECT `dos`  FROM   `Lugares`.`Lugares` WHERE `id`=".$lugar;
$linkB1 = mysql_query($linkA1);

$dato1=mysql_fetch_row($linkB1);



$partnom=$dato1[0].",".$dato2[0].",".$dato3[0];
}
else {$partnom="";}
    
}

if ($indv_rel2[2]==164 ){
    $typeof=$indv_rel2[3];

}
 if ($indv_rel2[2]==113 ){
    $summ=$indv_rel2[3];

}
if ($indv_rel2[2]==114){
    $note=$indv_rel2[3];

}
if ($indv_rel2[2]==264 ){
    $summ0=$indv_rel2[3];

}
if ($indv_rel2[2]==273 ){
    $ispol=$indv_rel2[3];

}
if ($indv_rel2[2]==274){
    $isecon=$indv_rel2[3];

}
if ($indv_rel2[2]==275){
    $issocial=$indv_rel2[3];

}
if ($indv_rel2[2]==276 ){
    $iscont=$indv_rel2[3];

}
if ($indv_rel2[2]==82 ){
    $source=$indv_rel2[3];

}


}



 echo "
<font size=1 face='ARIAL' color='blue'>RECORD DATE</font></td>
<td ><font size=1 face='ARIAL' >".$date ."</font>";


 


if (userIsInGroup1(1)){
$bEdit=1;
if(!($sectionName =="Administration")){
echo"
<td>".displayBotonRelacInddesdeEventpesc($oDocument, $bEdit)."
".displayBotonRelacInstdesdeEventpesc($oDocument, $bEdit)."
<!---".displayBotonRelacMultdesdeEventos($oDocument, $bEdit)."-->
</td>";
echo"
<td>".displayBotonEditar($oDocument, $bEdit)."
".displayCheckInOutButton($oDocument, $bEdit)."</td>"; 

	
				}	

		}


echo "
<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>REGION</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$region."</font></td>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>CITY</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$partnom."</font></td>
</tr>

<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>TYPE OF SOURCE</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$typeof."</font></td>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>SOURCE</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$source."</font></td>
</TR>

<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>IS IT POLITICS?</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$ispol."</font></td>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>IS IT ECONOMIC?</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$isecon."</font></td>
</tr>

<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>IS IT SOCIAL?</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$issocial."</font></td>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>IS IT CONTENGENCY?</font></td>
<td colspan='1'><font size=1 face='ARIAL'>".$iscont."</font></td>
</tr>

<TR>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>SUMMARY</font></td>
<td colspan='3'><font size=1 face='ARIAL'>".$summ."</font></td>
</tr>

<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>COMPLETE NOTE</font></td>
<td colspan='3'><font size=1 face='ARIAL'>".$note."</font></td>
</TR>

<tr>
<td bgcolor='lightgray'><font size=1 face='ARIAL' color='blue'>SUMMARY0</font></td>
<td colspan='3'><font size=1 face='ARIAL'>".$summ0."</font></td>
</tr>


";

/**
$notehtml=txt2html($not);
echo "
<tr>
<td bgcolor='lightgray'><font size=1 face='Arial' color='blue'>FULL NOTE</font></td>
<td colspan='3'><font size=1 face='Arial'>".$notehtml."</font></td>

</tr>

";
 */

echo "</td></tr></tbody></table></td></tr>";



//================>>>> INICIA INDIVIDUOS ===============>>>>
echo "<tr><td>";


$resulta= mysql_query("SELECT id FROM `documents` WHERE ((`parent_document_id`= $iddoc)  or ( `child_document_id`= $iddoc)) and `document_type_id`=5 and `status_id` = 1") or die("deadind1"); 
$indice=0;
while ($row =  mysql_fetch_row($resulta)) 
{ 
//$liste3[] = $row[0];
//$elrow=$row[0];
 $indice++; 
}
 

// Si indice es mayor a 0 existe trayectoria
if($indice>0)
{
echo "<tr><td>";
echo "<table width=100% height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'><th bgcolor='orange' colspan=2><font size=1 face='Arial'  color='white'><center>Individuo</center></font></th><tbody>";
echo "<tr>";

echo "<th bgcolor='lightgray'><font size=1 face='Arial' color='blue'>Individuo</font></td>";
echo "<th bgcolor='lightgray'><font size=1 face='Arial' color='blue'>Nacionalidad</font></th>";



/**
$result3= mysql_query("SELECT a.document_id, a.value,ea.value,eb.value,ec.value,ed.value, h.name,h.id, ee.value FROM `document_fields_link` as a,`document_fields_link` as ea,`document_fields_link` as eb,`document_fields_link` as ec ,`document_fields_link` as ed ,`document_fields_link` as ee, `documents` as doc ,`documents` as h WHERE doc.`id` = a.`document_id` and a.`document_field_id`=12 AND ea.`document_id`=eb.`document_id` AND ea.`document_id`=ec.`document_id` AND ea.`document_id`=ed.`document_id`  AND ea.`document_field_id`=8 AND eb.`document_field_id`=21 AND ec.`document_field_id`=22 AND ed.`document_field_id`=23 AND ee.`document_field_id`=54 AND ee.`document_id`=ea.`document_id` AND (((h.`id` = doc.`parent_document_id` AND ea.`document_id`=h.`id`) and h.`document_type_id`=18) or ((h.`id` = doc.`child_document_id` AND ea.`document_id`=h.`id`) and h.`document_type_id`=18))  and doc.`document_type_id`=5 and doc.`status_id` = 1 and ((doc.`parent_document_id`= $iddoc)  or ( doc.`child_document_id`= $iddoc)) order by eb.value desc ") or die("deadw"); 

*/

$result3= mysql_query("select * from individuo_eventos where parent_id= $iddoc or child_id= $iddoc");

while($row3 =  mysql_fetch_row($result3))
{
  

/**
if ($lug>0){
$oneev1="SELECT `name` FROM `documents` WHERE `id` =".$row3[5];
$twoev1=mysql_query($oneev1);
$threev1=mysql_fetch_row($twoev1);

$Lug=explode(" ",$threev1[0]);
} else {$Lug=explode("_"," _N/A_ _ _ ");}
*/


if ($row3[1]==$iddoc){$indv_id=$row3[2];}
else {$indv_id=$row3[1];}
$indv0="SELECT * FROM `individuos` WHERE `id` =".$indv_id;
$indv1=mysql_query($indv0);
$indv2=mysql_fetch_row($indv1);

echo "<tr>";

echo "<td ><a href='/FichasBD/branches/SY/control.php?action=getficha&letra=".$indv2[0] ."' target='fichas2' ><font size=1 face='Arial'>".$indv2[1] ." ".$indv2[2] ." ".$indv2[3] ."</font></a></td>";
echo "<td ><font size=1 face='Arial'>".$indv2[5] ."</font></td>";
echo "</tr>";


} // cierre del for}




echo "</tr></tbody></table></td></tr>";

}  // fin de indice






//=================<<<< TERMINA INDIVIDUOS <<<<=============

//================>>>> INICIA INSTITUTO ===============>>>>
echo "<tr><td>";


$resulta= mysql_query("SELECT a.`id` FROM `documents` as a ,`document_fields_link` as b WHERE b.`document_id` = a.`id` AND b.`document_field_id` = 12 AND ((a.`parent_document_id`= $iddoc)  or ( a.`child_document_id`= $iddoc)) and a.`document_type_id`=45 and a.`status_id` = 1 order by b.`value`") or die("deadw1");

$indice=0;
while ($row =  mysql_fetch_row($resulta)) 
{ 

 $indice++; 
}
 
if($indice>0)
{
echo "<tr><td>";
echo "<table width=100% height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'><thead><font size=2 face='Times'  color='blue'><center>Instituto</center></font></thead><tbody>";
echo "<tr>";
echo "<th><font size=2 face='Times' color='blue'>Multimedia</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Instituto</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Razon Sozial</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Fecha de <br>Registro</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Fecha de <br>Fundacion </font></td>";
echo "<th><font size=2 face='Times' color='blue'>Industria_Ambito </font></td>";
echo "<th><font size=2 face='Times' color='blue'>Telefono</font></td>";

echo "<th><font size=2 face='Times' color='blue'>Sitio Web</font></td>";
//echo "<th><font size=2 face='Times' color='blue'></font></th>";

echo "</tr>";






$result3= mysql_query("select * from empresa_eventos where parent_id= $iddoc or child_id = $iddoc");

while($row0 =  mysql_fetch_row($result3))
{
  


if ($row0[1]==$iddoc){$inst_id=$row0[2];}
else {$inst_id=$row0[1];}
$emp0="SELECT * FROM `empresas` WHERE `id` =".$inst_id;
$emp1=mysql_query($emp0);
$emp2=mysql_fetch_row($emp1);


echo "<tr>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getmultimedia&letra=".$emp2[0] ."' target='_blank' >Ver<br>Multimedia</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[3]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[5]."</font></td>";
echo "<td ><font size=2 face='Times'>". $row0[7]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[4]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[7]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[1]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$emp2[0] ."' target='fichas2' >". $emp2[6]."</font></td>";





echo "</tr>";

} // cierre del for}




echo "</tr></tbody></table></td></tr>";

}  // fin de indice






//=================<<<< TERMINA INSTITUCION <<<<=============


//=================>>>> INICIA MULTIMEDIA =============>>>>


echo "<tr><td>";


$resulta= mysql_query("SELECT a.`id` FROM `documents` as a ,`document_fields_link` as b WHERE b.`document_id` = a.`id` AND b.`document_field_id` = 12 AND ((a.`parent_document_id`= $iddoc)  or ( a.`child_document_id`= $iddoc)) and a.`document_type_id`=50 and a.`status_id` = 1 order by b.`value`") or die("deadw1");

$indice=0;
while ($row =  mysql_fetch_row($resulta)) 
{ 

 $indice++; 
}
 
if($indice>0)
{
echo "<tr><td>";
echo "<table width=100% height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'><thead><font size=2 face='Times'  color='blue'><center>Multimedia</center></font></thead><tbody>";
echo "<tr>";

echo "<th><font size=2 face='Times' color='blue'>ID1</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Archivo</font></td>";
echo "<th><font size=2 face='Times' color='blue'>Comentario</font></td>";


echo "</tr>";





$result3= mysql_query("select * from eventos_multimedia where parent_id= $iddoc or child_id = $iddoc");



while($row0 =  mysql_fetch_row($result3))
{
  


if ($row0[1]==$iddoc){$mult_id=$row0[2];}
else {$mult_id=$row0[1];}
$mult0="SELECT * FROM `multimedia` WHERE `id` =".$mult_id;
$mult1=mysql_query($mult0);
$mult2=mysql_fetch_row($mult1);


$busq_links="SELECT `filename` FROM `documents` WHERE `status_id`<=2 AND `document_type_id`= 33 AND `id`=".$mult2[0];
$busq_links1 = mysql_query($busq_links);
$busq_links2 = mysql_fetch_row($busq_links1);

echo "<tr>";

echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getmultimedia&letra=".$iddoc ."' target='fichas2' >". $mult2[0]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getmultimedia&letra=".$iddoc ."' target='fichas2' > ".$busq_links2[0]."</font></td>";
echo "<td ><font size=2 face='Times'><a href='/FichasBD/branches/SY/control.php?action=getmultimedia&letra=".$iddoc ."' target='fichas2' >". $mult2[1]."</font></td>";


echo "</tr>";

} // cierre del for}




echo "</tr></tbody></table></td></tr>";

}  // fin de indice






//=================<<<< TERMINA MULTIMEDIA <<<<=============




echo "</table>";


// SELECT * FROM `documents` WHERE `document_type_id`=2

//===============>>  Termina busqueda  =========>>

 
//abajo 1-hacer select name, id  from documents where tipo-doc = $tipodocs_enlazados[1]
$linkA = "SELECT `name`, `id` FROM  `documents` WHERE `status_id`= 1 AND `document_type_id`=".$tipodocs_enlazados[1];
$linkB = mysql_query($linkA);
 


 
 


 


 }

 ?>