<?php if(!defined('_lib')) die("Error");

	error_reporting(0); 
	$config_url=$_SERVER["SERVER_NAME"].'';

	$config['database']['servername'] = 'localhost';



	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'webkaraoke'; 

	$config['database']['refix'] = 'table_';
	$_SESSION['ckfinder_baseUrl']=$config_url;

	
	$ip_host = 'smtp.gmail.com';
	$mail_host = 'longdvpd05236@fpt.edu.vn';
	$pass_mail = 'ilnpnwptoivyqjiu';
	$config['mail_port'] = 587; 
	

	$config['lang']=array(''=>'Tiếng Việt');
	$config['phi']=0;
	$config['login']['attempt'] = 5;
	$config['login']['delay'] =10; 

	$config['sitekey'] = '6LctK40gAAAAAOxtDXCLwZgrB26WK6rvwV7qkp8Z';
	$config['secretkey'] = '6LctK40gAAAAABqttj3NpW_enRfhJvJqEXyQyoTc';

	$config['secret'] = 'q!#ObcUPBW&v5a1';
	$config['salt'] = 'q6b&cUPBWvE!@';

	date_default_timezone_set('Asia/Ho_Chi_Minh');

