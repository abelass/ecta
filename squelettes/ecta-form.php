<?php

echo '		<link type="text/css" rel="stylesheet" href="/squelettes/css/reset.css" media="screen">

		<link type="text/css" rel="stylesheet" href="/squelettes/css/stylesheet.css" media="screen">
		<link type="text/css" rel="stylesheet" href="/squelettes/css/rwd.css" media="screen">
		<link type="text/css" rel="stylesheet" href="/squelettes/css/accessability.css" media="screen">

		<link type="text/css" rel="stylesheet" href="/squelettes/css/previous.css" media="screen">';

/* ****************************** config ****************************** */

define('DEBUG', true);

define('MAIL_SMTP_PORT', 587);
define('MAIL_HOST', 'ngomedia.pl');
define('MAIL_USER', 'test@ngomedia.pl');
define('MAIL_PASS', '123QWEasd');
define('MAIL_MAIL', 'test@ngomedia.pl');

/* ****************************** tables ****************************** */
$countries = array(
    'Afghanistan',
    'Albania',
    'Algeria',
    'American Samoa',
    'Andorra',
    'Angola',
    'Anguilla',
    'Antarctica',
    'Antigua and Barbuda',
    'Argentina',
    'Armenia',
    'Aruba',
    'Australia',
    'Austria',
    'Azerbaijan',
    'Bahamas',
    'Bahrain',
    'Bangladesh',
    'Barbados',
    'Belarus',
    'Belgium',
    'Belize',
    'Benin',
    'Bermuda',
    'Bhutan',
    'Bolivia',
    'Bosnia and Herzegovina',
    'Botswana',
    'Bouvet Island',
    'Brazil',
    'British Indian Ocean Territory',
    'Brunei Darussalam',
    'Bulgaria',
    'Burkina Faso',
    'Burundi',
    'Cambodia',
    'Cameroon',
    'Canada',
    'Cape Verde',
    'Cayman Islands',
    'Central African Republic',
    'Chad',
    'Chile',
    'China',
    'Christmas Island',
    'Cocos Islands',
    'Colombia',
    'Comoros',
    'Congo',
    'Congo, Democratic Republic of the',
    'Cook Islands',
    'Costa Rica',
    'Cote d\'Ivoire',
    'Croatia',
    'Cuba',
    'Cyprus',
    'Czech Republic',
    'Denmark',
    'Djibouti',
    'Dominica',
    'Dominican Republic',
    'Ecuador',
    'Egypt',
    'El Salvador',
    'Equatorial Guinea',
    'Eritrea',
    'Estonia',
    'Ethiopia',
    'Falkland Islands',
    'Faroe Islands',
    'Fiji',
    'Finland',
    'France',
    'French Guiana',
    'French Polynesia',
    'Gabon',
    'Gambia',
    'Georgia',
    'Germany',
    'Ghana',
    'Gibraltar',
    'Greece',
    'Greenland',
    'Grenada',
    'Guadeloupe',
    'Guam',
    'Guatemala',
    'Guinea',
    'Guinea-Bissau',
    'Guyana',
    'Haiti',
    'Heard Island and McDonald Islands',
    'Honduras',
    'Hong Kong',
    'Hungary',
    'Iceland',
    'India',
    'Indonesia',
    'Iran',
    'Iraq',
    'Ireland',
    'Israel',
    'Italy',
    'Jamaica',
    'Japan',
    'Jordan',
    'Kazakhstan',
    'Kenya',
    'Kiribati',
    'Kuwait',
    'Kyrgyzstan',
    'Laos',
    'Latvia',
    'Lebanon',
    'Lesotho',
    'Liberia',
    'Libya',
    'Liechtenstein',
    'Lithuania',
    'Luxembourg',
    'Macao',
    'Madagascar',
    'Malawi',
    'Malaysia',
    'Maldives',
    'Mali',
    'Malta',
    'Marshall Islands',
    'Martinique',
    'Mauritania',
    'Mauritius',
    'Mayotte',
    'Mexico',
    'Micronesia',
    'Moldova',
    'Monaco',
    'Mongolia',
    'Montenegro',
    'Montserrat',
    'Morocco',
    'Mozambique',
    'Myanmar',
    'Namibia',
    'Nauru',
    'Nepal',
    'Netherlands',
    'Netherlands Antilles',
    'New Caledonia',
    'New Zealand',
    'Nicaragua',
    'Niger',
    'Nigeria',
    'Norfolk Island',
    'North Korea',
    'Norway',
    'Oman',
    'Pakistan',
    'Palau',
    'Palestinian Territory',
    'Panama',
    'Papua New Guinea',
    'Paraguay',
    'Peru',
    'Philippines',
    'Pitcairn',
    'Poland',
    'Portugal',
    'Puerto Rico',
    'Qatar',
    'Romania',
    'Russian Federation',
    'Rwanda',
    'Saint Helena',
    'Saint Kitts and Nevis',
    'Saint Lucia',
    'Saint Pierre and Miquelon',
    'Saint Vincent and the Grenadines',
    'Samoa',
    'San Marino',
    'Sao Tome and Principe',
    'Saudi Arabia',
    'Senegal',
    'Serbia',
    'Seychelles',
    'Sierra Leone',
    'Singapore',
    'Slovakia',
    'Slovenia',
    'Solomon Islands',
    'Somalia',
    'South Africa',
    'South Georgia',
    'South Korea',
    'Spain',
    'Sri Lanka',
    'Sudan',
    'Suriname',
    'Svalbard and Jan Mayen',
    'Swaziland',
    'Sweden',
    'Switzerland',
    'Syrian Arab Republic',
    'Taiwan',
    'Tajikistan',
    'Tanzania',
    'Thailand',
    'The Former Yugoslav Republic of Macedonia',
    'Timor-Leste',
    'Togo',
    'Tokelau',
    'Tonga',
    'Trinidad and Tobago',
    'Tunisia',
    'Turkey',
    'Turkmenistan',
    'Tuvalu',
    'Uganda',
    'Ukraine',
    'United Arab Emirates',
    'United Kingdom',
    'United States',
    'United States Minor Outlying Islands',
    'Uruguay',
    'Uzbekistan',
    'Vanuatu',
    'Vatican City',
    'Venezuela',
    'Vietnam',
    'Virgin Islands, British',
    'Virgin Islands, U.S.',
    'Wallis and Futuna',
    'Western Sahara',
    'Yemen',
    'Zambia',
    'Zimbabwe',
    );

