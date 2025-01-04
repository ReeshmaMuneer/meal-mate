<?php include('partials-front/menu.php'); ?>

<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Contact Us Form  | CodingLab </title>
    <link rel="stylesheet" href="css/contact.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

  <div class="bg">
  <section class="container menus">
    <h2 class="menus" >About Us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec diam euismod, laoreet dui ut, auctor ipsum. Donec euismod bibendum laoreet. Nullam pulvinar leo vitae magna aliquam eleifend. Pellentesque eget orci semper, venenatis magna sit amet, tincidunt odio. Donec euismod bibendum laoreet. Nullam pulvinar leo vitae magna aliquam eleifend.</p>
    <span></span>
  </section>
  </div>

  <div class="co">
  <div class=" imgs ">
    <img src="images/logo.png" class="img-responsive" alt="" />
  </div>

  <div class="containe  form ">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">South Eastern University of Sri Lanka,</div>
          <div class="text-two"> University Park, Oluvil.</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+94-714564214</div>
          <div class="text-two">+94-754565214</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">mealmate.@gmail.com</div>
          <div class="text-two">mealmatecs@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>If you have  Have questions about our menu or want to place an order over the phone? Reach out to us!. It's my pleasure to help you.
        
        </p>
      <form action="#">
        <div class="input-box">
          <input type="text" placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" placeholder="Enter your email">
        </div>
        <div class="input-box message-box">
            <textarea placeholder="Enter your message"></textarea>
        </div>
        <div class="button">
        <a href="<?php echo SITEURL; ?>thanks.php?"><input type="button" value="Send Now" ></a>
        </div>
      </form>
    </div>
    </div>
  </div>

  </div>
</body>
</html>

<?php include('partials-front/footer.php'); ?>
