<?php
date_default_timezone_set('Asia/Baghdad');
if(!file_exists('config.json')){
	$token = readline('Hi Enter Token: ');
	$id = readline('Hi Enter Id: ');
	file_put_contents('config.json', json_encode(['id'=>$id,'token'=>$token]));
	
} else {
		  $config = json_decode(file_get_contents('config.json'),1);
	$token = $config['token'];
	$id = $config['id'];
}

if(!file_exists('accounts.json')){
    file_put_contents('accounts.json',json_encode([]));
}
include 'index.php';
try {
	$callback = function ($update, $bot) {
		global $id;
		if($update != null){
		  $config = json_decode(file_get_contents('config.json'),1);
		  $config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
      $accounts = json_decode(file_get_contents('accounts.json'),1);
			if(isset($update->message)){
				$message = $update->message;
				$chatId = $message->chat->id;
				$text = $message->text;
				if($chatId == $id){
					if($text == '/start'){
              $bot->sendPhoto([ 'chat_id'=>$chatId,
                  'photo'=>"https://t.me/xiiXix/16",
                   'caption'=>'Elostora Elmalek',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃','callback_data'=>'login']],
                          [['text'=>"Elostora Elmalek", 'url'=>"https://t.me/pymarko"]],
                         
                      ]
                  ])
               ]);
          } 
if($text == '/help'){
              $bot->sendvideo([ 'chat_id'=>$chatId,
              'video'=>"https://t.me/ttemtim/3333",
              'caption'=>'طرق السحبب',
                      'reply_markup'=>json_encode([
                      'inline_keyboard'=>[                       
                       [['text'=>"𝐓𝐞𝐥𝐞", 'url'=>"https://t.me/Pymarko"]],
                       ]
                       ])
                       ]);
    
              $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/nnnneueh2/57",
                           'caption'=>'الصيد تضمن كيف',
                ]);
                      $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/ttemtim/3333",
              'caption'=>'كيف تجيي يوزرات للصيد ',
             ]);
            
            } if($text == '/start'){ 
            $bot->sendMessage([
		       'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"لا تقلق هنتر موجود لمساعده 🤍
@Pymarko",

              ]);   
 }

    elseif($text != null){
          	if($config['mode'] != null){
          		$mode = $config['mode'];
          		if($mode == 'addL'){
          			$ig = new ig(['file'=>'','account'=>['useragent'=>'Instagram 27.0.0.7.97 Android (28\/9; 320dpi; 720x1544; OPPO; CPH2015; OP4C7D; mt6765; en_US)']]);
          			list($user,$pass) = explode(':',$text);
          			list($headers,$body) = $ig->login($user,$pass);
          			 // echo $body;
          			$body = json_decode($body);
          			if(isset($body->message)){
          				if($body->message == 'challenge_required'){
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"*Error*. \n - Challenge Required"
          					]);
          				} else {
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"*Error*.\n - Incorrect Username Or Password"
          					]);
          				}
          			} elseif(isset($body->logged_in_user)) {
          				$body = $body->logged_in_user;
          				preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
								  $CookieStr = "";
								  foreach($matches[1] as $item) {
								      $CookieStr .= $item."; ";
								  }
          				$account = ['cookies'=>$CookieStr,'useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)'];
          				
          				$accounts[$text] = $account;
          				file_put_contents('accounts.json', json_encode($accounts));
          				$mid = $config['mid'];
          				$bot->sendMessage([
          				      'parse_mode'=>'markdown',
          							'chat_id'=>$chatId,
          							'text'=>"*Done Add New Accounts To Your Tool.*\n _Username_ : [$user])(instagram.com/$user)\n_Account Name_ : _{$body->full_name}_",
												'reply_to_message_id'=>$mid		
          					]);
          				$keyboard = ['inline_keyboard'=>[
										[['text'=>"𝙰𝙳𝙳 𝙽𝙴𝚆 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"Logout",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'𝙱𝙰𝙲𝙺','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙿𝙰𝙶𝙴 𝙱𝚈 @X_Q_9 𖤐",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
		              $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          			}
          		}  elseif($mode == 'selectFollowers'){
          		  if(is_numeric($text)){
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>"تم التعديل.",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙱𝚈 ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' 👩‍🔧┇ 𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ','callback_data'=>'login']],
                          [['text'=>'🦯┇ 𝙶𝙴𝚃𝙸𝙽𝙶 𝚄𝚂𝙴𝚁𝚂','callback_data'=>'grabber']],
                          [['text'=>'📳┇ 𝚂𝚃𝙰𝚁𝚃 ','callback_data'=>'run'],['text'=>' 📴┇𝚂𝚃𝙾𝙿 ','callback_data'=>'stop']],
                          [['text'=>'🦸┇𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝚂𝚃𝙰𝚃𝚄𝚂','callback_data'=>'status']],
                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- يرجى ارسال رقم فقط .'
          		    ]);
          		  }
          		} else {
          		  switch($config['mode']){
          		    case 'search': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php search.php');
          		      break;
          		      case 'followers': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php followers.php');
          		      break;
          		      case 'following': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php following.php');
          		      break;
          		      case 'hashtag': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php hashtag.php');
          		      break;
          		  }
          		}
          	}
          }
				} else {
					$bot->sendvideo([
       'chat_id'=>$chatId,
       'video'=> "https://t.me/a011437/3",
        'caption'=>'البوت مدفوع 💲 و ليس مجاني 
لشراء نسخه مراسلة المطور ',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'▫️| مطور البوت','url'=>'t.me/X_Q_9']],
                       [['text'=>"▪️| قناه صيد المشتركين", 'url'=>"t.me/M_T_1M"]],
                  ]
							])
					]);
				}
			} elseif(isset($update->callback_query)) {
          $chatId = $update->callback_query->message->chat->id;
          $mid = $update->callback_query->message->message_id;
          $data = $update->callback_query->data;
          echo $data;
          if($data == 'login'){
              
        		$keyboard = ['inline_keyboard'=>[
									[['text'=>"𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"🗑️",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'𝙷𝙾𝙼𝙴 𝙿𝙰𝙶𝙴 🎭','callback_data'=>'back']];
		              $bot->sendMessage([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                   'text'=>" 𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙿𝙰𝙶𝙴 𝙱𝚈 @X_Q_9 𖤐",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          } elseif($data == 'addL'){
          	
          	$config['mode'] = 'addL';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          	$bot->sendMessage([
          			'chat_id'=>$chatId,
          			'text'=>"Send Account Like : `user:pass`",
          			'parse_mode'=>'markdown'
          	]);
          } elseif($data == 'grabber'){
            
            $for = $config['for'] != null ? $config['for'] : 'حدد الحساب';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'🔎┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝚂𝙴𝙰𝚁𝙲𝙷 ','callback_data'=>'search']],
                        [['text'=>'#️⃣┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙷𝙰𝚂𝙷𝚃𝙰𝙶 ','callback_data'=>'hashtag'],['text'=>'🤳┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙴𝚇𝙿𝙻𝙾𝚁𝙴','callback_data'=>'explore']],
                        [['text'=>'👤┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆𝙴𝚁𝚂','callback_data'=>'followers'],['text'=>"👥┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆 ",'callback_data'=>'following']],
                        [['text'=>" 𝚂𝙴𝙻𝙴𝙲𝚃 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 : $for",'callback_data'=>'for']],
                        [['text'=>'🆕┇𝙽𝙴𝚆 𝙻𝙸𝚂𝚃 ','callback_data'=>'newList'],['text'=>'🔙┇𝚄𝙿 𝚃𝙾 𝙾𝙻𝙳 𝙻𝙸𝚂𝚃 ','callback_data'=>'append']],
                        [['text'=>'🔙┇𝙱𝙰𝙲𝙺','callback_data'=>'back']],
                    ]
                ])
            ]);
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الكلمه التريد البحث عليها و ايضا يمكنك من استخدام اكثر من كلمه عن طريق وضع فواصل بين الكلمات 📝"
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب متابعيه و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 👥"
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب الذي  متابعهم و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 👤"
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الهاشتاك بدون علامه # يمكنك استخدام هاشتاك واحد فقط"
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>" 𝑳𝑰𝑺𝑻 𝑵𝑬𝑾 𝑶𝑵𝑬𝑺 𝑯𝑨𝑽𝑬 𝑩𝑬𝑬𝑵 𝑺𝑼𝑪𝑪𝑬𝑺𝑺𝑭𝑼𝑳𝑳𝒀 𝑺𝑬𝑳𝑬𝑪𝑻𝑬𝑫✅",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝑻𝑯𝑬 𝑶𝑳𝑫 𝑳𝑰𝑺𝑻 𝑯𝑨𝑺 𝑩𝑬𝑬𝑵 𝑺𝑬𝑳𝑬𝑪𝑻𝑬𝑫 𝑺𝑼𝑪𝑪𝑬𝑺𝑺𝑭𝑼𝑳𝑳𝒀 ✅",
							'show_alert'=>1
						]);
						
          } elseif($data == 'for'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'forg&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"Select Account",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"Add Account First.",
							'show_alert'=>1
						]);
            }
          } elseif($data == 'selectFollowers'){
            bot('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'قم بأرسال عدد متابعين .'  
            ]);
            $config['mode'] = 'selectFollowers';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          } elseif($data == 'run'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'start&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"𝚂𝙴𝙻𝙴𝙲𝚃 𝙰𝙲𝙲𝙾𝚄𝙽𝚃",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"Add Account First.",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stop'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'stop&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"𝚂𝙴𝙻𝙴𝙲𝚃 𝙰𝙲𝙲𝙾𝚄𝙽𝚃",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"Add Account First.",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stopgr'){
            shell_exec('screen -S gr -X quit');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم الانتهاء من السحب",
							'show_alert'=>1
						]);
						$for = $config['for'] != null ? $config['for'] : 'Select Account';
            $count = count(explode("\n", file_get_contents($for)));
						$bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'🔎┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝚂𝙴𝙰𝚁𝙲𝙷 ','callback_data'=>'search']],
                        [['text'=>'#️⃣┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙷𝙰𝚂𝙷𝚃𝙰𝙶 ','callback_data'=>'hashtag'],['text'=>'🤳┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙴𝚇𝙿𝙻𝙾𝚁𝙴','callback_data'=>'explore']],
                        [['text'=>'👤┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆𝙴𝚁𝚂','callback_data'=>'followers'],['text'=>"👥┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆 ",'callback_data'=>'following']],
                        [['text'=>" 𝚂𝙴𝙻𝙴𝙲𝚃 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 : $for",'callback_data'=>'for']],
                        [['text'=>'🆕┇𝙽𝙴𝚆 𝙻𝙸𝚂𝚃 ','callback_data'=>'newList'],['text'=>'🔙┇𝚄𝙿 𝚃𝙾 𝙾𝙻𝙳 𝙻𝙸𝚂𝚃 ','callback_data'=>'append']],
                        [['text'=>'🔙┇𝙱𝙰𝙲𝙺','callback_data'=>'back']],
                    ]
                ])
            ]);
          } elseif($data == 'explore'){
            exec('screen -dmS gr php explore.php');
          } elseif($data == 'status'){
					$status = '';
					foreach($accounts as $account => $ac){
						$c = explode(':', $account)[0];
						$x = exec('screen -S '.$c.' -Q select . ; echo $?');
						if($x == '0'){
				        $status .= "*$account* ~> _Working_\n";
				    } else {
				        $status .= "*$account* ~> _Stop_\n";
				    }
					}
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"حاله الحسابات : \n\n $status",
							'parse_mode'=>'markdown'
						]);
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙱𝚈 ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' 👩‍🔧┇ 𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ','callback_data'=>'login']],
                          [['text'=>'🦯┇ 𝙶𝙴𝚃𝙸𝙽𝙶 𝚄𝚂𝙴𝚁𝚂','callback_data'=>'grabber']],
                          [['text'=>'📳┇ 𝚂𝚃𝙰𝚁𝚃 ','callback_data'=>'run'],['text'=>' 📴┇𝚂𝚃𝙾𝙿 ','callback_data'=>'stop']],
                          [['text'=>'🦸┇𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝚂𝚃𝙰𝚃𝚄𝚂','callback_data'=>'status']],
                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"🗑️",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'الصفحة الرئيسية ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                    'text'=>" 𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙿𝙰𝙶𝙴 𝙱𝚈 @X_Q_9 𖤐",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          	} elseif($data[0] == 'moveList'){
          	  file_put_contents('list', $data[1]);
          	  $keyboard = [];
          	  foreach ($accounts as $account => $v) {
                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'moveListTo&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختر الحساب الذي تريد نقل اللسته اليه 🔄",
                  'reply_markup'=>json_encode($keyboard)
	              ]);
          	} elseif($data[0] == 'moveListTo'){
          	  $keyboard = [];
          	  file_put_contents($data[1], file_get_contents(file_get_contents('list')));
          	  unlink(file_get_contents('list'));
          	  $keyboard['inline_keyboard'][] = [['text'=>'𝙷𝙾𝙼𝙴 𝙿𝙰𝙶𝙴 🎭','callback_data'=>'back']];
          	  $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"تم نقل اللسته الى الحساب ✅".$data[1],
                  'reply_markup'=>json_encode($keyboard)
	              ]);
          	} elseif($data[0] == 'forg'){
          	  $config['for'] = $data[1];
          	  file_put_contents('config.json',json_encode($config));
              $for = $config['for'] != null ? $config['for'] : 'Select';
              $count = count(file_get_contents($for));
date_default_timezone_set('Asia/Baghdad');
              $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'🔎┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝚂𝙴𝙰𝚁𝙲𝙷 ','callback_data'=>'search']],
                        [['text'=>'#️⃣┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙷𝙰𝚂𝙷𝚃𝙰𝙶 ','callback_data'=>'hashtag'],['text'=>'🤳┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙴𝚇𝙿𝙻𝙾𝚁𝙴','callback_data'=>'explore']],
                        [['text'=>'👤┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆𝙴𝚁𝚂','callback_data'=>'followers'],['text'=>"👥┇𝙷𝚄𝙽𝚃𝙸𝙽𝙶 𝙵𝚁𝙾𝙼 𝙵𝙾𝙻𝙻𝙾𝚆 ",'callback_data'=>'following']],
                        [['text'=>" 𝚂𝙴𝙻𝙴𝙲𝚃 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 : $for",'callback_data'=>'for']],
                        [['text'=>'🆕┇𝙽𝙴𝚆 𝙻𝙸𝚂𝚃 ','callback_data'=>'newList'],['text'=>'🔙┇𝚄𝙿 𝚃𝙾 𝙾𝙻𝙳 𝙻𝙸𝚂𝚃 ','callback_data'=>'append']],
                        [['text'=>'🔙┇𝙱𝙰𝙲𝙺','callback_data'=>'back']],
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙱𝚈 ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' 👩‍🔧┇ 𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ','callback_data'=>'login']],
                          [['text'=>'🦯┇ 𝙶𝙴𝚃𝙸𝙽𝙶 𝚄𝚂𝙴𝚁𝚂','callback_data'=>'grabber']],
                          [['text'=>'📳┇ 𝚂𝚃𝙰𝚁𝚃 ','callback_data'=>'run'],['text'=>' 📴┇𝚂𝚃𝙾𝙿 ','callback_data'=>'stop']],
                          [['text'=>'🦸┇𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝚂𝚃𝙰𝚃𝚄𝚂','callback_data'=>'status']],
                      ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>" ━━━━━━━━━━━━━━━━━━━━━