$prefix = array(
    '001',
    '002',
    '003',
    );

/* ****************************** mail class ****************************** */

function is_email( $val ){
    return preg_match('|^[_a-z0-9.-]*[a-z0-9]@[_a-z0-9.-]*[a-z0-9].[a-z]{2,4}$|e' , $val);
    }

class Mail
{

	static private $instance = false;
	
	public static function getInstance() {
			if(!self::$instance) {
			self::$instance = new Mail();
		}
		return self::$instance;
	}

	private $socket;

	public $iso = false;
	private $smtp = array();
	private $header = array();
	private $body = array();
	private $attachment = array();
	
	private $return = true;

	private $log;
	
	/**
	* Ustawianie nagłowkow
	* 
	* host
	* login
	* pass
	* 
	* @param type
	* @param value
	* @return bool - true on succeful
	**/
	public function setSmtp($type = false, $val ){
		if( $type ){
			$val = htmlspecialchars_decode($val);
			switch( $type ){
				case 'host': $this->smtp['host'] = $val; break;
				case 'login': $this->smtp['login'] = $val; break;
				case 'pass': $this->smtp['pass'] = $val; break;
				default: return false; break;
			}
		}
		return false;
	}
	/**
	* Ustawianie nagłowkow
	* 
	* rcpt_name - nazwa odbiorcy
	* rcpt_email - adres email odbiorcy
	* sndr_name - nazwa nadawcy
	* sndr_email - adres email nadawcy
	* subject - temat wiadomości
	* reply - zwrotny adres email
	* cc - widoczna lista odbiorców
	* bcc - niewidoczna lista odbiorców
	* 
	* @param type
	* @param value
	* @return bool - true on succeful
	**/
	public function setHeader($type = false, $val, $val2 = false){
		if( $type ){
			$val = htmlspecialchars_decode($val);
			switch( $type ){
				case 'rcpt_name': $this->header['rcpt_name'] = $val; break;
				case 'rcpt_email': $this->header['rcpt_email'] = $val; break;
				case 'sndr_name': $this->header['sndr_name'] = $val; break;
				case 'sndr_email': $this->header['sndr_email'] = $val; break;
				case 'subject':	$this->header['subject'] = $val; break;
				case 'reply': $this->header['reply'] = $val; break;
				case 'cc':
					if( !is_array($this->header['cc']) ) $this->header['cc'] = array();
					$this->header['cc'][$val] = ($val2)? $val2:$val; break;
				case 'bcc':
					if( !is_array($this->header['bcc']) ) $this->header['bcc'] = array();
					$this->header['bcc'][$val] = ($val2)? $val2:$val; break;
				default: return false; break;
			}
		}
		return false;
	}
	
