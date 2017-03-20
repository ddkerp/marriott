<?php

use \Slim\Http\Response as Response;
use \Slim\Http\Request as Request;
use \Slim\Container as Container;
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
 
 
 $c['db'] = function ($config) {
    $db = $config['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=test;charset=utf8" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
 
 

$app->get('/', function() use($app,$response) {
    //$app->response->setStatus(200);
	//$response =new \Slim\Http\Response();
       $response->setStatus(400);
    echo "Welcome to Slim 3.0 based API";
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
$app->post('/uploadimg', function(Request $request, Response $response, $args)use($app)  {
	//$response->withHeader('Content-Type', 'application/json');
	$response->headers->set('Content-Type', 'application/json');
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
			$file->moveTo(''.$filename);
			return $response->withJson(array("success"=>array("msg"=>"Uploaded successfully")),200);
		}
	} catch(PDOException $e) {
		//throw new \Exception("Forbidden", 200);
		//$newResponse = $response->setStatus(500);
		//return $newResponse->write('Server Error!!!');
		//$newresponse =  $response->setStatus(403);
		// $response =  $response->withHeader('Content-Type', 'application/json');
		return $response->withJson(array("error"=>array("msg"=>$e->getMessage())), 422);
    }
});

$app->post('/createplanurl', function(Request $request, Response $response, $args)use($app)  {
	//$response->withHeader('Content-Type', 'application/json');
	try 
    {
		$params = $request->getParams();//echo "<pre>";print_r($params);
		$planurl = $request->getParam('planurl');
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
		return $response->withJson(array("status"=>"success","data"=>array($planurl)),200);

	} catch(PDOException $e) {
		//throw new \Exception("Forbidden", 200);
		//$newResponse = $response->setStatus(500);
		//return $newResponse->write('Server Error!!!');
		//$newresponse =  $response->setStatus(403);
		 //$response =  $response->withHeader('Content-Type', 'application/json');
		 $response->headers->set('Content-Type', 'application/json');
		//return $response->withJson(array("status"=>"error","errors"=>array("message"=>$e->getMessage())), 422);
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