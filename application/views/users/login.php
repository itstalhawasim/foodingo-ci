<div class="bg-light-gray font-weight__500 hero my-4 py-3">
  <div class="lg-space"></div>
  <div class="container hero-inner">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6 mt-5 mt-lg-0">
        <img src="<?php echo base_url(); ?>assets/image/login.svg" class="img-fluid" alt="Login">
      </div>
      <div class="col-12 col-lg-5 mx-lg-auto box">
        <div class="text-center text-lg-right">
          <h3 class="text-center pb-3 pt-2">Log in to your account</h3>
          <?php if($this->session->flashdata('login_status')): ?>
              <?php $flash = $this->session->flashdata('login_status');
              echo ' <div class="alert text-center animated headShake alert-'.$flash['type'].'" role="alert">'.$flash['message'].'</div>'; ?>
          <?php endif; ?>
          <?php echo validation_errors('<div class="alert text-center alert-danger animated headShake">', '</div>'); ?>
          <?php echo form_open('user/login'); ?>
            <div class="form-group pill-input-lg">
              <input type="email" id="email" name="email" class="form-control rounded-pill" placeholder="Email address" required>
            </div>
            <div class="form-group pill-input-lg">
              <input type="password" id="password" name="password" class="form-control rounded-pill" placeholder="Password" required>
            </div>
            <button class="btn btn-lg btn-primary rounded-pill btn-block text-uppercase" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>
    <div class="lg-space"></div>
  </div>
</div>