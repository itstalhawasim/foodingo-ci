<div class="bg-light-gray font-weight__500 hero my-4 py-3">
  <div class="lg-space"></div>
  <div class="container hero-inner">
    <div class="row align-items-center">
      <div class="col-12 mx-lg-auto box">
        <h3 class="pb-3 pt-2">Manage Orders</h3>
        <?php if($this->session->flashdata('manage_orders_status')): ?>
            <?php $flash = $this->session->flashdata('manage_orders_status');
            echo ' <div class="alert text-center animated headShake alert-'.$flash['type'].'" role="alert">'.$flash['message'].'</div>'; ?>
        <?php endif; ?>
        <table id="manage_items" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Ordered On</th>
                  <th>Items</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody>
            <?php $count = 0;
              foreach($orders as $order) : ?>
                <tr>
                  <th><?=++$count;?></th>
                  <td><?=ucwords($order['name']);?></td>
                  <td><?=$order['address'];?></td>
                  <td><?=$order['order_date'];?></td>
                  <td><?=$order['items'];?></td>
                  <th>₹<?=$order['total'];?></th>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="lg-space"></div>
  </div>
</div>