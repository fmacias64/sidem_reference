<?php

require_once("../../../../config/dmsDefaults.php");


if  (1) {               

require_once("../../../../lib/util/sanitize.inc");
require_once("../../../Html.inc");
require_once("$default->fileSystemRoot/lib/documentmanagement/Document.inc");
require_once("$default->fileSystemRoot/presentation/lookAndFeel/knowledgeTree/documentmanagement/viewUI.inc");
$boolnota=0;
$echoactor=0;
$letra = $_GET["letra"];
$nota = $_GET["nota"];
$region = $_GET["region"];
$event = $_GET["event"];
$action = $_GET["action2"];
$type = $_GET["type"];
$competitive = $_GET["competitive"];
$sustainability = $_GET["sustainability"];
$reactiontype = $_GET["reactiontype"];
$reactiontopic = $_GET["reactiontopic"];
$consequence = $_GET["consequence"];
$actor = $_GET["actor"];
$competidor=$_GET["competidor"];
$industria=$_GET["industry"];
$subindustria=$_GET["subindustry"];
$parampais=$_GET["pais"];
$ano=$_GET["ano"];
$notime=$_GET["notime"];
$politik=$_GET["pol"];

$fechaA=$_GET["fecha1"];

$fechaP=$_GET["fecha2"];
$apartir=$_GET["apartir"];
$where1 = "";
$from1="";
 $letram=strtoupper($letra);
   $letrasar= explode("_",$letram);
   

   if ($fechaA==""){} else {$where1=" AND dateb > '".$fechaA."' ";}
if($nota=="")
{
}else
{
$boolnota=1;

$where1.="AND note LIKE '%$nota%' ";
}


if($parampais=="")
{

}else
{
$boolpais=1;


$where1.= " AND idcountry = ".$parampais." ";


}


if($industria=="")
{} else
{
$boolnota=1;
$where1.= " AND indufield = '".$industria."' ";

// SubIndustria
 }
if ($subindustria=="")
{}
else
{

  $from1.= ", Empresas_extended as emp ";
$where1.= " AND ( emp.id=id and subindustry = '".$subindustria."')";


}





if($ano=="")
{

}else
{
$boolano=1;

$where1.=" AND dateb LIKE '".$ano."%' ";
}

$oplog=($fechaA=="" && $fechaP=="" && $ano =="" && $nota=="" && $region=="");
$oplog=($oplog && $event=="" && $action=="" && $type=="" && $competitive=="");
$oplog=($oplog && $sustainability=="" && $reactiontype =="" &&$reactiontopic =="");
$oplog=($oplog && $consequence =="" &&  $actor =="" && $competidor =="" && $industria=="" && $parampais=="");
if($oplog)
{
$where1.="AND modifiedb  > (CURDATE()-INTERVAL 1 DAY) ";
}else
{

}

if($fechaA!="")
{
}else
{
$boolano=1;

if ($notime==1)
{

$where1.=" AND dateb > (CURDATE()-INTERVAL 2 WEEK) ";
}
else if($notime==2)
{

$where1.=" AND dateb  > (CURDATE()-INTERVAL 1 MONTH) ";
}
else if($notime==3)
{

$where1.=" AND dateb > (CURDATE()-INTERVAL 2 MONTH) ";
}
else
{
$where1.=" AND dateb >= (CURDATE()-INTERVAL 7 DAY) ";
}
}

if($fechaP=="")
{
}else
{
$boolano=1;

$where1.=" AND dateb < '$fechaP' ";
}



if($region=="")
{
}else
{


if($region=="Asia and South Pacific")
{
$where1.=" AND ( region='Asia & South Pacific' OR region='ASIA AND SOUTH PACIFIC') ";
}
else
if($region=="Egypt and Middle East")
{
$where1.=" AND ( region='Egypt & Middle East' OR region='EGYPT AND MIDDLE EAST') ";
}
else{


$where1.=" AND  region='".$region."' ";
}
}

if($event=="")
{//echo "no event<br>";
}else
{


if ($event=="Competitive Dynamic")
{
$where1.=" AND (iscompdyn='Yes' OR  iscompdyn='YES') ";
} else if ($event=="Technology")
{
$where1.=" AND (istech='Yes' OR  istech='YES') ";
} else if ($event=="Sustainability")
{
$where1.=" AND (issust='Yes' OR  issust='YES') ";

} else if ($event=="Opportunities")
{
$where1.=" AND (isopp='Yes' OR  isopp='YES') ";
} else if ($event=="Corporate")
{
$where1.=" AND (iscorp='Yes' OR  iscorp='YES') ";
} else if ($event=="Reactions")
{
$where1.=" AND (iseac='Yes' OR  iseac='YES') ";
}

}

if($politik=="")
{
}
else
{
$where1.=" AND ((ispoli='Yes' OR  ispoli='YES') ";
$where1.=" OR (isecon='Yes' OR  isecon='YES') ";
$where1.=" OR (issoci='Yes' OR  issoci='YES') ";
$where1.=" OR (iscont='Yes' OR  iscont='YES')) ";
}


if($action=="")
{
}else
{


if ($action=="New Company")
{
$where1.=" AND  compdynact='".$action."' ";
} else if ($action=="Acquisition-Company")
{
$where1.=" AND compdynact='".$action."' ";
} else if ($action=="Expansion")
{
$where1.=" AND compdynact='".$action."' ";
} else if ($action=="Mergers")
{
$where1.=" AND compdynact='".$action."' ";
} else if ($action=="Upgrades")
{
$where1.=" AND compdynact='".$action."' ";
} else if ($action=="JV")
{
$where1.=" AND compdynact='".$action."' ";
} else if ($action=="Alternative Fuels Project")
{
$where1.=" AND  techact='".$action."' ";
} else if ($action=="New Material / Processes")
{
$where1.=" AND techact='".$action."' ";
}else if ($action=="Projects / Loans")
{
$where1.=" AND sustaitype='".$action."' ";
}
else if ($action=="Organization of Forums and Events")
{
$where1.=" AND sustaitype='Organization of Forums and Events' ";
}
else if ($action=="Attendance to Forums and Events")
{
$where1.=" AND sustaitype='".$action."' ";
}
else if ($action=="Awards delivered")
{
$where1.=" AND sustaitype='".$action."' ";
}
else if ($action=="Document Publishing")
{
$where1.=" AND sustaitype='".$action."' ";
}
else if ($action=="Foundation/Cofoundation of organisms")
{
$where1.=" AND oppact='".$action."' ";
}else if ($action=="Cost Reduction")
{
$where1.=" AND oppact='".$action."' ";
}else if ($action=="Capital Finance Raise")
{
$where1.=" AND oppact='".$action."' ";
}else if ($action=="Increase Prices")
{
$where1.=" AND oppact='".$action."' ";
}else if ($action=="Volume Raise")
{
$where1.=" AND compdynsect='".$type."' ";
}
}

if($type=="")
{
}else
{



 if ($type=="Cement")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="Concrete")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="Aggregates")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="Other")
{
$where1.=" AND compdynsect='".$type."' ";
}

