<?php
    class Connection {
        //Data Source Name
        private $host = 'localhost';
        private $dbname = 'php_com_pdo';
        private $user = 'root';
        private $password = '';
        
        public function getConnection() {
            try {
                 $strTeste = "mysql:host=$this->host;dbname=$this->dbname";
                 $connection = new PDO($strTeste,
                                       "$this->user", 
                                       "$this->password");
                return $connection;

            } catch(PDOException $e) {
                print_r('Error Code: '. $e->getCode() . ' <br />Message: ' . $e->getMessage());
            }
        }
    }
?>