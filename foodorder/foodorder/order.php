

<?php 
include('partials-front/menu.php'); 
include('logincheck.php'); 
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check whether food id is set or not
if(isset($_GET['food_id']))
{
    // Get the Food id and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);
    // Check whether the data is available or not
    if($count==1)
    {
        // We have data
        // Get the data from Database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        // Food not available
        // Redirect to Home Page
        header('location:'.SITEURL);
        exit;
    }
}
else
{
    // Redirect to homepage
    header('location:'.SITEURL);
    exit;
}
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order" onsubmit="return validateForm()">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    // Check whether the image is available or not
                    if($image_name=="")
                    {
                        // Image not available
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        // Image is available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">Rs. <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. MealMate" class="input-responsive" pattern="[A-Za-z\s]+"value="<?php echo $_SESSION['user'] ?>" title="Name should only contain letters and spaces" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9471xxxxxx" class="input-responsive" pattern="\d{10}" title="Phone number should be 10 digits" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@mealmate.com" class="input-responsive" value="<?php echo $_SESSION['email'] ?>" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
        // Check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
            // Get all the details from the form
            $food = mysqli_real_escape_string($conn, $_POST['food']);
            $price = floatval($_POST['price']);
            $qty = intval($_POST['qty']);
            
            // Server-side validation
            $errors = [];

            if($qty <= 0) {
                $errors[] = "Quantity must be a positive number.";
            }

            if(!preg_match("/^[A-Za-z\s]+$/", $_POST['full-name'])) {
                $errors[] = "Name should only contain letters and spaces.";
            }

            if(!preg_match("/^\d{10}$/", $_POST['contact'])) {
                $errors[] = "Phone number should be 10 digits.";
            }

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if(empty($errors)) {
                $total = $price * $qty; // total = price x qty 
                $order_date = date("Y-m-d H:i:s"); // Order Date
                $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
                $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                // Save the Order in Database
                // Create SQL to save the data
                $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                // Debug the SQL query
                // echo $sql2; die();

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether query executed successfully or not
                if($res2 == true)
                {
                    // Query Executed and Order Saved
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                    exit;
                }
                else
                {
                    // Failed to Save Order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                    header('location:'.SITEURL);
                    exit;
                }
            } else {
                foreach($errors as $error) {
                    echo "<div class='error text-center'>$error</div>";
                }
            }
        }
        ?>

    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

<script>
function validateForm() {
    var qty = document.forms["order"]["qty"].value;
    var name = document.forms["order"]["full-name"].value;
    var contact = document.forms["order"]["contact"].value;
    var email = document.forms["order"]["email"].value;

    if (qty <= 0) {
        alert("Quantity must be a positive number.");
        return false;
    }

    var namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(name)) {
        alert("Name should only contain letters and spaces.");
        return false;
    }

    var contactPattern = /^\d{10}$/;
    if (!contactPattern.test(contact)) {
        alert("Phone number should be 10 digits.");
        return false;
    }

    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Invalid email format.");
        return false;
    }

    return true;
}
</script>
