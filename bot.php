<?php
    define('API_KEY','Token');

    $admin = "-1001782995893"; // admin idsi
    $adminuser = "youngcoderuz"; // admin user

    function del($nomi){
        array_map('unlink', glob("step/$nomi.*"));
    }
    function put($fayl, $nima){
        file_put_contents("$fayl", "$nima");
    }

    function pstep($cid,$zn){
        file_put_contents("step/$cid.step",$zn);
    }

    function step($cid){
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step",$step);
    }

    function nextTx($cid,$txt){
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt","$step\n$txt");
    }

    function ty($ch){
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    function ACL($callbackQueryId, $text = null, $showAlert = false)
    {
        return bot('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
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
    $cid = $message->chat->id;
    $cidtyp = $message->chat->type;
    $miid = $message->message_id;
    $name = $message->chat->first_name;
    $user = $message->from->username;
    $tx = $message->text;
    $callback = $update->callback_query;
    $mmid = $callback->inline_message_id;
    $mes = $callback->message;
    $mid = $mes->message_id;
    $cmtx = $mes->text;
    $mmid = $callback->inline_message_id;
    $idd = $callback->message->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida = $callback->id;
    $cqid = $update->callback_query->id;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->message->chat->type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    // mkdir("step");

    $otex = "😔 Bekor qilish";
    
    $keys = json_encode([
        'resize_keyboard'=>true,
        'keyboard' => [
            [['text' => "🎓 Kurslar"],],
            [['text' => "ℹ️ Biz haqimizda"],['text' => "📞 Aloqa"],],
            [['text' => "📍 Manzil"],['text' => "®️ Ro`yhatdan o`tish"],],
        ]
    ]);

$kurstillar = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "📔ARAB TILI"], ['text' => "🗣SPEAKING"],],
            [['text' => "🇰🇷Koreys tili"], ['text' => "🇷🇺RUS TILI"],],
            [['text' => "🔙 Ortga qaytish"],],
        ]
    ]);
    $otmen = json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
            [['text'=>"$otex"],],
        ]
    ]);

    $manzil = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "😊AJOYIB", 'text' => "😊AJOYIB"],['callback_data' => "😕YAXSHI", 'text' => "😕YAXSHI"],],
        ]
    ]);
$kursb = json_encode([
  'resize_keyboard' => true,
  'keyboard' => [
      [['text' => "🧑‍🏫Maktabga tayyorlov"], ['text' => "📒Matematika"],],
      [['text' => "📕Ona tili"], ['text' => "📗Rus tili"],],
      [['text' => "📘Ingliz tili"], ['text' => "🧮 Mental arifmetika"],],
      [['text' => "🔙 Ortga qaytish"],],
  ]
]);
    $kursabitur = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "🇺🇸INGLIZ TILI"], ['text' => "📕IELTS"],],
            [['text' => "📕MATEMATIKA"], ['text' => "🇷🇺RUS TILI"],],
            [['text' => "📘FIZIKA"], ['text' => "🇺🇿Ona tili "],],
            [['text' => "📗TARIX"], ['text' => "📘BIOLOGIYA"],],
            [['text' => "📙KIMYO"],],
            [['text' => "🔙 Ortga qaytish"],],
        ]
    ]);
$kurslar = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Abituriyentlar uchun"], ['text' => "Bolalar uchun"],],
            [['text' => "Til kurslari"]],
            [['text' => "🔙 Ortga qaytish"],],
        ]
    ]);
if($tx == "Til kurslari"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurstillar,
        ]);
    }
 if($tx == "Abituriyentlar uchun"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "<b>$name , marhamat kerakli kursni tanlang!</b>",
            'parse_mode' => 'HTML',
            'reply_markup' => $kursabitur
        ]);
    }
  if($tx == "Bolalar uchun"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "<b>$name , marhamat kerakli kursni tanlang!</b>",
            'parse_mode' => 'HTML',
            'reply_markup' => $kursb
        ]);
    }

    $tasdiq = json_encode(
        ['inline_keyboard' => [
            [['callback_data' => "ok", 'text' => "Ha 👍"],['callback_data' => "clear", 'text' => "Yo'q 👎"],],
        ]
    ]);

    if(isset($tx)){
        ty($cid);
    }



    if($tx == "/start"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }
    if ($tx == "ℹ️ Biz haqimizda") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://ozodbek6.deect.ru/markaz.jpg",