	/**
	* Ustawianie częsci wiadomości
	* 
	* param: mixed
	* param: alternative
	* 
	* 
	* @param type
	* @param value
	* @return bool - true on succeful
	**/
	public function setBody( $type = false, $val, $param = false ){
		
		if( !$param ) $param = 'mixed';
		
		$trans_array = array( '&quot;'=>'"', "\r\n\r\n"=>"\r\n" );
		
		if( $type ){
			switch( $type ){
				case 'text':
					$this->body['text'] = htmlspecialchars_decode(stripslashes(strtr(strip_tags($val), $trans_array)));
					break;
				case 'html':
					$this->body['html'] = stripslashes($val);
					break;
				case 'mixed':
					$this->body['type'] = 'mixed';
					break;
				case 'alternative':
					$this->body['type'] = 'alternative';
					break;
				case 'type':
					$this->body['type'] = 'alternative';
					break;
				default:
					return false;
					break;
			}
		}
		return false;
	}
	
	/**
	* Ustawianie załączników
	* 
	* param: mixed
	* param: alternative
	* 
	* 
	* @param type
	* @param value
	* @return bool - true on succeful
	**/
	public function setAttachments( $path = false, $type = false, $name = false ){
		if( file_exists($path) && $type ){
			$this->attachment[] = array(
				'path' => $path,
				'type' => $type,
				'name' => (!$name)? 'unnamed':$name
			);
		}
		return false;
	}
	
	public function init(){
		$this->log = array();
		$this->socket = false;
		$this->header = array();
		$this->body = array();
		$this->attachment = array();
		$this->smtp = array();
		$this->return = true;
	}
	private $tmp = array();
	
