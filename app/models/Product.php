  <?php
    class Product {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function addProduct($data){
            if($data['product_type'] == "dvd"){
                $this->db->query('INSERT INTO products (product_sku, product_name, product_price, product_type) VALUES(:product_sku, :product_name, :product_price, :product_type); 
                    INSERT INTO type_dvd (product_sku, product_size) VALUES(:product_sku, :product_size)
                ');
   
                $this->db->bind(':product_sku', $data['product_sku']);
                $this->db->bind(':product_name', $data['product_name']);
                $this->db->bind(':product_price', $data['product_price']);
                $this->db->bind(':product_type', $data['product_type']);
                $this->db->bind(':product_size', $data['product_size']);
            }

            else if($data['product_type'] == "book"){
                $this->db->query('INSERT INTO products (product_sku, product_name, product_price, product_type) VALUES(:product_sku, :product_name, :product_price, :product_type); 
                INSERT INTO type_book (product_sku, product_weight) VALUES(:product_sku, :product_weight)
            ');

            $this->db->bind(':product_sku', $data['product_sku']);
            $this->db->bind(':product_name', $data['product_name']);
            $this->db->bind(':product_price', $data['product_price']);
            $this->db->bind(':product_type', $data['product_type']);
            $this->db->bind(':product_weight', $data['product_weight']);
            }

            else if($data['product_type'] == "furniture"){
                $this->db->query('INSERT INTO products (product_sku, product_name, product_price, product_type) VALUES(:product_sku, :product_name, :product_price, :product_type); 
                INSERT INTO type_furniture (product_sku, product_height, product_width, product_length) VALUES(:product_sku, :product_height, :product_width, :product_length)
            ');

            $this->db->bind(':product_sku', $data['product_sku']);
            $this->db->bind(':product_name', $data['product_name']);
            $this->db->bind(':product_price', $data['product_price']);
            $this->db->bind(':product_type', $data['product_type']);
            $this->db->bind(':product_height', $data['product_height']);
            $this->db->bind(':product_width', $data['product_width']);
            $this->db->bind(':product_length', $data['product_length']);
            }


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
        public function getProducts(){
            $this->db->query(' SELECT * FROM products AS p
            INNER JOIN type_book AS tb ON p.product_sku = tb.product_sku;
            ');

            $result1 = $this->db->resultset();

            $this->db->query(' SELECT * FROM products AS p
            INNER JOIN type_dvd AS td ON p.product_sku = td.product_sku');

            $result2 = $this->db->resultset();

            $this->db->query(' SELECT * FROM products AS p
            INNER JOIN type_furniture AS tf ON p.product_sku = tf.product_sku');

            $result3 = $this->db->resultset();

            $result = array_merge($result1, $result2, $result3);

            return $result;
        }

        public function delete($chk){
            for($i=0; $i<sizeof($chk); $i++){
                $this->db->query("DELETE FROM products WHERE product_sku in('$chk[$i]')");
                $this->db->execute();
            }

            // $this->db->query("DELETE FROM products WHERE product_sku in($a)");
            // if ($this->db->execute()) {
            //     return true;
            // } else {
            //     return false;
            // }
        }

    }