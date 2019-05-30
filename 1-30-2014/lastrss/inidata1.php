<?
// COLUMBIA
$U01 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0008&u=";
$L01 = "Quito";
$U02 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0022&u=";
$L02 = "Cayambe";
$U03 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0001&u=";
$L03 = "Cuenca";
$U04 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0016&u=";
$L04 = "Galapagos Islands";
$U05 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0003&u=";
$L05 = "Guayaquil";
$U06 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0015&u=";
$L06 = "Loja";
$U07 = "http://xml.weather.yahoo.com/forecastrss?p=ECXX0006&u=";
$L07 = "Manta";

// PERU
$U51 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0011&u=";
$L51 = "Lima";
$U52 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0005&u=";
$L52 = "Chiclayo";
$U53 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0008&u=";
$L53 = "Cusco";
$U54 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0010&u=";
$L54 = "Iquitos";
$U55 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0015&u=";
$L55 = "Nazca";
$U56 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0029&u=";
$L56 = "Puerto Maldonado";
$U57 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0020&u=";
$L57 = "Puno";
$U58 = "http://xml.weather.yahoo.com/forecastrss?p=PEXX0022&u=";
$L58 = "Trujillo";
// List of RSS URLs

$rsslist=array(
"Y01F" => array($U01."f", $U02."f", $L01, $L02),
"Y01C" => array($U01."c", $U02."c", $L01, $L02),
"Y02F" => array($U02."f", $U03."f", $L02, $L03),
"Y02C" => array($U02."c", $U03."c", $L02, $L03),
"Y03F" => array($U03."f", $U04."f", $L03, $L04),
"Y03C" => array($U03."c", $U04."c", $L03, $L04),
"Y04F" => array($U04."f", $U05."f", $L04, $L05),
"Y04C" => array($U04."c", $U05."c", $L04, $L05),
"Y05F" => array($U05."f", $U06."f", $L05, $L06),
"Y05C" => array($U05."c", $U06."c", $L05, $L06),
"Y06F" => array($U06."f", $U07."f", $L06, $L07),
"Y06C" => array($U06."c", $U07."c", $L06, $L07),
"Y07F" => array($U07."f", $U01."f", $L07, $L01),
"Y07C" => array($U07."c", $U01."c", $L07, $L01),
"Y51F" => array($U51."f", $U52."f", $L51, $L52),
"Y51C" => array($U51."c", $U52."c", $L51, $L52),
"Y52F" => array($U52."f", $U53."f", $L52, $L53),
"Y52C" => array($U52."c", $U53."c", $L52, $L53),
"Y53F" => array($U53."f", $U54."f", $L53, $L54),
"Y53C" => array($U53."c", $U54."c", $L53, $L54),
"Y54F" => array($U54."f", $U55."f", $L54, $L55),
"Y54C" => array($U54."c", $U55."c", $L54, $L55),
"Y55F" => array($U55."f", $U56."f", $L55, $L56),
"Y55C" => array($U55."c", $U56."c", $L55, $L56),
"Y56F" => array($U56."f", $U57."f", $L56, $L57),
"Y56C" => array($U56."c", $U57."c", $L56, $L57),
"Y57F" => array($U57."f", $U58."f", $L57, $L58),
"Y57C" => array($U57."c", $U58."c", $L57, $L58),
"Y58F" => array($U58."f", $U51."f", $L58, $L51),
"Y58C" => array($U58."c", $U51."c", $L58, $L51)
);
?>