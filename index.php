<?php
  /* Admin is logged in */
  $_SESSION['username'] = "Admin";

  /* include header.php */
  include ('template/header.php');

  /* include upload_page.php */
  include ('template/landing_page.php');

  /* include footer.php */
  include ('template/footer.php');
?>