" . date('Y/n/j g:i') . "\n" . "
الحساب الوهمي 🤺 : ".explode(':',$data[1])[0].'

  تم بدا الفحص ✅

━━━━━━━━━━━━━━━━━━━━━',
                'parse_mode'=>'markdown'
              ]);
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"𝙷𝙸 𝙱𝚁𝙾 𝙸𝙽 𝚃𝙷𝙴 𝙲𝙾𝙽𝚃𝚁𝙾𝙻 𝙱𝚈 ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' 👩‍🔧┇ 𝙰𝙳𝙳 𝙵𝙰𝙺𝙴 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 ','callback_data'=>'login']],
                          [['text'=>'🦯┇ 𝙶𝙴𝚃𝙸𝙽𝙶 𝚄𝚂𝙴𝚁𝚂','callback_data'=>'grabber']],
                          [['text'=>'📳┇ 𝚂𝚃𝙰𝚁𝚃 ','callback_data'=>'run'],['text'=>' 📴┇𝚂𝚃𝙾𝙿 ','callback_data'=>'stop']],
                          [['text'=>'🦸┇𝙰𝙲𝙲𝙾𝚄𝙽𝚃𝚂 𝚂𝚃𝙰𝚃𝚄𝚂','callback_data'=>'status']],
                      ]
                    ])
                  ]);
              exec('screen -S '.explode(':',$data[1])[0].' -X quit');
          	}
          }
			}
		}
	};
	$bot = new EzTG(array('throw_telegram_errors'=>false,'token' => $token, 'callback' => $callback));
} catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
	sleep(1);
}