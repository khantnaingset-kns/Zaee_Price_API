<?php
/**
 * Created by PhpStorm.
 * User: Khant Naing Set
 * Date: 8/20/2016
 * Time: 2:31 AM
 */

namespace DataOperation;

use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class DBConnectionErrorException extends \Exception
{
    public function Message($objectname)
    {
        return "Database Connection Error Occur at " . $objectname . " function!!!";
    }
}

class SqlQueryExecutionError extends \Exception
{
    public function Message($objectname)
    {
        return "SQl Query Execution Error Occur at " . $objectname . " function!!!";
    }
}

class DataAccess
{

    private $servername = "localhost";
    private $dbname = "zaeeapidb";
    private $username = "root";
    private $password = "";
    private $logpath = "/Log/DBLog.log";

    function Log($logdata)
    {
        $logger = new Logger('app_log');
        $logger->pushHandler(new StreamHandler($this->logpath, Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        $logger->addInfo($logdata);

    }

    function dbConnection()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            if (!$conn) {
                throw new DBConnectionErrorException();
            } else {

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ dbConnection, message was " . $pdoe->getMessage());
            $conn = null;
        } catch (DBConnectionErrorException $dbcee) {
            $this->log($dbcee->Message('dbConnection'));
            $conn = null;
            return null;
        }


    }

    function getAPIKey()
    {
        $conn = $this->dbConnection();

        try {
            $sql = "SELECT apikey From apikey";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {

                    while ($fetchdata = $stmt->fetch()) {

                        $apikey[] = $fetchdata['apikey'];

                    }
                    return $apikey;

                    //return $apikey;

                }
            } else {
                throw new SqlQueryExecutionError();
                return null;
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ getAPIKey, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('getAPIKey'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_ricePrices($type1, $type2, $type3, $division)
    {

        $conn = $this->dbConnection();
        try {

            $sql = "INSERT INTO rice_prices (r_type1,r_type2,r_type3,division) VALUES (:type1,:type2,:type2,:division)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type1', $type1);
            $stmt->bindParam(':type2', $type2);
            $stmt->bindParam(':type3', $type3);
            $stmt->bindParam(':division', $division);
            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_ricePrices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_ricePrices'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_onionPrices($type1, $type2, $type3, $division)
    {

        $conn = $this->dbConnection();
        try {

            $sql = "INSERT INTO onion_prices (on_type1,on_type2,on_type3,division) VALUES (:type1,:type2,:type2,:division)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type1', $type1);
            $stmt->bindParam(':type2', $type2);
            $stmt->bindParam(':type3', $type3);
            $stmt->bindParam(':division', $division);
            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }

        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_onionPrices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_onionPrices'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_oilPrices($type1, $type2, $type3, $division)
    {

        $conn = $this->dbConnection();
        try {

            $sql = "INSERT INTO oil_prices (o_type1,o_type2,o_type3,division) VALUES (:type1,:type2,:type2,:division)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type1', $type1);
            $stmt->bindParam(':type2', $type2);
            $stmt->bindParam(':type3', $type3);
            $stmt->bindParam(':division', $division);
            $queryexecutioncheck = $stmt->execute();
            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }

        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_oilPrices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_oilPrices'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_garlicPrices($type1, $type2, $type3, $division)
    {

        $conn = $this->dbConnection();
        try {

            $sql = "INSERT INTO garlic_prices (g_type1,g_type2,g_type3,division) VALUES (:type1,:type2,:type2,:division)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type1', $type1);
            $stmt->bindParam(':type2', $type2);
            $stmt->bindParam(':type3', $type3);
            $stmt->bindParam(':division', $division);
            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }

        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_garlicPrices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_garlicPrices'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_pepperPrices($type1, $type2, $type3, $division)
    {

        $conn = $this->dbConnection();
        try {

            $sql = "INSERT INTO pepper_prices (p_type1,p_type2,p_type3,division) VALUES (:type1,:type2,:type2,:division)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type1', $type1);
            $stmt->bindParam(':type2', $type2);
            $stmt->bindParam(':type3', $type3);
            $stmt->bindParam(':division', $division);
            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }

        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_pepperPrices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_pepperPrices'));
            $conn = null;
            return null;
        }
    }

    // This method return latestID of Inserted Database Table and result of query execution (eg. True or False)
    function insertData_Prices($ricepricesid, $oilpricesid, $onionpricesid, $garlicpricesid, $pepperpricesid)
    {
        $conn = $this->dbConnection();
        try {
            $sql = "INSERT INTO prices (rice_prices_id,oil_prices_id,onion_prices_id,garlic_prices_id,pepper_prices_id)
             VALUES (:ricepriceid,:oilpricesid,:onionpricesid,:garlicpricesid,:pepperpricesid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ricepriceid', $ricepricesid);
            $stmt->bindParam(':oilpricesid', $oilpricesid);
            $stmt->bindParam(':onionpricesid', $onionpricesid);
            $stmt->bindParam(':garlicpricesid', $garlicpricesid);
            $stmt->bindParam(':pepperpricesid', $pepperpricesid);

            if ($stmt->execute()) {
                $latestid = $conn->lastInsertId();
                return $data = [
                    'id' => $latestid,
                    'condition' => true
                ];
            } else {
                throw new SqlQueryExecutionError();
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_Prices, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_Prices'));
            $conn = null;
            return null;
        }

    }

    function insertData_Zaee($date, $updatetime, $pid)
    {
        $conn = $this->dbConnection();
        try {
            $sql = "INSERT INTO zaee(date,update_time,p_id) VALUES (:date,:updatetime,:pid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':updatetime', $updatetime);

            $stmt->bindParam(':pid', $pid);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new SqlQueryExecutionError();
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ insertData_Zaee, message was " . $pdoe->getMessage());
            $conn = null;
            return false;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('insertData_Zaee'));
            $conn = null;
            return false;
        }
    }

    function updateDailyFeedData($ricesprices, $onionprices, $oilprices, $garlicprices, $pepperprices, $zaee)
    {

        $ricepricesreturndata = $this->insertData_ricePrices($ricesprices['type1'], $ricesprices['type2'],
            $ricesprices['type3'], $ricesprices['division']);
        $onionpricesreturndata = $this->insertData_onionPrices($onionprices['type1'],
            $onionprices['type2'], $onionprices['type3'], $onionprices['division']);
        $oilpricesreturndata = $this->insertData_oilPrices($oilprices['type1'],
            $oilprices['type2'], $oilprices['type3'], $oilprices['division']);
        $garlicpricesreturndata = $this->insertData_garlicPrices($garlicprices['type1'], $garlicprices['type2'], $garlicprices['type3'], $garlicprices['division']);
        $pepperpricesreturndata = $this->insertData_pepperPrices($pepperprices['type1'],
            $pepperprices['type2'], $pepperprices['type3'], $pepperprices['division']);
        $pricesreturndata = $this->insertData_Prices($ricepricesreturndata['id'],
            $oilpricesreturndata['id'], $onionpricesreturndata['id'], $garlicpricesreturndata['id'], $pepperpricesreturndata['id']);

        return $this->insertData_Zaee($zaee['date'], $zaee['updatetime'], $pricesreturndata['id']);


    }

    function retieveDailyFeedData($date, $division)
    {
        $conn = $this->dbConnection();

        try {
            $statement = require __DIR__ . '/dboperationstatement.php';
            $sql = $statement['getdatastatement'];
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':currentdate', $date);
            $stmt->bindParam(':division', $division);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $fetchdata = $stmt->fetch();

                    return $fetchdata;
                }
                else{
                    return null;
                }


            } else {
                throw new SqlQueryExecutionError();
                return null;
            }
        } catch (PDOException $pdoe) {
            $this->log("PDO exception Occured @ retieveDailyFeedData, message was " . $pdoe->getMessage());
            $conn = null;
            return null;

        } catch (SqlQueryExecutionError $sqee) {
            $this->log($sqee->Message('retieveDailyFeedData'));
            $conn = null;
            return null;
        }
    }

}