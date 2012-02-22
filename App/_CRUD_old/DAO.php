<?

class DAO extends PDO{
        
        # atributes / objects for Crud
        public $id;
        public $table;
        public $fields;
        public $values;
        public $where;
        public $limit;
        public $asc;
        public $desc;
        public $date;
        
        # atributes / objects for tables
        public $table1;
        public $table2;
        public $field;
        public $like;
        
        # atributes / objects for conection
        private $connect = DATABASE;
        private $root = ROOT;
        private $pass = PASSWORD;
        private static $conn;

        function DAO($connect, $root = '', $pass = '') {
                parent::__construct($connect, $root, $pass);
        }

        public static function getDAO() {
                if (!isset(self::$conn)) {
                        try {
                                self::$conn = new DAO("mysql:host=localhost;dbname=jogosonline", "root", "");
                }
                                
                        catch (PDOException $e) {
                                throw new Exception("Error to Connect: " .$e->getMessage() . " Code: " .$e->getCode());
                }
           }

                return self::$conn;
        }

        public static function PDO($sql) {
                try {
                        self::$conn = DAO::getDAO();
                        $stm = self::$conn->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (!empty($result)){
                                return $result;
                        }else{
                                return array();
                        }
                        
                }catch (PDOException $e) {
                echo "Exception Error: ".$e->getMessage(). " Code: " .$e->getCode();
                }
                
        }
        
        public function setId($id){
                $this->id = $id;        
        }
        
        public function getId(){
                return $this->id;       
        }
        
        public function select(){
                $date   = (!empty($this->data)  ? ", DATE_FORMAT({$this->data}, '%d/%m/%Y') AS data" : "");
                $padrao = (!empty($this->desc)  ? "{$this->desc} DESC" : "{$this->asc} ASC");
                $where  = (!empty($this->where) ? "WHERE {$this->where}" : "" );
                $limit  = (!empty($this->limit) ? "LIMIT {$this->limit}" : "" );
                $like   = (!empty($this->like)  ? "LIKE '%{$this->like}%'" : "" );
                
                if((!empty($this->table1)) and (!empty($this->table2) and (!empty($this->field)))){
                        $sql = "SELECT {$this->fields} {$date} FROM {$this->table1} INNER JOIN {$this->table2} ON {$this->field} {$where} {$limit}";  
                }else{
                        $sql = "SELECT {$this->fields} {$date} FROM {$this->table} {$like} {$where} ORDER BY {$padrao} {$limit}";      
                }
                
                return self::PDO($sql); 
        }
        
        public function insert(){       
                $sql = "INSERT INTO {$this->table} ({$this->fields}) VALUES ({$this->values})";
                return self::PDO($sql);
        }
        
        public function update(){
                $sql = "UPDATE {$this->table} SET {$this->fields} WHERE id = {$this->getId()}";
                return self::PDO($sql);
        }
        
        public function delete(){
                $sql = "DELETE FROM {$this->table} WHERE id = {$this->getId()}";
                return self::PDO($sql);
        }
        
        public function total(){
                $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
                return self::PDO($sql);
        }

                
}

?>