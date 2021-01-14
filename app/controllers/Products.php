<?php
class Products extends Controller {
    
    public function __construct(){
        $this->productModel = $this->model('Product');
    }

    public function index(){

        $data=[
            'title' => 'Home page',
        ];

        $this->view('pages/index', $data);
    }

    public function addProduct(){
        $URLROOT = URLROOT;
        $data = [
            'title' => 'Add Product Page',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($_POST['product_type'] == "dvd"){
                $data = [
                    'product_sku' => trim($_POST['product_sku']),
                    'product_name' => trim($_POST['product_name']),
                    'product_price' => trim($_POST['product_price']),
                    'product_type' => trim($_POST['product_type']),
                    'product_size' => trim($_POST['product_size']),
                ];
            }

            else if($_POST['product_type'] == "book"){
                $data = [
                    'product_sku' => trim($_POST['product_sku']),
                    'product_name' => trim($_POST['product_name']),
                    'product_price' => trim($_POST['product_price']),
                    'product_type' => trim($_POST['product_type']),
                    'product_weight' => trim($_POST['product_weight']),
                ];
            }

            else if($_POST['product_type'] == "furniture"){
                $data = [
                    'product_sku' => trim($_POST['product_sku']),
                    'product_name' => trim($_POST['product_name']),
                    'product_price' => trim($_POST['product_price']),
                    'product_type' => trim($_POST['product_type']),
                    'product_height' => trim($_POST['product_height']),
                    'product_width' => trim($_POST['product_width']),
                    'product_length' => trim($_POST['product_length']),
                ];
            }

            $product = $this->productModel->addProduct($data);
            header("Location: $URLROOT/products/list");
        }
        else{
            $this->view('pages/product/addProduct');
        }
    }

    public function list(){
        $products = $this->productModel->getProducts();
        $data = [
            'products' => $products
        ];
        $this->view('pages/product/listProducts', $data);
    }

    public function delete(){
        $URLROOT = URLROOT;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $chk = $_POST['chk'];
            $deletedProducts = $this->productModel->delete($chk);
            header("Location: $URLROOT/products/list");

           
    }

}

}