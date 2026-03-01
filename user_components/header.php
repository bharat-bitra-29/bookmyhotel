<style>
    :root {
        --primary-gold: #C9A961;
        --primary-gold-light: #D4B876;
        --primary-gold-dark: #B8964D;
        --deep-blue: #1B3B5F;
        --deep-blue-dark: #152E4A;
        --charcoal: #2C3E50;
        --light-gray: #F8F9FA;
        --medium-gray: #DEE2E6;
    }

    #nav-bar {
        background: white !important;
        box-shadow: 0 4px 20px rgba(27, 59, 95, 0.15);
        border-bottom: 3px solid var(--primary-gold);
    }

    #nav-bar .navbar-brand {
        color: var(--deep-blue);
        font-weight: 700;
        font-size: 1.8rem;
        transition: all 0.3s ease;
    }

    #nav-bar .navbar-brand:hover {
        color: var(--primary-gold);
        transform: scale(1.05);
    }

    #nav-bar .nav-link {
        color: var(--charcoal);
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    #nav-bar .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0%;
        height: 3px;
        background: var(--primary-gold);
        transition: width 0.3s ease;
    }

    #nav-bar .nav-link:hover {
        color: var(--primary-gold);
    }

    #nav-bar .nav-link:hover::before {
        width: 80%;
    }

    #nav-bar .nav-link.active {
        color: var(--primary-gold);
        background: linear-gradient(135deg, var(--light-gray) 0%, #E9ECEF 100%);
    }

    .btn-outline-dark {
        border: 2px solid var(--deep-blue);
        color: var(--deep-blue);
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-dark:hover {
        background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
        border-color: var(--primary-gold);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 169, 97, 0.3);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-radius: 12px;
        border-top: 3px solid var(--primary-gold);
        padding: 10px 0;
    }

    .dropdown-item {
        color: var(--charcoal);
        font-weight: 600;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, var(--primary-gold-light) 0%, var(--primary-gold) 100%);
        color: white;
        padding-left: 25px;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(27, 59, 95, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
        color: white;
        border-bottom: none;
        padding: 20px 25px;
    }

    .modal-header .modal-title {
        font-weight: 700;
        font-size: 1.3rem;
    }

    .modal-header .modal-title i {
        color: var(--primary-gold);
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 1;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-body .form-label {
        color: var(--deep-blue);
        font-weight: 600;
        margin-bottom: 8px;
    }

    .modal-body .form-control,
    .modal-body textarea {
        border: 2px solid var(--medium-gray);
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .modal-body .form-control:focus,
    .modal-body textarea:focus {
        border-color: var(--primary-gold);
        box-shadow: 0 0 0 0.2rem rgba(201, 169, 97, 0.25);
    }

    .modal-body .badge {
        background: linear-gradient(135deg, var(--light-gray) 0%, #E9ECEF 100%) !important;
        color: var(--charcoal) !important;
        border: 1px solid var(--medium-gray);
        padding: 10px 15px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .modal-body .btn-dark {
        background: linear-gradient(135deg, var(--primary-gold) 0%, var(--primary-gold-dark) 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(201, 169, 97, 0.3);
    }

    .modal-body .btn-dark:hover {
        background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(27, 59, 95, 0.4);
    }

    .text-secondary.text-decoration-none {
        color: var(--primary-gold) !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .text-secondary.text-decoration-none:hover {
        color: var(--deep-blue) !important;
        text-decoration: underline !important;
    }
</style>

<!-- Navbar -->
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top bgcolor-nav ">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="room.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php">Facilites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="about.php">About</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php
        if(isset($_SESSION['user_login']) && $_SESSION['user_login'] == true) {

          echo <<< data

          <div class="btn-group">
            <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              $_SESSION[U_Name]
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>
          data;
        }
        else {
          echo <<< data

          <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                  Login
          </button>
          <button type="button" class="btn btn-outline-dark shadow-none " data-bs-toggle="modal" data-bs-target="#registerModal">
                  Register
          </button>
          data;
        }
        ?>
       
      </div>
    </div>
  </div>
</nav>


<!-- login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center" >
          <i class="bi bi-person-circle fs-3 me-2"></i>User Login</h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="login-step-1">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email_num" type="text" class="form-control shadow-none" required>
          </div>

         <div class="mb-4"> <label class="form-label">Password</label> <div class="input-group"> <input name="pass" type="password" class="form-control shadow-none" placeholder="Enter password" required> <button class="btn btn-outline-secondary shadow-none" type="button" id="toggle-login-pass"> <i class="bi bi-eye" id="icon-login-pass"></i> </button> </div> <div class="invalid-feedback d-block" id="err-pass"></div> </div>

          <button type="submit" class="btn btn-dark shadow-none w-100">Generate OTP</button>
        </div>

        <div id="login-step-2" class="d-none">
          <div class="mb-3">
            <label class="form-label">Enter OTP</label>
            <input id="otp_input" type="text" class="form-control shadow-none" maxlength="6">
          </div>

          <button type="button" class="btn btn-success w-100 mb-2" onclick="verifyOtp()">Login</button>

          <button type="button" class="btn btn-link w-100" id="regen_btn" onclick="regenerateOtp()" disabled>
            Regenerate OTP (30s)
          </button>

          <small class="text-muted text-center d-block" id="otp_timer">Wait 30 seconds</small>
        </div>
      </div>

      </form>
    </div>
  </div>
</div>


<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form" novalidate>
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-badge fs-3 me-2"></i>User Registration
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
            Note: Your details must match with your ID (Aadhar Card, Passport, Driving License, etc.) that will be required during check-in.
          </span>

          <div class="container-fluid">
            <div class="row">

              <!-- Name -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control shadow-none" required>
                <div class="invalid-feedback d-block reg-error" id="err-name"></div>
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
                <div class="invalid-feedback d-block reg-error" id="err-email"></div>
              </div>

              <!-- Phone -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <div class="input-group">
                  <select class="form-select shadow-none" id="country-code" style="max-width: 130px;">
                    <option value="+91"  data-digits="10" selected>🇮🇳 +91</option>
                    <option value="+1"   data-digits="10">🇺🇸 +1</option>
                    <option value="+44"  data-digits="10">🇬🇧 +44</option>
                    <option value="+61"  data-digits="9">🇦🇺 +61</option>
                    <option value="+971" data-digits="9">🇦🇪 +971</option>
                    <option value="+966" data-digits="9">🇸🇦 +966</option>
                    <option value="+65"  data-digits="8">🇸🇬 +65</option>
                    <option value="+60"  data-digits="10">🇲🇾 +60</option>
                    <option value="+92"  data-digits="10">🇵🇰 +92</option>
                    <option value="+880" data-digits="10">🇧🇩 +880</option>
                    <option value="+94"  data-digits="9">🇱🇰 +94</option>
                    <option value="+977" data-digits="10">🇳🇵 +977</option>
                    <option value="+33"  data-digits="9">🇫🇷 +33</option>
                    <option value="+49"  data-digits="10">🇩🇪 +49</option>
                    <option value="+81"  data-digits="10">🇯🇵 +81</option>
                    <option value="+86"  data-digits="11">🇨🇳 +86</option>
                    <option value="+82"  data-digits="10">🇰🇷 +82</option>
                    <option value="+7"   data-digits="10">🇷🇺 +7</option>
                    <option value="+55"  data-digits="11">🇧🇷 +55</option>
                    <option value="+27"  data-digits="9">🇿🇦 +27</option>
                  </select>
                  <input name="phone_num" type="tel" class="form-control shadow-none" 
                         placeholder="Enter phone number" maxlength="10" required>
                </div>
                <small class="text-muted" id="phone-hint">Enter 10-digit number</small>
                <div class="invalid-feedback d-block reg-error" id="err-phone"></div>
              </div>

              <!-- Address -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                <div class="invalid-feedback d-block reg-error" id="err-address"></div>
              </div>

              <!-- Pincode -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Pincode</label>
                <input name="pincode" type="number" class="form-control shadow-none" required>
                <div class="invalid-feedback d-block reg-error" id="err-pincode"></div>
              </div>

              <!-- Date of Birth -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
                <div class="invalid-feedback d-block reg-error" id="err-dob"></div>
              </div>

              <!-- Password -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                  <input name="password" type="password" class="form-control shadow-none" required>
                  <button class="btn btn-outline-secondary shadow-none" type="button" id="toggle-password">
                    <i class="bi bi-eye" id="icon-password"></i>
                  </button>
                </div>
                <div class="invalid-feedback d-block reg-error" id="err-password"></div>
                <div class="progress mt-2" style="height:5px; display:none;" id="strength-bar-wrap">
                  <div class="progress-bar" id="strength-bar" role="progressbar" 
                       style="width:0%; transition: width 0.4s ease;"></div>
                </div>
                <small class="form-text" id="strength-label"></small>
              </div>

              <!-- Confirm Password -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                  <input name="confirm_pass" type="password" class="form-control shadow-none" required>
                  <button class="btn btn-outline-secondary shadow-none" type="button" id="toggle-confirm">
                    <i class="bi bi-eye" id="icon-confirm"></i>
                  </button>
                </div>
                <div class="invalid-feedback d-block reg-error" id="err-confirm"></div>
              </div>

            </div>
          </div>

          <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shadow-none">Register</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- forgot modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center" >
          <i class="bi bi-person-circle fs-3 me-2"></i>Forgot Password</h5>
      </div>
      <div class="modal-body">
         <div class="mb-3">
          <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
            Note: Link sent to your email to reset password.
          </span>

             <label  class="form-label">Email </label>
             <input name="email"  type="email" class="form-control shadow-none" required >
          </div>
          
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2"  data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-dark shadow-none ">Send link</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
