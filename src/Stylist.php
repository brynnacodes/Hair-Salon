<?php
    class Stylist
    {
        private $name;
        private $description;
        private $id;

        function __construct($name, $description, $id = null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()

        {
            return $this->name;
        }

        function setDescription($new_description)
        {
            $this->description = $new_description;
        }

        function getDescription()

        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function updateDescription($new_description)
        {
            $exec = $GLOBALS['DB']->prepare("UPDATE stylists SET description = :description WHERE id = :id;");
            $exec->execute([':description' => $new_description, ':id' => $this->getId()]);
            $this->setDescription($new_description);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        function getClients()
        {
            $clients = Client::getAll();
            $matching_clients = [];
            foreach ($clients as $client) {
                if ($client->getStylistId() == $this->getId()) {
                    array_push($matching_clients, $client);
                }
            }
            return $matching_clients;
        }

        //using prepared statements will allow users to enter special characters such as apostrophes or backslashes without creating errors in the database; Also prevents against injection attacks

        function save()
        {
            $exec = $GLOBALS['DB']->prepare("INSERT INTO stylists (name, description) VALUES (:name, :description)");
            $exec->execute([':name' => $this->getName(), ':description' => $this->getDescription()]);
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($id)
        {
            $found_stylist;
            $stylists = Stylist::getAll();
            foreach ($stylists as $stylist) {
                if ($stylist->getId() == $id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = [];
            foreach ($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $description = $stylist['description'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $description, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }
    }


?>
