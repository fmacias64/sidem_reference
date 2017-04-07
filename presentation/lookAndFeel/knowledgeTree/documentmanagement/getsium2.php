<?php

require_once("../../../../config/dmsDefaults.php");
require_once("$default->fileSystemRoot/lib/visualpatterns/NavBar.inc");
require_once("$default->fileSystemRoot/presentation/Html.inc");



$id_docactual=$_GET[idd];
$id_enlacesel=$_GET[cc];
 

KTUtil::extractGPC('fDocumentID');
require_once("../../../Html.inc");
require_once("$default->fileSystemRoot/lib/documentmanagement/Document.inc");
require_once("$default->fileSystemRoot/presentation/lookAndFeel/knowledgeTree/documentmanagement/viewUI.inc");
require_once("$default->fileSystemRoot/lib/documentmanagement/DocumentCollaboration.inc");




 
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
 $txt = str_replace("&amp;#8217;","&rsquo;",$txt);
$txt = str_replace("&amp;#8232;","&rsquo;",$txt);
  $txt = str_replace("\x92","&rsquo;",$txt);
$txt = str_replace("\x93","&quot;",$txt);
$txt = str_replace("\x94","&quot;",$txt);
$txt = str_replace("\x96","&quot;",$txt);
$txt = str_replace("\x97","&quot;",$txt);
$txt = str_replace("\x99"," ",$txt);
$txt = str_replace("\x80","Euros ",$txt);
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

//=======================>>>>> INICIA ==============>>>>>

   $iddoc=$letra;

 $storend= "<link rel=\"stylesheet\" href=\"$default->uiUrl/stylesheet.php\">\n";

 $storend.= "<table  align='center' style='text-align: left; width:648px ;height:80%; ' border='1'  cellpadding='2' cellspacing='2' >
<tr>
    <td><table  height=70%  align='left' style='text-align: left';'width: 600px;' border='1'  cellpadding='2' cellspacing='2'><font size=4 face='Arial'><tbody>";

  


$iddoc = $_GET["letra"];
$oDocument = & Document::get($iddoc);
  
 
  $storend.="<tr>
<th rowspan='1' align='center'><a href='http://proveedores.intelect.com.mx/FichasBD/branches/SY/presentation/lookAndFeel/knowledgeTree/documentmanagement/getsium.php?industry=BUILDING%20MATERIALS&region=NOAM'><font size=4 face='Arial' color='red'><img src='http://proveedores.intelect.com.mx/FichasBD/branches/SY/graphics/inicio1.gif' width='40' height='40' alt='pagina de inicio'></a></th>
<TH colspan='2'align='center' bgcolor='orange' ><font size=4 face='Arial' color='white'>Datos del Evento</font></th></th></tr> 
";

   $docs="img/".$oDocument->getFileName();


 //==================>>>> busqueda para datos =================>>>

