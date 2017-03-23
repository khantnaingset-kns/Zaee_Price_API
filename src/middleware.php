<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
namespace Middleware;


use DataOperation\DataAccess;
use DataOperation\DataTransaction;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class ResponseData
{
	
	
	function getData_DailyFeedPrices($request, $response)
		    {
		
		$dataaccess = new DataAccess();
		$returndata = $dataaccess->retieveDailyFeedData("2016-08-31", 'Yangon');
		
		$dt = new DataTransaction();
		
		$jsondata = $dt->encodeFeedDatatoJSON($returndata);
		
		return $response = $response->withHeader('Content-Type', 'application/json')->write($jsondata)->withStatus(200);
		
		
	}
}

class RequestData
{
	
	
	private $logpath = "/AppLog/PostDataLog.log";
	
	function Log($logdata)
		    {
		$logger = new Logger('app_log');
		$logger->pushHandler(new StreamHandler(__DIR__ . $this->logpath, Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		$logger->addInfo($logdata);
		
	}
	
	function postData_DailyFeedPrices($request, $response)
		    {
		
		$postdata = $request->getBody();
		$dt = new DataTransaction();
		$decodeddata = $dt->decodePostDatatoArray($postdata);
		
		
		$dataaccess = new DataAccess();
		
		$check = $dataaccess->updateDailyFeedData($decodeddata['riceprices'], $decodeddata['onionprices'], $decodeddata['oilprices'],
				                $decodeddata['garlicprices'], $decodeddata['pepperprices'], $decodeddata['zaee']);
		if ($check) {
			$successedstatus = [
						                    "status" => "Successed",
						                    "Message" => "Record are successfully upload to API",
						                    "updateTime" => date("h:i:sa")
						                ];
			$this->Log("Update Data Completed in " . date("h:i:sa") . " " . date("Y/m/d"));
			return $response->withHeader('Content-Type', 'application/json')->write(json_encode($successedstatus))->withStatus(200);
			
		}
		else {
			$failedstatus = [
						                    "status" => "Failed",
						                    "Message" => "Something Wrong in Uploading Data to API, Check the Post Data or Server",
						                    "updateTime" => date("h:i:sa")
						                ];
			$this->Log("Update Data Failed in " . date("h:i:sa") . " " . date("Y/m/d"));
			return $response->withHeader('Content-Type', 'application/json')->write(json_encode($failedstatus))->withStatus(400);
		}
		
	}
	
	function Authorize($apikey)
		    {
		
		$dataaccess = new DataAccess();
		$apikeys = $dataaccess->getAPIKey();
		for ($i = 0; $i < count($apikeys); $i++) {
			if ($apikey == $apikeys[$i]) {
				return true;
			}
			else {
				return false;
			}
		}
		
		
	}
	
}