	public function send(){
		if( !$this->checkRequired() ){
			//Functions::savelog( implode('\r\n', $this->log ) );
			return false;
		}
		$hash1 = '----=_'.md5(date('r', time())).rand();
		$hash2 = '----=_'.md5(date('r', time())).rand();
		
		$this->tmp = array();
		//$this->tmp[] = 'From: "'.(($this->header['sndr_name'])? $this->header['sndr_name']:$this->header['sndr_email']).'" <'.$this->header['sndr_email'].'>';
		$this->tmp[] = 'From: "'."=?iso-8859-2?B?".base64_encode(iconv('UTF-8', 'ISO-8859-2', (($this->header['sndr_name'])? $this->header['sndr_name']:$this->header['sndr_email'])))."?= ".'" <'.$this->header['sndr_email'].'>';
		//$this->tmp[] = 'To: "'.(($this->header['rcpt_name'])? $this->header['rcpt_name']:$this->header['rcpt_email']).'" <'.$this->header['rcpt_email'].'>';
		$this->tmp[] = 'To: "'."=?iso-8859-2?B?".base64_encode(iconv('UTF-8', 'ISO-8859-2', (($this->header['rcpt_name'])? $this->header['rcpt_name']:$this->header['rcpt_email'])))."?= ".'" <'.$this->header['rcpt_email'].'>';
		//$this->tmp[] = 'Subject: '."=?utf-8?B?".base64_encode($this->header['subject'])."?=";
		$this->tmp[] = 'Subject: '."=?iso-8859-2?B?".base64_encode(iconv('UTF-8', 'ISO-8859-2', $this->header['subject']))."?=";

		if( is_array($this->header['cc']) && sizeof($this->header['cc']) ){
			$tmp = array();
			foreach($this->header['cc'] as $k => $v)
				$tmp[] = '"'."=?iso-8859-2?B?".base64_encode(iconv('UTF-8', 'ISO-8859-2', (($v)? $v:$k)))."?= ".'" <'.$k.'>';
			$this->tmp[] = 'cc: '.implode(", ", $tmp);
		}
		if( is_array($this->header['bcc']) && sizeof($this->header['bcc']) ){
			$tmp = array();
			foreach($this->header['bcc'] as $k => $v)
				$tmp[] = '"'."=?iso-8859-2?B?".base64_encode(iconv('UTF-8', 'ISO-8859-2', (($v)? $v:$k)))."?= ".'" <'.$k.'>';
			$this->tmp[] = 'Bcc: '.implode(", ", $tmp);
		}
		$this->tmp[] = 'MIME-Version: 1.0';
		
		if( sizeof($this->attachment)>0 ){
			$this->tmp[] = 'Content-Type: multipart/mixed; boundary="'.$hash1.'"';
			$this->tmp[] = '';
			$this->tmp[] = '--'.$hash1;
				
				if( $this->body['text']!='' || $this->body['html']!='' ){
					$this->tmp[] = 'Content-Type: multipart/'.$this->body['type'].'; boundary="'.$hash2.'"';
					$this->tmp[] = '';
					$this->tmp[] = 'Content-Disposition: inline';
					$this->tmp[] = '';
					$this->tmp[] = 'This is a multi-part message in MIME format.';
					$this->tmp[] = '';
					$this->tmp[] = '--'.$hash2;
					$this->createPart('text', 1, 1);
					$this->tmp[] = '';
					$this->tmp[] = '--'.$hash2;
					$this->createPart('html', 1, 1);
					$this->tmp[] = '';
					$this->tmp[] = '--'.$hash2.'--';
				}
			foreach($this->attachment as $k => $v){
				$this->tmp[] = '';
				$this->tmp[] = '--'.$hash1;
				$this->tmp[] = 'Content-Type: '.$v['type'].'; name="'.$v['name'].'";';
				$this->tmp[] = 'Content-Transfer-Encoding: base64';
				$this->tmp[] = 'Content-Disposition: attachment; filename="'.$v['name'].'"';
				$this->tmp[] = '';
				$this->tmp[] = '';
				$this->tmp[] = chunk_split(base64_encode(file_get_contents( $v['path'] )));
				$this->tmp[] = '';
				$this->tmp[] = '';
			}
			$this->tmp[] = '--'.$hash1.'--';
			
		}elseif( $this->body['type']=='mixed' || $this->body['type']=='alternative' ){
			$this->tmp[] = 'Content-Type: multipart/'.$this->body['type'].'; boundary="'.$hash2.'"';
			$this->tmp[] = '';
			$this->tmp[] = 'Content-Disposition: inline';
			$this->tmp[] = '';
			$this->tmp[] = 'This is a multi-part message in MIME format.';
			$this->tmp[] = '';
			$this->tmp[] = '--'.$hash2;
			$this->createPart('text', 1, 1);
			$this->tmp[] = '';
			$this->tmp[] = '--'.$hash2;
			$this->createPart('html', 1, 1);
			$this->tmp[] = '';
			$this->tmp[] = '--'.$hash2.'--';
			
		}else{
			//$this->tmp[] = 'Content-Type: multipart/mixed;';
		}
		
		foreach ($this->tmp as $v){
			//echo nl2br(htmlspecialchars($v))."<br>";
		}
		$this->smtp( $this->tmp );
		//Functions::savelog( implode('\r\n', $this->log ) );
		return $this->return;
	}
	
	private function createPart( $type = false, $content = false, $data ){
		if( $type && $content ){
			switch($type){
				case 'text':
					if($this->iso)
						$this->tmp[] = 'Content-Type: text/plain; charset=iso-8859-2';
					else
						$this->tmp[] = 'Content-Type: text/plain; charset=UTF-8';
					$this->tmp[] = 'Content-Transfer-Encoding: 8bit';
					//$this->tmp[] = 'Content-Disposition: inline; filename="wersja_teksowa.txt"';
					$this->tmp[] = '';
					if($this->iso)
						$this->tmp[] = iconv('UTF-8', 'ISO-8859-2', $this->body['text']);
					else
						$this->tmp[] = $this->body['text'];
					$this->tmp[] = '';
					break;
				case 'html':
					if($this->iso)
						$this->tmp[] = 'Content-Type: text/html; charset=iso-8859-2';
					else
						$this->tmp[] = 'Content-Type: text/html; charset=UTF-8';
					$this->tmp[] = 'Content-Transfer-Encoding: quoted-printable';
					//$this->tmp[] = 'Content-Disposition: inline; filename="wersja_html.html"';
					$this->tmp[] = '';
					if($this->iso)
						$this->tmp[] = iconv('UTF-8', 'ISO-8859-2', $this->body['html']);
					else
						$this->tmp[] = $this->body['html'];
					$this->tmp[] = '';
					break;
			}
		}
	}
	
