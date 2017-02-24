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

        protected function tearDown()
        {
            Stylist::deleteAll();
        }

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

        function test_save()
        {
            //Arrange
            $name = "Carrie";
            $description = "My specialties are womens cuts";
            $test_stylist = new Stylist($name, $description);

            //Act
            $test_stylist->save();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);
            $test_stylist->save();

            $name2 = "Carrie";
            $description2 = "My specialties are womens cuts";
            $test_stylist2 = new Stylist($name, $description);
            $test_stylist2->save();
            //Act

            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);
            $test_stylist->save();

            $name2 = "Carrie";
            $description2 = "My specialties are womens cuts";
            $test_stylist2 = new Stylist($name, $description);
            $test_stylist2->save();
            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);
            $test_stylist->save();

            $name2 = "Carrie";
            $description2 = "My specialties are womens cuts";
            $test_stylist2 = new Stylist($name, $description);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);
            $test_stylist->save();

            //Act
            $new_description = "I only do buzz cuts";
            $test_stylist->updateDescription($new_description);
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($new_description, $result[0]->getDescription());
        }

        function test_delete()
        {
            //Arrange
            $name = "Robert";
            $description = "My specialties are mens cuts and styles";
            $test_stylist = new Stylist($name, $description);
            $test_stylist->save();

            $name2 = "Carrie";
            $description2 = "My specialties are womens cuts";
            $test_stylist2 = new Stylist($name, $description);
            $test_stylist2->save();

            //Act

            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

    }

?>
