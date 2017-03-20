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
 
 session_start();
 //session_destroy();
 //$app->add();
function dbconn ($config) {
    $db = $config['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=test;charset=utf8" . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$db = dbconn($config);
 //echo "<pre>";print_r($db);exit;
 
$app->get('/', function() use($app,$response) {
    //$app->response->setStatus(200);
	//$response =new \Slim\Http\Response();
       $response->setStatus(400);
	   echo "<pre>";print_r($_SESSION);exit;
    echo "Welcome to Slim 2.0 based API";
}); 
$app->get('/getScore/{id}', function (Request $request, Response $response, $args) use($app) {
 
 $id = (int)$args['id'];
    try 
    {
		$db = $this->db;
        $sth = $db->prepare("SELECT * FROM venue  WHERE id = :id");
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $student = $sth->fetch(PDO::FETCH_ASSOC);
		
		if (!$sth) {
			throw new PDOException($sth->errorInfo());
		}
        if($student) {
            $response->setStatus(200);
          //$response->withHeader('Content-Type', 'application/json');
		  $response->headers->set('Content-Type', 'application/json');
			return $response->withJson($student);
			//$response->getBody()->write(var_export($student));return $response;
        } else {
            throw new PDOException('No records found.');
        }
 
    } catch(PDOException $e) {
        $response->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
	
});
$app->post('/uploadimg', function()use($app,$db)  {
	//$db = $c['db'];
	$sth = $db->prepare("SELECT * FROM venue  WHERE id = :id");
	$response = $app->response;
	$request = $app->request;
	$groom_pimage = $_FILES['groom_pimage'];
	//$_SESSION['dd']="dd";
	$CSRFToken = $request->params('CSRFToken');
	echo "<pre>";print_r($CSRFToken);exit;
	
	
	
	try 
    {
		if(empty($groom_pimage)){
			throw new PDOException("No files");
		}
		foreach($_FILES as $file){
			if(empty($file)){
				throw new PDOException("No file");
			}
			//1048576 = 1M
			if($file['size'] > (1048576*2)){
				throw new PDOException("File size is big");
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
			
			
			$sth = $db->prepare("INSERT INTO planner values (:groom_pimage,:event_date,:session_id,:created_date,:ip_address) WHERE student_id = :id");
 
			$sth->bindParam(':groom_pimage', $uploadedfilepath, PDO::PARAM_STR);
			$sth->bindParam(':session_id', $session_id, PDO::PARAM_STR);
			$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
			$sth->execute();
			
			//$file->moveTo(''.$filename);
			$response->setStatus(200);
			$response->headers->set('Content-Type', 'application/json');
			$dataAry = array("success"=>array("msg"=>"Uploaded successfully"));
			return $response->body(json_encode($dataAry));
		}
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
	try 
    {
		$planurl = $request->params('planurl');
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
$app->post('/updateScore', function() {
    $app = \Slim\Slim::getInstance();
    $allPostVars = $app->request->post();
    $score = $allPostVars['score'];
    $id = $allPostVars['id'];
 
    try 
    {
        $db = getDB();
 
        $sth = $db->prepare("UPDATE students 
            SET score = :score 
            WHERE student_id = :id");
 
        $sth->bindParam(':score', $score, PDO::PARAM_INT);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
 
        $app->response->setStatus(200);
        $app->response()->headers->set('Content-Type', 'application/json');
        echo json_encode(array("status" => "success", "code" => 1));
        $db = null;
 
    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
 
});
$app->run();