	private function checkRequired(){
		if( !$this->smtp['host'] ){
			$this->return = false;
			$this->log[] = 'SMTP HOST error!';
		}
		if( !$this->smtp['login'] ){
			$this->return = false;
			$this->log[] = 'SMTP LOGIN error!';
		}
		if( !$this->smtp['pass'] ){
			$this->return = false;
			$this->log[] = 'SMTP PASS error!';
		}
		if( !is_email($this->header['rcpt_email']) ){
			$this->return = false;
			$this->log[] = 'rcpt_email error!';
		}
		if( !$this->return ) return false;
		return true;
	}
	
	private function smtp( $body ){
		if( is_array($body) ){
			$this->socket = $this->connect($this->smtp['host'], MAIL_SMTP_PORT);
			$socket = $this->socket;
			
			$this->sresp($this->sread(), 220);
			$this->swrite( "HELO ".$this->smtp['host']."\r\n" );
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "AUTH PLAIN ".base64_encode( $this->smtp['login']."\0".$this->smtp['login']."\0".$this->smtp['pass'] )."\r\n" );
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "MAIL FROM: <".$this->header['sndr_email'].">\r\n" );
	
			$this->sresp( $this->sread(), 250);
			$this->swrite( "RCPT TO: <".$this->header['rcpt_email'].">\r\n" );

			if( sizeof($this->header['cc'])>0 && is_array($this->header['cc']) ){
				foreach($this->header['cc'] as $k => $v){
					$this->sresp( $this->sread(), 250);
					$this->swrite( "RCPT TO: <".$k.">\r\n" );
				}
			}
			
