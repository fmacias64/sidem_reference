<?php

function generaNombre($base,$id_doc,$tipodoc,$nommapa)
{
 $numrr=rand(100000,200000);

 if ($tipodoc==18)
   {
     if ($id_doc!=""){
       $param_ID=$base.'_'.$id_doc.'_'.$numrr;
     } else 
       {  $param_ID=$base.'_'.$numrr;
       }
   }
 else if ($tipodoc==4)
   {
 $param_ID=$base.'_'.$id_doc.'_4_'.$nommapa.$numrr;
   }
 return $param_ID;

}

function fgeneraFichaE($iddoc,$tipodoc,$nommapa)
{
  global $firephp;
  if ($tipodoc==18)
    {

  global $default;
 
$oDocument = & Document::get($iddoc);
$indv_rel= "SELECT * FROM `document_fields_link` WHERE `document_field_id`<> 1  AND `document_id`=".$iddoc;
$indv_rel1 = mysql_query($indv_rel);


 while($indv_rel2 = mysql_fetch_row($indv_rel1))
{
$bandtipo=1;
 

 
 if ($indv_rel2[2]==8) {
    $nam=$indv_rel2[3];
    $bandtipo=0;
}
 if ($indv_rel2[2]==21 ){
   $appat=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==22){
   $apmat=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==23 ){
    $fech=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==58 ){
    $mail=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==96 ){
    $resum=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==57 ){
    $tel=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==63 ){
    $rel1=$indv_rel2[3];
$bandtipo=0;
}

if ($indv_rel2[2]==64 ){
    $rel2=$indv_rel2[3];
$bandtipo=0;
}

if ($indv_rel2[2]==65 ){
    $rel3=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==69 ){
    $gen=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==54 ){
    $cit=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==100 ){
    $cit1=$indv_rel2[3];
$bandtipo=0;
}
if ($indv_rel2[2]==101 ){
    $cit2=$indv_rel2[3];
$bandtipo=0;
}
}

 
 $docs= "img/".$oDocument->getFileName();
   
  $tama=filesize($docs);

$genero0= "SELECT value FROM `document_fields_link` WHERE `document_field_id`=69  AND `document_id`=".$iddoc;
$genero1 = mysql_query($genero0);
$genero2 = mysql_fetch_row($genero1);


 $Nom = " http://proveedores.intelect.com.mx/FichasBD/branches/SY/Documents". $oDocument->generateFullFolderPath($oDocument->getFolderID())."/".$oDocument->getFileName();
 
 $nombrenodo=generaNombre("NF",$iddoc,$tipodoc,$nommapa);
 $sRet.= '<node CREATED="1274726484516" ID="'.generaNombre("NF",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274726484516" TEXT="'.$nam.'&nbsp; '.$appat.'&nbsp; '.$apmat.'"/> ';
$sRet.= "\n";
//$firephp->log($nombrenodo,'nnodo');

//=============>> INSERTAR IMAGEN INDIVIDUO =========>>>>
 
$sRet.= '<node CREATED="1274726560189" FOLDED="true" ID="'.generaNombre("Imagen_hombre",$iddoc,$tipodoc,$nommapa).'"  MODIFIED="1274731872010"  TEXT="Foto"> ';

if ($tama >= 10){

 


   $sRet.= '<node CREATED="1274726560189" ID="'.generaNombre("Imagen_hombre",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274731872010"  TEXT="&lt;html&gt;&lt;img src=&quot;'.$Nom.'&quot;&gt; "/> ';


 }
 else
if ($genero2[0]=="Femenino")
{
  $sRet.= '<node CREATED="1274726560189" ID="'.generaNombre("Imagen_mujer",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274731872010"  TEXT="&lt;html&gt;&lt;img src=&quot;http://proveedores.intelect.com.mx/FichasBD/branches/SY/presentation/lookAndFeel/knowledgeTree/documentmanagement/nofotof.jpg&quot;&gt; "/> ';
 }
 else
   {//aqui me quede 19 jul
     $sRet.= '<node CREATED="1274726560189" ID="'.generaNombre("Imagen",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274731872010"  TEXT="&lt;html&gt;&lt;img src=&quot;http://proveedores.intelect.com.mx/FichasBD/branches/SY/Documents/Root Folder/Default Unit/SIDEM/Individuo/nofoto.jpg&quot;&gt; "/> ';
}
//========================<<<< TERMINA INSERTAR IMAGEN <<<=================

$sRet.= "</node>\n";

 $sRet.= '<node CREATED="1274726544449" FOLDED="true" ID="'.generaNombre("EncabezadoDatos",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274726552543"  TEXT="Datos Personales"> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274727244482" ID="'.generaNombre("FechaNacimiento",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727255598" TEXT="Fecha de Nacimiento: '.$fech.'"/> ';
 $sRet.= "\n";
 $sRet.= '<node CREATED="1274727259629" ID="'.generaNombre("Nacionalidad",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727274490" TEXT="Nacionalidad: '.$cit.'"/> ';

$sRet.= "\n";
 $sRet.= '<node CREATED="1274727277041" ID="'.generaNombre("Telefono",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727284185" TEXT="Tel&#xe9;fono: '.$tel.'"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274727286487" ID="'.generaNombre("Email",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727292060" TEXT="E-mail: '.$mail.'"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274727293821" ID="'.generaNombre("Genero",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727298847" TEXT="Genero: '.$gen.'"/> ';
$sRet.= "\n";
 $resum=str_replace('"', "''", $resum);
 $resumen_html=utf8_encode($resum);
 $sRet.= '<node CREATED="1274727301428" FOLDED="true" ID="'.generaNombre("Resumen",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727311168" TEXT="Resumen Ejecutivo: "> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274727320886" ID="'.generaNombre("textoResumen",$iddoc,$tipodoc,$nommapa).'" MODIFIED="1274727325890" TEXT="'.$resumen_html.'"/> ';
$sRet.= "\n";
 $sRet.= '</node> ';
$sRet.= "\n";
 $sRet.= '</node> ';
$sRet.= "\n";
//----------------------------
// id doc tipo 18 (individuo), del nodo anterior , el tipo 4 (trayectoria), el id del mapa, y el numero random
 $numrr=rand(100000,200000);
// $nom_mapa=explode("/",$ppath);
// $posNombre=count($nom_mapa)-1;
 
//ojo se usa variable:$nombre_nodo, para tener le mismo nombre en nodo y en enlace ya que genera nombre genera un nombre nuevo cada que se invoca, debido a factor random
$nombre_nodo=generaNombre("NTRAY",$iddoc,4,$nommapa); 

$enlace= "http://".$default->serverName.$default->rootUrl."/control.php?action=modifymindmap&idd=".$iddoc."&tipo= 4&numinstr=1&elmapa=".$nommapa."&idnodo=".$nombre_nodo;

$sRet.= '<node CREATED="1274726578281" ID="'.$nombre_nodo.'" LINK="'.$enlace.'" MODIFIED="1274731944034"  TEXT="&lt;html&gt;&lt;a href=&quot;#&quot;&gt;Trayectoria &lt;/a&gt;"/> ';
$sRet.= "\n";

$nombrerel = generaNombre("NREL",$iddoc,4,$nommapa);

 $sRet.= '<node CREATED="1274726656461" ID="'.$nombrerel.'" '.generaInstruccion($nombrerel,"5","20").' MODIFIED="1274731740381"  TEXT="Relaciones"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274726769137" ID="'.generaNombre("NDOM",$iddoc,4,$nommapa).'" LINK="http://www.google.com/" MODIFIED="1274731788162"  TEXT="Domicilios"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274726805198" ID="'.generaNombre("NEVE",$iddoc,4,$nommapa).'" LINK="http://www.google.com/" MODIFIED="1274731802458"  TEXT="Eventos"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274726819714" ID="'.generaNombre("NPRE",$iddoc,4,$nommapa).'" LINK="http://www.google.com/" MODIFIED="1274731812289"  TEXT="Preferencias"/> ';
$sRet.= "\n";
 $sRet.= '<node CREATED="1274727040921" ID="'.generaNombre("NMULTI",$iddoc,4,$nommapa).'" LINK="http://www.google.com/" MODIFIED="1274731829310" TEXT="Multimedia"/> ';

//las dos lineas abajo se suprimen para que nombre este al mismo nivel de los datos
//$sRet.= "\n";
// $sRet.= '</node> ';






    }

return $sRet;
}


?>