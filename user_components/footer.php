<link rel="stylesheet" href="user_css/common.css">

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

    .footer-section {
        background: linear-gradient(135deg, var(--deep-blue) 0%, var(--deep-blue-dark) 100%);
        color: white;
        margin-top: 80px;
        border-top: 4px solid var(--primary-gold);
        box-shadow: 0 -10px 30px rgba(27, 59, 95, 0.2);
    }

    .footer-section h3 {
        color: white;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-section h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-gold);
    }

    .footer-section h5 {
        color: var(--primary-gold-light);
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--primary-gold);
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .footer-section a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        padding: 5px 0;
        position: relative;
    }

    .footer-section a::before {
        content: '▸';
        color: var(--primary-gold);
        margin-right: 8px;
        transition: all 0.3s ease;
    }

    .footer-section a:hover {
        color: var(--primary-gold);
        padding-left: 8px;
    }

    .footer-section a:hover::before {
        margin-right: 12px;
    }

    .footer-section a i {
        color: var(--primary-gold);
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .footer-bottom {
        background: var(--deep-blue-dark);
        color: rgba(255, 255, 255, 0.9);
        padding: 15px 0;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .custom-alert {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.4s ease-out;
    }

    .custom-alert .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        font-weight: 600;
    }

    .alert-success {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
        border-left: 4px solid #27ae60;
    }

    .alert-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        border-left: 4px solid #c0392b;
    }

    .alert .btn-close {
        filter: brightness(0) invert(1);
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media screen and (max-width: 768px) {
        .custom-alert {
            right: 10px;
            left: 10px;
            min-width: auto;
        }
    }
</style>

<!-- footer -->
<div class="container-fluid footer-section bgcolor-nav">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
                <p>
                    <?php echo $settings_r['site_about'] ?>
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Quick Links</h5>
                <a href="index.php" class="d-block mb-2">Home</a>
                <a href="room.php" class="d-block mb-2">Rooms</a>
                <a href="facilities.php" class="d-block mb-2">Facilities</a>
                <a href="contact.php" class="d-block mb-2">Contact Us</a>
                <a href="about.php" class="d-block mb-2">About Us</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5>Follow Us</h5>
                <?php 
                    if($contact_r['cd_tw']!=''){
                        echo<<<data
                        <a href="$contact_r[cd_tw]" class="d-block mb-2"><i class="bi bi-twitter-x"></i> X </a>
                        data;
                    }
                ?>
                <a href="<?php echo $contact_r['cd_fb'] ?>" class="d-block mb-2"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="<?php echo $contact_r['cd_insta'] ?>" class="d-block"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>
</div>

<h6 class="text-center footer-bottom">Designed and Developed by PK</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function alert(type,msg,position='body') {
        let alert_class =  (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${alert_class} alert-dismissible fade show " role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
        }
        else{
            document.getElementById(position).appendChild(element);
        }
        setTimeout(() => {
        element.remove();
        }, 2000);
    } 

  function setActive() {
    navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0;i<a_tags.length;i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name)>=0) {
        a_tags[i].classList.add('active');
      }
    }
  }


  let register_form = document.getElementById('register-form');
  register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    document.querySelectorAll('#register-form .reg-error').forEach(el => {
      el.textContent = '';
    });
    document.querySelectorAll('#register-form .is-invalid').forEach(el => {
      el.classList.remove('is-invalid');
    });

    let isValid = true;

    function showError(fieldName, message, errId) {
      isValid = false;
      const field = register_form.elements[fieldName];
      if (field) field.classList.add('is-invalid');
      if (errId) {
        const errDiv = document.getElementById(errId);
        if (errDiv) errDiv.textContent = message;
      }
    }

    const name     = register_form.elements['name'].value.trim();
    const email    = register_form.elements['email'].value.trim();
    const address  = register_form.elements['address'].value.trim();
    const pincode  = register_form.elements['pincode'].value.trim();
    const dob      = register_form.elements['dob'].value;
    const password = register_form.elements['password'].value;
    const confirm  = register_form.elements['confirm_pass'].value;

    const phoneInput     = register_form.elements['phone_num'];
    const countrySelect  = document.getElementById('country-code');
    const countryCode    = countrySelect.value;
    const requiredDigits = parseInt(countrySelect.options[countrySelect.selectedIndex].dataset.digits);
    const phone          = phoneInput.value.trim();

    // ───── Name ─────
    if (name === '') {
      showError('name', 'Name is required.', 'err-name');
    } else if (!/^[a-zA-Z\s]{2,60}$/.test(name)) {
      showError('name', 'Name must be 2–60 letters only.', 'err-name');
    }

    // ───── Email ─────
    if (email === '') {
      showError('email', 'Email is required.', 'err-email');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError('email', 'Enter a valid email address.', 'err-email');
    }

    // ───── Phone ─────
    if (phone === '') {
      showError('phone_num', 'Phone number is required.', 'err-phone');
    } else if (!/^\d+$/.test(phone)) {
      showError('phone_num', 'Phone number must contain digits only.', 'err-phone');
    } else if (phone.length !== requiredDigits) {
      showError('phone_num', `Must be exactly ${requiredDigits} digits for ${countryCode}.`, 'err-phone');
    }

    // ───── Address ─────
    if (address === '') {
      showError('address', 'Address is required.', 'err-address');
    } else if (address.length < 10) {
      showError('address', 'Enter a complete address (min 10 characters).', 'err-address');
    }

    // ───── Pincode ─────
    if (pincode === '') {
      showError('pincode', 'Pincode is required.', 'err-pincode');
    } else if (!/^\d{6}$/.test(pincode)) {
      showError('pincode', 'Pincode must be exactly 6 digits.', 'err-pincode');
    }

    // ───── Date of Birth ─────
    if (dob === '') {
      showError('dob', 'Date of birth is required.', 'err-dob');
    } else {
      const today     = new Date();
      const birthDate = new Date(dob);
      let age = today.getFullYear() - birthDate.getFullYear();
      const m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
      if (age < 18) {
        showError('dob', 'You must be at least 18 years old.', 'err-dob');
      } else if (age > 100) {
        showError('dob', 'Please enter a valid date of birth.', 'err-dob');
      }
    }

    // ───── Password ─────
    if (password === '') {
      showError('password', 'Password is required.', 'err-password');
    } else if (password.length < 8) {
      showError('password', 'Password must be at least 8 characters.', 'err-password');
    } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
      showError('password', 'Must include uppercase, lowercase and a number.', 'err-password');
    }

    // ───── Confirm Password ─────
    if (confirm === '') {
      showError('confirm_pass', 'Please confirm your password.', 'err-confirm');
    } else if (confirm !== password) {
      showError('confirm_pass', 'Passwords do not match.', 'err-confirm');
    }

    // ───── Stop if invalid ─────
    if (!isValid) return;

    let data = new FormData();
    data.append('name',         name);
    data.append('email',        email);
    data.append('phone_num',    countryCode + phone);   // e.g. +919876543210
    data.append('address',      address);
    data.append('pincode',      pincode);
    data.append('dob',          dob);
    data.append('password',     password);
    data.append('confirm_pass', confirm);
    data.append('register',     '');

    var myModal = document.getElementById('registerModal');
    var modal   = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    // ───── AJAX ─────
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "user_ajax/login_register.php", true);

    xhr.onload = function () {
      if (this.responseText == 'pass_mismatch') {
        alert('error', "Password not matched");
      } else if (this.responseText == 'email_already') {
        alert('error', "This Email is Already Registered");
      } else if (this.responseText == 'phone_already') {
        alert('error', "This Phone Number is Already Registered");
      } else if (this.responseText == 'invalid_phone') {
        alert('error', "Invalid phone number format");
      } else if (this.responseText == 'mail_failed') {
        alert('error', "Cannot send confirmation mail! Try again later");
      } else if (this.responseText == 'ins_failed') {
        alert('error', "Registration Failed");
      } else {
        alert('success', "Registration Successful. Confirmation link sent to registered email.");
        register_form.reset();
      }
    };

    xhr.send(data);
  });


  document.querySelector('input[name="password"]').addEventListener('input', function () {
    const val   = this.value;
    const bar   = document.getElementById('strength-bar');
    const wrap  = document.getElementById('strength-bar-wrap');
    const label = document.getElementById('strength-label');

    if (val.length === 0) {
      wrap.style.display = 'none';
      label.textContent  = '';
      return;
    }

    wrap.style.display = 'block';

    let score = 0;
    if (val.length >= 8)         score++;
    if (/[A-Z]/.test(val))       score++;
    if (/[a-z]/.test(val))       score++;
    if (/\d/.test(val))          score++;
    if (/[@$!%*?&_#]/.test(val)) score++;

    const levels = [
      { width: '20%',  color: '#dc3545', text: '😟 Very Weak'  },
      { width: '40%',  color: '#fd7e14', text: '😐 Weak'       },
      { width: '60%',  color: '#ffc107', text: '🙂 Fair'       },
      { width: '80%',  color: '#20c997', text: '😊 Strong'     },
      { width: '100%', color: '#198754', text: '💪 Very Strong' },
    ];

    const lvl            = levels[score - 1] || levels[0];
    bar.style.width      = lvl.width;
    bar.style.background = lvl.color;
    label.textContent    = lvl.text;
    label.style.color    = lvl.color;
  });

  function togglePassword(btnId, iconId, fieldName) {
    document.getElementById(btnId).addEventListener('click', function () {
      const input        = document.querySelector(`input[name="${fieldName}"]`);
      const icon         = document.getElementById(iconId);
      const isHidden     = input.type === 'password';
      input.type         = isHidden ? 'text' : 'password';
      icon.className     = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
    });
  }

  togglePassword('toggle-password', 'icon-password', 'password');
  togglePassword('toggle-confirm',  'icon-confirm',  'confirm_pass');

  document.getElementById('country-code').addEventListener('change', function () {
    const digits     = this.options[this.selectedIndex].dataset.digits;
    const phoneInput = document.querySelector('input[name="phone_num"]');

    document.getElementById('phone-hint').textContent = `Enter ${digits}-digit number`;
    phoneInput.maxLength = digits;
    phoneInput.value     = '';
    phoneInput.classList.remove('is-invalid');
    document.getElementById('err-phone').textContent = '';
  });

  document.querySelector('input[name="phone_num"]').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '');
  });

