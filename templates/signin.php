
<?php require 'header.php' ?>
<!-- Begin Create an account form -->
<div class="row">
  <div class="large-12 columns">
    <div id="signin" class="text-center">
      <form id='signin' action='signin.php' method='post' accept-charset='UTF-8'>
          <h3>Sign In</h3>
          <input type='hidden' name='submitted' id='submitted' value='1'/>
          <input type='text' name='name' id='name' maxlength="50"                 placeholder="Your Name"/>
          <input type='text' name='email' id='email' maxlength="50"               placeholder="Your Email Address"/>
          <!-- <input type='password' name='password' id='password' maxlength="50"     placeholder="Choose a Password"/>  -->
          <input type='submit' name='Sign In' value='Sign In' class="button success expand" />
      </form>
    </div>
  </div> 
</div> 
<!-- End Create an account form -->
<?php require 'footer.php' ?>