else if ($type=="Quarries")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="Sea Terminal")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="Distribution Center")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="RandB Center")
{
$where1.=" AND compdynsect='R&D'";
}
else if ($type=="Non Core Related")
{
$where1.=" AND compdynsect='".$type."' ";
}
else if ($type=="AF. TDF(Tires)")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="AF Bio-Mass")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="AF. Industrial Wastes")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="AF. Municipal Waste")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="NP. Low resource consumption")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="NP. Recyclers")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="NP. Low polluters / Env Quality Enchancers")
{
$where1.=" AND techtype='".$type."' ";
}
else if ($type=="Training/ Education ")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Business Incubator")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Redeployment on closure")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Infraestructure Development")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Housing")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Natural Disaster Aid")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Historical Monuments Protector")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Safety promotion")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Labor Equity/Human Rights")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Sponsor of Cultural-Sport Activities")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Stakeholders/Community Involvement")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Biodiversity and Quarry Rehabilitation")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Protecting Air Quality and Mitigating Disturbances")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Water Protection")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Reccycling Industrial by products and wastes")
{
$where1.="AND typcorp='".$type."' ";
}
else if ($type=="Energy Recovery (Electricity)")
{
$where1.="AND typcorp='".$type."' ";
}
}
//===========================


if($competitive=="")
{//echo "no action<br>";
}else
{



if ($competitive=="Plan")
{
$where1.=" AND compdynsp='".$competitive."' ";
}
else if ($competitive=="In Process")
{
$where1.=" AND compdynsp='".$competitive."' ";
}
else if ($competitive=="Completed")
{
$where1.=" AND compdynsp='".$competitive."' ";
}
}
//======================
if($sustainability=="")
{//echo "no action<br>";
}else
{


if ($sustainability=="Economic")
{
$where1.="AND  sustaitheme='".$sustainability."' ";
}
else if ($sustainability=="Social")
{
$where1.="AND  sustaitheme='".$sustainability."' ";
}
else if ($sustainability=="Enviroment")
{
$where1.="AND  sustaitheme='".$sustainability."' ";
}
else if ($sustainability=="Sustainable")
{
$where1.="AND  sustaitheme='".$sustainability."' ";
}
}
//================

