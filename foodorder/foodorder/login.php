<?php include('./config/constants.php'); ?>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <link rel="stylesheet" href="./login.css">

</head>
<body>

<!-- partial:index.partial.html -->
<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
						<form action="" id="Form" method="POST">
							<?php 
								if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
								{
									echo $_SESSION['add']; //Display the SEssion Message if SEt
									unset($_SESSION['add']); //Remove Session Message
								}
							?>
							
						<div class="input-group">
							<img src="images/logo.png" alt="Restaurant Logo" class="logo1" >
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="fuculty" placeholder="Faculty" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="year" placeholder="Year" required>
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="email" name="email" placeholder="Email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" id="password" placeholder="Password" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
						</div>
                     		<button name="sub">
							 	Sign up
							</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
						</form>

					</div>
				</div>
			
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">

					<div class="form sign-in">
						<form action="" method="POST">
						<?php 
							if(isset($_SESSION['login']))
							{
								echo $_SESSION['login'];
								unset($_SESSION['login']);
							}

							if(isset($_SESSION['no-login-message']))
							{
								echo $_SESSION['no-login-message'];
								unset($_SESSION['no-login-message']);
							}
						?>
						<div class="input-group">
							<img src="images/logo.png" alt="Restaurant Logo" class="logo1" >
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username">
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Password">
						</div>
						<button name="submit">
							Sign in
						</button>
						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
						</form>
					</div>
				</div>

				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->

		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
					
				</div>
				<div class="img sign-in">
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
<!-- partial -->
  <script  src="./login.js"></script>



   



<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
        //3. Execute the Query
        $res = mysqli_query($conn, $sql);
		$id;
		$email;
		if($res){
			$row = mysqli_fetch_assoc($res);
			if($row){
				 $id=$row['id'];
				 $email=$row['email'];
			}
		}	
        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it
            $_SESSION['id'] = $id; //TO check whether the user is logged in or not and logout will unset it
            $_SESSION['email'] = $email; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'./index.php?id='.$id );
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'./login.php');
        }


    }

?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['sub']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $username = $_POST['username'];
		$fuculty=$_POST['fuculty'];
		$year=$_POST['year'];
		$email=$_POST['email'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        $cpassword = md5($_POST['cpassword']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
		if($password == $cpassword){

			$sql = "INSERT INTO tbl_user SET 
            username='$username',
			fuculty='$fuculty',
			year='$year',
			email='$email',
            password='$password'
        	";

			//3. Executing Query and Saving Data into Datbase
			$res = mysqli_query($conn, $sql) or die(mysqli_error());
		
		}
        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['login'] = "<div class='success'>User Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'./login.php');
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['login'] = "<div class='error'>Failed to Add User.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'./login.php');
        }

    }
    
?>

</body>
</html>
