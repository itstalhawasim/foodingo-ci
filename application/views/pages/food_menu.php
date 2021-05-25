<div class="bg-light-gray font-weight__500 hero my-4 py-3">
  <div class="lg-space"></div>
  <div class="container hero-inner">
    <?php if($this->session->flashdata('order_status')): ?>
      <?php $flash = $this->session->flashdata('order_status');
      echo ' <div class="alert text-center animated headShake alert-'.$flash['type'].'" role="alert">'.$flash['message'].'</div>'; ?>
    <?php endif; ?>
    <div class="row">
      <div class="col-12 col-lg-9 mt-5 mt-lg-0">
        <?php foreach ($items as $item) { 
          $item_restaurants = $this->restaurant_model->get_menu_items($item['item_name'], $item['type']);
        ?>
        <div class="jumbotron bg-transparent mt-3 mb-2 pb-4 <?=$item['type']?>-item-bg text-white">
          <div class="media mt-3">
            <div class="mr-3 mt-1 font-weight-bold text-<?=($item['type']=='veg')?'success veg':'danger non-veg'?>">&#9679;</div> 
            <h2 class="text-lg-left text-sm-center"><?=ucwords($item['item_name'])?></h2>
          </div>
        </div>
        <div class="row mx-0 mb-3">
        <?php foreach ($item_restaurants as $restaurant) { 
          $restaurant_info = $this->restaurant_model->get_restaurant($restaurant['restaurant_id']);
        ?>
          <div class="col-12 col-lg-4 col-md-6 pl-0 pr-2">
            <div class="box text-center rounded py-2 px-3 mb-5 mb-lg-0 mt-lg-2">
              <div class="text-center py-3">
                <h4 class="text-truncate"><?=ucwords($restaurant_info['full_name'])?></h4>
                <address><?=$restaurant_info['address']?></address>
                <p class="font-weight-bold">Price: ₹<?=$restaurant['price']?></p>
                <?php echo form_open('user/add_cart'); ?>
                  <input type="hidden" id="item_name" name="item_name" value="<?=$item['item_name']?>">
                  <input type="hidden" id="price" name="price" value="<?=$restaurant['price']?>">
                  <input type="hidden" id="restaurant" name="restaurant" value="<?=$restaurant_info['full_name']?>">
                  <button class="btn btn-success" type="submit">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
        <div class="sm-space"></div>
      <?php }
      if(empty($items)){ ?>
        <center><p>No items found, please check back later.</p></center>
      <?php } ?>
      </div>
      <div class="col-12 col-lg-3 mx-lg-auto">
        <div class="box is-sticky">
          <h3 class="pb-3 text-lg-left text-sm-center">Cart</h3>
          <?php 
            if(!empty($this->session->cart_items)){
              $total_amount = 0;
              $str_items = null;  
              foreach ($this->session->cart_items as $cart_item){ 
                foreach ($cart_item as $item => $key){
                  $total_amount += $key;
                  $str_items .= ', '.$item;?>
                  <p><?=$item?> <span class="float-right font-weight-bold">₹<?=$key?></span></p> 
          <?php }} ?>
            <hr>
            <p class="pt-2 font-weight-bold">Total <span class="float-right font-weight-bold">₹<?=$total_amount?></span></p> 
            <?php echo form_open('user/place_order'); ?>
              <input type="hidden" id="items" name="items" value="<?=ltrim($str_items, ',')?>">
              <input type="hidden" id="total" name="total" value="<?=$total_amount?>">
              <input type="hidden" id="restaurant_id" name="restaurant_id" value="<?=$restaurant['restaurant_id']?>">
              <button class="btn btn-primary btn-block btn-rounded" type="submit">Place Order</button>
            </form>
          <?php }else{ ?>
                  <p>No items in the cart.</p> 
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="lg-space"></div>
  </div>
</div>