if($reactiontype=="")
{//echo "no reactiontype<br>";
}else
{



 if ($reactiontype=="Positive")
{
$where1.=" AND reaction='".$reactiontype."' ";
}
else if ($reactiontype=="Negative")
{
$where1.=" AND reaction='".$reactiontype."' ";
}
else if ($reactiontype=="N/A")
{
$where1.=" AND reaction='".$reactiontype."' ";
}
}
//====================

if($reactiontopic=="")
{//echo "no reactiontopic<br>";
}else
{


 if ($reactiontopic=="Enviroment/Health" || $reactiontopic=="ENVIRONMENT/HEALTH" || $reactiontopic == "Environment" )
{
$where1.=" AND  (reacttopic='Enviroment/Health' OR reacttopic='ENVIRONMENT/HEALTH') ";
}
else if ($reactiontopic=="Labor/Security within org" || $reactiontopic=="LABOR/SECURITY WITHIN ORG" )
{
$where1.=" AND (reacttopic='Labor/Security within org' OR reacttopic='LABOR/SECURITY WITHIN ORG') ";
}
else if ($reactiontopic=="Competitiveness" || $reactiontopic=="COMPETITIVENESS")
{
  $where1.=" AND (reacttopic='Competitiveness' OR reacttopic='COMPETITIVENESS' ) ";
}
else if ($reactiontopic=="Social Resp. community" || $reactiontopic=="SOCIAL RESPONSIBILITY WITH COMMUNITY" )
{
$where1.=" AND ( reacttopic='Social Resp. community' OR reacttopic='SOCIAL RESPONSIBILITY WITH COMMUNITY' )";
}
else if ($reactiontopic=="ETHICS / LICIT" )
{
$where1.="AND ( reacttopic='ETHICS / LICIT' ) ";
}
else if ($reactiontopic=="PERFORMANCE")
{
$where1.="AND ( reacttopic='PERFORMANCE') ";
}
else if ($reactiontopic=="N/A")
{
$where1.="AND ( reacttopic='N/A') ";
}
}
//=====================

if($consequence=="")
{//echo "no consequence<br>";
}else
{

if ($consequence=="CLOSURES")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="DOWNGRADE")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="EXPROPIATION")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="FINES")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="INVESTIGATION")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="LAWSUITS")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="OPPOSITION / ACCUSATION")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="PROTEST / DEMOSTRATIONS")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="RECOGNITION")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="RECOMMENDATION")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="RESTRICTIONS")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="UPGRADE")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="WARNING")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
else if ($consequence=="N/A")
{
$where1.=" AND  reactcons='".$consequence."' ";
}
}
//=========================

if($actor=="")
{//echo "no actor<br>";
}else
{
$echoactor=1;

 if ($actor=="Community")
{
$where1.=" AND reactact='".$actor."' ";
}
else if ($actor=="NGO/Media")
{
$where1.=" AND reactact='".$actor."' ";
}
else if ($actor=="Government")
{
$where1.=" AND reactact='".$actor."' ";
}
else if ($actor=="Other Competitors")
{
$where1.=" AND reactact='".$actor."' ";
}

else if ($actor=="N/A")
{
$where1.=" AND reactact='".$actor."' ";
}
}