$indv_rel= "SELECT * FROM `document_fields_link` WHERE `document_field_id`<> 1  AND `document_id`=".$iddoc;
$indv_rel1 = mysql_query($indv_rel);
//$indv_rel2 = mysql_fetch_row($indv_rel1);

 while ($indv_rel2 = mysql_fetch_row($indv_rel1))
{

   
 if ($indv_rel2[2]==102) {
    $total=$indv_rel2[3];
    
}
  
 if ($indv_rel2[2]==103) {
    $gross=$indv_rel2[3];
    
}
  
 if ($indv_rel2[2]==104) {
    $operI=$indv_rel2[3];
    
}
  
 if ($indv_rel2[2]==105) {
    $netr=$indv_rel2[3];
    
}
  
 if ($indv_rel2[2]==106) {
    $ebitda=$indv_rel2[3];
    
}
 if ($indv_rel2[2]==109 ){
   $date=$indv_rel2[3];

}
 if ($indv_rel2[2]==110){
   $reg=$indv_rel2[3];

}

 if ($indv_rel2[2]==113 ){
    $summ=$indv_rel2[3];

}
if ($indv_rel2[2]==114){
    $note=$indv_rel2[3];

}
if ($indv_rel2[2]==115 ){
    $sour=$indv_rel2[3];

}
if ($indv_rel2[2]==116 ){
    $compds=$indv_rel2[3];

}
if ($indv_rel2[2]==117 ){
    $compsp=$indv_rel2[3];

}
if ($indv_rel2[2]==118 ){
    $rect=$indv_rel2[3];

}
if ($indv_rel2[2]==119 ){
    $top=$indv_rel2[3];

}
if ($indv_rel2[2]==120 ){
    $consq=$indv_rel2[3];

}
if ($indv_rel2[2]==121 ){
    $react=$indv_rel2[3];

}
if ($indv_rel2[2]==122 ){
    $suste=$indv_rel2[3];

}
if ($indv_rel2[2]==125 ){
    $tecte=$indv_rel2[3];

}
if ($indv_rel2[2]==123 ){
    $sustp=$indv_rel2[3];

}
if ($indv_rel2[2]==124 ){
    $sustt=$indv_rel2[3];

}
if ($indv_rel2[2]==126 ){
    $techs=$indv_rel2[3];

}
if ($indv_rel2[2]==127 ){
    $act=$indv_rel2[3];

}
if ($indv_rel2[2]==130 ){
    $relindv=$indv_rel2[3];

}
if ($indv_rel2[2]==136 ){
    $compd=$indv_rel2[3];

}
if ($indv_rel2[2]==137 ){
    $istec=$indv_rel2[3];

}
if ($indv_rel2[2]==138 ){
    $iscorp=$indv_rel2[3];

}
if ($indv_rel2[2]==139 ){
    $issusta=$indv_rel2[3];

}

if ($indv_rel2[2]==142 ){
//    $comp=$indv_rel2[3];
  $competidor=$indv_rel2[3];
if ($competidor>0){
$one="SELECT `name` FROM `documents`  WHERE  id=".$competidor;
$two=mysql_query($one);
$three=mysql_fetch_row($two);
$partnomcompM=explode("_",$three[0]);
$partnomcomp=$partnomcompM[1];
}
else {$partnomcomp="";}


}
if ($indv_rel2[2]==148 ){
    $country=$indv_rel2[3];

}

if ($indv_rel2[2]==149 ){
    $amount=$indv_rel2[3];

}
if ($indv_rel2[2]==150 ){
    $add=$indv_rel2[3];

}

if ($indv_rel2[2]==152){
    $plant=$indv_rel2[3];
}
if ($indv_rel2[2]==155){
    $typecor=$indv_rel2[3];
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


if ($indv_rel2[2]==163){
    $techd=$indv_rel2[3];
}
if ($indv_rel2[2]==164){
    $typeso=$indv_rel2[3];
}
}


if(empty($date)){
$storend.=" ";
 
}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray' valign='center' align='left'>
<font size=4 face='Arial' color='blue'>Date</font></td>
<td><font size=4 face='Arial'>".$date ."</font></td></tr>";
}

if(empty($reg)){
$storend.=" ";

}
else
{
$storend.="
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Region</font></td>
<td ><font size=4 face='Arial'>".$reg."</font></td>
</tr>";
}

if(empty($country)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Country</font></td>
<td ><font size=4 face='Arial'>".$country ."</font></td>
</tr>";
}

if(empty($partnom)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>City</font></td>
<td colspan='1'><font size=4 face='Arial'>".$partnom."</font></td>
</tr>";
}

if(empty($plant)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Plant</font></td>
<td colspan='1'><font size=4 face='Arial'>".$plant."</font></td>
</tr>";
}

if(empty($partnomcomp)){
$storend.=" ";

}
else
{
$storend.= "

<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Competitor</font></td>
<td colspan='1'> <a href='/FichasBD/branches/SY/control.php?action=getfinst&letra=".$competidor."' target='fichas2' ><font size=4 face='Arial' color='red'>".$partnomcomp."</font></a></td>
</tr>";
}

if(empty($sour)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Source</font></td>
<td><font size=2 face='Arial'>".$sour."</font></td>
</tr>";
}

if(empty($compd)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Is Competitive <br>Dynamic?</font></td>
<td><font size=4 face='Arial'>".$compd."</font></td>
</tr>";
}

if(empty($act)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Competitive <br>Dynamic Action</font></td>
<td><font size=4 face='Arial'>".$act."</font></td>
</tr>";
}

if(empty($compds)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Competitive <br>Dynamic Sector</font></td>
<td><font size=4 face='Arial'>".$compds."</font></td>
</tr>";
}

