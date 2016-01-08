<?php require_once 'header.php' ?>
<!-- Begin Add Restaurant form -->
<div class="row">
  <div class="large-12 columns">
    <div id="restaurant-suggestion">
      <form id='restaurant-suggestion' action='add-a-restraurant-suggestion.php' method='post' accept-charset='UTF-8'>
          <h3>Add Restaurant</h3>
          uOttawa Urban spoon is your guide to bars and restaurants open to the general public. Let us know if we're missing info about your favourite place. (Please note that we do not list delivery services, caterers, or other similar businesses.)
          <input type='hidden' name='submitted' id='submitted' value='1'/>
          <input type='hidden' name='restaurantid' id='restaurantid' value='<?php echo $restaurantid ?>'/>
          <input type='text'  name='Name' id='Name' maxlength="50"                 placeholder="Restaurant Name"/>
          <select name="Type">
              <option value="">Please select restaurant type</option>
              <?php foreach ($restaurantTypeEnums as $restaurantTypeEnum): ?> 
                <?php $restaurantTypeEnum = $restaurantTypeEnum['unnest'] ?>
                <option value="<?php echo $restaurantTypeEnum ?>"><?php echo $restaurantTypeEnum ?></option>
              <?php endforeach ?>
          </select>
          <input type='text'  name='URL' id='URL' maxlength="50"               placeholder="Restaurant Website"/>
          <input type='hidden' name='locationid' id='locationid' value='<?php echo $locationid ?>'/>
          <input type='text'  name='First_Open_Date' id='First_Open_Date' maxlength="50"                 placeholder="Restaurant Established Date"/>
          <input type='text'  name='Manager' id='Manager' maxlength="50"                 placeholder="Restaurant Manager"/>
          <input type='text'  name='Phone_Number' id='Phone_Number' maxlength="50"                 placeholder="Restaurant Phone Number"/>
          <input type='text'  name='Street_Address' id='Street_Address' maxlength="50"                 placeholder="Restaurant Address"/>
          <input type='text'  name='Hour_Open' id='Hour_Open' maxlength="50"                 placeholder="Restaurant Hours Open"/>
           <input type='text'  name='Hour_Close' id='Hour_Close' maxlength="50"                 placeholder="Restaurant Hours Close"/>
          <input type='submit' name='Suggest Restaurant' value='Suggest Restaurant' class="button success" />
      </form>
    </div>
  </div> 
</div> 
<!-- End Add Restaurant form -->
<?php require_once 'footer.php' ?>