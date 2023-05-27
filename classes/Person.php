<?php

    namespace MyApp;
    use \DateTimeZone;
    use \DateTime;

    /*
        Implement a Person class.

        Person has following attributes:
        - unique integer ID
        - name
        - surname
        - sex M/F
        - birth date
        You can get these information from the instance but you can not change them. 
        (we do not consider ability to change name or sex)

        Operations:
        - Get person age in days.
    */

    class Person {
        protected int $id;
        protected string $name;
        protected string $surname;
        protected string $sex;
        protected DateTime $birthdate;

        function __construct($object) {
            $this->id = $object["id"];
            $this->name = $object["name"];
            $this->surname = $object["surname"];
            $this->sex = $object["sex"];
            $this->birthdate =  new DateTime($object["birthdate"], new DateTimeZone('UTC'));
        }

        function setId($id) {
            $this->id = $id;
        }

        function getId() {
            return $this->id;
        }

        function getName() {
            return $this->name;
        }

        function setSurname($surname) {
            $this->surname = $surname;
        }

        function getSurname() {
            return $this->surname;
        }

        function getSex() {
            return $this->sex;
        }

        function setBirthday($birthdate) {
            $this->birthdate = new DateTime($birthdate, new DateTimeZone('UTC'));
        }

        function getBirthdate() {
            return $this->birthdate;
        }

        public function getAgeInDays() {
            return $this->birthdate->diff(new DateTime())->days;
        }
    }