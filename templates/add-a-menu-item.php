<?php require_once 'header.php' ?>
<!-- Begin add a menu item form -->
<div class="row">
  <div class="large-12 columns">
    <div id="add-a-menu-item" class="text-center">
      <form id='add-a-menu-item' action='add-a-menu-item.php' method='post' accept-charset='UTF-8'>
          <h3>Add a Menu Item</h3>
          <table class="large-12 columns">
            <caption>Current Menu at <?php echo $restaurantName ?></caption>
            <tr>
              <th>Menu Item</th>
              <th>Item Type</th>
              <th>Item Category</th>
              <th>Price</th>
            </tr>
              <?php foreach ($restaurantMenuItems as $restaurantMenuItem): ?> 
                <tr>
                  <td><?php echo $restaurantMenuItem['name'] ?></td>
                  <td><?php echo $restaurantMenuItem['type'] ?></td>
                  <td><?php echo $restaurantMenuItem['category'] ?></td>
                  <td><?php echo $restaurantMenuItem['price'] ?></td>
                </tr>
              <?php endforeach ?>
          </table>
          <input type='hidden' name='submitted' id='submitted' value='1'/>
          <input type='hidden' name='itemid' id='itemid' value='<?php echo $itemId ?>'/>
          <input type='text' name='name' id='name' maxlength="50"                 placeholder="Menu Item Name"/>
          <select name="item-type">
              <option value="">Please select the item type</option>
              <?php foreach ($itemEnums as $itemEnum): ?> 
                <?php $itemEnum = $itemEnum['unnest'] ?>
                <option value="<?php echo $itemEnum ?>"><?php echo $itemEnum ?></option>
              <?php endforeach ?>
          </select>
          <select name="item-category">
              <option value="">Please select the item category</option>
              <?php foreach ($itemCategoryEnums as $itemCategoryEnum): ?> 
                <?php $itemCategoryEnum = $itemCategoryEnum['unnest'] ?>
                <option value="<?php echo $itemCategoryEnum ?>"><?php echo $itemCategoryEnum ?></option>
              <?php endforeach ?>
          </select>
          <textarea name="description" rows=5 placeholder="Please enter the item description..."></textarea>
          <input type='text' name='price' id='price' maxlength="6"                 placeholder="Menu Item Price XX.XX"/>
          <input type='hidden' name='restaurantid' id='restaurantid' value='<?php echo $restaurantId ?>'/>
          <input type='submit' name='Submit' value='Add a new item' class="button success" />
      </form>
    </div>
  </div> 
</div> 
<!-- End add a menu item form -->
<?php require_once 'footer.php' ?>