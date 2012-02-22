<?

class Functions{
        
        public function createPassword($quantidade){
                for($i = 0; $i < $quantidade; $i++){
                        return rand(1, $quantidade);
                }
        }
        
}


?>