<div class="bg-light-gray font-weight__500 hero my-4 py-3">
  <div class="lg-space"></div>
  <div class="container hero-inner">
    <div class="row align-items-center">
      <div class="col-12 col-lg-8 mx-lg-auto box">
        <h3 class="pb-1 pt-2">Add Menu Item</h3>
        <?php if($this->session->flashdata('add_item_status')): ?>
            <?php $flash = $this->session->flashdata('add_item_status');
            echo ' <div class="alert text-center animated headShake alert-'.$flash['type'].'" role="alert">'.$flash['message'].'</div>'; ?>
        <?php endif; ?>
        <?php echo validation_errors('<div class="alert text-center alert-danger animated headShake">', '</div>'); ?>
        <?php echo form_open('restaurant/add_item'); ?>
          <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" id="item_name" name="item_name" class="form-control rounded-pill" placeholder="Enter food/item name" required>
          </div>
          <div class="form-group">
            <label for="item_name">Item Type</label>
            <select id="type" name="type" class="custom-select rounded-pill" required>
              <option disabled="" selected="" value="">Select Item Type</option>
              <option value="veg">Veg</option>
              <option value="non-veg">Non Veg</option>
            </select>
          </div>
          <div class="form-group pb-2">
            <label for="item_name">Item Price</label>
            <input type="number" id="price" name="price" min="1" class="form-control rounded-pill" placeholder="Item price" required>
          </div>
          <button class="btn btn-primary rounded-pill btn-block text-uppercase" type="submit">Save</button>
        </form>
      </div>
    </div>
    <div class="lg-space"></div>
  </div>
</div>