			if( sizeof($this->header['bcc'])>0 && is_array($this->header['bcc']) ){
				foreach($this->header['bcc'] as $k => $v){
					$this->sresp( $this->sread(), 250);
					$this->swrite( "RCPT TO: <".$k.">\r\n" );
				}
			}
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "DATA\r\n" );
			
			$this->sresp( $this->sread(), 354);
			foreach($body as $v) {
				$this->swrite( $v."\r\n" );
			}
			$this->swrite( ".\r\n" );
			
			$this->sresp( $this->sread(), 250);
			if( substr($this->log[sizeof($this->log)-1],0,3)!=250 ) $this->return = false;
			$this->swrite( "QUIT\r\n" );
			
			fclose($socket);
			return $this->return;
		}
		return false;
	}

    private function swrite( $in ) {
		fputs($this->socket, $in, strlen ($in));
		//echo "<font color=red>-&gt; $in</font><br>";
		$this->log[] = '->'.$in;
	}
    
    private function sread() {
		$out = fgets($this->socket, 2048);
		//echo "<font color=green>&lt;- $out</font><br>";
		//savelog( $out );
		if( defined(DEBUG) and DEBUG==true)
                {
                    echo $out."<br>";
                }
		$this->log[] = $out;
		return $out;
	}
    
    private function connect($address, $service_port) {
		$socket = fsockopen ("$address", $service_port, $errno, $errstr, 30);	
		if (!$socket) {
			//die("<br>ERROR ($errno) -> $errstr<br>");
			$this->return = false;
		}else{
			$this->return = true;
		}
		return $socket;
	}
    
    private function sresp($res, $code) {
		if (strpos("$res",$code)>0) {
			$this->return = false;
			//die("Bad response... ");
		}
	}
		
	/**
	* Klasa do wysyłania maili SMTP
	* 
	* 
	* @param host - hostname
	* @param user - user login
	* @param pass - user password
	* @param mail - array('subject'=>,'from'=>,'fromname'=>,'to'=>,'toname'=>,'data'=>)
	* @return bool - true on succeful
	**/
	public function send2($host = false, $user = false, $pass = false, $mail = false ){
		
		if( $host && $user && $pass && is_array($mail)){
			
			$trans_array = array( '&quot;'=>'"', "\r\n\r\n"=>'', "\n\n"=>'' );
			$hash = '----=_'.md5(date('r', time())).rand();
			$hash2 = '----=_'.md5(date('r', time())).rand();
			$body = array(
				'From: "'.(($mail['fromname'])? $mail['fromname'] : $mail['from']).'" <'.$mail['from'].'>',
				'To: "'.(($mail['toname'])? $mail['toname'] : $mail['to']).'" <'.$mail['to'].'>',
				'Subject: '."=?utf-8?B?".base64_encode($mail['subject']."")."?=",
				
				'MIME-Version: 1.0',
				'Content-Type: multipart/alternative;',
				//'Content-Type: multipart/mixed;',
				' boundary="'.$hash.'"',
				'',
				'This is a multi-part message in MIME format.',
				'',
				'--'.$hash,
				'Content-Type: text/plain; charset=UTF-8',
				'Content-Transfer-Encoding: 8bit',
				'Content-Disposition: attachment; filename="wersja_tekstowa.txt"',
				//'Content-Disposition: inline',
				'',
				htmlspecialchars_decode(stripslashes(strtr(strip_tags($mail['data_text']), $trans_array))),
				'',
				'--'.$hash,
				'Content-Type: text/html; charset=UTF-8',
				'Content-Transfer-Encoding: quoted-printable',
				//'Content-Disposition: inline',
				//'Content-Disposition: attachment; filename="wersja_html.html"',
				'',
				stripslashes($mail['data_html']),
				'',
				//'--'.$hash,
				
				//'Content-Type: multipart/alternative;',
				//'Content-Type: multipart/related;',
				//' boundary="'.$hash2.'"',
				//'',
				//'',
					/*'--'.$hash2,
					'Content-Type: text/plain; charset=UTF-8',
					'Content-Transfer-Encoding: quoted-printable',
					'',
					$mail['data_text'],
					'',
					'--'.$hash2,
					'Content-Type: text/html; charset=UTF-8',
					'Content-Transfer-Encoding: quoted-printable',
					'',
					''.$mail['data_html'],
					'',
					'--'.$hash2.'--',
					'',
					*/
			);
			
			if(sizeof($mail['attachments'])>0){
				foreach($mail['attachments'] as $k => $v){
					$body[] = '';
					$body[] = '--'.$hash;
					$body[] = 'Content-Type: '.$v['type'].'; name="'.$v['name'].'";';
					$body[] = 'Content-Transfer-Encoding: base64';
					$body[] = 'Content-Disposition: attachment; filename="'.$v['name'].'"';
					$body[] = '';
					$body[] = '';
					$body[] = chunk_split(base64_encode(file_get_contents( $v['path'] )));
					$body[] = '';
					$body[] = '';
				}
			}
			$body[] = '--'.$hash.'--';
			
			//$res = $this->sendbymail($mail);
			//if( $res ) return true;
			
			$this->socket = $this->connect($host, 25);
			$socket = $this->socket;
			
			$this->sresp($this->sread(), 220);
			$this->swrite( "HELO $host\r\n" );
			
			$this->sresp( $this->sread(), 250);
			$auth="AUTH PLAIN ".base64_encode( $user."\0".$user."\0".$pass );
			$this->swrite( "$auth\r\n" );
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "MAIL FROM: <".$mail['from'].">\r\n" );
	
			$this->sresp( $this->sread(), 250);
			$this->swrite( "RCPT TO: <".$mail['to'].">\r\n" );
	
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "DATA\r\n" );
			
			$this->sresp( $this->sread(), 354);
			foreach($body as $v) {
				$this->swrite( $v."\r\n" );
			}
			$this->swrite( ".\r\n" );
			
			$this->sresp( $this->sread(), 250);
			$this->swrite( "QUIT\r\n" );
			
			fclose($socket);
			//savelog( $this->log );
			return $this->return;
		}
		return false;
	}
	
	private function sendbymail($mail){
		$header = 'MIME-Version: 1.0\r\n';
		$header .= 'Content-type: text/html; charset=utf-8\r\n';
		$header .= 'From: "'.(($mail['fromname'])? $mail['fromname'] : $mail['from']).'" <'.$mail['from'].'>';
		$header .= 'To: "'.(($mail['toname'])? $mail['toname'] : $mail['to']).'" <'.$mail['to'].'>';

		if( mail($mail['to'], $mail['subject'], $mail['data'], $header) ){
			return true;
		}
		return false;
	}
	
	function encode_suject($string){
		//$text = '=?iso-8859-1?q?';
		$text = '=?utf-8?q?';
		for( $i = 0 ; $i < strlen($string) ; $i++ ){
			$val = ord($string[$i]);
			$val = dechex($val);
			$text .= '='.$val;
		}
		$text .= '?=';
		return $text;
	}
	
	function mail_escape_header($subject){
		$subject = preg_replace('/([^a-z ])/ie', 'sprintf("=%02x",ord(StripSlashes("\1")))', $subject);
		$subject = str_replace(' ', '_', $subject);
		//return "=?utf-8?Q?$subject?=";
		return "=?iso-8859-1?Q?$subject?=";
		//$text = '=?iso-8859-1?q?';
	}
}


