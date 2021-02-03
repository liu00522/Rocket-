<?php
  /* Admin is logged in */  
  $_SESSION['username'] = "Admin";

  /* include header.php */
  include ('template/header.php');

  /* include product_page.php */
  include ('template/product_page.php');

  /* include footer.php */
  include ('template/footer.php');
?>