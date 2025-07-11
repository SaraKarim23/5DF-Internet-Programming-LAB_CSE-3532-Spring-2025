<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Transaction.css">

</head>
<body>

<div class="container">

    <form action="transactionconnect.php" method="post">

        <div class="row">

            <div class="col">

                <h2 class="title">billing address</h2>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="" name="fullname">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="" name="email">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="" name="address">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="" name="city">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>phone:</span>
                        <input type="text" placeholder="" name="phone">
                    </div>
                    <div class="inputBox">
                        <span>state:</span>
                        <input type="text" placeholder="" name="state">
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="assets/images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="" name="cardname">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="" name="creditnumber">
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" placeholder="" name="expmonth">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>zip Code:</span>
                        <input type="text" placeholder="" name="zip">
                    </div>
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="" name="expyear">
                    </div>
                    
                </div>

            </div>
    
        </div>

        <input type="submit" value="proceed to checkout" class="submit-btn">
    </form>

</div>    
    
</body>
</html>