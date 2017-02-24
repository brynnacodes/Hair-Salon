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
        protected function tearDown()
        {
            Client::deleteAll();
        }

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
            $test_client = new Client($name, $phone, $stylist_id, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $id = 1;
            $test_client = new Client($name, $phone, $stylist_id, $id);

            //Act
            $test_client->save();
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_client = new Client($name, $phone, $stylist_id);
            $test_client->save();

            $name2 = "Carrie";
            $phone2 = "1234";
            $stylist_id2 = 2;
            $test_client2 = new Client($name, $phone, $stylist_id);
            $test_client2->save();

            //Act

            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $id = 1;
            $test_client = new Client($name, $phone, $stylist_id, $id);
            $test_client->save();

            $name2 = "Carrie";
            $phone2 = "1234";
            $stylist_id2 = 3;
            $id2 = 1;
            $test_client2 = new Client($name, $phone, $stylist_id, $id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_client = new Client($name, $phone, $stylist_id);
            $test_client->save();

            $name2 = "Carrie";
            $phone2 = "1234";
            $stylist_id2 = 2;
            $test_client2 = new Client($name, $phone, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function test_updatePhone()
        {
            //Arrange
            $name = "Carrie";
            $phone = "1234";
            $stylist_id = 2;
            $test_client = new Client($name, $phone, $stylist_id);
            $test_client->save();

            //Act
            $new_phone = "4567";
            $test_client->updatePhone($new_phone);
            $result = Client::getAll();

            //Assert
            $this->assertEquals($new_phone, $result[0]->getPhone());
        }

        function test_delete()
        {
            //Arrange
            $name = "Dan";
            $phone = "1234";
            $stylist_id = 3;
            $test_client = new Client($name, $phone, $stylist_id);
            $test_client->save();

            $name2 = "Carrie";
            $phone2 = "1234";
            $stylist_id2 = 2;
            $test_client2 = new Client($name, $phone, $stylist_id);
            $test_client2->save();

            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }

    }
?>