if(empty($amount)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Amount</font></td>
<td><font size=4 face='Arial'>".$amount."</font></td>
</tr>";
}

if(empty($add)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Added Capacity</font></td>
<td><font size=4 face='Arial'>".$add."</font></td>
</tr>";
}

if(empty($compsp)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Competitive <br>Dynamic SP</font></td>
<td><font size=4 face='Arial'>".$compsp."</font></td>
</tr>";
}

if(empty($istec)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Is Technology?</font></td>
<td><font size=4 face='Arial'>".$istec."</font></td>
</tr>";
}

if(empty($tecte)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Technology <br>Action</font></td>
<td colspan='1'><font size=4 face='Arial'>".$tecte."</font></td>
</tr>";
}

if(empty($techs)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Technology Type</font></td>
<td><font size=4 face='Arila'>".$techs."</font></td>
</tr>";
}

if(empty($techd)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Technology Description</font></td>
<td><font size=4 face='Arial'>".$techd."</font></td>
</tr>";
}

if(empty($issusta)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Is Sustainability?</font></td>
<td ><font size=4 face='Arial'>".$issusta."</font></td>
</tr>";
}

if(empty($suste)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Sustainability <br>Action</font></td>
<td><font size=4 face='Arial'>".$suste."</font></td>
</tr>";
}

if(empty($sustp)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Sustainability <br>Type</font></td>
<td colspan='1'><font size=4 face='Arial'>".$sustp."</font></td>
</tr>";
}

if(empty($sustt)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Sustainability Theme</font></td>
<td><font size=4 face='Arial'>".$sustt."</font></td>
</tr>";
}

if(empty($iscorp)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Is Corporate?</font></td>
<td ><font size=4 face='Arial'>".$iscorp."</font></td>
</tr>";
}

if(empty($total)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Total Income</font></td>
<td><font size=4 face='Arial'>".$total."</font></td>
</tr>";
}

if(empty($rect)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Gross Profits</font></td>
<td><font size=4 face='Arial'>".$rect."</font></td>
</tr>";
}


if(empty($operI)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Operating Income</font></td>
<td><font size=4 face='Arial'>".$operI."</font></td>
</tr>";
}


if(empty($netr)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Net Revenue</font></td>
<td><font size=4 face='Arial'>".$netr."</font></td>
</tr>";
}


if(empty($ebitda)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>EBITDA</font></td>
<td><font size=4 face='Arial'>".$ebitda."</font></td>
</tr>";
}


if(empty($rect)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Reaction Type</font></td>
<td><font size=4 face='Arial'>".$rect."</font></td>
</tr>";
}


if(empty($top)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Reaction Topic</font></td>
<td><font size=4 face='Arial'>".$top."</font></td>
</tr>";
}


if(empty($consq)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Reaction Consequence</font></td>
<td><font size=4 face='Arial'>".$consq."</font></td>
</tr>";
}


if(empty($react)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Reaction Actor</font></td>
<td><font size=4 face='Arial'>".$react."</font></td>
</tr>";
}


if(empty($relindv)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Related Individual</font></td>
<td colspan='1'><font size=4 face='Arial'>".$relindv."</font></td>
</tr>";
}


if(empty($summ)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Summary</font></td>
<td colspan='2'><p align='justify'><font size=4 face='Arial'>".$summ."</font></p></td>
</tr>";
}

$storend.= "
<tr>
<td colspan='4'>
<br>
</td>
</tr>
";

$notehtml=txt2html($note);

if(empty($notehtml)){
$storend.=" ";

}
else
{
$storend.="
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Complete Note</font></td>
<td colspan='3'><p><font size=4 face='Arial'>".$notehtml."</font></p></td>
</tr>";
}

if(empty($typeso)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Type of Source</font></td>
<td><font size=4 face='Arial'>".$typeso."</font></td>
</tr>";
}

if(empty($sour)){
$storend.=" ";

}
else
{
$storend.= "
<tr>
<td bgcolor='lightgray'><font size=4 face='Arial' color='blue'>Source</font></td>
<td><font size=2 face='Arial'>".$sour."</font></td>
</tr>";
}





$storend.= "</td></tr></td></tr></table>";


