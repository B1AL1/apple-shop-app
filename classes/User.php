<?php
    class User
    {    
        protected $userName;
        protected $passwd;
        protected $fullName;
        protected $email;
        protected $date;
        const STATUS_USER = 1;
        const STATUS_ADMIN = 2;

        function __construct($userName, $fullName, $email, $passwd)
        {
            $this->status=User::STATUS_USER;
            $this->userName = $userName;
            $this->fullName = $fullName;
            $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
            $this->email = $email;
            $this->date = new DateTime();
        }

        public function getUserName()
        {
            return $this->userName;
        }

        public function getPasswd()
        {
            return $this->passwd;
        }

        public function getFullName()
        {
            return $this->fullName;
        }

        public function getEmail()
        {
            return $this->emal;
        }

        public function getDate()
        {
            return ($this->date)->format('Y-m-d');
        }

        public function setUserName($userName): void {
            $this->userName = $userName;
        }

        public function setPasswd($passwd): void {
            $this->passwd = $passwd;
        }

        public function setFullName($fullName): void {
            $this->fullName = $fullName;
        }

        public function setEmail($email): void {
            $this->email = $email;
        }

        public function setDate($date): void {
            $this->date = $date;
        }
        Public function show() {
            echo "Nazwa uzytkownika: ".$this->userName."<br>Hasło: ".$this->passwd."<br>Imie i nazwisko: ".$this->fullName."<br>Email: ".$this->email."<br>Data utworzenia: ".($this->date)->format('Y-m-d')."<br>Status: ". $this->status."<br>";
        }

        function toArray(){
            $arr=
            [
                'userName' => $this->userName,
                'fullName' => $this->fullName,
                'passwd' => $this->passwd,
                'email' => $this->email,
                'date' => ($this->date)->format('Y-m-d'),
                'status' => $this->status
            ];
            return $arr;
        }

        function saveDB($db){   
            $sql = "INSERT INTO USERS (id, userName, fullName, email, passwd, status, date) VALUES (NULL,'".$this->userName."','".$this->fullName."','".$this->email."','".$this->passwd."','".$this->status."','".($this->date)->format('Y-m-d')."')";
            $db->insert($sql);
        }

        static function getAllUsersFromDB($db){
            echo $db->select("SELECT * FROM USERS", ["id", "userName", "fullName", "email", "passwd", "status", "date"]);
        }
    }