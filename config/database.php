<?php
/**
 * Short description for class
 *
 * *PHP version 7.4
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   API
 * @package    REST_1
 * @author     Another Author <another@example.com>
 * @copyright  2021-2022 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 */ 
class Database
{
    private $host;
    private $dbuser;
    private $dbname;
    private $pwd;
    private $conn;
    /**
     * Short description of the connect function
     *
     * PHP version 7.4
     * th
     * * @param    null  $object The object to convert
     * * @return    null
     * 
    */
    public function connect()
    {
        $this->host='localhost';
        $this->dbuser='root';
        $this->dbname='rest_api';
        $this->pwd="";
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->pwd);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}
