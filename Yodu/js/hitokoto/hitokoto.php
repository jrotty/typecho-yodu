<?php
// 指定允许其他域名访问  
header('Access-Control-Allow-Origin:*');  
function hitokoto()
{
    $data  = dirname(__FILE__) . '/hitokoto.json';
    $json  = file_get_contents($data);
    $array = json_decode($json, true);
    $count = count($array);
    if ($count != 0)
    {
        $hitokoto = $array[array_rand($array)]['hitokoto'];
        echo $hitokoto;
    }
    else
    {
        echo '';
    }

}
hitokoto();
?>