'caption'=>"<b>Assalomu alaykum va rohmatullohi va barokatuh!

📈 Ilm bizni yuqoriga yuksaltiradi!

O'zingiz va ota-onangizni hozirgi qiyinchiliklardan halos eting. Ilm o'rganing, eng kerakli kasblardan birining egasi bo'ling. Hammasi o'z qo'lingizda!
✅ Yangiyer ziyo o'quv markazida ochiladigan yangi guruhlarga hoziroq yoziling 

📚 Eng sifatli ta'lim;
🗺 Eng qulay joylashuv;
💵 Eng hamyonbop narxlar;
👩🏻‍🏫 Eng professional ustozlar;
🏢 Eng zamonaviy dars xonalar!

Hullas, eng zo'r o'quv markazda eng qisqa vaqtda tayyorgarlik ko'rib eng yuqori natijalarga erishishingiz mumkin!</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

    if($tx == "📞 Aloqa"){
	bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://ozodbek6.deect.ru/yangiyer.jpg",
'caption'=>"Biz bilan bog'lanish:

📞 Tel.: +998 99 476-69-55
📧 Telegram: @yangiyerziyo_admin

Bizni telegram orqali kuzating: @yangiyerziyo_NTM",
'parse_mode'=>'HTML',
	'reply_markup' => $keys,

	]);
	}
    if ($tx == "📍 Manzil") {
        bot('sendLocation', [
            'chat_id' => $cid,
            'latitude' => 40.266429165225915,
            'longitude' => 68.82442620000002,
            'reply_markup' => $keys,
        ]);
    }
   

    // Kurs haqida ma'lumot
    if ($tx == "🎓 Kurslar") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Aynan qaysi yo'nalishdagi kursimiz haqida ma'lumot kerak ?*",
            'parse_mode' => 'markdown',
            'reply_markup' => $kurslar,
        ]);
    }

    if ($tx == "🇺🇸INGLIZ TILI") {
        bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://ddnews.ru/wp-content/uploads/2020/11/eMrKS_cSuXE.jpg",
'caption'=>" <b>🇺🇸INGLIZ TILI
O'QITUVCHILAR: Egamqulov Shahzod  va  Isroilova Umida.
💳 Narxi: 180 000/oy</b>\n",
'parse_mode'=>'HTML',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "📕IELTS") {
        bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://telegra.ph/file/d71d50193720fa2f35b77.jpg",
'caption'=>" <b>📕IELTS:
O'qituvchi: Isroilova Umida 
💳 Narxi: 180 000/oy</b>\n",
'parse_mode'=>'HTML',
            'reply_markup' => $kurs,
        ]);
    }

    if ($tx == "🗣SPEAKING") {
        bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://static.ielts-fighter.com/uploads/2019/11/11/062847bf7370431169deacf9b02e0830_3-loai-cau-hoi-trong-speaking.jpg",
'caption'=>" <b>🗣SPEAKING:
O'qituvchi:Isroilov Umida
💳 Narxi: 250 000/oy</b>\n",
'parse_mode'=>'HTML',
            'reply_markup' => $kurs,
        ]);
    }

  if ($tx == "🇷🇺RUS TILI") {
        bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://oxford-edu.uz/oxsford/images/course/Tl6t0NPh.jpg",
'caption'=>" <b>🇷🇺RUS TILI: 
Rus tili grammatikasi: 300 000
Rus tili (soʻzlashuv): 260 000 so'm Azimova Xushroʻybibi 
Rus tili (soʻzlashuv):180 000 so'm Imamova Gavhar
</b>",
'parse_mode'=>'HTML',
            'reply_markup' => $kurs,
        ]);
    }
