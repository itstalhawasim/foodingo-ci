<div class="bg-light-gray font-weight__500 hero my-4 py-3">
  <div class="lg-space"></div>
  <div class="container hero-inner">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6 mt-5 mt-lg-0">
        <img src="<?php echo base_url(); ?>assets/image/login.svg" class="img-fluid" alt="Login">
      </div>
      <div class="col-12 col-lg-5 mx-lg-auto box">
        <div class="text-center text-lg-right">
          <h3 class="text-center pb-3 pt-2">Register and get orders</h3>
          <?php if($this->session->flashdata('register_status')): ?>
              <?php $flash = $this->session->flashdata('register_status');
              echo ' <div class="alert text-center animated headShake alert-'.$flash['type'].'" role="alert">'.$flash['message'].'</div>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<div class="alert text-center alert-danger animated headShake">', '</div>'); ?>
          <?php echo form_open('restaurant/register'); ?>
            <div class="form-group pill-input-lg">
              <input type="text" id="full_name" name="full_name" class="form-control rounded-pill" placeholder="Restaurant name" required>
            </div>
            <div class="form-group pill-input-lg">
              <input type="email" id="email" name="email" class="form-control rounded-pill" placeholder="Your Email address" required>
            </div>
            <div class="form-group">
              <textarea id="address" name="address" class="form-control address-textarea" placeholder="Enter your address here" rows="4" required></textarea>
            </div>
            <div class="form-group pill-input-lg">
              <input type="password" id="password" name="password" class="form-control rounded-pill" placeholder="Password" required>
            </div>
            <div class="form-group pill-input-lg">
              <input type="password" id="confirm_password" name="confirm_password" class="form-control rounded-pill" placeholder="Confirm Password" required>
            </div>
            <button class="btn btn-lg btn-primary rounded-pill btn-block text-uppercase" type="submit">Sign up</button>
          </form>
        </div>
      </div>
    </div>
    <div class="lg-space"></div>
  </div>
</div>