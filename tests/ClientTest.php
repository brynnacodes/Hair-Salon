<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Client.php';

    $server = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        function test_getName()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_client = new Client($name, $phone, $stylist_id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_client = new Client($name, $phone, $stylist_id);

            //Act
            $result = $test_client->getPhone();

            //Assert
            $this->assertEquals($phone, $result);
        }

        function test_getStylistId()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_stylist = new Client($name, $phone, $stylist_id);

            //Act
            $result = $test_stylist->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $id = 1;
            $test_stylist = new Client($name, $phone, $stylist_id, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

    }
?>
