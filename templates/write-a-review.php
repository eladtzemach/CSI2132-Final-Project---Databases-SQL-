<?php require 'header.php' ?>
<!-- Begin the add a review form -->
<div class="row">
  <div class="large-12 columns">
    <div id="registration" class="text-center">
      <form id='write-a-review' action='process-a-user-review.php' method='post' accept-charset='UTF-8'>
          <h3>Write a review</h3>
          <select name="restaurantid">
              <option value="">Please select a restaurant</option>
              <?php foreach ($restaurants as $restaurant): ?> 
                <?php $restaurantName = $restaurant['name'];
                      $restaurantID   = $restaurant['restaurantid']; ?>
                <option value="<?php echo $restaurantID ?>"><?php echo $restaurantName ?></option>
              <?php endforeach ?>
          </select>
          <div class="row" id="radio-buttons">
            <div class="large-12 columns">
              <label>Please rate the Price</label>
              <input type="radio" name="price" value="1" id="price1"><label for="price1">1</label>
              <input type="radio" name="price" value="2" id="price2"><label for="price2">2</label>
              <input type="radio" name="price" value="3" id="price3"><label for="price3">3</label>
              <input type="radio" name="price" value="4" id="price4"><label for="price4">4</label>
              <input type="radio" name="price" value="2" id="price5"><label for="price5">5</label>
            </div>
            <div class="large-12 columns">
              <label>Please rate the Food</label>
              <input type="radio" name="food" value="1" id="food1"><label for="food1">1</label>
              <input type="radio" name="food" value="2" id="food2"><label for="food2">2</label>
              <input type="radio" name="food" value="3" id="food3"><label for="food3">3</label>
              <input type="radio" name="food" value="4" id="food4"><label for="food4">4</label>
              <input type="radio" name="food" value="2" id="food5"><label for="food5">5</label>
            </div>
            <div class="large-12 columns">
              <label>Please rate the Mood</label>
              <input type="radio" name="mood" value="1" id="mood1"><label for="mood1">1</label>
              <input type="radio" name="mood" value="2" id="mood2"><label for="mood2">2</label>
              <input type="radio" name="mood" value="3" id="mood3"><label for="mood3">3</label>
              <input type="radio" name="mood" value="4" id="mood4"><label for="mood4">4</label>
              <input type="radio" name="mood" value="2" id="mood5"><label for="mood5">5</label>
            </div>
            <div class="large-12 columns">
              <label>Please rate the Staff</label>
              <input type="radio" name="staff" value="1" id="staff1"><label for="staff1">1</label>
              <input type="radio" name="staff" value="2" id="staff2"><label for="staff2">2</label>
              <input type="radio" name="staff" value="3" id="staff3"><label for="staff3">3</label>
              <input type="radio" name="staff" value="4" id="staff4"><label for="staff4">4</label>
              <input type="radio" name="staff" value="2" id="staff5"><label for="staff5">5</label>
            </div>
            <div class="large-12 columns">
              <label>Please rate the Staff's Helpfulness</label>
              <input type="radio" name="helpfulness" value="1" id="helpfulness1"><label for="helpfulness1">1</label>
              <input type="radio" name="helpfulness" value="2" id="helpfulness2"><label for="helpfulness2">2</label>
              <input type="radio" name="helpfulness" value="3" id="helpfulness3"><label for="helpfulness3">3</label>
              <input type="radio" name="helpfulness" value="4" id="helpfulness4"><label for="helpfulness4">4</label>
              <input type="radio" name="helpfulness" value="2" id="helpfulness5"><label for="helpfulness5">5</label>
            </div>
            <div class="large-12 columns">
              <label>Please rate Overall</label>
              <input type="radio" name="overall" value="1" id="overall1"><label for="overall1">1</label>
              <input type="radio" name="overall" value="2" id="overall2"><label for="overall2">2</label>
              <input type="radio" name="overall" value="3" id="overall3"><label for="overall3">3</label>
              <input type="radio" name="overall" value="4" id="overall4"><label for="overall4">4</label>
              <input type="radio" name="overall" value="2" id="overall5"><label for="overall5">5</label>
            </div>
          </div>
          <input type='hidden' name='submitted' id='submitted' value='1'/>
          <div class="large-12 columns">
              <textarea name="comments" rows=5 placeholder="Please enter your comments..."></textarea>
          </div>
          <input type='hidden' name='userid' id='userid' value='<?php echo $userid ?>'/>
          <input type='submit' name='Submit' value='Submit' class="button success" />
      </form>
    </div>
  </div> 
</div> 
<!-- End the add a review form -->
<?php require 'footer.php' ?>