//////////
if ($tx == "🇰🇷Koreys tili") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://oxford-edu.uz/oxsford/images/course/KfSxorgR.jpg",
'caption'=>" <b>🇰🇷Koreys tili:
O'qituvchi: Xudoyberganov Baxtiyor
💳 Narxi: 300 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "🇺🇿Ona tili") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://oxford-edu.uz/oxsford/images/course/HYrCp8Lu.jpg",
'caption'=>"<b>🇺🇿Ona tili:
O'qituvchi: OMONLIQOV UMMATQUL
💳 Narxi: 300 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📗TARIX") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://catherineasquithgallery.com/uploads/posts/2021-03/1615820374_18-p-fon-puteshestvennikov-21.jpg",
'caption'=>"<b>📗TARIX:
O'qituvchi: Akbarxonov Ismoilxon
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📘BIOLOGIYA") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://avatars.mds.yandex.net/i?id=ba52f6ab98271d1ffc324df17625b49c-5477655-images-thumbs&n=13",
'caption'=>"<b>📘BIOLOGIYA
O'qituvchi: Usmonov Baxtiyor
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📙KIMYO") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://do.cdodd.ru/pluginfile.php/13177/course/overviewfiles/%D1%85%D0%B8%D0%BC%D0%B8%D1%8F.jpg",
'caption'=>"<b>📙KIMYO:
O'qituvchi: Mahamadiyev Sharofiddin 
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📘FIZIKA") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://i.sunhome.ru/journal/155/izvestnie-fiziki-v2.orig.jpg",
'caption'=>"<b>📘FIZIKA:
O'qituvchi: XOLTOʻRAYEV OLIMJON
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📕MATEMATIKA") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://i.sunhome.ru/journal/155/izvestnie-fiziki-v2.orig.jpg",
'caption'=>"<b>📕MATEMATIKA:
O'qituvchi:  XOLTOʻRAYEV OLIMJON
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "📔ARAB TILI") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://cf2.ppt-online.org/files2/slide/g/gCY5Arf2b0eEmF8HdIOVU19PvxiaKkhNsTRSuG/slide.jpg",
'caption'=>"<b>📔ARAB TILI:
O'qituvchi: Karimov Sherzod
💳 Narxi: 180 000/oy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kurs,
  ]);
}

if ($tx == "🧑‍🏫Maktabga tayyorlov") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://pbs.twimg.com/media/DuJCpHJW0AMR0vC.jpg:large",
'caption'=>"<b>👩‍🏫Maktabga tayyorlov: 200 000 so'm Otabekova Shirinoy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}

if ($tx == "📒Matematika") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"http://rpk-do.ru/pluginfile.php/2310/course/overviewfiles/%D1%84%D0%BE%D1%82%D0%BE1.jpg",
'caption'=>"<b>📕Matematika: 160 000 so'm Otabekova Shirinoy va
Xolto'rayev Olimjon </b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}

if ($tx == "📕Ona tili") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://oxford-edu.uz/oxsford/images/course/HYrCp8Lu.jpg",
'caption'=>"<b>📗Ona tili: 160 000 so'm Otabekova Shirinoy</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}

if ($tx == "📗Rus tili") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://oxford-edu.uz/oxsford/images/course/Tl6t0NPh.jpg",
'caption'=>"<b>📙Rus tili: 180 000 so'm Azimova Xushroʻybibi</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}

if ($tx == "📘Ingliz tili") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://avatars.mds.yandex.net/i?id=f5610e8be2304dd6fbde42299e5db081-3742206-images-thumbs&n=13",
'caption'=>"<b>📘Ingliz tili: 180 000 so'm Isroilova Umida</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}

