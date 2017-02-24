<?php

    class Client
    {
        private $name;
        private $phone;
        private $stylist_id;
        private $id;

        function __construct($name, $phone, $stylist_id, $id = null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->stylist_id = $stylist_id;
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

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setStylistId($input)
        {
            $this->stylist_id = $input;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function updatePhone($new_phone)
        {
            $exec = $GLOBALS['DB']->prepare("UPDATE clients SET phone = :phone WHERE id = :id;");
            $exec->execute([':phone' => $new_phone, ':id' => $this->getId()]);
            $this->setPhone($new_phone);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }

        function save()
        {
            $exec = $GLOBALS['DB']->prepare("INSERT INTO clients (name, phone, stylist_id) VALUES (:name, :phone, :stylist_id)");
            $exec->execute([':name' => $this->getName(), ':phone' => $this->getPhone(), ':stylist_id' => $this->getStylistId()]);
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($id)
        {
            $found_client;
            $clients = Client::getAll();
            foreach ($clients as $client) {
                if ($client->getId() == $id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = [];
            foreach ($returned_clients as $client) {
                $name = $client['name'];
                $phone = $client['phone'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $phone, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

    }
?>
