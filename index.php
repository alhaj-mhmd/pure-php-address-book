 <?php $page_title = "Home"; require_once 'header.php'; ?>

 <?php session_start();
  include('nav.php'); ?>
 <div class="container-fluid mb-5">
   <div class="row">
     <div class="col-12 text-center">
       <h1 class="my-4">
         Welcome To My Website
       </h1>
       <h2 class="my-3 text-info">simple pure php phonebook project</h2>
       <h3 class="text-danger mb-5">
        Mohammad Ali
       </h3>
     </div>
     <div class="col-4"></div>
     <div class="col-4 text-center">
       <img src="img/mali.jpg" alt="Mohammad Ali" class="img-rounded" width="500" height="500">
     </div>
     <div class="col-4"></div>
   </div>
 </div>

 <?php require_once 'footer.php'; ?>
 