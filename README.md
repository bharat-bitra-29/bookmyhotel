# PKCS#11 Based OTP Authentication System

A secure hotel booking system integrated with **PKCS#11 and SoftHSM** for OTP-based authentication.

---

## Features

* Secure OTP using PKCS#11
* Key storage using SoftHSM
* Hotel booking system
* MySQL database integration
* Apache + PHP backend

---

## Quick Setup Overview

1. Install required packages (SoftHSM, Apache, MySQL, PHP)
2. Configure SoftHSM and create token
3. Clone the repository
4. Setup `.env` file (SMTP key)
5. Compile PKCS#11 programs
6. Setup database
7. Deploy to Apache

---

## Full Installation Guide

For detailed step-by-step setup, refer to the guide below:

[Installation Guide](./installation_guide.pdf)

---

## Run the Project

```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

Open in browser:

```
http://localhost/bookmyhotel
```

---

## Security Note

This project uses **SoftHSM + PKCS#11** to securely generate and verify OTPs.
Proper permissions and group access are required for correct execution.

---

## Author

**Bharat Bitra**