if($competidor=="")
{//echo "no competidor<br>";
}else
{
$echocompetidor=1;


if ($competidor=="1581")
{
$where1.="AND ( compet='1581'";
$where1.=" OR compet='1587'";  
$where1.=" OR compet='1640'";
$where1.=" OR compet='1641'";
$where1.=" OR compet='1655'";
$where1.=" OR compet='2300'";
$where1.=" OR compet='2301'";
$where1.=" OR compet='3238'";
//  la union $where1.=" OR compet='3170'";
$where1.=" OR compet='3192'";
//la union $where1.=" OR compet='3184'";
$where1.=" OR compet='3116'";
$where1.=" OR compet='3113'";
$where1.=" OR compet='3102'";
$where1.=" OR compet='3065'";
$where1.=" OR compet='3143'";


$where1.=") ";
}
else if ($competidor=="3089")
{
$where1.="AND ( compet='3089'";
$where1.=" OR compet='3122'";  
$where1.=" OR compet='3157'";
$where1.=" OR compet='3159'";
$where1.=" OR compet='3175'";
$where1.=" OR compet='3217'";
$where1.=" OR compet='3224'";
$where1.=" OR compet='3227'";
$where1.=" OR compet='3170'";
$where1.=" OR compet='3231'";
$where1.=" OR compet='3184'";


$where1.=") ";
}



}



header("Content-type: application/rss+xml");

//header("Content-Disposition: attachment; filename=report.csv");




//            Encabezado

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
echo "\r\n";
echo "<?xml-stylesheet href=\"http://www.intelect.com.mx/legislativo/rss.css\" type=\"text/css\"?>"; //cambiar aqui
echo "\r\n";
echo "<rdf:RDF";
echo "\r\n";
echo "  xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"";
echo "\r\n";
echo "  xmlns:dc=\"http://purl.org/dc/elements/1.1/\"";
echo "\r\n";
echo "  xmlns=\"http://purl.org/rss/1.0/\"";
echo "\r\n";
echo "  xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">";
echo "\r\n";

echo "<channel rdf:about=\"http://proveedores.intelect.com.mx/FichasBD/branches/SY/presentation/lookAndFeel/knowledgeTree/documentmanagement/getrss1.php\">"; //cambiar aqui
echo "\r\n";
//echo "    <title>Eventos Empresariales</title>";
//$busq_links2="SELECT distinct `id` FROM EventosB2B_extended".$from1." WHERE 1 ".$where1." order by dateb DESC";
echo "    <title>";
if ($industria == "FOOD, BEVERAGES & TOBACCO"){echo "Food / Beverages ";}
if ($region) {echo $region." ";}
if ($event) {echo $event;}
if ($reactiontopic=="Competitiveness" && $industria == "BUILDING MATERIALS"){echo "Antitrust";}
if ($reactiontopic=="Competitiveness" && $industria != "BUILDING MATERIALS"){echo "Antitrust in Other Industries";}
if ($reactiontopic=="Enviroment/Health" || $reactiontopic=="ENVIRONMENT/HEALTH" || $reactiontopic == "Environment" ){echo "Environment Reactions";}

if ($region=="" && $event =="" && $reactiontopic != "Competitiveness" && $reactiontopic!="Enviroment/Health" &&  $reactiontopic!="ENVIRONMENT/HEALTH" && $reactiontopic != "Environment"  ) {echo "Eventos Empresariales";}
echo "</title>";

echo "\r\n";
echo "    <description>RSS 1.0 export from the B2B Events Records.</description>";
echo "\r\n";
echo "    <link>http://proveedores.intelect.com.mx/FichasBD/branches/SY/presentation/lookAndFeel/knowledgeTree/documentmanagement/getrss1.php</link>"; //cambiar aqui
echo "\r\n";
echo "    <language>en_US</language>";
echo "\r\n";
echo "    <items>";
echo "\r\n";
echo "      <rdf:Seq>";
echo "\r\n";

// Fin de Encabezado

//listado rdf

