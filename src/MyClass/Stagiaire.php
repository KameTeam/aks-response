<?php
    namespace MyClass;

    Class Stagiaire{
        private $id;
        private $name;
        private $phone;
        private $create_at;
        private $birthday;

        public function __construct($id, $name, $phone, $birthday, $create_at)
        {
            $this->id = $id;
            $this->name = $name;
            $this->phone = $phone;
            $this->create_at = $create_at;
            $this->birthday = $birthday;
        }

        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getPhone(){
            return $this->phone;
        }
        public function getBirthday(){
            return $this->birthday;
        }
        public function getCreateAt(){
            return $this->create_at;
        }
        public function setName($name){
            $this->name = $name;
            return $this;
        }
        public function setPhone($phone){
            $this->phone = $phone;
            return $this;
        }
        public function setBirthday($birthday){
            $this->birthday = $birthday;
            return $this;
        }
        public function setCreateAt($create_at){
            $this->create_at = $create_at;
            return $this;
        }
    }
?>