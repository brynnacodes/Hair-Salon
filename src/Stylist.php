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
    }


?>