//$busq_links="SELECT distinct b.`id` FROM (select id,modified,pais from `documents` where `document_type_id`=38  AND `status_id`<=2) as b ".$from1." WHERE 1 ".$where1;

$busq_links="SELECT distinct `id` FROM EventosB2B_extended".$from1." WHERE 1 ".$where1." order by dateb DESC";

//echo $busq_links;
$busq_links1 = mysql_query($busq_links);



 while ($busq_links2 = mysql_fetch_row($busq_links1))
{  //while busqlinks2

echo "<rdf:li rdf:resource=\"http://proveedores.intelect.com.mx/FichasBD/branches/SY/control.php?action=getfeventb2b&amp;letra=".$busq_links2[0]."\"/>";
echo "\r\n";

}
echo "    </rdf:Seq>";
echo "\r\n";
echo "    </items>";
echo "\r\n";

echo "  </channel>";
echo "\r\n";

//fin listado rdf





$insmod=0;
   
//$busq_links="SELECT distinct b.`id` FROM (select id,modified,pais from `documents` where `document_type_id`=38  AND `status_id`<=2) as b ".$from1." WHERE 1 ".$where1;

$busq_links="SELECT distinct `id` FROM EventosB2B_extended WHERE 1 ".$where1." order by dateb DESC";

$busq_links1 = mysql_query($busq_links);



 while ($busq_links2 = mysql_fetch_row($busq_links1))
{  //while busqlinks2
 $insmod++; 
  $modd=$insmod%2;
  $red=220*$modd-255*($modd-1);
  $green=220*$modd-255*($modd-1);
  $blue=220*$modd-255*($modd-1);
$oDocument = & Document::get($busq_links2[0]);

 

 



$indv_rel= "SELECT * FROM `document_fields_link` WHERE `document_field_id`<> 1  AND `document_id`=".$busq_links2[0];
$indv_rel1 = mysql_query($indv_rel);


 while ($indv_rel2 = mysql_fetch_row($indv_rel1))
{  //whileinvrel

 

  if ($indv_rel2[2]==155 ){
   $typeCD=$indv_rel2[3];

}
 if ($indv_rel2[2]==126 ){
   $typeT=$indv_rel2[3];

}
 if ($indv_rel2[2]==123 ){
   $typeS=$indv_rel2[3];

}
 
 if ($indv_rel2[2]==273 ){
   $ispoli=$indv_rel2[3];

} 
 if ($indv_rel2[2]==274 ){
   $isecon=$indv_rel2[3];

} 
 if ($indv_rel2[2]==276 ){
   $iscont=$indv_rel2[3];

} 
 if ($indv_rel2[2]==275 ){
   $issoci=$indv_rel2[3];

} 
 if ($indv_rel2[2]==185 ){
   $typeOpp=$indv_rel2[3];

} 

 if ($indv_rel2[2]==161) {
    $lugar=$indv_rel2[3];
if ($lugar>0){
$one="SELECT A.`dos` FROM `Lugares`.`Pais` as A , `Lugares`.`Lugares` as B WHERE A.id = B.cinco and B.id=".$lugar;
$two=mysql_query($one);
$three=mysql_fetch_row($two);
$partnom=$three[0];
}
else {$partnom="";}
    
}

 if ($indv_rel2[2]==109 ){
   $fech=$indv_rel2[3];

}
 if ($indv_rel2[2]==142){
   $competidor=$indv_rel2[3];

if ($competidor>0){
$one="SELECT value  FROM `document_fields_link`"
     ." WHERE `document_field_id`= 92  AND `document_id`=".$competidor;
$two=mysql_query($one);
$three=mysql_fetch_row($two);
$partnomcomp=$three[0];
}
else {$partnomcomp="";}

}

//**********

 if ($indv_rel2[2]==110){
   $regsql=$indv_rel2[3];
//region

}

 if ($indv_rel2[2]==152){
   $plansql=$indv_rel2[3];
//planta

}

 if ($indv_rel2[2]==116){
   $cdsecsql=$indv_rel2[3];
//cdsect

}
 if ($indv_rel2[2]==117){
   $cdspsql=$indv_rel2[3];
//cdsect

}
if ($indv_rel2[2]==185){
   $opptypsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==155){
   $typcorpevsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==103){
   $grosprofsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==104){
   $opincomsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==105){
   $netrevsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==106){
   $ebitdasql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==102){
   $totincomesql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==123){
   $sustypsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==124){
   $susthemesql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==126){
   $techtypsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==163){
   $techdescsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==119){
   $reactopsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==120){
   $reactconssql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==150){
   $addcapsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==149){
   $amountsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==164){
   $typesourcsql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==113){
   $summarysql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==114){
   $compnotesql=$indv_rel2[3];
//cdsect
}
if ($indv_rel2[2]==115){
   $sourcesql=$indv_rel2[3];
//cdsect
}

if ($indv_rel2[2]==130){
   $relatedind=$indv_rel2[3];
//cdsect
if ($relatedind>0){
$nom_rel= "SELECT value FROM `document_fields_link` WHERE `document_field_id`= 8  AND `document_id`=".$relatedind;
$nom_rel1 = mysql_query($nom_rel);
$nom=mysql_fetch_row($nom_rel1);
$ap_rel= "SELECT value FROM `document_fields_link` WHERE `document_field_id`= 21  AND `document_id`=".$relatedind;
$ap_rel1 = mysql_query($ap_rel);
$ap=mysql_fetch_row($ap_rel1);
$am_rel= "SELECT value FROM `document_fields_link` WHERE `document_field_id`= 22  AND `document_id`=".$relatedind;
$am_rel1 = mysql_query($am_rel);
$am=mysql_fetch_row($am_rel1);
$relindsql=$nom[0]." ".$ap[0]." ".$am[0];
}
}

if ($indv_rel2[2]==114){
   $compnotesql=$indv_rel2[3];
//cdsect
}


if ($indv_rel2[2]==161 ){ //ciudad
    $lug=$indv_rel2[3];
$bandtipo=0;
if($indv_rel2[3]>0)
{


$linkA2 = "SELECT B.`dos` FROM   `Lugares`.`Lugares` as A, `Lugares`.`Estado` as B WHERE A.`cuatro` = B.`id` AND A.`id`=".$indv_rel2[3];
$linkB2 = mysql_query($linkA2);
$dato2=mysql_fetch_row($linkB2);

$linkA1 = "SELECT `dos`  FROM   `Lugares`.`Lugares` WHERE `id`=".$indv_rel2[3];
$linkB1 = mysql_query($linkA1);

$dato1=mysql_fetch_row($linkB1);
//$sToRender .= "<SELECT  ID=\"%s\" NAME=\"%s\"   SIZE=\"1\">";
 $LugToRender = "$dato1[0] / $dato2[0]";

     //  $extra.="<tr><td><font size=2 face='Times' color='blue'>$explparam[2]</font></td><td colspan='2' align='justify'><font size=2 face='Times'>".$sToRender."</font></td></tr>";

//$sToRender.="<input type='text' size='20' name='%s' value='%s' maxlength='12' />";

//return sprintf($sToRender,$this->sFormName, $this->sFormName,$this->sValue, $this->sFormName);
}//si value es mayor a 0 arriba si no abajo

}








//**********

 if ($indv_rel2[2]==136 ){
    $compdyn=$indv_rel2[3];
if ($compdyn=="Yes"){
 $pncd="Competitive Dynamic";}
else {
 $pncd="";}

}
if ($indv_rel2[2]==137 ){
    $tech=$indv_rel2[3];
    if ($tech=="Yes"){
    $pnt="Technology";}
else{
    $pnt="";}

}
 if ($indv_rel2[2]==138 ){
    $corp=$indv_rel2[3];
if ($corp=="Yes"){
 $pncrp="Corporate";}
else {  $pncrp="";}

}
if ($indv_rel2[2]==139){
    $sust=$indv_rel2[3];
    if ($sust=="Yes"){
      $pnsust="Sustainability";}
else {
      $pnsust="";}
}

if ($indv_rel2[2]==186){
    $react=$indv_rel2[3];
    if ($react=="Yes"){
      $pnreact="Reactions";}
else {
      $pnreact="";}
}

if ($indv_rel2[2]==121){
    $react_actor=$indv_rel2[3];
}



// Ifs Columna 5

 if ($indv_rel2[2]==186){
    $react=$indv_rel2[3];
    if ($react=="Yes"){
      $col5react="React.";}
    else {
      $col5react="";}}

 if ($indv_rel2[2]==183){
    $oppo=$indv_rel2[3];
    if ($oppo=="Yes"){
      $col5oppo="Opp.";}
else {
      $col5oppo="";}}

 if ($indv_rel2[2]==139){
    $susta=$indv_rel2[3];
    if ($susta=="Yes"){
      $col5susta="Sust.";}
else {
      $col5susta="";}}

if ($indv_rel2[2]==136){
    $compe=$indv_rel2[3];
    if ($compe=="Yes"){
      $col5compe="CD.";}
else {
      $col5compe="";}}

if ($indv_rel2[2]==137){
    $techn=$indv_rel2[3];
    if ($techn=="Yes"){
      $col5techn="Tech.";}
else {
      $col5techn="";}}



if ($indv_rel2[2]==118){
    $rectyp=$indv_rel2[3];
   }

if ($indv_rel2[2]==127){
    $cdact=$indv_rel2[3];
   }

if ($indv_rel2[2]==122){
    $sustact=$indv_rel2[3];
   }

if ($indv_rel2[2]==125){
    $technact=$indv_rel2[3];
   }

if ($indv_rel2[2]==184){
    $oppoact=$indv_rel2[3];
   }







//Ifs Column 6

 if ($indv_rel2[2]==138){
    $corpo=$indv_rel2[3];
    if ($corpo=="Yes"){
      $col6corpo="Corp.";}
    else {
      $col6corpo="";}}

if ($indv_rel2[2]==119){
    $reactop=$indv_rel2[3];
   }

if ($indv_rel2[2]==116){
    $compdinsec=$indv_rel2[3];
   }

if ($indv_rel2[2]==124){
    $sustheme=$indv_rel2[3];
   }

if ($indv_rel2[2]==126){
    $techtyp=$indv_rel2[3];
   }


if ($indv_rel2[2]==155){
    $typcorpev=$indv_rel2[3];
   }


if ($indv_rel2[2]==185){
    $opptyp=$indv_rel2[3];
   }




// Ifs Column7

 if ($indv_rel2[2]==117){
    $compdynsp=$indv_rel2[3];
    }
 

 
 if ($indv_rel2[2]==120){
    $reactcon=$indv_rel2[3];
    }

if ($indv_rel2[2]==163){
    $techndesc=$indv_rel2[3];
    }


// Columna8 

 if ($indv_rel2[2]==121){
    $reactact=$indv_rel2[3];
    }

}


echo "<item rdf:about=\"http://proveedores.intelect.com.mx/FichasBD/branches/SY/control.php?action=getfeventb2b&amp;letra=".$busq_links2[0]."\">";
echo "\r\n";
$sumsql=str_replace('"',"'",$summarysql);
$sumsql2=txt2txt($sumsql);
$pretit="";
if ($politik!=""){
if($ispoli!=""){$pretit=" &lt;p&gt;&lt;Politics&gt; ";}
if($issoci!=""){$pretit=" &lt;p&gt;&lt;Social&gt; ";}
if($isecon!=""){$pretit=" &lt;p&gt;&lt;Economics&gt; ";}
if($iscont!=""){$pretit=" &lt;p&gt;&lt;Contingency&gt; ";}

}
echo "<title><![CDATA[".$sumsql2."]]>".$pretit."</title>";
echo "\r\n";
echo "<description>";
echo "\r\n";
echo "Fecha ".$fech."\n";
echo "\r\n";


$compnsql=str_replace('"',"'",$compnotesql);

$comphtml=txt2html($compnsql);

echo $comphtml; 
echo "</description>\n";
echo "\r\n";

echo "<link>http://proveedores.intelect.com.mx/FichasBD/branches/SY/control.php?action=getfeventb2b&amp;letra=".$busq_links2[0]."</link>";
echo "\r\n";
//echo "<pubDate>Wed, 29 Jul 2009 16:07:26 GMT</pubDate>";
//date_default_timezone_set('GMT');
$tiempo=explode("-",$fech);
$fechh=date("D, j M Y G:i:s T",$fech);
echo "\r\n";
echo "<pubDate>".date("D, j M Y G:i:s T",mktime(0,0,0,$tiempo[1],$tiempo[2],$tiempo[0]))."</pubDate>";
echo "\r\n";
//echo "<dc:date>2009-07-29T16:07:26Z</dc:date>";
echo "<dc:date>".date("Y-m-d\TG:i:s\Z",mktime(10,0,0,$tiempo[1],$tiempo[2],$tiempo[0]))."</dc:date>";
echo "\r\n";
echo "<dc:creator>SY</dc:creator>";
echo "\r\n";
echo "<dc:contributor>SY</dc:contributor>";
echo "\r\n";

echo "<dc:language>es</dc:language>";
echo "\r\n";
echo "<dc:subject>Opportunities</dc:subject>";
echo "\r\n";
echo "</item>\n";
echo "\r\n";


//$sumadecondiciones=0;
}