//================>>>> INICIA INDIVIDUOS ===============>>>>



$resulta= mysql_query("SELECT id FROM `documents` WHERE ((`parent_document_id`= $iddoc)  or ( `child_document_id`= $iddoc)) and `document_type_id`=43 and `status_id` = 1") or die("deadind1"); 
$indice=0;
while ($row =  mysql_fetch_row($resulta)) 
{ 

 $indice++; 
}
 

if($indice>0)
{
$storend.= "<tr><td>
<table  height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'>";
$storend.='<tr><td>

<input type="button" value="Individuo" onclick="window.open(\''.$default->rootUrl.'/control.php?action=getfeventb2b_indv&letra='.$iddoc.'\')" >
</td></tr>

';



}  // fin de indice
else
{
$storend.= "
<tr><td><table height=50%  align='left' style='text-align: left' ;  border='1'  cellpadding='2' cellspacing='2'>
<tr><td>
<table height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'>

<tr><td bgcolor='lightgray' align='center'><font size=4 face='Arial' color='blue'>INDIVIDUOS </td>
<td><font size=4 face='Arial'>NO SE TIENEN INDIVIDUOS RELACIONADOS A ESTE EVENTO  </td></tr>
</td></tr>
</td></tr></table>";
}

//=================<<<< TERMINA INDIVIDUOS <<<<=============


//================>>>> INICIA INSTITUTO ===============>>>>



$resulta= mysql_query("SELECT a.`id` FROM `documents` as a ,`document_fields_link` as b WHERE b.`document_id` = a.`id` AND b.`document_field_id` = 78 AND ((a.`parent_document_id`= $iddoc)  or ( a.`child_document_id`= $iddoc)) and a.`document_type_id`=41 and a.`status_id` = 1 order by b.`value`") or die("deadw1");

$indice=0;
while ($row =  mysql_fetch_row($resulta)) 
{ 

 $indice++; 
}
 
if($indice>0)
{

$storend.="
<tr><td>
<table  height=50%  align='left' style='text-align: left' ; ' border='1'  cellpadding='2' cellspacing='2'>";
$storend.='<tr><td>';

$storend.= '						  
<input type="button" value="Instituto" onclick="window.open(\''.$default->rootUrl.'/control.php?action=getfeventb2b_inst&letra='.$iddoc.'\')" >
';



$storend.= "</tr></tbody></td></tr></table>";

}  // fin de indice
else
{
$storend.="<tr><td>
<table  height=50%  align='left' style='text-align: left' ; border='1'  cellpadding='2' cellspacing='2'>

<tr><td bgcolor='lightgray' align='center'><font size=4 face='Arial' color='blue'>INSTITUTO</td>
<td><font size=4 face='Arial'>NO SE TIENEN INSTITUTOS RELACIONADOS A ESTE EVENTO  </td></tr></table>";
}



//=================<<<< TERMINA INSTITUCION <<<<=============






$storend.="</table></table>";
echo imprime_web($storend);


