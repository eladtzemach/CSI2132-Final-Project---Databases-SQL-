<?php 
  require_once 'header.php';
  session_destroy(); 
?>
<!-- Begin Create an account form -->
<div class="row">
  <div class="large-12 columns">
    <div id="registration" class="text-center">
      <form id='register' action='registration.php' method='post' accept-charset='UTF-8'>
          <h3>Create an account</h3>
          <input type='hidden' name='submitted' id='submitted' value='1'/>
          <input type='text' name='name' id='name' maxlength="50"                 placeholder="Your Name"/>
          <input type='text' name='email' id='email' maxlength="50"               placeholder="Your Email Address"/>
          <!-- <input type='password' name='password' id='password' maxlength="50"     placeholder="Choose a Password"/> 
          <input type='password' name='re-password' id='password' maxlength="50"  placeholder="Re-enter a Password"/> -->
          <select name="raterType">
              <option value="">Please select your rater type</option>
              <?php foreach ($raterEnums as $raterEnum): ?> 
                <?php $raterEnum = $raterEnum['unnest'] ?>
                <option value="<?php echo $raterEnum ?>"><?php echo $raterEnum ?></option>
              <?php endforeach ?>
          </select>
          <input type='hidden' name='userid' id='userid' value='<?php echo $userid ?>'/>
          <input type='submit' name='Submit' value='Submit' class="button expand" />
      </form>
    </div>
  </div> 
</div> 
<!-- End Create an account form -->
<?php require_once 'footer.php' ?>