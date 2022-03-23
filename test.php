<?php
session_start();
var_dump($_SESSION);
//$i=0;
$tableauasso= ["<i >hello been</i>","<i>hello world</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello bad</i>","<i>hello gfgf</i>","<i>hellogfgd</i>"];
foreach ($tableauasso as $key=>$value){   
    echo $key."->".$value."<br>";
    //$i++;
}
?>