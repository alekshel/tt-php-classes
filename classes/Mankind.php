<?php

    namespace MyApp;
    use MyApp\Person;
    use \ArrayIterator;

    /*
        Implement Mankind class, which works with Person instances.

        General requirements:
        - there can only exist a single instance of the class (Martians are not mankind...)
        - allow to use the instance as array (use person IDs as array keys) and allow to loop through the instance via foreach

        Required operations:
        - Load people from the file (see below)
        - Get the Person based on ID
        - get the percentage of Men in Mankind



        Loading people from the file:

        Input file is in CSV format. Each person is in separate line.
        Each line contains ID of the person, name, surname, sex (M/F) and birth date in format dd.mm.yyyy.
        Attributes are separated by semicolon (;) File is using UTF8 encoding.

        Example:
        123;Michal;Walker;M;01.11.1962
        3457;Pavla;Nowak;F;13.04.1887

        Expected number of records in the file <= 1000.

        Also suggest how to handle the situation when the file is 
        much larger (100 MiB+) - in terms of this method and the Mankind class itself.
    */

    class Mankind extends Person {
        private static $instance;
        private array $people;

        function __construct() {
            $this->people = array();
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function add($object) {
            $id = $object["id"];
            $person = new Person($object);
            $this->people[$id] = $person;
        }

        public function loadFromFile($filepath) {
            if (($handle = fopen($filepath, 'r')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $csvArray = explode(';', $data[0]);

                    $this->add([
                        "id" => $csvArray[0],
                        "name" => $csvArray[1],
                        "surname" => $csvArray[2],
                        "sex" => $csvArray[3],
                        "birthdate" => $csvArray[4],
                    ]);
                }
                fclose($handle);
            }
        }

        public function getPersonById($id) {
            return $this->people[$id] ?? null;
        }

        public function getPercentageOfMen() {
            $menCount = 0;

            $totalPeople = count($this->people);
            if (!$totalPeople) {
                return 0;
            }

            foreach ($this->people as $person) {
                if ($person->getSex() === 'M') {
                    $menCount++;
                }
            }

            return round(($menCount / $totalPeople) * 100, 2) . "%";
        }

        public function getAll() {
            return new ArrayIterator($this->people);
        }
    }