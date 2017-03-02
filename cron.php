<?php
require_once 'option.php';
require_once $TwitterInfoPath;



// Cowitterロード
require __DIR__ . '/vendor/autoload.php';
use mpyw\Co\Co;
use mpyw\Co\CURLException;
use mpyw\Cowitter\Client;
use mpyw\Cowitter\HttpException;

// Twitterに接続
$client = new Client([$consumer_key, $consumer_secret,$access_token,$access_token_secret]);
$client = $client->withOptions([CURLOPT_CAINFO => __DIR__ . '/vendor/cacert.pem']);

// users.jsonをパース
$json = file_get_contents('users.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,false);

var_dump($arr);
$result = new stdClass;

foreach ($arr as $key => $value) {
    // user_idが空白なら取得する
    if($value->user_id == 0 )
    {
        // idがなければ取得
        echo "user_id取得: @" . $key . "<br>";
        try{
            $statuses = $client->get('users/show', ['screen_name' => $key]);
        }catch(HttpException $e){
            echo "<pre>" . $e . "</pre>";
            echo "&nbsp;&nbsp;@" . $key . " is not found...<br>";
            $arr->$key->state = "NotExist->screen_name";
            continue;
        }
        $arr->$key->user_id = $statuses->id;
        $arr->$key->state = "Active";
    }
    
    // ツイート取得
    echo "ツイート取得: @" . $key . "(" . $value->user_id . ")<br>";
    try{
        if($value->since == (0 || null || "")){
            $statuses = $client->get('statuses/user_timeline', ['user_id' => $value->user_id]);
        }else{
            $statuses = $client->get('statuses/user_timeline', ['user_id' => $value->user_id , 'since_id' => $value->since]);
        }
    }catch(HttpException $e){
        echo "<pre>" . $e . "</pre>";
        echo "&nbsp;&nbsp;@" . $key . "(" . $value->user_id . ") is not found...<br>";
        $arr->$key->state = "NotExist->user_id";
        continue;
    }
    
    if(count($statuses) == 0){
        echo "&nbsp;&nbsp;更新なし";
    }else{
        $arr->$key->since = $statuses[0]->id_str;
        $result->$key = $statuses;
    }
    echo "<hr>";
}

$arr = json_encode($arr,JSON_PRETTY_PRINT);
file_put_contents("users.json" , $arr);

var_dump($result);