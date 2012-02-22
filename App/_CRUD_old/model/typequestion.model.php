<?PHP

class TypeQuestion_Model{
        
		private $id;
        private $nametypequestion;
        private $description;
        
        # seters 
        public function setNameTypeQuestion($nametypequestion){
                $this->nametypequestion = $nametypequestion;    
        }
        
        public function setDescription($description){
                $this->description = $description;  
        }
        
        # geters
        public function getNameTypeQuestion(){
                return $this->nametypequestion;     
        }
        
        public function getDescription(){
                return $this->description;    
        }
       
}

?>