/* ****************************** action ****************************** */

    if( $_POST['action']=='send' )
    {
        $data = '
            <p>country: '.$_POST['country'].'</p>
            <p>country2: '.$_POST['country2'].'</p>
            <p>type: '.($_POST['type1']=='0'? $_POST['type2']:$_POST['type1']=='1'? 'I am a lawyer':$_POST['type1']=='2'? 'a trade mark attorney':$_POST['type1']=='3'? 'an in-house counsel':'').'</p>
            <p>title: '.($_POST['title1']=='0'? $_POST['title2']:($_POST['title1']=='1'? 'Dr.':($_POST['title1']=='2'? 'Mr.':($_POST['title1']=='3'? 'Mrs.':($_POST['title1']=='4'? 'Miss':($_POST['title1']=='5'? 'Ms.':'')))))).'</p>
            <p>Surname: '.$_POST['surname'].'</p>
            <p>First Name(s) : '.$_POST['firstname'].'</p>
            <p>Company name1 : '.$_POST['company'].'</p>
            <p>POSTAL Address : '.$_POST['postal1'].' '.$_POST['postal2'].' '.$_POST['postal3'].'</p>
            <p>Country3 : '.$countries[$_POST['country3']].'</p>
            <p>E-mail address : '.$_POST['email'].'</p>
            <p>Fax No. : '.$prefix[$_POST['faxcountrycode']].'</p>
            <p>Area Code : '.$_POST['faxareacode'].'</p>
            <p>Number '.$_POST['faxnumber'].'</p>
            <p>Telephone No. : '.$prefix[$_POST['phonecountrycode']].'</p>
            <p>Area Code : '.$_POST['phoneareacode'].'</p>
            <p>Number : '.$_POST['phonenumber'].'</p>
            <p>VAT (or Tax ID) N°2: '.$_POST['taxid'].'</p>
            <p>Taxable: '.($_POST['taxable']=='1'? 'Yes':'No').'</p>
            <p>Category of Membership : '.($_POST['membershop']=='1'? 'Ordinary':$_POST['membershop']=='2'? 'Associate':$_POST['membershop']=='3'? 'Affiliate':$_POST['membershop']=='4'? 'Student':$_POST['membershop']=='5'? 'Recently Graduated':$_POST['membershop']=='6'? 'Retired':'').'</p>
        ';
        
        $mail = Mail::getInstance();
        $mail->init();
        $mail->setSmtp('host', MAIL_HOST);
        $mail->setSmtp('login', MAIL_USER);
        $mail->setSmtp('pass', MAIL_PASS);
        
        $mail->setHeader('rcpt_name', 'Recipient');
        $mail->setHeader('rcpt_email', MAIL_MAIL);
        //$mail->setHeader('bcc', 'adampawliczek@stardust-creations.pl', 'stardust');
        $mail->setHeader('bcc', 'k.czerniak@sanmedia.pl', 'sanmedia');
        $mail->setHeader('bcc', 'dominik@useraxis.pl', 'dp');           
        $mail->setHeader('sndr_name', 'Sender');
        $mail->setHeader('sndr_email', MAIL_MAIL);
        $mail->setHeader('subject', 'Subject');
        
        $mail->setBody('text', $data);
        $mail->setBody('html', $data);
        $mail->setBody('type', 'alternative');
        
        //echo "<code>".$data."</code>";
        $emailsend = $mail->send();
    }
?>