//Fin de RSS



echo "<xhtml:script id=\"js\" type=\"text/javascript\" src=\"http://www.intelect.com.mx/legislativo/rss.js\" />";
echo "\r\n";
echo "</rdf:RDF>";
echo "\r\n";



//






// if boolnota
// echo con pedazo de nota

//uyuy


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
  $txt = str_replace('"','&quot;',$txt);
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
  $txt = str_replace('&','&amp;',$txt);

  //Ajdusts links - anything starting with HTTP opens in a new window
  $txt = stri_replace("<a href=\"http://","&lt;a target=\"_blank\" href=\"http://",$txt);
  $txt = stri_replace("<a href=http://","&lt;a target=\"_blank\" href=http://",$txt);

  //Basic formatting
  $eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";
  $html = '&lt;p&gt;'.str_replace("$eol$eol","&lt;/p&gt;&lt;p&gt;",$txt).'&lt;/p&gt;';
  $html = str_replace("$eol","&lt;br /&gt;\n",$html);
  $html = str_replace("&lt;/p&gt;","&lt;/p&gt;\n\n",$html);
  $html = str_replace("&lt;p&gt;&lt;/p&gt;","&lt;p&gt;&lt;/p&gt;",$html);
 $html = str_replace("<","&lt;",$html);
 $html = str_replace(">","&gt;",$html);
  //Wipes <br> after block tags (for when the user includes some html in the text).
  $wipebr = Array("table","tr","td","blockquote","ul","ol","li");

  for($x = 0; $x < count($wipebr); $x++) {

    $tag = $wipebr[$x];
    $html = stri_replace("&lt;$tag&gt;&lt;br /&gt;","&lt;$tag&gt;",$html);
    $html = stri_replace("&lt;/$tag&gt;&lt;br /&gt;","&lt;/$tag&gt;",$html);
    $html = stri_replace("<$tag><br />","&lt;$tag&gt;",$html);
    $html = stri_replace("</$tag><br />","&lt;/$tag&gt;",$html);

  }

  return $html;
}


function txt2txt($txt) {
// Transforms txt in html

  //Kills double spaces and spaces inside tags.
  while( !( strpos($txt,'  ') === FALSE ) ) $txt = str_replace('  ',' ',$txt);
  $txt = str_replace(' >','>',$txt);
  $txt = str_replace('< ','<',$txt);
  //Transforms accents in html entities.
  //$txt = htmlentities($txt);

  //We need some HTML entities back!
  //$txt = str_replace('"','&quot;',$txt);
 $txt = str_replace("&amp;#8217;","&rsquo;",$txt);
  $txt = str_replace("\x92","\"",$txt);
$txt = str_replace("\x93","\"",$txt);
$txt = str_replace("\x94","\"",$txt);
$txt = str_replace("\x96","\"",$txt);
$txt = str_replace("\x97","\"",$txt);
$txt = str_replace("\x99"," ",$txt);
$txt = str_replace("\x80","Euros ",$txt);
  $txt = str_replace('&lt;','<',$txt);
  $txt = str_replace('&gt;','>',$txt);
 
  //Basic formatting
  $eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";

  $html=$txt;


  return $html;
}






?>
