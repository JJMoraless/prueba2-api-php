<?php
    namespace App;
    class areas extends connect{
        private $queryPost= 'INSERT INTO areas(name_area) VALUES(:N_Area)';
        private $queryGetAll = 'SELECT id AS "A_id", name_area AS "N_Area" FROM areas';
        private $queryUpdate = 'UPDATE areas SET name_area = :N_Area WHERE id = :A_id';
        private $queryDelete = 'DELETE FROM `areas` WHERE `areas`.`id` = :A_id';
        private $message;
        use getInstance;
        function __construct(private $id = 0, private $name_area = 1){parent::__construct();}
        public function postAreas(){
            try {
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("N_Area", $this->name_area);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function getAllAreas(){
            try {
                $res = $this->conx->prepare($this->queryGetAll);
                $res->execute();
                $this->message = $res->fetchAll(\PDO::FETCH_ASSOC);
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                echo json_encode($this->message);
            }
        }
        public function updateAreas(){
            try {
                $res = $this->conx->prepare($this->queryUpdate);
                $res->bindValue("A_id", $this->id);
                $res->bindValue("N_Area", $this->name_area);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function deleteAreas(){
            try {
                $res = $this->conx->prepare($this->queryDelete);
                $res->bindValue("A_id", $this->id); 
                $res->execute();
                $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(\PDO::FETCH_ASSOC)];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
    }
?> 

<?php
    namespace App;
    interface environments{
        public function __get($name);
    }
    abstract class connect extends credentials implements environments{
        use getInstance;
        protected $conx;
        function __construct(private $driver = "mysql", private $port = 3306){
            try {
                $this->conx = new \PDO($this->driver . ":host=" . $this->__get('host') . ";port=" . $this->port . ";dbname=" . $this->__get('dbname') . ";user=" . $this->username . ";password=" . $this->password);
                $this->conx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                $this->conx = $e->getMessage();
                print_r($e->getMessage());
            }
        }
    }
?>
}
<?php
    namespace App;
    abstract class credentials{
        //CREDENCIALES CAMPUS
        // protected $host = '172.16.48.204';
        // private $username = 'sputnik';
        // private $password = 'Sp3tn1kC@';
        // protected $dbname = 'campusland';
        //CREDENCIALES LOCAL
        protected $host = 'localhost';
        private $username = 'root';
        private $password = '';
        protected $dbname = 'campusland';
        public function __get($name){
            return $this->{$name};
        }
        function __construct(){
            
        }
    }
?>