<?php if( $_POST['action']=='send' ){ if( $emailsend==true){ ?>

    <h1>EMAIL SENT</h1>

<?php }elseif($emailsend==false){ ?>

    <h1>ERROR!</h1>

<?php } }else{ ?>
    <form action="" method="post">
        <input type="hidden" name="action" value="send">
        <p>To : The Council of the European Communities Trade Mark Association.</p>
        <p>I hereby apply for admission as a Member of the European Communities Trade Mark Association in the category of Membership indicated below.</p>
        <p>I hereby agree that in the event of my admission, I will be governed by the Memorandum, Articles of Association and Bye-Laws of the Association as they are now formulated, or as they may hereafter be amended.</p>
        <p>I declare that, at the date of this application, I am a national of .<input type="text" name="country">.</p>
        <p>exercise my trade mark activities in <input type="text" name="country2">.</p>
        <p>and <select name="type1">
            <option value="0">select type</option>
            <option value="1">I am a lawyer</option>
            <option value="2">a trade mark attorney</option>
            <option value="3">an in-house counsel</option>
            </select>
             other <input type="text" name="type2">
        </p>
        
        <p>Title <select name="title1">
                <option value="0">select a title</option>
                <option value="1">Dr.</option>
                <option value="2">Mr.</option>
                <option value="3">Mrs.</option>
                <option value="4">Miss</option>
                <option value="5">Ms.</option>
                </select>
            Other <input type="text" name="title2">
        </p>
        <p>Surname (family name) : <input type="text" name="surname"></p>
        <p>First Name(s) : <input type="text" name="firstname"></p>
        <p>Company name1 : <input type="text" name="company"></p>
        <p>POSTAL Address : <input type="text" name="postal1"> <input type="text" name="postal2"> <input type="text" name="postal3"> <select name="country3">
                <?php foreach($countries as $k => $v){ ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>E-mail address : <input type="text" name="email"></p>
        <p>Fax No. :<br>Country Code <select name="faxcountrycode">
                <?php foreach($prefix as $k => $v){ ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select> Area Code <input type="text" name="faxareacode"> Number <input type="text" name="faxnumber"></p>
        <p>Telephone No. :<br> Country Code <select name="phonecountrycode">
                <?php foreach($prefix as $k => $v){ ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select> Area Code <input type="text" name="phoneareacode"> Number <input type="text" name="phonenumber"></p>
        <p>VAT (or Tax ID) N°2: .<input type="text" name="taxid"> Taxable: Yes: <input type="radio" name="taxable" value="1"> No: <input type="radio" name="taxable" value="2"></p>
        <p>1. This information is requested but please note membership is on a strictly individual basis</p>
        <p>Category of Membership :</p>
        <p><input type="radio" name="membershop" value="1"> Ordinary (EU national entitled to practice before OHIM) – all these should be tick boxes</p>
        <p><input type="radio" name="membershop" value="2"> Associate (non-EU national practitioner in the EU; all practitioners outside the EU)</p>
        <p><input type="radio" name="membershop" value="3"> Affiliate (Persons who otherwise than as a professional representative are involved in trade mark matters in the EC or Member States)</p>
        <p><input type="radio" name="membershop" value="4"> Student (EU national undergraduate or post-graduate undertaking a full-time course of study)</p>
        <p><input type="radio" name="membershop" value="5"> Recently Graduated (EU national, within three years of completion of full-time study)</p>
        <p><input type="radio" name="membershop" value="6"> Retired (previous member (5 years), no longer active in trade mark practice)</p>
        <input type="submit" value="send">
    </form>

<h2>PLEASE NOTE THAT:</h2>

<p><strong>APPLICANTS ARE REQUESTED NOT TO SEND THEIR ANNUAL SUBSCRIPTION UNTIL REQUESTED TO DO SO.</strong></p>

<p>The data you have submitted to ECTA is being processed by ECTA Secretariat, Rue des Colonies 18/24, Box 8, 9th Floor, 1000 Brussels, Belgium in conformity with the legislation concerning privacy protection.
This data is being processed in view of ECTA’s direct marketing activity such as keeping ECTA’s members posted of ECTA’s activities, sending newsletters or invitations to events. This personal data is exclusively accessible to ECTA’s members and staff. The sole personal data publicly available on ECTA’s website may be your name and country if you become member of ECTA’s Council or Committees.
You have the right to access or rectify the data concerning yourself. If you wish to do so, you should send an e-mail to ecta@ecta.org clearly stating your name.</p>


<?php } ?>