if ($tx == "🧮 Mental arifmetika") {
  bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://mypetrovich.ru/backend/uploads/15ea30af3708372c729913ea19fd0544.jpg",
'caption'=>"<b>🧮Mental arifmetika: 180 000 so'm  Nurmatova Nazira</b>",
'parse_mode'=>'HTML',
      'reply_markup' => $kursb,
  ]);
}
    if ($tx == "🔙 Ortga qaytish") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

    // register uchun
    if($tx == "®️ Ro`yhatdan o`tish"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Ism-familiyangizni kiriting\n(Masalan : Falonchiyev Falonchi)",
            'parse_mode' => 'markdown',
            'reply_markup' => $otmen,
        ]);
        pstep($cid,"0");
        put("step/$cid.menu","register");
    }

    if($step == "0" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Tug'ilgan sangizni kiriting\n(Masalan : 04.05.2006)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "🎓 Yangi o'quvchi: ". $tx);
        step($cid);
        }
    }

    if($step == "1" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Qaysi yo'nalish bo'yicha tahsil olmoqchisiz?\n(Masalan : IELTS, Matematika...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $otmen,
            ]);
        nextTx($cid, "🌐 Tug'ilgan sana: ".$tx);
        step($cid);
        }
    }

    if($step == "2" and $menu == "register"){
        if($tx == $otex){}else{
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Tanlagan yo'nalishingiz bo'yicha bilim darajangiz qanday?\n(Masalan : Umuman yo'q, Oz-moz bilaman...)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
            nextTx($cid, "📚 Kurs: ".$tx);
            step($cid);
        }
    }

    if($step == "3" and $menu == "register"){
        bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : +998971234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
        nextTx($cid, "👨🏻‍💻 Daraja: ".$tx);
        step($cid);
    }

    if($step == "4" and $menu == "register"){
        if($tx == $otex){}else{
           if(mb_stripos($tx,"+998")!==false){
            bot('sendMessage', [
                    'chat_id'=>$cid,
                    'text'=>"*Ma'lumotlar muvaffaqiyatli saqlandi*, Iltimos bot faoliyatini baholang?",
                    'parse_mode'=>'markdown',
                    'reply_markup' => $manzil,
                ]);
                nextTx($cid, "📞 Aloqa: ".$tx);
                step($cid);
            }else{
                bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Telefon raqamingizni kiriting?\n(Masalan : +998971234567)",
                'parse_mode' => 'markdown',
                'reply_markup' => $cancel,
            ]);
          } 
        }
    }

    if(isset($data) and $stepe == "5" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"<b>Sizning Anketa tayyor bo'ldi, barchasi ma'lumotlaringiz tasdiqlaysizmi?</b>
            $baza\n☑️ Botga berilgan baho : $data",
            'parse_mode'=>'html',
            'reply_markup'=>$tasdiq,
        ]);
        nextTx($cbid, "👌 Botga bergan bahosi: ".$data);
        step($cbid);
    }

    if($data == "ok" and $stepe == "6" and $menue == "register"){
        ACL($ida);
        $baza = file_get_contents("step/$cbid.txt");
        bot('sendMessage',[
            'chat_id'=>$admin,
            'text'=>"<b>Yangi o'quvchi!</b>
            Username: @$cbuser
            <a href='tg://user?id=$cbid'>Zaxira profili</a><code>$baza</code>",
            'parse_mode'=>'html',
        ]);
        bot('sendMessage',[
            'chat_id'=>$cbid,
            'text'=>"✅ Sizning Anketangiz xodimlarimizga muvaffaqiyatli jo'natildi, qisqa fursatlarda sizga aloqaga chiqamiz! E'tiboringiz uchun rahmat",
            'parse_mode'=>'html',
            'reply_markup'=>$keys,
        ]);
        del($cbid);
    }
    if($tx == $otex or $data == "clear"){
    ACL($ida);
    del($cbid);
    del($cid);
    if(isset($tx)) $url = "$cid";
    if(isset($data)) $url = "$cbid";
    bot('sendMessage', [
    'chat_id'=>$url,
    'text'=>"Anketa bekor qilindi!",
    'reply_markup'=>$keys,
    ]);
    }

?>
