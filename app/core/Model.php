<?php 

trait Model {
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = 'desc';
    protected $order_column = 'id';
    public $errors = [];

    public function findAll() {

        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

    public function where($data,$data_not = []) {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach($keys as $key){
            $query .= $key . " = :" . $key . " && ";
        }

        foreach($keys_not as $key){
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query," && ");
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        show($query);
        $data = array_merge($data,$data_not);

        return $this->query($query,$data);
    }

    public function first($data,$data_not = []) {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query="SELECT * FROM $this->table WHERE ";

        foreach($keys as $key){
            $query .= $key . " = :" . $key . " && ";
        }

        foreach($keys_not as $key){
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query," && ");
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data,$data_not);

        $result = $this->query($query,$data);

        if($result){
            return $result[0];
        }
        return false;

    }

    public function insert($data) {

        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".  implode(",",$keys).") VALUES (:". implode(",:", $keys). ")";

        $this->query($query,$data);
        return false;
    }

    public function update($id, $data, $id_column = 'id') {

        //remove unwanted data
        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach($keys as $key){
            $query .= $key . " = :". $key . ", ";
        }
        $query = trim($query,", ");

        $query .= " WHERE $id_column = :$id_column";
        
        $data[$id_column] = $id;
        //echo $query;
        $this->query($query, $data);

        return false;

    }

    public function delete($id, $id_column = 'id') {

        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        $this->query($query,$data);
        //echo $query;
        return false;
    }

    public function firstById($id) {

        $query = "SELECT * FROM $this->table WHERE id = :id";

        $data = ['id' => $id];

        // Execute the query
        $result = $this->query($query, $data);

        // Check if a result is found
        if ($result) {
            return $result[0]; // Return the first result
        }

        return false; // Return false if no result
        }

        public function getUsersByRole($role, $joinTable) {

            $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role 
                        FROM users u 
                        JOIN $joinTable p ON u.id = p.userID 
                        WHERE p.user_role = :user_role 
                        LIMIT $this->limit OFFSET $this->offset";
        
            // Bind the provided role to the query
            $data = ['user_role' => $role];
        
            $result = $this->query($query, $data);
        
            if($result){
                return $result;
            }else{
                return [];
            }
        }

        public function searchByTerm($searchTerm, $role,  $joinTable ) {
            // Sanitize the search term
            $searchTerm = $searchTerm['searchTerm'];
        
            // Query with dynamic role and search term
                $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role
                    FROM users u
                    JOIN profile p ON u.id = p.userID
                    WHERE p.user_role = 'singer'
                    AND (
                        u.name LIKE '%$searchTerm%' OR
                        p.biography LIKE '%$searchTerm%' OR
                        p.music_genres LIKE '%$searchTerm'OR
                        p.past_works LIKE '%$searchTerm%' OR
                        p.services LIKE '%$searchTerm%' OR
                        p.specializations LIKE '%$searchTerm%' OR
                        p.equipment LIKE '%$searchTerm%'
                )";
        
            // // Bind the role and search term
            // $data = [
            //     'user_role' => $role,
            //     'searchTerm' => $searchTerm,
            // ];
        
            // Execute the query and return results
            $result = $this->query($query);
        
            // Return an array, either with results or empty
            if($result){
                return $result;
            }else{
                return [];
            }
        }
        
        
}