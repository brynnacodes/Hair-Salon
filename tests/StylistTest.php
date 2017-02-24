<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';

    $server = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        function test_getName()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getDescription()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);

            //Act
            $result = $test_stylist->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $id = 1;
            $test_stylist = new Stylist($name, $description, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }



    }

?>
