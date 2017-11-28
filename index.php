<?php
/*
ربات نوشته شده توسط دانیال ملک زاده(@JanPHP)و دریافت اخبار @Danial_Rbo
*/
//--@mriven
define('API_KEY','توکن ربات شما');
//--@mrivem
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//--@mriven
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);

  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);

  return exec_curl_request($handle);
}
//--@mriven
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$names = $update->message->from->first_name;
$username = $update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$reply = $update->message->reply_to_message->forward_from->id;
$stickerid = $update->message->reply_to_message->sticker->file_id;
$photo = $update->message->photo;
$video = $update->message->video;
$sticker = $update->message->sticker;
$file = $update->message->document;
$music = $update->message->audio;
$voice = $update->message->voice;
$forward = $update->message->forward_from;
$step = file_get_contents("data/$from_id/step.txt");
$admin = 328130490;
$link = file_get_contents ("data/$from_id/link.txt");
$size = file_get_contents ("data/$from_id/size.txt");
$font = file_get_contents ("data/$from_id/font.txt");
$erte = file_get_contents ("data/$from_id/erte.txt");
$char = file_get_contents ("data/$from_id/char.txt");
$color = file_get_contents ("data/$from_id/color.txt");
$zaban = file_get_contents ("data/$from_id/zaban.txt");
$matn = file_get_contents ("data/$from_id/matn.txt");
$arze = file_get_contents ("data/$from_id/arze.txt");
//--@mriven
function sendphoto($ChatId, $axesh, $matnesh){
	makereq('sendPhoto',[
	'chat_id'=>$ChatId,
	'photo'=>$axesh,
	'caption'=>$matnesh
	]);
	}
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}

function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
//--@mriven
if($textmessage == '/start' )
{
	if (!file_exists("data/$from_id/step.txt")) {
    mkdir("data/$from_id");
    save("data/$from_id/step.txt","none");
    save("bots/$from_id/link.txt","");
save("bots/$from_id/size.txt","");
save("bots/$from_id/font.txt","");
save("bots/$from_id/erte.txt","");
save("bots/$from_id/char.txt","");
save("bots/$from_id/color.txt","");
save("bots/$from_id/zaban.txt","");
save("bots/$from_id/matn.txt","");
    $members = file_get_contents("Member.txt");
    save("Member.txt",$members."$from_id\n");
	}
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام  $name 🤚
➖➖➖➖➖➖➖
😉به سرویس لگو ساز هوشمند خوش آمدید😉
➖➖➖➖➖➖➖
😋این ربات بهت این امکان میدهدتا خودت لگو خودتو طراحی کنی و استفاده کنی😋
➖➖➖➖➖➖➖
نویسنده👤: @mriven
➖➖➖➖➖➖➖
🆔: @DarkSkyTM",
'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
['text'=>"🎨ساخت لگو🎨"]
],
[
['text'=>"👤پشتیبانی👤"],['text'=>"📚راهنما📚"]
        ]
 ],
'resize_keyboard'=>true
           ])
     ]));
}
//--@mriven
elseif($textmessage == '👣برگشت' )
{
    save("data/$from_id/step.txt","none");
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام  $name 🤚
➖➖➖➖➖➖➖
😉به سرویس لگو ساز هوشمند خوش آمدید😉
➖➖➖➖➖➖➖
😋این ربات بهت این امکان میدهدتا خودت لگو خودتو طراحی کنی و استفاده کنی😋
➖➖➖➖➖➖➖
نویسنده👤: @mriven
➖➖➖➖➖➖➖
🆔: @DarkSkyTM",
'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
['text'=>"🎨ساخت لگو🎨"]
],
[
['text'=>"👤پشتیبانی👤"],['text'=>"📚راهنما📚"]
        ]
 ],
'resize_keyboard'=>true
           ])
     ]));
}
//--@mriven
elseif($textmessage == "📚راهنما📚"){
 sendMessage($chat_id,"این ربات به شما این امکان میدهد کهولگو خود را طراحی کنید و از آن لذت ببرید گزینه ساخت لگو کلیک کن");
}
//--@mriven
elseif($textmessage == "👤پشتیبانی👤"){
 sendMessage($chat_id,"😉اگر ایده یا نظری دارید باما در میان بگذارید:😉
@mriven
@mrivenbot");
}
//--@mriven
elseif($textmessage == "🎨ساخت لگو🎨"){
	save("data/$from_id/step.txt","zaban");
	var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😋دوست عزیز لینک عکستو بفرست😋:",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
			'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "zaban"){
		save("data/$from_id/step.txt","matn");
		save("data/$from_id/link.txt",$textmessage);
	var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😋خب حالا زبان متنی که میخوای بنویسی وارد کن 😋:
en 
fa
😉en یعنی انگلیسی fa یعنی فارسی😉",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
			'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "matn"){
		save("data/$from_id/step.txt","size");
		save("data/$from_id/zaban.txt",$textmessage);
	var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😄متن خود را ارسال کنید😄:",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
			'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "size"){
		save("data/$from_id/step.txt","char");
		save("data/$from_id/matn.txt",$textmessage);
	var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😄لطفا اندلزه متن خود را از بین 0 تا 1000 تعیین کنید😄:

🔻اندازه عالی : 100🔺",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
			'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "char"){
  save("data/$from_id/step.txt","erte");
  save("data/$from_id/size.txt",$textmessage);
 var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😄لطفا اندازه چرخش خود را از بین 0 تا 1000 انتخاب نمایید😄:

🔻اندازه عالی: 0🔺",
 'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
   'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "erte"){
  save("data/$from_id/step.txt","arze");
  save("data/$from_id/char.txt",$textmessage);
 var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😄لطفا ارتفاع متن خود را از بین 0 تا 1000 انتخاب نمایید😄:

🔻اندازه عالی: 650🔺",
 'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
   'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "arze"){
  save("data/$from_id/step.txt","color");
  save("data/$from_id/erte.txt",$textmessage);
 var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"😄لطفا عرض متن خود را از بین 0 تا 1000 انتخاب نمایید😄:

🔻اندازه عالی: 300🔺",
 'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
   'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "color"){
  save("data/$from_id/step.txt","payan");
  save("data/$from_id/arze.txt",$textmessage);
 var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"لطفا رنگ متن خودتون رو وارد کنید😋
1-green
2-yellow
3-red
4-blue
5-gray
6-black
7-ping
8-gold
9-silver
10-orange",
 'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
                [
                    ['text'=>"👣برگشت"]
                ]
            ],
   'resize_keyboard'=>true
        ])
    ]));
}
//--@mriven
elseif($step == "payan"){
            $photo = "http://provps.ir/api/logo/index.php?bg=".$link."&fsize=".$size."&ht=".$erte."&wt=10&RO=".$char."&color=".$color."&lang=".$zaban."&text=".$matn."";
  save("data/$from_id/step.txt","none");
  save("data/$from_id/matn.txt",$textmessage);
  var_dump(makereq('sendPhoto',[
        'chat_id'=>$update->message->chat->id,
        'photo'=>$photo,
  'caption'=>"لوگوی شما آماده شد😊",
    ]));
}
//--@mriven
?>
