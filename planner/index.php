<?php
use \Slim\Http\Response as Response;
use \Slim\Http\Request as Request;
use \Slim\Container as Container;
//use Slim\Middleware\SessionCookie;
$config = include(__DIR__ . '/config/local.php');
//$db = new PDO("mysql:host=localhost;dbname=test", $config['db']['user'], $config['db']['pass'] );
require 'vendor/autoload.php';
//\Slim\Slim::registerAutoloader();
//$c = new Container($configuration);
//$app = new \Slim\App();
$app = new \Slim\Slim();
//$app = new \Slim\App($c);
//$c = $app->getContainer($configuration);
$response = new Response();
//$request = new Request();
 //echo "<pre>";print_r($db);exit;
 session_start();
 //session_destroy();
 //$app->add();
function dbconn ($config) {
    $db = $config['settings']['db'];
    $pdo = new PDO("mysql:host=" . "localhost" . ";dbname=marriou2_marriott;charset=utf8" . $db['dbname'], "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$db = dbconn($config);
 //echo "<pre>";print_r($db);exit;
 
$app->get('/', function() use($app,$response) {
       $response->setStatus(400);
		echo "Welcome to Slim 2.0 based API";
}); 
$app->get('/profile', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->params('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT id,groom_name,bride_name,groom_pimage,bride_pimage,event_date FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			throw new PDOException("Token is not valid");
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
	$CSRFToken = $request->params('CSRFToken');
	try 
    {
		
		if(empty($pimage)){
			throw new PDOException("File is empty");
		}
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
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
			$uploadedfilepath = $file['name'];
			
			if (move_uploaded_file($file['tmp_name'], $uploadedfilepath) === true) {
                
            }else{
				throw new PDOException("File move error!");
			}
			
			$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
			$session_id = $sth->fetchColumn();
			
			//echo $session_id;exit;
			if($session_id != ""){
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
			$dataAry = array("success"=>array("msg"=>"Uploaded successfully"),"data"=>array("image_path"=>$uploadedfilepath));
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
$app->post('/profile', function()use($app,$db)  {
	//$db = $c['db'];
	//$sth = $db->prepare("SELECT * FROM venue  WHERE id = :id");
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->params('CSRFToken');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	$event_date = $request->params('event_date');
	try 
    {
		if(empty($bride_name)){
			throw new PDOException("Bride Name is empty");
		}
		if(empty($groom_name)){
			throw new PDOException("Groom Name is empty");
		}
		if(empty($event_date)){
			throw new PDOException("Event date is empty");
		}
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
			$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
			$session_id = $sth->fetchColumn();
			if($session_id != ""){
				$sth = $db->prepare("UPDATE planner SET bride_name = :bride_name, groom_name = :groom_name, event_date = :event_date WHERE session_id = :session_id");
				$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
				$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
				$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->execute();
			}else{
				$sth = $db->prepare("INSERT INTO planner (bride_name,groom_name,event_date,session_id,ip_address) values (:bride_name,:groom_name,:event_date,:session_id,:ip_address)");
				$event_date = "2017-01-01";
				$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
				$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
				$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
				$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
				$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
				$sth->execute();
			}
			$data = array("bride_name"=>$bride_name,"groom_name"=>$groom_name,"event_date"=>$event_date);
			$response->setStatus(200);
			$response->headers->set('Content-Type', 'application/json');
			$dataAry = array("success"=>array("msg"=>"Uploaded successfully"),"data"=>$data);
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
	$CSRFToken = $request->params('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT template_order FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchColumn();
		if(empty($result)){
			throw new PDOException("Token is not valid");
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
	$CSRFToken = $request->params('CSRFToken');
	$templates = $request->params('templates');
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		if(empty($templates)){
			throw new PDOException("Template is empty");
		}

		$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$session_id = $sth->fetchColumn();
		if($session_id != ""){
			$sth = $db->prepare("UPDATE planner SET template_order = :template_order WHERE session_id = :session_id");
			$sth->bindParam(':template_order', $templates, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Token is not valid");
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Template order saved"));
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
	$CSRFToken = $request->params('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT event_date,bride_name,groom_name,header_image FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			throw new PDOException("Token is not valid");
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
$app->post('/headers', function()use($app,$db)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->params('CSRFToken');
	$event_date = $request->params('event_date');
	$event_name = $request->params('event_name');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	$header_image = $request->params('header_image');
	
	if(ISSET($_FILES['header_image'])){
		$himage =$_FILES['header_image'];
	}
	
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}

		$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$session_id = $sth->fetchColumn();
		if($session_id != ""){
			$sth = $db->prepare("UPDATE planner SET event_date = :event_date, event_name = :event_name, bride_name = :bride_name, groom_name = :groom_name, header_image = :header_image WHERE session_id = :session_id");
			$sth->bindParam(':event_date', $event_date, PDO::PARAM_STR);
			$sth->bindParam(':event_name', $event_name, PDO::PARAM_STR);
			$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
			$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
			$sth->bindParam(':header_image', $header_image, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Token is not valid");
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Header saved"));
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
	$CSRFToken = $request->params('CSRFToken');
	try{
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		$sth = $db->prepare("SELECT bride_description,groom_description,bride_name,groom_name,groom_pimage,bride_pimage FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch();
		if(empty($result)){
			throw new PDOException("Token is not valid");
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
	$CSRFToken = $request->params('CSRFToken');
	$bride_desc = $request->params('bride_desc');
	$groom_desc = $request->params('groom_desc');
	$bride_name = $request->params('bride_name');
	$groom_name = $request->params('groom_name');
	
	if(ISSET($_FILES['groom_pimage'])){
		$groom_pimage = $_FILES['groom_pimage'];
	}
	if(ISSET($_FILES['bride_pimage'])){
		$bride_pimage = $_FILES['bride_pimage'];
	}
	
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}

		foreach($_FILES as $key=>$file){
			if(empty($file)){
				throw new PDOException("No file");
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
			$uploadedfilepath[$key] = $file['name'];
			
			if (move_uploaded_file($file['tmp_name'], $file['name']) === true) {
                
            }else{
				throw new PDOException("File move error!");
			}

		}
		
		$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$session_id = $sth->fetchColumn();
		if($session_id !=""){
			$sth = $db->prepare("UPDATE planner SET bride_description = :bride_description, groom_description = :groom_description, bride_name = :bride_name, groom_name = :groom_name, groom_pimage = :groom_pimage, bride_pimage = :bride_pimage WHERE session_id = :session_id");
			$sth->bindParam(':bride_description', $bride_desc, PDO::PARAM_STR);
			$sth->bindParam(':groom_description', $groom_desc, PDO::PARAM_STR);
			$sth->bindParam(':bride_name', $bride_name, PDO::PARAM_STR);
			$sth->bindParam(':groom_name', $groom_name, PDO::PARAM_STR);
			$sth->bindParam(':groom_pimage', $uploadedfilepath['groom_pimage'], PDO::PARAM_STR);
			$sth->bindParam(':bride_pimage', $uploadedfilepath['bride_pimage'], PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Token is not valid");
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Header saved"));
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
	$CSRFToken = $request->params('CSRFToken');
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
		$sth = $db->prepare("SELECT guest_name,guest_image,guest_relation FROM planner_guest WHERE planner_id = :planner_id");
		$sth->bindParam(':planner_id', $result, PDO::PARAM_STR);
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
	$CSRFToken = $request->params('CSRFToken');
	$name = $request->params('name');
	$relation = $request->params('relation');
	if(ISSET($_FILES['guest_image'])){
		$guest_image = $_FILES['guest_image'];
	}
	try 
    {
		if(empty($CSRFToken)){
			throw new PDOException("Token is empty");
		}
		if(empty($name)){
			throw new PDOException("Name is empty");
		}
		if(empty($relation)){
			throw new PDOException("Relation is empty");
		}

			$file = $_FILE['guest_image'];
			if(empty($file)){
				throw new PDOException("No file");
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
						
			if (move_uploaded_file($file['tmp_name'], $file['name']) === true) {
                
            }else{
				throw new PDOException("File move error!");
			}
		$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		$session_id = $sth->fetchColumn();
		if($session_id != ""){
			$sth = $db->prepare("UPDATE planner SET template_order = :template_order WHERE session_id = :session_id");
			$sth->bindParam(':template_order', $templates, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			throw new PDOException("Token is not valid");
		}
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("success"=>array("msg"=>"Template order saved"));
		return $response->body(json_encode($dataAry));
		
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});

$app->post('/uploadgallimg', function(Request $request, Response $response, $args)use($app)  {
	$response->withHeader('Content-Type', 'application/json');
	//$files = $request->getUploadedFiles();
	//echo "<pre>";print_r($request->getParams());
	//echo "<pre>";print_r($files);exit;
	try 
    {
		$files = $request->getUploadedFiles();
		if(empty($files)){
			throw new PDOException("No files");
		}
		foreach($files as $file){
			if(empty($file)){
				throw new PDOException("No files");
			}
			//1048576 = 1M
			if($file->getSize() > (1048576*2)){
				throw new PDOException("File size is big");
			}
			$allowed_image_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif','image/bmp');
			if(!in_array($file->getClientMediaType(),$allowed_image_types)){
				throw new PDOException("Not valid ext");
			}
			if(!in_array(mime_content_type($file->file),$allowed_image_types)){
				throw new PDOException("Not an Image");
			}
			if ($file->getError() != UPLOAD_ERR_OK ) {
				throw new PDOException($file->getError());
			}
			$filename = $file->getClientFilename();
			$newpath = 'upload/'.str_replace(" ","_",$filename);
			$file->moveTo($newpath);
			return $response->withJson(array("success"=>array("msg"=>"Uploaded successfully"),"data"=>array("image_path"=>$newpath)),200);
		}
	} catch(PDOException $e) {
		//throw new \Exception("Forbidden", 200);
		//$newResponse = $response->withStatus(500);
		//return $newResponse->write('Server Error!!!');
		//$newresponse =  $response->withStatus(403);
		// $response =  $response->withHeader('Content-Type', 'application/json');
		return $response->withJson(array("error"=>array("msg"=>$e->getMessage())), 422);
    }
});
$app->post('/createplanurl', function()use($app)  {
	$response = $app->response;
	$request = $app->request;
	$CSRFToken = $request->params('CSRFToken');
	$planurl = $request->params('planurl');
	try 
    {
		if(empty($planurl)){
			throw new PDOException("Empty Url");
		}
		
		//check if it is valid
		//if(!ctype_alnum($planurl)) {
		if(!ctype_alpha($planurl)) {
		//if(!preg_match('/^[A-Za-z0-9_]+$/',$planurl)) {
			throw new PDOException("Url is not valid");
		}
		//check if already exist
		if(in_array($planurl,array("ddk"))){
			throw new PDOException("Url already exist. Please create new one");
		}
		
		$sth = $db->prepare("SELECT session_id FROM planner WHERE session_id = :session_id");
		$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
		$sth->execute();
		//$student = $sth->fetch(PDO::FETCH_ASSOC);
		$session_id = $sth->fetchColumn();
		if($CSRFToken == $session_id){
			$sth = $db->prepare("UPDATE planner SET planurl = :planurl WHERE session_id = :session_id");
			$sth->bindParam(':planurl', $planurl, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->execute();
		}else{
			$sth = $db->prepare("INSERT INTO planner (planurl,session_id,ip_address) values (:planurl,:session_id,:ip_address)");
			$event_date = "2017-01-01";
			$sth->bindParam(':planurl', $planurl, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $CSRFToken, PDO::PARAM_STR);
			$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
			$sth->execute();
		}
			
		$response->setStatus(200);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"success","data"=>array($planurl));
		return $response->body(json_encode($dataAry));
	} catch(PDOException $e) {
		$response->setStatus(422);
		$response->headers->set('Content-Type', 'application/json');
		$dataAry = array("status"=>"error","errors"=>array("message"=>$e->getMessage()));
		return $response->body(json_encode($dataAry));
    }
});

$app->run();
