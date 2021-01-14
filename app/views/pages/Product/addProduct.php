<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css" />
</head>
<body>
<div class="main">
<h2>Product Add</h2>
<hr>
<div class="container">
    <form action="<?php echo URLROOT; ?>/products/addProduct" method ="POST" onsubmit="return checkForBlank()">
        
        <div class="product_formElement">
        <label for="product_sku">SKU</label>
        <input type="text" name="product_sku" id="product_sku" class="form-control">
        <p id="skuTypeError" class="typeError"></p>
        </div>
        <div class="product_formElement">
        <label for="product_name">Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control">
        <p id="nameTypeError" class="typeError"></p>
        </div>
        <div class="product_formElement">
        <label for="product_price">Price($)</label>
        <input type="text" name="product_price" id="product_price" class="form-control">
        <p id="priceTypeError" class="typeError"></p>
        </div>
        
        
        <div class="product_formElement">
        <label for="productSwitcher">Type Switcher</label>
        <select id="product_type" name="product_type" class="btn btn-info">
            <option>Type Switcher</option>
            <option value="dvd">DVD</option>
            <option value="book">Book</option>
            <option value="furniture">Furniture</option>
        </select>
        <p id="selectError"></p>
        </div>
        <div class="product__formContent">
            <div id="dvd" class="data">
                <label for="product_size">Size (MB)</label>
                <input type="text" name="product_size" id="product_size" class="form-control">
                <p id="sizeTypeError" class="typeError"></p>
                <p>Please provide the Size of the disk </p>
            </div>
            <div id="book" class="data" >
                <label for="product_weight">Weight (KG)</label>
                <input type="text" name="product_weight" id="product_weight" class="form-control">
                <p id="weightTypeError" class="typeError"></p>
                <p>Please provide the weight of Book</p>
            </div>
            <div id="furniture" class="data">
                <div class="product_formElement">
                <label for="product_height">Height (CM)</label>
                <input type="text" name="product_height" id="product_height" class="form-control">
                <p id="heightTypeError" class="typeError"></p>
                </div>
                <div class="product_formElement">
                <label for="product_width">Width (CM)</label>
                <input type="text" name="product_width" id="product_width" class="form-control">
                <p id="widthTypeError" class="typeError"></p>
                </div>
                <div class="product_formElement">
                <label for="product_length">Length (CM)</label>
                <input type="text" name="product_length" id="product_length" class="form-control">
                <p id="lengthTypeError" class="typeError"></p>
                </div>
                <p>Please provide the dimensions - height, width, length</p>
            </div>
        </div>
       
        <button class="product__saveBtn btn btn-info" type="submit" id="submit" value="submit">Save</button>
    </form>
    <button class="product__cancleBtn btn btn-info" id="cancel" value="cancel" onclick="window.location.href='<?php echo URLROOT; ?>/products/list'">Cancel</button>
</div>
</div>
<?php
    require APPROOT . '/views/includes/footer.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function checkForBlank(){
        var change = document.getElementsByClassName("typeError");
        for (var i = 0; i < change.length; i++) {
        change[i].innerHTML = "";
        }
        let pt = document.getElementById("product_type");
        let selectedValue = pt.options[pt.selectedIndex].value;
        let typeError = false;
        let typeSelectError = false;
        let letters = /^[0-9a-zA-Z]+$/;
        let numbers = /^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/;

        if(!document.getElementById('product_sku').value.match(letters)){
            document.getElementById("skuTypeError").innerText = "*Required SKU field must contain alphabets and numbers only";
            typeError = true;
        }

        if(!document.getElementById('product_name').value.match(letters)){
            document.getElementById("nameTypeError").innerText = "*Required Name field must contain alphabets and numbers only";
            typeError = true;
        }

        if(!document.getElementById('product_price').value.match(numbers)){
            console.log("inside hte if of price");
            document.getElementById("priceTypeError").innerText = "*Required Price field must be a valid number upto 2 decimal places";
            typeError = true;
        }

        if(selectedValue == "Type Switcher"){
            document.getElementById('product_type').style.borderColor = "red";
            document.getElementById('selectError').innerText = "Please select a Product Type";
            typeSelectError = true;
        }

        if(!document.getElementById('product_size').value.match(numbers)  && selectedValue === "dvd"){
            document.getElementById("sizeTypeError").innerText = "*Required Size field must be a valid number";
            typeError = true;
        }

        if(!document.getElementById('product_weight').value.match(numbers)  && selectedValue === "book"){
            document.getElementById("weightTypeError").innerText = "*Required Weight field must be a valid number";
            typeError = true;
        }

        if(!document.getElementById('product_height').value.match(numbers) && selectedValue === "furniture"){
            document.getElementById("heightTypeError").innerText = "*Required Height field must be a valid number";
            typeError = true;
        }

        if(!document.getElementById('product_width').value.match(numbers) && selectedValue === "furniture"){
            document.getElementById("widthTypeError").innerText = "*Required Width field must be a valid number";
            typeError = true;
        }

        if(!document.getElementById('product_length').value.match(numbers)  && selectedValue === "furniture"){
            document.getElementById("lengthTypeError").innerText = "*Required Length field must be a valid number";
            typeError = true;
        }
        

        if(typeError === true || typeSelectError === true){
            return false;
        }

    }

    $(document).ready(function(){
        $('#product_type').on('change', function(){
            // alert($(this).val());
            $(".data").hide();
            $("#" + $(this).val()).fadeIn(100);
        });
    });
</script>


</body>

</html>







