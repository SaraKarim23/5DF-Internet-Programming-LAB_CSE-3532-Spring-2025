<?php include( "partials-front/menu.php" ) ?>; 

    
   <!-- <section class="food-search text-center ">
        <div class="container">
            
           
</section>-->
    <?php
        $order = isset( $_SESSION['contact_status'] ) ?  $_SESSION['contact_status'] : '';
        echo $order;
        unset( $_SESSION['contact_status'] );
    ?>
    <br>
        <h1 style="text-align: center;color:purple;">Contact Us</h1>
        <?php
        $message = isset($_SESSION['add']) ? $_SESSION['add'] : '';
        echo $message;
        unset($message);
        ?>
    <div class="container" style="width: 50%;margin-top:2%;background:lightgray">
    
        <form action="" method="POST">
        <h2 class="text-center">Fill this form to confirm your Contact.</h2>
            <label for="fullname" class="order-label">Full Name</label>
            <input type="text" name="full_name" placeholder="Enter Full Name" class=""><br><br>

            <label for="email" class="order-label">Email</label>
            <input type="email" name="email" placeholder="Enter Email Address" class=" "><br><br>


            <label for="Message" class="order-label">Message</label><br>
            <textarea name="message" placeholder="Enter your message" class="input-responsive" id="message" cols="30" rows="10" ></textarea>
<br>
<br>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary" >
        </form><br><br>
        <br>

        <a href="./index.html" class="btn btn-primary">Back to Homepage </a>
        </div>
</div>
<?php
            if( isset( $_POST['submit'] ) ) {
                // if ($_POST['full_name'] == '' or  $_POST['email'] ='' or $_POST['message'] ='') {
                    // $_SESSION['contact_status'] = '<br><div class="success" style="color:red;text-align:center">Please Fill all fields!</div>';
                    // header("location:".SITEURL."contact.php");
                    // return false;
                // }
                $full_name  = isset($_POST['full_name']) ? $_POST['full_name']: '';
                $email      =isset( $_POST['email']) ? $_POST['email'] : '';
                $message    = isset($_POST['message']) ? $_POST['message'] : '';
                $sql = "INSERT into resto_contact (full_name, email, message) VALUES ( '$full_name','$email','$message')";
                $result = mysqli_query( $conn, $sql );

                if( $result ) {
                    $_SESSION['contact_status'] = '<br><div class="success" style="color:blue;text-align:center">Submited Successfully!</div>';
                    header("location:".SITEURL."contact.php");
                } else {
                    $_SESSION['contact_status'] = '<br><div class="success" style="color:red;text-align:center">Failed To Submit!</div>';
                    header("location:".SITEURL."contact.php");
                }
            }
        ?>

