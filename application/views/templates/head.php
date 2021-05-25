<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>assets/image/favicon.ico' />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:500,700,900" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" integrity="sha512-doJrC/ocU8VGVRx3O9981+2aYUn3fuWVWvqLi1U+tA2MWVzsw+NVKq1PrENF03M+TYBP92PnYUlXFH1ZW0FpLw==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css" integrity="sha512-rbQVBRhxp7t0s71vF4UBqe5cFYvlG3l/q5KR02v6aGjqh5U0//71F0l5i/+2Q0GB7Z0rgcrzQQOin+WFm1VmJw==" crossorigin="anonymous" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

    <title>Order food from your favourite restaurants! - Foodingo</title>
  </head>
  <body class="text-black base-font-size">
    <div class="h-100">
      <header class="header">
        <div class="header-inner">
          <nav class="navbar navbar-expand-lg pt-5 pb-2">
            <div class="container">
              <a class="navbar-brand md-font-size font-family-secondary font-weight__700 text-dark-gray m-0" href="<?php echo base_url(); ?>">
                Foodingo <i class="fas fa-pizza-slice"></i>
              </a>
              <button class="navbar-toggler base-plus-font-size" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="base-color fa fa-bars xl-font-size"></span>
              </button>
              <div class="collapse navbar-collapse mt-3 mt-lg-0 sm-font-size" id="main-menu">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>about" class="nav-link text-dark-gray font-family-secondary font-weight__700 mx-lg-4">
                      <i class="fas fa-concierge-bell"></i> About
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>food_menu" class="nav-link text-dark-gray font-family-secondary font-weight__700 mx-lg-4">
                      <i class="fas fa-utensils"></i> Food Menu
                    </a>
                  </li>
                  <?php if($this->session->userdata('is_restaurant')): ?>
                    <li class="nav-item add-menu-item bg-secondary">
                      <a href="<?php echo base_url(); ?>restaurant/add_item" class="nav-link text-dark font-family-secondary font-weight__700 mx-lg-4">
                        <i class="fas fa-plus"></i> Add Menu Item
                      </a>
                    </li>
                    <li class="nav-item view-orders bg-secondary">
                      <a href="<?php echo base_url(); ?>restaurant/view_orders" class="nav-link text-dark font-family-secondary font-weight__700 mx-lg-4">
                        <i class="fas fa-stream"></i> View Orders
                      </a>
                    </li>
                  <?php elseif(!$this->session->userdata('uid')): ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link text-dark-gray font-family-secondary font-weight__700 mx-lg-4 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-plus"></i> Register
                      </a>
                      <div class="dropdown-menu text-dark-gray font-family-secondary" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>user/register">Customer</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>restaurant/register">Restaurant</a>
                      </div>
                    </li>
                  <?php endif; ?>
                  <?php if($this->session->userdata('uid')): ?>
                    <li class="nav-item bg-secondary <?php echo ($this->session->userdata('is_restaurant')?'has-right-rounded-border':'rounded-pill'); ?>">
                      <a href="<?php echo base_url(); ?>user/logout" class="nav-link text-dark font-family-secondary font-weight__700 mx-lg-4">
                        Logout <i class="fas fa-sign-out-alt"></i>
                      </a>
                    </li>
                  <?php else: ?>
                    <li class="nav-item bg-secondary rounded-pill">
                      <a href="<?php echo base_url(); ?>user/login" class="nav-link text-dark font-family-secondary font-weight__700 mx-lg-4">
                        Login
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </header>
      