// }
function imprime_web($mistring)
{

$imphtml= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";

  $imphtml.= "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">";
    $imphtml.= "<head>";
      
  
  $imphtml.= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-15\" />";
  $imphtml.= "<meta name=\"generator\" content=\"Nuxeo CPS http://www.cps-project.org/\" />";
  $imphtml.= "<title>";

$imphtml.= "SIUM";

  $imphtml.= "</title>";
  //$imphtml.= "<base href=\"http://boletin.intelect.com.mx/\" />";
  $imphtml.= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" title=\"CPSDefault styles\" href=\"default.css\" />";
  
  $imphtml.= "<!--[if IE]>";$imphtml.= "<link rel=\"stylesheet\" type=\"text/css\" href=\"msie.css\" />";
  $imphtml.= "<![endif]-->";
  $imphtml.= "<link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"default_print.css\" />";
  $imphtml.= "<meta http-equiv=\"imagetoolbar\" content=\"no\" />";
  
  
  
  
  
  $imphtml.= "<script type=\"text/javascript\" src=\"functions.js\">";
  $imphtml.= "</script>";

      
$imphtml.= "<meta name=\"engine\" content=\"CPSSkins 2.3\" />";
$imphtml.= "<!-- Shortcut icon -->";
$imphtml.= "<link rel=\"icon\" href=\"cpsicon.png\" type=\"image/png\" />";
$imphtml.= "<link rel=\"shortcut icon\" href=\"cpsicon.png\" type=\"image/png\" />";

$imphtml.= "<!-- CSS1 -->";
$imphtml.= "<link rel=\"Stylesheet\" type=\"text/css\" href=\"cpsskins_common.css\" />";
$imphtml.= "<link rel=\"Stylesheet\" type=\"text/css\" href=\"renderCSS.css\" />";
$imphtml.= "<!-- CSS2 -->";
$imphtml.= "<style type=\"text/css\" media=\"all\">";

$imphtml.= "@import url(cpsskins_common-css2.css);";

$imphtml.= "</style>";
$imphtml.= "<!-- JavaScript -->";
$imphtml.= "<script type=\"text/javascript\" src=\"renderJS\">";
$imphtml.= "</script>";
$imphtml.= "<script type=\"text/javascript\" src=\"cpsskins_renderJS\">";
$imphtml.= "</script>";
$imphtml.= "</head>";
    
  //  $imphtml.= "<body onload=\"setFocus();\" style=\"margin:0.5em\">";
      
  $imphtml.= "<div>";
//$imphtml.= "<a href=\"http://boletin.intelect.com.mx/accessibility\" accesskey=\"0\">";
//$imphtml.= "</a>";
//$imphtml.= "<a href=\"http://boletin.intelect.com.mx/\" accesskey=\"1\">";
//$imphtml.= "</a>";
//$imphtml.= "<a href=\"#content\" accesskey=\"2\">";
//$imphtml.= "</a>";
//$imphtml.= "<a href=\"#menu\" accesskey=\"3\">";
//$imphtml.= "</a>";
//$imphtml.= "<a href=\"http://boletin.intelect.com.mx/advanced_search_form\" accesskey=\"4\">";
//$imphtml.= "</a>";
//$imphtml.= "<a href=\"http://boletin.intelect.com.mx/\" accesskey=\"7\">";
//$imphtml.= "</a>";
//$imphtml.= "</div>";
  
    $imphtml.= "<table cellpadding=\"0\" cellspacing=\"0\" summary=\"Aviso\" style=\"width:100%;\" class=\"shapeNoBorder colorTransparent\">";
       $imphtml.= "<tr>";
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:650px\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
      $imphtml.= "</tr>";
    $imphtml.= "</table>";
  
  
    $imphtml.= "<table cellpadding=\"0\" cellspacing=\"0\" summary=\"Banner\" style=\"width:100%;\" class=\"shapeNoBorder colorTransparent\">";
       $imphtml.= "<tr>";
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:650px\">";
              
                
              
              
                
                  $imphtml.= "<div style=\"text-align: left;\" class=\"colorTransparent fontColorBlack fontShapeVerdana shapeNoBorder\">";
                    $imphtml.= "<img src=\"cenefaSIUM.jpg\" width=\"649\" height=\"147\" alt=\"1\" />";
                    
                  $imphtml.= "</div>";
                
              
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
      $imphtml.= "</tr>";
    $imphtml.= "</table>";
  
  
    $imphtml.= "<table cellpadding=\"0\" cellspacing=\"0\" summary=\"Contenido 4 a\" style=\"width:100%;\" class=\"shapeNoBorder colorTransparent\">";
       $imphtml.= "<tr>";
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          /****
            $imphtml.= "<td valign=\"top\" style=\"width:135px\" class=\"shapeNoBorder colorBlanco\">";
              
                
                  $imphtml.= "<div style=\"text-align: left;padding:0.;\" class=\"\">";
                    $imphtml.= "<table >";
                    $imphtml.= "<tr  >";
                    $imphtml.= "<td bgcolor=\"#999999\" valign=\"top\">";
                    $imphtml.= "<p style=\"width: 135px;\" >";
                    $imphtml.= "<font color=\"#ffffff\" face=\"Tahoma, Arial, Helvetica, sans-serif\" size=\"1\">";
$imphtml.= "<a href=\"/publico/workspaces/boleblog/entorno-de-competencia7399\">";

$imphtml.= "Entorno de Competencia Nacional";

$imphtml.= "</a>";
$imphtml.= "</font>";
$imphtml.= "</p>";
$imphtml.= "</td>";
$imphtml.= "</tr>";
$imphtml.= "</table>"; 
$imphtml.= "<table >";
$imphtml.= "<tr  >";
$imphtml.= "<td bgcolor=\"#999999\" valign=\"top\">";
$imphtml.= "<p style=\"width: 135px;\" >";
$imphtml.= "<font color=\"#ffffff\" face=\"Tahoma, Arial, Helvetica, sans-serif\" size=\"1\">";
$imphtml.= "<a href=\"/publico/workspaces/boleblog/entorno-de-competencia\">";

$imphtml.= "Entorno de Competencia Internacional";

$imphtml.= "</font>";
$imphtml.= "</p>";
$imphtml.= "</td>";
$imphtml.= "</tr>";
$imphtml.= "</table>"; 
$imphtml.= "<table >";
$imphtml.= "<tr  >";
$imphtml.= "<td bgcolor=\"#999999\" valign=\"top\">";
$imphtml.= "<p style=\"width: 135px;\" >";
$imphtml.= "<font color=\"#ffffff\" face=\"Tahoma, Arial, Helvetica, sans-serif\" size=\"1\">";
$imphtml.= "<a href=\"/publico/workspaces/boleblog/corporativo-nacional-e\">";

$imphtml.= "Corporativo";

$imphtml.= "</a>";
$imphtml.= "</font>";
$imphtml.= "</p>";
$imphtml.= "</td>";
$imphtml.= "</tr>";
$imphtml.= "</table>"; 
$imphtml.= "<table >";
$imphtml.= "<tr  >";
$imphtml.= "<td bgcolor=\"#999999\" valign=\"top\">";
$imphtml.= "<p style=\"width: 135px;\" >";
$imphtml.= "<font color=\"#ffffff\" face=\"Tahoma, Arial, Helvetica, sans-serif\" size=\"1\">";
$imphtml.= "<a href=\"/publico/workspaces/boleblog/mercados-nacional-e\">";

$imphtml.= "Finanzas";

$imphtml.= "</a>";
$imphtml.= "</font>";
$imphtml.= "</p>";
$imphtml.= "</td>";
$imphtml.= "</tr>";
$imphtml.= "</table>";
                    
                  $imphtml.= "</div>";
                
              
            $imphtml.= "</td>";
          
        
        ***/
          
            $imphtml.= "<td valign=\"top\" style=\"width:651px\" class=\"shapeNoBorder colorBlanco\">";
              
$imphtml.= $mistring;




     $imphtml.= "</td>";
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          $imphtml.= "</tr>";
$imphtml.= "</table>";
  
  
  
  
    $imphtml.= "<table cellpadding=\"0\" cellspacing=\"0\" summary=\"Footer 20\" style=\"width:100%;\" class=\"shapeNoBorder colorTransparent\">";
       $imphtml.= "<tr>";
       $imphtml.= "<td valign=\"top\" style=\"width:30%\"  class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:650px\"   class=\"shapeNoBorder colorTransparent\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\"  class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
      $imphtml.= "</tr>";
    $imphtml.= "</table>";
  
  
    $imphtml.= "<table cellpadding=\"0\" cellspacing=\"0\"  summary=\"Disclainer 21\" style=\"width:100%;\"  class=\"shapeNoBorder colorTransparent\">";
       $imphtml.= "<tr>";
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\" class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:650px\" class=\"shapeNoBorder colorGris\">";
              
                
                 // $imphtml.= "<div style=\"text-align: left;\"  class=\"colorGris\">";
                  
//$imphtml.= "  Para cancelar su suscripción, suspender temporalmente este envío, modificar sus datos o correo electrónico";
//$imphtml.= " envíe un mensaje a la dirección de correo conred@cred.com.mx indicando los detalles que desee modificar y con gusto atenderemos su petición.";
                    
                //  $imphtml.= "</div>";
                
              
            $imphtml.= "</td>";
          
        
        
          
            $imphtml.= "<td valign=\"top\" style=\"width:30%\"  class=\"shapeNoBorder colorGris\">";
            $imphtml.= "</td>";
          
        
      $imphtml.= "</tr>";
    $imphtml.= "</table>";
  

    $imphtml.= "</body>";
  $imphtml.= "</html>";

return $imphtml;

}



 ?>