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
    }
?>
