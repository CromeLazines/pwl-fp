<?php 
    include("partial/header.php");
    include("env.php");
    include("partial/menu.php");
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    $title = $row['title'];
    $price = $row['price'];
    $image_name=$row['image_name'];
?>
<?php
            if(isset($_POST['submit']))
            {
                // Get all the details from the form

                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // total = price x qty 

                date_default_timezone_set("Asia/Jakarta");
                $order_date = date("Y-m-d h:i:sa"); //Order DAte

                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];
                $customer_bank = $_POST['bank'];


                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "INSERT INTO `tbl_order` 
                (`food`,
                `price`,
                `qty`,
                `total`,
                `order_date`,
                `status`,
                `customer_name`,
                `customer_contact`,
                `customer_email`,
                `customer_address`,
                `customer_bank`) VALUES( 
                '".$food."',
                '".$price."',
                '".$qty."',
                '".$total."',
                '".$order_date."',
                '".$status."',
                '".$customer_name."',
                '".$customer_contact."',
                '".$customer_email."',
                '".$customer_address."',
                '".$customer_bank."')";

                //echo $sql2; die();

                //Execute the Query
                $result = $con->query($sql2);
                //Check whether query executed successfully or not
                if(!$result){
                    trigger_error('Invalid query: ' . $con->error);
                    exit;
                }else{
                    session_start();
                    ?><div class="alert alert-success">Data Berhasil di tambahkan.</div><?php
                }

            }
        ?>
<section class="food-search">
        <div class="container">
            <div class="row">
            <h2 class="text-center text-white">Selesaikan Pesananmu</h2>

<form action="" method="POST" class="row g-3">
    <fieldset>
        <legend>Pilihan Makanan</legend>

        <div class="food-menu-img">
            <?php 
            
                //CHeck whether the image is available or not
                if($image_name=="")
                {
                    //Image not Availabe
                    echo "<div class='error'>Image not Available.</div>";
                }
                else
                {
                    //Image is Available
                    ?>
                    <img src="img/assets/<?php echo $image_name; ?>" style="height: 150px;width:150px" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                }
            
            ?>
            
        </div>

        <div class="food-menu-desc">
            <h3><?php echo $title; ?></h3>
            <input type="hidden" name="food" value="<?php echo $title; ?>">

            <p class="food-price"><?php echo $price; ?></p>
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <div class="order-label">Quantity</div>
            <input type="number" name="qty" class="form-control" value="1" required>
            
        </div>

    </fieldset>
    
    <fieldset>
        <legend>Delivery Details</legend>
        <div class="form-outline mb-4">
            <input type="text" name="full-name" id="full-name" placeholder="Nama" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
            <input type="tel" name="contact" id="contact" placeholder="No. Telpon" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="email" id="email" placeholder="Email" class="form-control" />
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="address" id="address" placeholder="Alamat" class="form-control" />
        </div>
        <select class="form-select" name="bank" id="bank" aria-label="Default select example">
            <option selected>Bank</option>
            <option value="BNI">BNI</option>
            <option value="BRI">BRI</option>
            <option value="Mandiri">Mandiri</option>
        </select>
        <br>
        <button type="submit" name="submit" value="Konfirmasi Pesanan" class="btn btn-primary btn-block mb-4">Konfirmasi Pesanan</button>
    </fieldset>

</form>
            </div>
        </div>
</section>
<?php include("partial/footer.php")?>