// ── Login Form ───────────────────────────────────────────────
  //login 
  let login_form = document.getElementById('login-form');
  let step1 = document.getElementById('login-step-1');
  let step2 = document.getElementById('login-step-2');

  login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();
    data.append('email_num', login_form.elements['email_num'].value);
    data.append('pass', login_form.elements['pass'].value);
    data.append('generate_otp', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "user_ajax/login_register.php", true);

    xhr.onload = function () {
      if (this.responseText == 'OTP_SENT') {
        step1.classList.add('d-none');
        step2.classList.remove('d-none');
        startOtpTimer();
        alert('success', 'OTP sent to your email');
      } 
      else {
        alert('error', this.responseText);
      }
    };
    xhr.send(data);
  });

  function verifyOtp() {
    let otp = document.getElementById('otp_input').value;

    let data = new FormData();
    data.append('otp', otp);
    data.append('verify_otp', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "user_ajax/login_register.php", true);

    xhr.onload = function () {
      if (this.responseText == 'LOGIN_OK') {
        window.location.reload();
      } else {
        alert('error', 'Invalid OTP');
      }
    };
    xhr.send(data);
  }

  function regenerateOtp() {
    let data = new FormData();
    data.append('regenerate_otp', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "user_ajax/login_register.php", true);

    xhr.onload = function () {
      if (this.responseText == 'OTP_SENT') {
        alert('success', 'New OTP sent');
        startOtpTimer();
      }
    };
    xhr.send(data);
  }

  function startOtpTimer() {
    let btn = document.getElementById('regen_btn');
    let timer = document.getElementById('otp_timer');

    let sec = 30;
    btn.disabled = true;

    let interval = setInterval(() => {
      sec--;
      timer.innerText = "Wait " + sec + " seconds";
      if (sec <= 0) {
        clearInterval(interval);
        btn.disabled = false;
        timer.innerText = "You can regenerate OTP";
      }
    }, 1000);
  }

  document.getElementById('toggle-login-pass').addEventListener('click', function () { const input = login_form.elements['pass']; const icon = document.getElementById('icon-login-pass'); const isHidden = input.type === 'password'; input.type = isHidden ? 'text' : 'password'; icon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye'; });


//forgot

    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit',(e)=> {
    e.preventDefault();

    let data = new FormData();
    data.append('email',forgot_form.elements['email'].value);
    data.append('forgot_pass','');


    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","user_ajax/login_register.php",true);

    xhr.onload = function() {
      if(this.responseText == 'inv_email') {
        alert('error',"Invalid Email");
      }
      else if(this.responseText == 'not_verified'){
        alert('error',"This Email is not verified!");       
      }
      else if(this.responseText == 'inactive'){
        alert('error',"Account Inactive! Contact admin");       
      }
      else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot Send mail");       
      }     
      else if(this.responseText == 'upd_failed'){
        alert('error',"Account Recovery Failed");       
      }     
      else {
        alert('success',"Reset link sent to email!");
        forgot_form.reset();       
      }
    }
    xhr.send(data);
  });


  function checkLogintoBook(status,room_id) {
    if(status) {
      window.location.href = 'confirm_booking.php?id='+room_id;
    }
    else {
      alert('error','Please Login to book room!');
    }

  }


  setActive();
</script>