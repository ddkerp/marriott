<?php
use \Slim\Http\Response as Response;
use \Slim\Http\Request as Request;
use \Slim\Container as Container;
$config = include(__DIR__ . '/config/local.php');
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$response = new Response();
session_start();
function dbconn ($config) {
    $db = $config['settings']['db'];
    $pdo = new PDO("mysql:host=" . "localhost" . ";dbname=marriou2_marriott;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
function generateCSRFToken (){
	 if (function_exists('mcrypt_create_iv')) {
        $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
       $token = bin2hex(openssl_random_pseudo_bytes(32));
    }
	return $token;
}
function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}
$db = dbconn($config);
function checkValidToken($CSRFToken,$db){
	$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
	$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
	$sth->execute();
	//$student = $sth->fetch(PDO::FETCH_ASSOC);
	return $session_id = $sth->fetchColumn();
}
if (!function_exists('getallheaders')){ 
    function getallheaders() { 
       $headers = ''; 
       foreach ($_SERVER as $name => $value) { 
            if (substr($name, 0, 5) == 'HTTP_') { 
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
            } 
       } 
       return $headers; 
    } 
}
$app->get('/', function() use($app,$response) {
    //$app->response->setStatus(200);
	//$response =new \Slim\Http\Response();
       $response->setStatus(400);
		echo "Welcome to Slim 2.0 based API";
}); 
$app->post('/uploadimg', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	
	if(ISSET($_FILES['groom_pimage'])){
		$gbimage = 'groom_pimage';
		$pimage = $_FILES[$gbimage];
	}elseif(ISSET($_FILES['bride_pimage'])){
		$gbimage = 'bride_pimage';
		$pimage = $_FILES[$gbimage];
	}
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		$newToken = false;
		if(empty($pimage)){
			throw new PDOException("File is empty.");
		}
		$sendToken = false;
		if(empty($CSRFToken)){
			$CSRFToken = generateCSRFToken();
			$sendToken = true;
			$newToken = true;
		}else{
			$session_id = checkValidToken($CSRFToken,$db);
			if($session_id == ""){
				throw new PDOException("Token is invalid");
			}
		}
		
		foreach($_FILES as $file){
			if(empty($file)){
				throw new PDOException("File is empty");
			}
			//1048576 = 1M
			$allowed_iange_size = 1048576*2;
			if($file['size'] > $allowed_iange_size){
				throw new PDOException("File size is bigger than the allowed size");
			}
			$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
			if(!in_array($file['type'],$allowed_image_types)){
				throw new PDOException("Not valid ext");
			}
			if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
				throw new PDOException("Not an Image");
			}
			if ($file['error'] != 0 ) {
				throw new PDOException("Upload error");
			}
			
			$userDirName = substr($CSRFToken,-8);
			if (!file_exists("upload/".$userDirName)) {
 				if (!mkdir("upload/".$userDirName, 0777, true)) {
					throw new PDOException("Cannot create dir");
				}
			}
			$fileinfo = pathinfo($file['name']);
			$fileext = $fileinfo['extension'];
			$uploadedfilepath = "upload/".$userDirName."/".mt_rand().".".$fileext;
			if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
                
            }else{
				throw new PDOException("File move error!");
			}
			
			//$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
			//$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			//$sth->execute();
			//$session_id = $sth->fetchColumn();
			
			//echo $session_id;exit;
			if($newToken == false){
				$sth = $db->prepare("UPDATE planner SET ".$gbimage." = :".$gbimage."  WHERE session_id = :session_id");
				$sth->bindParam(':'.$gbimage.'', $uploadedfilepath, PDO::PARAM_STR);
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
			}else{
				$sth = $db->prepare("INSERT INTO planner (".$gbimage.",session_id,ip_address) values (:".$gbimage.",:session_id,:ip_address)");
				$sth->bindParam(':'.$gbimage.'', $uploadedfilepath, PDO::PARAM_STR);
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
				$sth->execute();
			}
			$response->setStatus(200);
			$response->headers->set('Content-Type', 'application/json');
			$data = array("image_path"=>$uploadedfilepath);
			$dataAry = array("success"=>array("msg"=>"Uploaded successfully"),"data"=>$data);
			if($sendToken){
				$dataAry["CSRFToken"] = $CSRFToken;
			}
			return $response->body(json_encode($dataAry));
		}
	} catch(PDOException $e) {
	//}catch (\Exception $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/profile', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id,groom_name,bride_name,groom_pimage,bride_pimage,event_date FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$result);
		return $response->body(json_encode($dataAry));
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/profile', function()use($app,$db)  {
	//$db = $c['db'];
	//$sth = $db->prepare("SELECT * FROM venue  WHERE id = :id");
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	$event_date = $request->params('event_date');
	try 
    {
		$newToken = false;
		if(empty($bride_name)){
			throw new PDOException("Bride Name is empty");
		}
		if(empty($groom_name)){
			throw new PDOException("Groom Name is empty");
		}
		if(empty($event_date)){
			throw new PDOException("Event date is empty");
		}
		$sendToken = false;
		if(empty($CSRFToken)){
			$CSRFToken = generateCSRFToken();
			$sendToken = true;
			$newToken = true;
		}else{
			$session_id = checkValidToken($CSRFToken,$db);
			if($session_id == ""){
				throw new PDOException("Token is invalid");
			}
		}
		//$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		//$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		//$sth->execute();
		//$session_id = $sth->fetchColumn();
		if($newToken == false){
			$sth = $db->prepare("UPDATE planner SET bride_name = :bride_name, groom_name = :groom_name, event_date = :event_date WHERE session_id = :session_id");
			$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
			$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
			$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			$sth = $db->prepare("INSERT INTO planner (bride_name,groom_name,event_date,session_id,ip_address) values (:bride_name,:groom_name,:event_date,:session_id,:ip_address)");
			$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
			$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
			$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
			$sth->execute();
		}
		
		$sth = $db->prepare("SELECT url FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$planurl = $sth->fetchColumn();
		
		if($planurl == ""){
			$planurl = substr($bride_name,0,4)."".substr($groom_name,0,4)."".str_replace("-","",$event_date);
			$sth = $db->prepare("SELECT id FROM planner WHERE url = :url");
			$sth->bindParam(':url', $planurl, PDO::PARAM_STR);
			$sth->execute();
			$planid = $sth->fetchColumn();
			if($planid != ""){
				$planurl = $planurl."_".rand();
			}
			$sth = $db->prepare("UPDATE planner SET url = :url WHERE session_id = :session_id");
			$sth->bindParam(':url', $planurl, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}
		$sth = $db->prepare("SELECT bride_name,groom_name,event_date,groom_pimage,bride_pimage,url FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Saved successfully"));	
		$dataAry['data'] = $result;
		if($sendToken){
			$dataAry["CSRFToken"] = $CSRFToken;
		}
		return $response->body(json_encode($dataAry));
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/createplanurl', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT url FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$result);
		return $response->body(json_encode($dataAry));
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/createplanurl', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	//$CSRFToken = $request->params('CSRFToken');
	$planurl = $request->params('planurl');
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		if(empty($planurl)){
			throw new PDOException("Empty Url");
		}
		//check if it is valid
		if(!preg_match('/^[A-Za-z0-9_-]+$/',$planurl)) {
			throw new PDOException("Url is not valid");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		//check if already exist
		$sth = $db->prepare("SELECT id FROM planner WHERE url = :url and session_id != :session_id");
		$sth->bindParam(':url', $planurl, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$planid = $sth->fetchColumn();
		if($planid != ""){
			throw new PDOException("Url already exist. Please create new one");
		}
		$sth = $db->prepare("UPDATE planner SET url = :url WHERE session_id = :session_id");
		$sth->bindParam(':url', $planurl, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$data = array("url"=>$planurl);
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Saved successfully"),"data"=>$data);	
		return $response->body(json_encode($dataAry));
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/template', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT template_order FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchColumn();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
		$data = array("template_order"=>$result);
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/template', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$templates = $request->params('templates');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		if(empty($templates)){
			throw new PDOException("Template is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$arrayTemplates = explode(",",$templates);
		if(array_diff_key( $arrayTemplates , array_unique( $arrayTemplates ) )){
			throw new PDOException("Template have duplicates");
		}
		if(count($arrayTemplates) <=6 && count($arrayTemplates) >=1){
			foreach($arrayTemplates as $template){
				if(!is_numeric($template) || $template>6 || $template<=0){
					throw new PDOException("Template is invalid");
				}
			}
		}else{
			throw new PDOException("Template is invalid");
		}
		$sth = $db->prepare("UPDATE planner SET template_order = :template_order WHERE session_id = :session_id");
		$sth->bindParam(':template_order', $templates, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$data = array("template_order"=>$templates);
		$dataAry = array("success"=>array("msg"=>"Template order saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->post('/headerimage', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(ISSET($_FILES['header_image']['tmp_name'])){
			if(file_exists($_FILES['header_image']['tmp_name']) || is_uploaded_file($_FILES['header_image']['tmp_name'])) {
				$file =$_FILES['header_image'];
			}
		}else{
			throw new PDOException("Image not selected");
		}
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		if(!empty($file)){
			//1048576 = 1M
			$allowed_iange_size = 1048576*2;
			if($file['size'] > $allowed_iange_size){
				throw new PDOException("File size is bigger than the allowed size");
			}
			$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
			if(!in_array($file['type'],$allowed_image_types)){
				throw new PDOException("Not valid ext");
			}
			if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
				throw new PDOException("Not an Image");
			}
			if ($file['error'] != 0 ) {
				throw new PDOException("Upload error");
			}
			
			$userDirName = substr($CSRFToken,-8);
			if (!file_exists("upload/".$userDirName)) {
 				if (!mkdir("upload/".$userDirName, 0777, true)) {
					throw new PDOException("Cannot create dir");
				}
			}
			$fileinfo = pathinfo($file['name']);
			$fileext = $fileinfo['extension'];
			$uploadedfilepath = "upload/".$userDirName."/header_".mt_rand().".".$fileext;
			if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
                
            }else{
				throw new PDOException("File move error!");
			}
			
			
		}
		$sth = $db->prepare("UPDATE planner SET header_image = :header_image WHERE session_id = :session_id");
		$sth->bindParam(':header_image', $uploadedfilepath, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
			
		$sth = $db->prepare("SELECT header_image FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$data = $sth->fetch();
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Header image saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/headers', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT event_date,bride_name,groom_name,header_image FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
		$data = $result;
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/headers', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$event_date = $request->params('event_date');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		if(empty($event_date)){
			throw new PDOException("Event Date is empty");
		}
		if(empty($groom_name)){
			throw new PDOException("Groom Name is empty");
		}
		if(empty($bride_name)){
			throw new PDOException("Bride Name is empty");
		}
		if(!validateDate($event_date)){
			throw new PDOException("Invalid date");
		}
		$sth = $db->prepare("UPDATE planner SET event_date = :event_date, bride_name = :bride_name, groom_name = :groom_name WHERE session_id = :session_id");
		$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
		$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
		$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
			
		$sth = $db->prepare("SELECT bride_name,groom_name,event_date FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		$data = $result;
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Header saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/bridegroom', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT bride_description,groom_description,bride_name,groom_name,groom_pimage,bride_pimage,bride_twitter_link,bride_fb_link,bride_insta_link,groom_twitter_link,groom_fb_link,groom_insta_link FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
		$data = $result;
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/bridegroom', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$bride_desc = $request->params('bride_desc');
	$groom_desc = $request->params('groom_desc');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	$bride_twitter_link = $request->params('bride_twitter_link');
	$bride_fb_link = $request->params('bride_fb_link');
	$bride_insta_link = $request->params('bride_insta_link');
	$groom_twitter_link = $request->params('groom_twitter_link');
	$groom_fb_link = $request->params('groom_fb_link');
	$groom_insta_link = $request->params('groom_insta_link');
	
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		if(empty($groom_name)){
			throw new PDOException("Groom Name is empty");
		}
		if(empty($bride_name)){
			throw new PDOException("Bride Name is empty");
		}
		if(empty($bride_desc)){
			throw new PDOException("Bride Description is empty");
		}
		if(empty($groom_desc)){
			throw new PDOException("Groom Description is empty");
		}
		$sth = $db->prepare("UPDATE planner SET bride_description = :bride_description, groom_description = :groom_description, bride_name = :bride_name, groom_name = :groom_name, bride_twitter_link = :bride_twitter_link, bride_fb_link = :bride_fb_link, bride_insta_link = :bride_insta_link, groom_twitter_link = :groom_twitter_link, groom_fb_link = :groom_fb_link, groom_insta_link = :groom_insta_link WHERE session_id = :session_id");
		$sth->bindParam(':bride_description', $bride_desc, PDO::PARAM_STR);
		$sth->bindParam(':groom_description', $groom_desc, PDO::PARAM_STR);
		$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
		$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
		$sth->bindParam(':bride_twitter_link', $bride_twitter_link, PDO::PARAM_STR);
		$sth->bindParam(':bride_fb_link', $bride_fb_link, PDO::PARAM_STR);
		$sth->bindParam(':bride_insta_link', $bride_insta_link, PDO::PARAM_STR);
		$sth->bindParam(':groom_twitter_link', $groom_twitter_link, PDO::PARAM_STR);
		$sth->bindParam(':groom_fb_link', $groom_fb_link, PDO::PARAM_STR);
		$sth->bindParam(':groom_insta_link', $groom_insta_link, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		
		$sth = $db->prepare("SELECT bride_description,groom_description,bride_name,groom_name,groom_pimage,bride_pimage,bride_twitter_link,bride_fb_link,bride_insta_link,groom_twitter_link,groom_fb_link,groom_insta_link FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$data = $sth->fetch();
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Header saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->post('/bridalparty', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$group = $request->params();
	$CSRFToken = $request->headers('CSRFToken');
	
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$group_name = "guest";
		$file_name = "guest_image";
		if(!ISSET($group[$group_name])){
			throw new PDOException("Guest data is required");
		}
		if(is_array($group[$group_name]) && count($group[$group_name])>0){
			foreach($group[$group_name] as $key=>$value){
			
				if(empty($value['guest_name'])){
					throw new PDOException("Guest Name is empty for index - ".$key);
				}
				if(empty($value['relation'])){
					throw new PDOException("Guest Relation is empty for index - ".$key);
				}
				//if($_FILES[$file_name]["name"][$key] != ""){
					
					if(ISSET($_FILES[$file_name]['tmp_name'][$key])){
						if(file_exists($_FILES[$file_name]['tmp_name'][$key]) || is_uploaded_file($_FILES[$file_name]['tmp_name'][$key])) {
							//$file =$_FILES['header_image'];
						}
					}else{
						throw new PDOException("Image not selected for index - ".$key);
					}
		
					$file['name'] = $_FILES[$file_name]["name"][$key];
					$file['type'] = $_FILES[$file_name]["type"][$key];
					$file['tmp_name'] = $_FILES[$file_name]["tmp_name"][$key];
					$file['error'] = $_FILES[$file_name]["error"][$key];
					$file['size'] = $_FILES[$file_name]["size"][$key];
					//1048576 = 1M
					$allowed_iange_size = 1048576*2;
					if($file['size'] > $allowed_iange_size){
						throw new PDOException($file['name']. " - File size is bigger than the allowed size");
					}
					$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
					if(!in_array($file['type'],$allowed_image_types)){
						throw new PDOException($file['name']." - Not valid ext");
					}
					if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
						throw new PDOException($file['name']." - Not an Image");
					}
					if ($file['error'] != 0 ) {
						throw new PDOException($file['name']." - Upload error");
					}
					
					$userDirName = substr($CSRFToken,-8);
					$guestDirName = "upload/".$userDirName."/guest";
					if (!file_exists($guestDirName)) {
						if (!mkdir($guestDirName, 0777, true)) {
							throw new PDOException("Cannot create dir");
						}
					}
					$fileinfo = pathinfo($file['name']);
					$fileext = $fileinfo['extension'];
					$uploadedfilepath = $guestDirName."/".mt_rand().".".$fileext;
					if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
						
					}else{
						throw new PDOException("File move error!");
					}
				//}
				
				$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
				$planner_id = $sth->fetchColumn();
				$id  = ISSET($value['guest_id'])?$value['guest_id']:null;
				//echo $session_id;exit;
				if($id != ""){
					$sth = $db->prepare("UPDATE planner_guest SET guest_name = :guest_name, guest_relation = :guest_relation, guest_image = :guest_image WHERE id = :id and planner_id = :planner_id");
					$sth->bindParam(':guest_name', $value['guest_name'], PDO::PARAM_STR);
					$sth->bindParam(':guest_relation', $value['relation'], PDO::PARAM_STR);
					$sth->bindParam(':guest_image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':id', $id, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $id;
				}else{
					$sth = $db->prepare("INSERT INTO planner_guest (planner_id,guest_name,guest_relation,guest_image) values (:planner_id,:guest_name,:guest_relation,:guest_image)");
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':guest_relation', $value['relation'], PDO::PARAM_STR);
					$sth->bindParam(':guest_name', $value['guest_name'], PDO::PARAM_STR);
					$sth->bindParam(':guest_image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $db->lastInsertId(); 
				}
			
			}
		}else{
			throw new PDOException("Atleast one guest data is required");
		}
		
			
		$ids = implode(",",$ids);
		
			
		$sth = $db->prepare("SELECT guest_image,guest_name,guest_relation,id as guest_id FROM planner_guest WHERE id in ($ids) and planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		//$sth->bindParam(':id', $ids, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data = $result;
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Guest saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/bridalparty', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchColumn();
		if(empty($result)){
			throw new PDOException("Token is not valid");
		}
		$sth = $db->prepare("SELECT guest_name,guest_image,guest_relation,id as guest_id FROM planner_guest WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $result, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
	
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		return $response->body(json_encode($dataAry));
	
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->delete('/gallery', function()use($app,$db)  {
	
	$response = $app->response;
	$request = $app->request;
	//$group = $request->params();
	$CSRFToken = $request->headers('CSRFToken');
	$image_id = $request->params('image_id');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		
		if(empty($image_id)){
			throw new PDOException("ID is empty");
		}
		
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		
		$sth = $db->prepare("SELECT pg.* FROM planner p join planner_gallery pg on (p.id = pg.planner_id) WHERE pg.id = :image_id and p.session_id = :session_id");
		$sth->bindParam(':image_id', $image_id, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $session_id, PDO::PARAM_STR);
		$sth->execute();
		$gallery = $sth->fetch();
		
		if($gallery["id"] == ""){
			throw new PDOException("ID is invalid");
		}
		
		$userDirName = substr($session_id,-8);
		$uploadedfilepath = $gallery["image"];
		if($uploadedfilepath !=""){
			if (file_exists($uploadedfilepath)) {
				if (!unlink($uploadedfilepath)) {
					throw new PDOException("Cannot delete the file");
				}
			}
		}
	
		$sth = $db->prepare("DELETE FROM planner_gallery WHERE id = :image_id");
		$sth->bindParam(':image_id', $gallery["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Image Deleted"));
		return $response->body(json_encode($dataAry));
		
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->post('/gallery', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$group = $request->params();
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$group_name = "gallery";
		$file_name = "gallery_image";
		if(!ISSET($group[$group_name])){
			throw new PDOException("Image data is required");
		}
		if(is_array($group[$group_name]) && count($group[$group_name])>0){
			foreach($group[$group_name] as $key=>$value){
			
				if(empty($value['image_title'])){
					throw new PDOException("Image Title is empty for index - ".$key);
				}
				if(empty($value['image_description'])){
					throw new PDOException("Image Desc is empty for Index - ".$key);
				}
					
					if(ISSET($value['image_id'])){
						//old images
							//$uploadedfilepath = $value['image'];
					}else{
						// new images
						if(ISSET($_FILES[$file_name]['tmp_name'][$key])){
							if(file_exists($_FILES[$file_name]['tmp_name'][$key]) || is_uploaded_file($_FILES[$file_name]['tmp_name'][$key])) {
								//$file =$_FILES['header_image'];
								$file['name'] = $_FILES[$file_name]["name"][$key];
								$file['type'] = $_FILES[$file_name]["type"][$key];
								$file['tmp_name'] = $_FILES[$file_name]["tmp_name"][$key];
								$file['error'] = $_FILES[$file_name]["error"][$key];
								$file['size'] = $_FILES[$file_name]["size"][$key];
								//1048576 = 1M
								$allowed_iange_size = 1048576*2;
								if($file['size'] > $allowed_iange_size){
									throw new PDOException($file['name']. " - File size is bigger than the allowed size");
								}
								$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
								if(!in_array($file['type'],$allowed_image_types)){
									throw new PDOException($file['name']." - Not valid ext");
								}
								if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
									throw new PDOException($file['name']." - Not an Image");
								}
								if ($file['error'] != 0 ) {
									throw new PDOException($file['name']." - Upload error");
								}
								
								$userDirName = substr($CSRFToken,-8);
								$groupDirName = "upload/".$userDirName."/gallery";
								if (!file_exists($groupDirName)) {
									if (!mkdir($groupDirName, 0777, true)) {
										throw new PDOException("Cannot create dir");
									}
								}
								$fileinfo = pathinfo($file['name']);
								$fileext = $fileinfo['extension'];
								$uploadedfilepath = $groupDirName."/".mt_rand().".".$fileext;
								if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
									
								}else{
									throw new PDOException("File move error!");
								}
							}
						}else{
								throw new PDOException("Image not selected for index - ".$key);
						}
					}
					
					
				
				
				$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
				$planner_id = $sth->fetchColumn();
				$id  = ISSET($value['image_id'])?$value['image_id']:null;
				if($id != ""){
					$sth = $db->prepare("UPDATE planner_gallery SET image_title = :image_title, image_description = :image_description, image = IFNULL(:image, image) WHERE id = :id and planner_id = :planner_id");
					$sth->bindParam(':image_title', $value['image_title'], PDO::PARAM_STR);
					$sth->bindParam(':image_description', $value['image_description'], PDO::PARAM_STR);
					$sth->bindParam(':image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':id', $id, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $id;
				}else{
					$sth = $db->prepare("INSERT INTO planner_gallery (planner_id,image_title,image_description,image) values (:planner_id,:image_title,:image_description,:image)");
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':image_title', $value['image_title'], PDO::PARAM_STR);
					$sth->bindParam(':image_description', $value['image_description'], PDO::PARAM_STR);
					$sth->bindParam(':image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $db->lastInsertId(); 
				}
			
			}
		}else{
			throw new PDOException("Atleast one Image data is required");
		}
		
			
		$ids = implode(",",$ids);
		
			
		$sth = $db->prepare("SELECT image_title,image_description,image,id as image_id FROM planner_gallery WHERE id in ($ids) and planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data = $result;
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Image saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/gallery', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchColumn();
		if(empty($result)){
			throw new PDOException("Token is not valid");
		}
		$sth = $db->prepare("SELECT image_title,image_description,image,id as image_id FROM planner_gallery WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $result, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		if(empty($result)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$data = $result;
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
	
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		return $response->body(json_encode($dataAry));
	
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/story', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$group = $request->params();
	$story_intro = $request->params('story_intro');
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$group_name = "story";
		$file_name = "story_image";
		if(!ISSET($group[$group_name])){
			throw new PDOException("Story data is required");
		}
		if(is_array($group[$group_name]) && count($group[$group_name])>0){
			foreach($group[$group_name] as $key=>$value){
			
				if(empty($value['title'])){
					throw new PDOException("Image Title is empty for index - ".$key);
				}
				if(empty($value['description'])){
					throw new PDOException("Image Desc is empty for Index - ".$key);
				}
				if(empty($value['date'])){
					throw new PDOException("Date is empty for Index - ".$key);
				}
					if(ISSET($_FILES[$file_name]['tmp_name'][$key])){
						if(file_exists($_FILES[$file_name]['tmp_name'][$key]) || is_uploaded_file($_FILES[$file_name]['tmp_name'][$key])) {
						}
					}else{
						throw new PDOException("Image not selected for index - ".$key);
					}
					$file['name'] = $_FILES[$file_name]["name"][$key];
					$file['type'] = $_FILES[$file_name]["type"][$key];
					$file['tmp_name'] = $_FILES[$file_name]["tmp_name"][$key];
					$file['error'] = $_FILES[$file_name]["error"][$key];
					$file['size'] = $_FILES[$file_name]["size"][$key];
					//1048576 = 1M
					$allowed_iange_size = 1048576*2;
					if($file['size'] > $allowed_iange_size){
						throw new PDOException($file['name']. " - File size is bigger than the allowed size");
					}
					$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
					if(!in_array($file['type'],$allowed_image_types)){
						throw new PDOException($file['name']." - Not valid ext");
					}
					if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
						throw new PDOException($file['name']." - Not an Image");
					}
					if ($file['error'] != 0 ) {
						throw new PDOException($file['name']." - Upload error");
					}
					
					$userDirName = substr($CSRFToken,-8);
					$groupDirName = "upload/".$userDirName."/story";
					if (!file_exists($groupDirName)) {
						if (!mkdir($groupDirName, 0777, true)) {
							throw new PDOException("Cannot create dir");
						}
					}
					$fileinfo = pathinfo($file['name']);
					$fileext = $fileinfo['extension'];
					$uploadedfilepath = $groupDirName."/".mt_rand().".".$fileext;
					if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
						
					}else{
						throw new PDOException("File move error!");
					}
				
				
				$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
				$planner_id = $sth->fetchColumn();
				$id  = ISSET($value['story_id'])?$value['story_id']:null;
				if($id != ""){
					$sth = $db->prepare("UPDATE planner_story SET title = :title, description = :description, image = :image,  date = :date WHERE id = :id and planner_id = :planner_id");
					$sth->bindParam(':title', $value['title'], PDO::PARAM_STR);
					$sth->bindParam(':description', $value['description'], PDO::PARAM_STR);
					$sth->bindParam(':date', $value['date'], PDO::PARAM_STR);
					$sth->bindParam(':image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':id', $id, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $id;
			
				}else{
					$sth = $db->prepare("INSERT INTO planner_story (planner_id,title,description,image,date) values (:planner_id,:title,:description,:image,:date)");
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':title', $value['title'], PDO::PARAM_STR);
					$sth->bindParam(':description', $value['description'], PDO::PARAM_STR);
					$sth->bindParam(':date', $value['date'], PDO::PARAM_STR);
					$sth->bindParam(':image', $uploadedfilepath, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $db->lastInsertId(); 
				}
			
			}
			
			if(ISSET($_FILES["counter_bg_image"]['tmp_name'])){
				if(file_exists($_FILES["counter_bg_image"]['tmp_name']) || is_uploaded_file($_FILES["counter_bg_image"]['tmp_name'])) {
					$file = $_FILES["counter_bg_image"];
					$allowed_iange_size = 1048576*2;
					if($file['size'] > $allowed_iange_size){
						throw new PDOException($file['name']. " - File size is bigger than the allowed size");
					}
					$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
					if(!in_array($file['type'],$allowed_image_types)){
						throw new PDOException($file['name']." - Not valid ext");
					}
					if(!in_array(mime_content_type($file['tmp_name']),$allowed_image_types)){
						throw new PDOException($file['name']." - Not an Image");
					}
					if ($file['error'] != 0 ) {
						throw new PDOException($file['name']." - Upload error");
					}
					
					$userDirName = substr($CSRFToken,-8);
					$groupDirName = "upload/".$userDirName."";
					if (!file_exists($groupDirName)) {
						if (!mkdir($groupDirName, 0777, true)) {
							throw new PDOException("Cannot create dir");
						}
					}
					$fileinfo = pathinfo($file['name']);
					$fileext = $fileinfo['extension'];
					$uploadedfilepath = $groupDirName."/counter_bg".mt_rand().".".$fileext;
					if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
						
					}else{
						throw new PDOException("File move error!");
					}
					$counter_bg_image = $uploadedfilepath;
				}
			}else{
				$counter_bg_image = "";
			}
					
			$sth = $db->prepare("UPDATE planner SET story_intro = :story_intro,counter_bg_image = :counter_bg_image WHERE id = :planner_id");
			$sth->bindParam(':story_intro', $story_intro, PDO::PARAM_STR);
			$sth->bindParam(':counter_bg_image', $counter_bg_image, PDO::PARAM_STR);
			$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Atleast one Story data is required");
		}
		
			
		$ids = implode(",",$ids);
		
			
		$sth = $db->prepare("SELECT title,description,image,date,id as story_id FROM planner_story WHERE id in ($ids) and planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data['story'] = $result;
		$sth = $db->prepare("SELECT event_date,story_intro,counter_bg_image FROM planner WHERE id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		$data = array_merge($data,$result);
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Story saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/story', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$planner_id = $sth->fetchColumn();
		if(empty($planner_id)){
			throw new PDOException("Token is not valid");
		}
		$sth = $db->prepare("SELECT title,description,image,date,id as story_id FROM planner_story WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data['story'] = $result;
		$sth = $db->prepare("SELECT event_date,story_intro,counter_bg_image FROM planner WHERE id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		$data = array_merge($data,$result);
		if(empty($data)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
	
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		return $response->body(json_encode($dataAry));
	
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->post('/event', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$group = $request->params();
	$event_intro = $request->params('event_intro');
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$group_name = "event";
		if(!ISSET($group[$group_name])){
			throw new PDOException("Event data is required");
		}
		if(is_array($group[$group_name]) && count($group[$group_name])>0){
			foreach($group[$group_name] as $key=>$value){
			
				if(empty($value['event_name'])){
					throw new PDOException("Event Nmae is empty for index - ".$key);
				}
				if(empty($value['date'])){
					throw new PDOException("Date is empty for Index - ".$key);
				}
				if(empty($value['venue_id'])){
					throw new PDOException("Venue id is empty for Index - ".$key);
				}
				if(empty($value['theme'])){
					throw new PDOException("Theme is empty for Index - ".$key);
				}
				if(empty($value['cuisine'])){
					throw new PDOException("Cuisine is empty for Index - ".$key);
				}
				$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
				$planner_id = $sth->fetchColumn();
				$id  = ISSET($value['event_id'])?$value['event_id']:null;
				if($id != ""){
					$sth = $db->prepare("UPDATE planner_event SET event_name = :event_name, date = :date, venue_id = :venue_id,  theme = :theme, cuisine = :cuisine WHERE id = :id and planner_id = :planner_id");
					$sth->bindParam(':event_name', $value['event_name'], PDO::PARAM_STR);
					$sth->bindParam(':date', $value['date'], PDO::PARAM_STR);
					$sth->bindParam(':venue_id', $value['venue_id'], PDO::PARAM_STR);
					$sth->bindParam(':theme', $value['theme'], PDO::PARAM_STR);
					$sth->bindParam(':cuisine', $value['cuisine'], PDO::PARAM_STR);
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':id', $id, PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $id;
			
				}else{
					$sth = $db->prepare("INSERT INTO planner_event (planner_id,event_name,date,venue_id,theme,cuisine) values (:planner_id,:event_name,:date,:venue_id,:theme,:cuisine)");
					$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
					$sth->bindParam(':event_name', $value['event_name'], PDO::PARAM_STR);
					$sth->bindParam(':date', $value['date'], PDO::PARAM_STR);
					$sth->bindParam(':venue_id', $value['venue_id'], PDO::PARAM_STR);
					$sth->bindParam(':theme', $value['theme'], PDO::PARAM_STR);
					$sth->bindParam(':cuisine', $value['cuisine'], PDO::PARAM_STR);
					$sth->execute();
					$ids[] = $db->lastInsertId(); 
				}
			
			}
			$sth = $db->prepare("UPDATE planner SET event_intro = :event_intro WHERE id = :planner_id");
			$sth->bindParam(':event_intro', $event_intro, PDO::PARAM_STR);
			$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Atleast one Event data is required");
		}
		
			
		$ids = implode(",",$ids);
		
			
		$sth = $db->prepare("SELECT event_name,date,venue_id,theme,cuisine,id as event_id FROM planner_event WHERE id in ($ids) and planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data['event'] = $result;
		$sth = $db->prepare("SELECT event_intro FROM planner WHERE id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		$data = array_merge($data,$result);
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Event saved"),"data"=>$data);
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->get('/event', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$planner_id = $sth->fetchColumn();
		if(empty($planner_id)){
			throw new PDOException("Token is not valid");
		}
		$sth = $db->prepare("SELECT event_name,date,venue_id,theme,cuisine,id as event_id FROM planner_event WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll();
		$data['event'] = $result;
		$sth = $db->prepare("SELECT event_intro FROM planner WHERE id = :planner_id");
		$sth->bindParam(':planner_id', $planner_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		$data = array_merge($data,$result);
		if(empty($data)){
			$dataAry = array("success"=>array("msg"=>"Data not available"));
		}else{
			$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		}
	
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		return $response->body(json_encode($dataAry));
	
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});
$app->get('/preview', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers("CSRFToken");
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id,url,groom_name,bride_name,groom_pimage,bride_pimage,event_date,header_image,event_name,bride_description,groom_description,bride_twitter_link,bride_fb_link,bride_insta_link,groom_twitter_link,groom_fb_link,groom_insta_link,template_order,session_id,story_intro,event_intro,counter_bg_image  FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$planner = $sth->fetch();
		if(empty($planner)){
			throw new PDOException("Token is not valid");
		}else{
			$data = $planner;
			unset($data['id']);
		}
	
		$sth = $db->prepare("SELECT guest_name,guest_image,guest_relation FROM planner_guest WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$guest = $sth->fetchAll();
		if(!empty($guest)){
			$data["guest"] = $guest;
		}
		$sth = $db->prepare("SELECT image,image_title,image_description FROM planner_gallery WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$gallery = $sth->fetchAll();
		//if(!empty($gallery)){
			$data["gallery"] = $gallery;
		//}
		$sth = $db->prepare("SELECT title,description,image,date FROM planner_story WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$story = $sth->fetchAll();
		if(!empty($story)){
			$data["story"] = $story;
		}
		$sth = $db->prepare("SELECT event_name,date,venue_id,theme,cuisine FROM planner_event WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$event = $sth->fetchAll();
		foreach($event as $key=>$value){
			$sth = $db->prepare("SELECT name,image,replace(name,' ','_') as url FROM venue WHERE id = :id");
			$sth->bindParam(':id', $value["venue_id"], PDO::PARAM_STR);
			$sth->execute();
			$venue = $sth->fetch();
			if(!empty($venue)){
				$event[$key]["venue"] = $venue;
			}
			$sth = $db->prepare("SELECT title,file_name FROM venue_image WHERE venue_id = :venue_id");
			$sth->bindParam(':venue_id', $value["venue_id"], PDO::PARAM_STR);
			$sth->execute();
			$venue_image = $sth->fetchAll();
			if(!empty($venue_image)){
				$event[$key]["venue"]["venue_image"] = $venue_image;
			}
		}
		if(!empty($event)){
			$data["event"] = $event;
		}
		
		
		
		
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});

$app->get('/wedding', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$url = $request->params("url");
	try{
		if(empty($url)){
			throw new PDOException("Url is empty");
		}
		$status = 1;
		$sth = $db->prepare("SELECT id,url,groom_name,bride_name,groom_pimage,bride_pimage,event_date,header_image,event_name,bride_description,groom_description,bride_twitter_link,bride_fb_link,bride_insta_link,groom_twitter_link,groom_fb_link,groom_insta_link,template_order,session_id,story_intro,event_intro,counter_bg_image  FROM planner WHERE url = :url and status = :status");
		$sth->bindParam(':url', $url, PDO::PARAM_STR);
		$sth->bindParam(':status', $status, PDO::PARAM_STR);
		$sth->execute();
		$planner = $sth->fetch();
		if(empty($planner)){
			throw new PDOException("Url is not valid");
		}else{
			$data = $planner;
			unset($data['id']);
		}
	
		$sth = $db->prepare("SELECT guest_name,guest_image,guest_relation FROM planner_guest WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$guest = $sth->fetchAll();
		if(!empty($guest)){
			$data["guest"] = $guest;
		}
		$sth = $db->prepare("SELECT image,image_title,image_description FROM planner_gallery WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$gallery = $sth->fetchAll();
		//if(!empty($gallery)){
			$data["gallery"] = $gallery;
		//}
		$sth = $db->prepare("SELECT title,description,image,date FROM planner_story WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$story = $sth->fetchAll();
		if(!empty($story)){
			$data["story"] = $story;
		}
		$sth = $db->prepare("SELECT event_name,date,venue_id,theme,cuisine FROM planner_event WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $planner['id'], PDO::PARAM_STR);
		$sth->execute();
		$event = $sth->fetchAll();
		foreach($event as $key=>$value){
			$sth = $db->prepare("SELECT name,image,replace(name,' ','_') as url FROM venue WHERE id = :id");
			$sth->bindParam(':id', $value["venue_id"], PDO::PARAM_STR);
			$sth->execute();
			$venue = $sth->fetch();
			if(!empty($venue)){
				$event[$key]["venue"] = $venue;
			}
			$sth = $db->prepare("SELECT title,file_name FROM venue_image WHERE venue_id = :venue_id");
			$sth->bindParam(':venue_id', $value["venue_id"], PDO::PARAM_STR);
			$sth->execute();
			$venue_image = $sth->fetchAll();
			if(!empty($venue_image)){
				$event[$key]["venue"]["venue_image"] = $venue_image;
			}
		}
		if(!empty($event)){
			$data["event"] = $event;
		}
		
		
		
		
		$dataAry = array("success"=>array("msg"=>"Data is available"),"data"=>$data);
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
	}
});


$app->delete('/bridalparty', function()use($app,$db)  {
	
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$id = $request->params('id');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		
		if(empty($id)){
			throw new PDOException("ID is empty");
		}
		
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		
		$sth = $db->prepare("SELECT ps.* FROM planner p join planner_guest ps on (p.id = ps.planner_id) WHERE ps.id = :id and p.session_id = :session_id");
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $session_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		
		if($result["id"] == ""){
			throw new PDOException("ID is invalid");
		}
		
		$userDirName = substr($session_id,-8);
		$uploadedfilepath = $result["image"];
		if($uploadedfilepath !=""){
			if (file_exists($uploadedfilepath)) {
				if (!unlink($uploadedfilepath)) {
					throw new PDOException("Cannot delete the file");
				}
			}
		}
	
		$sth = $db->prepare("DELETE FROM planner_guest WHERE id = :id");
		$sth->bindParam(':id', $result["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Guest Deleted"));
		return $response->body(json_encode($dataAry));
		
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});

$app->delete('/event', function()use($app,$db)  {
	
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$id = $request->params('id');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		
		if(empty($id)){
			throw new PDOException("ID is empty");
		}
		
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		$sth = $db->prepare("SELECT ps.* FROM planner p join planner_event ps on (p.id = ps.planner_id) WHERE ps.id = :id and p.session_id = :session_id");
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $session_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		
		if($result["id"] == ""){
			throw new PDOException("ID is invalid");
		}
			
		$sth = $db->prepare("DELETE FROM planner_event WHERE id = :id");
		$sth->bindParam(':id', $result["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Event Deleted"));
		return $response->body(json_encode($dataAry));
		
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->delete('/story', function()use($app,$db)  {
	
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->headers('CSRFToken');
	$id = $request->params('id');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		
		if(empty($id)){
			throw new PDOException("ID is empty");
		}
		
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		
		$sth = $db->prepare("SELECT ps.* FROM planner p join planner_story ps on (p.id = ps.planner_id) WHERE ps.id = :id and p.session_id = :session_id");
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->bindParam(':session_id', $session_id, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		
		if($result["id"] == ""){
			throw new PDOException("ID is invalid");
		}
		
		$userDirName = substr($session_id,-8);
		$uploadedfilepath = $result["image"];
		if($uploadedfilepath !=""){
			if (file_exists($uploadedfilepath)) {
				if (!unlink($uploadedfilepath)) {
					throw new PDOException("Cannot delete the file");
				}
			}
		}
	
		$sth = $db->prepare("DELETE FROM planner_story WHERE id = :id");
		$sth->bindParam(':id', $result["id"], PDO::PARAM_STR);
		$sth->execute();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Story Deleted"));
		return $response->body(json_encode($dataAry));
		
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});

$app->post('/publish', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$group = $request->params();
	$CSRFToken = $request->headers('CSRFToken');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$session_id = checkValidToken($CSRFToken,$db);
		if($session_id == ""){
			throw new PDOException("Token is invalid");
		}
		
		//TODO check if the planner has necessary data for publishing
		$status=1;
		$sth = $db->prepare("UPDATE planner SET status = :status WHERE session_id = :session");
		$sth->bindParam(':status', $status, PDO::PARAM_STR);
		$sth->bindParam(':session', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Planner Published"));
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});
$app->run();
