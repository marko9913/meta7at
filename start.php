<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"جاري فحص برعايه هنتر ✝️ : 

" . date('Y/n/j') . "\n" . "
",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'𝙲𝙷𝙴𝙲𝙺 ~ '.$i,'callback_data'=>'fgf']],
                [['text'=>'𝙴𝙼𝙰𝙸𝙻 ~ '.$mail,'callback_data'=>'bro']],
                [['text'=>'𝚄𝚂𝙴𝚁 ~ '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"𝙶𝙼𝙰𝙸𝙻 : $gmail",'callback_data'=>'dfgfd'],['text'=>"𝚈𝙰𝙷𝙾𝙾 : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'𝙼𝙰𝙸𝙻𝚁𝚄 : '.$mailru,'callback_data'=>'fgd'],['text'=>'𝙷𝙾𝚃𝙼𝙰𝙸𝙻 : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>' ✅ 𝚈𝙴𝚂 ~ '.$true,'callback_data'=>'gj']],
                [['text'=>' ❌ 𝙽𝙾 ~ '.$false,'callback_data'=>'dghkf']]
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false and !is_string($info)) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(hotmail|outlook|yahoo|Yahoo)\.(com)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.com') or strpos($mail,'outlook.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo.com')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "𝔸ℍ𝕄𝔼𝔻 ℍ𝕌ℕ𝕋𝔼ℝ.✅
━━━━━━━━━━━━
.👤. 𝕌𝕊𝔼ℝ : [$usern](instagram.com/$usern)\n 
.📧. 𝔼𝕄𝔸𝕀𝕃  : [$mail]\n 
.👥. 𝔽𝕆𝕃𝕃𝕆𝕎𝔼ℝ𝕊  : $follow\n 
.🚻. 𝔽𝕆𝕃𝕃𝕆𝕎𝕀ℕ𝔾 : $following\n 
.🤳. ℙ𝕆𝕊𝕋 : $media\n
.⌚. ℍ𝕆𝕌ℝ𝕊 : ".date("Y")."/".date("n")."/".date("d")." : " . date('g:i') . "\n" . "
.🔢. 𝙳𝙾𝙽𝙴 𝙷𝚄𝙽𝚃𝙸𝙽𝙶 : $true
━━━━━━━━━━━━
 [@X_Q_9 ✹ @A_H_M_E_D_0_1_1༗]",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'𝙲𝙷𝙴𝙲𝙺 ~ '.$i,'callback_data'=>'fgf']],
                [['text'=>'𝙴𝙼𝙰𝙸𝙻 ~ '.$mail,'callback_data'=>'bro']],
                [['text'=>'𝚄𝚂𝙴𝚁 ~ '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"𝙶𝙼𝙰𝙸𝙻 : $gmail",'callback_data'=>'dfgfd'],['text'=>"𝚈𝙰𝙷𝙾𝙾 : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'𝙼𝙰𝙸𝙻𝚁𝚄 : '.$mailru,'callback_data'=>'fgd'],['text'=>'𝙷𝙾𝚃𝙼𝙰𝙸𝙻 : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>' ✅ 𝚈𝙴𝚂 ~ '.$true,'callback_data'=>'gj']],
                [['text'=>' ❌ 𝙽𝙾 ~ '.$false,'callback_data'=>'dghkf']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } elseif(is_string($info)){
        bot('sendMessage',[
            'chat_id'=>$id,
            'text'=>"الحساب - `$screen`\n تم حظره من *الفحص*.",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                        [['text'=>'نقل اللسته -✅','callback_data'=>'moveList&'.$screen]],
                        [['text'=>'حذف الحساب -❎','callback_data'=>'del&'.$screen]]
                    ]    
            ]),
            'parse_mode'=>'markdown'
        ]);
        exit;
    } else {
        $NotBusiness+=1;
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'𝙲𝙷𝙴𝙲𝙺 ~ '.$i,'callback_data'=>'fgf']],
                [['text'=>'𝙴𝙼𝙰𝙸𝙻 ~ '.$mail,'callback_data'=>'bro']],
                [['text'=>'𝚄𝚂𝙴𝚁 ~ '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"𝙶𝙼𝙰𝙸𝙻 : $gmail",'callback_data'=>'dfgfd'],['text'=>"𝚈𝙰𝙷𝙾𝙾 : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'𝙼𝙰𝙸𝙻𝚁𝚄 : '.$mailru,'callback_data'=>'fgd'],['text'=>'𝙷𝙾𝚃𝙼𝙰𝙸𝙻 : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>' ✅ 𝚈𝙴𝚂 ~ '.$true,'callback_data'=>'gj']],
                [['text'=>' ❌ 𝙽𝙾 ~ '.$false,'callback_data'=>'dghkf']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"انتهي الفحص".explode(':',$screen)[0]]);

