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
                          [['text'=>'π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π','callback_data'=>'login']],
                          [['text'=>"Elostora Elmalek", 'url'=>"https://t.me/pymarko"]],
                         
                      ]
                  ])
               ]);
          } 
if($text == '/help'){
              $bot->sendvideo([ 'chat_id'=>$chatId,
              'video'=>"https://t.me/ttemtim/3333",
              'caption'=>'Ψ·Ψ±Ω Ψ§ΩΨ³Ψ­Ψ¨Ψ¨',
                      'reply_markup'=>json_encode([
                      'inline_keyboard'=>[                       
                       [['text'=>"πππ₯π", 'url'=>"https://t.me/Pymarko"]],
                       ]
                       ])
                       ]);
    
              $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/nnnneueh2/57",
                           'caption'=>'Ψ§ΩΨ΅ΩΨ― ΨͺΨΆΩΩ ΩΩΩ',
                ]);
                      $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/ttemtim/3333",
              'caption'=>'ΩΩΩ ΨͺΨ¬ΩΩ ΩΩΨ²Ψ±Ψ§Ψͺ ΩΩΨ΅ΩΨ― ',
             ]);
            
            } if($text == '/start'){ 
            $bot->sendMessage([
		       'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"ΩΨ§ ΨͺΩΩΩ ΩΩΨͺΨ± ΩΩΨ¬ΩΨ― ΩΩΨ³Ψ§ΨΉΨ―Ω π€
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
										[['text'=>"π°π³π³ π½π΄π π°π²π²πΎππ½π ",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"Logout",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'π±π°π²πΊ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"π·πΈ π±ππΎ πΈπ½ ππ·π΄π°π²π²πΎππ½ππ π²πΎπ½πππΎπ» πΏπ°πΆπ΄ π±π @X_Q_9 π€",
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
          		        'text'=>"ΨͺΩ Ψ§ΩΨͺΨΉΨ―ΩΩ.",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"π·πΈ π±ππΎ πΈπ½ ππ·π΄ π²πΎπ½πππΎπ» π±π ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' π©βπ§β π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π ','callback_data'=>'login']],
                          [['text'=>'π¦―β πΆπ΄ππΈπ½πΆ πππ΄ππ','callback_data'=>'grabber']],
                          [['text'=>'π³β πππ°ππ ','callback_data'=>'run'],['text'=>' π΄βπππΎπΏ ','callback_data'=>'stop']],
                          [['text'=>'π¦Έβπ°π²π²πΎππ½ππ πππ°πππ','callback_data'=>'status']],
                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- ΩΨ±Ψ¬Ω Ψ§Ψ±Ψ³Ψ§Ω Ψ±ΩΩ ΩΩΨ· .'
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
        'caption'=>'Ψ§ΩΨ¨ΩΨͺ ΩΨ―ΩΩΨΉ π² Ω ΩΩΨ³ ΩΨ¬Ψ§ΩΩ 
ΩΨ΄Ψ±Ψ§Ψ‘ ΩΨ³Ψ?Ω ΩΨ±Ψ§Ψ³ΩΨ© Ψ§ΩΩΨ·ΩΨ± ',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'β«οΈ| ΩΨ·ΩΨ± Ψ§ΩΨ¨ΩΨͺ','url'=>'t.me/X_Q_9']],
                       [['text'=>"βͺοΈ| ΩΩΨ§Ω Ψ΅ΩΨ― Ψ§ΩΩΨ΄ΨͺΨ±ΩΩΩ", 'url'=>"t.me/M_T_1M"]],
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
									[['text'=>"π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"ποΈ",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'π·πΎπΌπ΄ πΏπ°πΆπ΄ π­','callback_data'=>'back']];
		              $bot->sendMessage([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                   'text'=>" π·πΈ π±ππΎ πΈπ½ ππ·π΄π°π²π²πΎππ½ππ π²πΎπ½πππΎπ» πΏπ°πΆπ΄ π±π @X_Q_9 π€",
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
            
            $for = $config['for'] != null ? $config['for'] : 'Ψ­Ψ―Ψ― Ψ§ΩΨ­Ψ³Ψ§Ψ¨';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'πβπ·ππ½ππΈπ½πΆ π΅ππΎπΌ ππ΄π°ππ²π· ','callback_data'=>'search']],
                        [['text'=>'#οΈβ£βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π·π°ππ·ππ°πΆ ','callback_data'=>'hashtag'],['text'=>'π€³βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΄ππΏπ»πΎππ΄','callback_data'=>'explore']],
                        [['text'=>'π€βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎππ΄ππ','callback_data'=>'followers'],['text'=>"π₯βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎπ ",'callback_data'=>'following']],
                        [['text'=>" ππ΄π»π΄π²π π°π²π²πΎππ½π : $for",'callback_data'=>'for']],
                        [['text'=>'πβπ½π΄π π»πΈππ ','callback_data'=>'newList'],['text'=>'πβππΏ ππΎ πΎπ»π³ π»πΈππ ','callback_data'=>'append']],
                        [['text'=>'πβπ±π°π²πΊ','callback_data'=>'back']],
                    ]
                ])
            ]);
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"Ψ§ΩΨ§Ω ΩΩ Ψ¨Ψ£Ψ±Ψ³Ψ§Ω Ψ§ΩΩΩΩΩ Ψ§ΩΨͺΨ±ΩΨ― Ψ§ΩΨ¨Ψ­Ψ« ΨΉΩΩΩΨ§ Ω Ψ§ΩΨΆΨ§ ΩΩΩΩΩ ΩΩ Ψ§Ψ³ΨͺΨ?Ψ―Ψ§Ω Ψ§ΩΨ«Ψ± ΩΩ ΩΩΩΩ ΨΉΩ Ψ·Ψ±ΩΩ ΩΨΆΨΉ ΩΩΨ§Ψ΅Ω Ψ¨ΩΩ Ψ§ΩΩΩΩΨ§Ψͺ π"
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"Ψ§ΩΨ§Ω ΩΩ Ψ¨Ψ£Ψ±Ψ³Ψ§Ω Ψ§ΩΩΩΨ²Ψ± Ψ§ΩΨͺΨ±ΩΨ― Ψ³Ψ­Ψ¨ ΩΨͺΨ§Ψ¨ΨΉΩΩ Ω Ψ§ΩΨΆΨ§ ΩΩΩΩΩ ΩΩ Ψ§Ψ³ΨͺΨ?Ψ―Ψ§Ω Ψ§ΩΨ«Ψ± ΩΩ ΩΩΨ²Ψ± ΨΉΩ Ψ·Ψ±ΩΩ ΩΨΆΨΉ ΩΩΨ§Ψ΅Ω Ψ¨ΩΩ Ψ§ΩΩΩΨ²Ψ±Ψ§Ψͺ π₯"
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"Ψ§ΩΨ§Ω ΩΩ Ψ¨Ψ£Ψ±Ψ³Ψ§Ω Ψ§ΩΩΩΨ²Ψ± Ψ§ΩΨͺΨ±ΩΨ― Ψ³Ψ­Ψ¨ Ψ§ΩΨ°Ω  ΩΨͺΨ§Ψ¨ΨΉΩΩ Ω Ψ§ΩΨΆΨ§ ΩΩΩΩΩ ΩΩ Ψ§Ψ³ΨͺΨ?Ψ―Ψ§Ω Ψ§ΩΨ«Ψ± ΩΩ ΩΩΨ²Ψ± ΨΉΩ Ψ·Ψ±ΩΩ ΩΨΆΨΉ ΩΩΨ§Ψ΅Ω Ψ¨ΩΩ Ψ§ΩΩΩΨ²Ψ±Ψ§Ψͺ π€"
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"Ψ§ΩΨ§Ω ΩΩ Ψ¨Ψ£Ψ±Ψ³Ψ§Ω Ψ§ΩΩΨ§Ψ΄ΨͺΨ§Ω Ψ¨Ψ―ΩΩ ΨΉΩΨ§ΩΩ # ΩΩΩΩΩ Ψ§Ψ³ΨͺΨ?Ψ―Ψ§Ω ΩΨ§Ψ΄ΨͺΨ§Ω ΩΨ§Ψ­Ψ― ΩΩΨ·"
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>" π³π°πΊπ» π΅π¬πΎ πΆπ΅π¬πΊ π―π¨π½π¬ π©π¬π¬π΅ πΊπΌπͺπͺπ¬πΊπΊπ­πΌπ³π³π πΊπ¬π³π¬πͺπ»π¬π«β",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"π»π―π¬ πΆπ³π« π³π°πΊπ» π―π¨πΊ π©π¬π¬π΅ πΊπ¬π³π¬πͺπ»π¬π« πΊπΌπͺπͺπ¬πΊπΊπ­πΌπ³π³π β",
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
                'text'=>'ΩΩ Ψ¨Ψ£Ψ±Ψ³Ψ§Ω ΨΉΨ―Ψ― ΩΨͺΨ§Ψ¨ΨΉΩΩ .'  
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
                  'text'=>"ππ΄π»π΄π²π π°π²π²πΎππ½π",
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
                  'text'=>"ππ΄π»π΄π²π π°π²π²πΎππ½π",
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
							'text'=>"ΨͺΩ Ψ§ΩΨ§ΩΨͺΩΨ§Ψ‘ ΩΩ Ψ§ΩΨ³Ψ­Ψ¨",
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
                        [['text'=>'πβπ·ππ½ππΈπ½πΆ π΅ππΎπΌ ππ΄π°ππ²π· ','callback_data'=>'search']],
                        [['text'=>'#οΈβ£βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π·π°ππ·ππ°πΆ ','callback_data'=>'hashtag'],['text'=>'π€³βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΄ππΏπ»πΎππ΄','callback_data'=>'explore']],
                        [['text'=>'π€βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎππ΄ππ','callback_data'=>'followers'],['text'=>"π₯βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎπ ",'callback_data'=>'following']],
                        [['text'=>" ππ΄π»π΄π²π π°π²π²πΎππ½π : $for",'callback_data'=>'for']],
                        [['text'=>'πβπ½π΄π π»πΈππ ','callback_data'=>'newList'],['text'=>'πβππΏ ππΎ πΎπ»π³ π»πΈππ ','callback_data'=>'append']],
                        [['text'=>'πβπ±π°π²πΊ','callback_data'=>'back']],
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
							'text'=>"Ψ­Ψ§ΩΩ Ψ§ΩΨ­Ψ³Ψ§Ψ¨Ψ§Ψͺ : \n\n $status",
							'parse_mode'=>'markdown'
						]);
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"π·πΈ π±ππΎ πΈπ½ ππ·π΄ π²πΎπ½πππΎπ» π±π ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' π©βπ§β π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π ','callback_data'=>'login']],
                          [['text'=>'π¦―β πΆπ΄ππΈπ½πΆ πππ΄ππ','callback_data'=>'grabber']],
                          [['text'=>'π³β πππ°ππ ','callback_data'=>'run'],['text'=>' π΄βπππΎπΏ ','callback_data'=>'stop']],
                          [['text'=>'π¦Έβπ°π²π²πΎππ½ππ πππ°πππ','callback_data'=>'status']],
                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π ",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"ποΈ",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'Ψ§ΩΨ΅ΩΨ­Ψ© Ψ§ΩΨ±Ψ¦ΩΨ³ΩΨ© ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                    'text'=>" π·πΈ π±ππΎ πΈπ½ ππ·π΄π°π²π²πΎππ½ππ π²πΎπ½πππΎπ» πΏπ°πΆπ΄ π±π @X_Q_9 π€",
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
                  'text'=>"Ψ§Ψ?ΨͺΨ± Ψ§ΩΨ­Ψ³Ψ§Ψ¨ Ψ§ΩΨ°Ω ΨͺΨ±ΩΨ― ΩΩΩ Ψ§ΩΩΨ³ΨͺΩ Ψ§ΩΩΩ π",
                  'reply_markup'=>json_encode($keyboard)
	              ]);
          	} elseif($data[0] == 'moveListTo'){
          	  $keyboard = [];
          	  file_put_contents($data[1], file_get_contents(file_get_contents('list')));
          	  unlink(file_get_contents('list'));
          	  $keyboard['inline_keyboard'][] = [['text'=>'π·πΎπΌπ΄ πΏπ°πΆπ΄ π­','callback_data'=>'back']];
          	  $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"ΨͺΩ ΩΩΩ Ψ§ΩΩΨ³ΨͺΩ Ψ§ΩΩ Ψ§ΩΨ­Ψ³Ψ§Ψ¨ β".$data[1],
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
                        [['text'=>'πβπ·ππ½ππΈπ½πΆ π΅ππΎπΌ ππ΄π°ππ²π· ','callback_data'=>'search']],
                        [['text'=>'#οΈβ£βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π·π°ππ·ππ°πΆ ','callback_data'=>'hashtag'],['text'=>'π€³βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΄ππΏπ»πΎππ΄','callback_data'=>'explore']],
                        [['text'=>'π€βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎππ΄ππ','callback_data'=>'followers'],['text'=>"π₯βπ·ππ½ππΈπ½πΆ π΅ππΎπΌ π΅πΎπ»π»πΎπ ",'callback_data'=>'following']],
                        [['text'=>" ππ΄π»π΄π²π π°π²π²πΎππ½π : $for",'callback_data'=>'for']],
                        [['text'=>'πβπ½π΄π π»πΈππ ','callback_data'=>'newList'],['text'=>'πβππΏ ππΎ πΎπ»π³ π»πΈππ ','callback_data'=>'append']],
                        [['text'=>'πβπ±π°π²πΊ','callback_data'=>'back']],
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"π·πΈ π±ππΎ πΈπ½ ππ·π΄ π²πΎπ½πππΎπ» π±π ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' π©βπ§β π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π ','callback_data'=>'login']],
                          [['text'=>'π¦―β πΆπ΄ππΈπ½πΆ πππ΄ππ','callback_data'=>'grabber']],
                          [['text'=>'π³β πππ°ππ ','callback_data'=>'run'],['text'=>' π΄βπππΎπΏ ','callback_data'=>'stop']],
                          [['text'=>'π¦Έβπ°π²π²πΎππ½ππ πππ°πππ','callback_data'=>'status']],
                      ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>" βββββββββββββββββββββ
" . date('Y/n/j g:i') . "\n" . "
Ψ§ΩΨ­Ψ³Ψ§Ψ¨ Ψ§ΩΩΩΩΩ π€Ί : ".explode(':',$data[1])[0].'

  ΨͺΩ Ψ¨Ψ―Ψ§ Ψ§ΩΩΨ­Ψ΅ β

βββββββββββββββββββββ',
                'parse_mode'=>'markdown'
              ]);
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=>"π·πΈ π±ππΎ πΈπ½ ππ·π΄ π²πΎπ½πππΎπ» π±π ~ @Pymarko",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>' π©βπ§β π°π³π³ π΅π°πΊπ΄ π°π²π²πΎππ½π ','callback_data'=>'login']],
                          [['text'=>'π¦―β πΆπ΄ππΈπ½πΆ πππ΄ππ','callback_data'=>'grabber']],
                          [['text'=>'π³β πππ°ππ ','callback_data'=>'run'],['text'=>' π΄βπππΎπΏ ','callback_data'=>'stop']],
                          [['text'=>'π¦Έβπ°π²π²πΎππ½ππ πππ°πππ','callback_data'=>'status']],
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