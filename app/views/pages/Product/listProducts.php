<html lang="en">
<head>
    <title>List Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
</head>
<body>
<div class="main">
    <h2>List of Products</h2>
<hr>

<div class="container">
    <form action="<?php echo URLROOT; ?>/products/delete" method="POST" onsubmit="return boxCheck()">
    <div id="errorMsg"></div>
    <div class="product__list">
    <?php foreach($data['products'] as $product):?>
        <div class="product">
            <div class="product__checkbox">
            <input id="checkbox" type="checkbox" name="chk[]" value="<?php echo $product->product_sku ?>">
            </div>
            <div class="product__details">
                <p><?php echo $product->product_sku; ?></p> 
                <p><?php echo $product->product_name; ?></p> 
                <p>$<?php echo $product->product_price; ?></p> 
                <p><?php echo $product->product_type; ?></p>
                <?php if($product->product_type == "dvd"): ?>
                    <p>Size:<?php echo $product->product_size; ?></p>
                <?php endif; ?>
                <?php if($product->product_type == "book"): ?>
                    <p>Weight:<?php echo $product->product_weight; ?></p>
                <?php endif; ?>
                <?php if($product->product_type == "furniture"): ?>
                    <p>Dimensions: 
                        <?php echo $product->product_height; ?> X
                        <?php echo $product->product_width; ?> X
                        <?php echo $product->product_length; ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <button class="product__deleteBtn btn btn-info" type="submit" value="mass delete" name="delete">Mass Delete</button>
    </form>
    <button class="product__addProductBtn btn btn-info" onclick="window.location.href='<?php echo URLROOT; ?>/products/addProduct'">Add Product</button>
</div>
</div>
<?php
    require APPROOT . '/views/includes/footer.php';
?>
<script>
    function boxCheck(){
        var checkbox = document.getElementsByName('chk[]');
        let ln = 0;
        
        for(let i=0; i< checkbox.length; i++) {
            if(checkbox[i].checked)
                ln++
        }
        if(ln == 0){
            document.getElementById("errorMsg").innerText = "Please select a product to delete.";
            return false; 
        }
       
        
    }
</script>
</body>
</html>

