## Environment Configuration

Create a `.env` file inside the `bookmyhotel` folder.

### Step 1: Navigate to project folder

```bash
cd bookmyhotel
nano .env
```

### Step 2: Paste This
```
BREVO_SMTP_KEY= paste the key located in installation_guide.pdf

```

### Step 3: SAVE FILE
```
ctrl + o ,enter
ctrl + x
```

```markdown
## Email Configuration

This project uses **Brevo SMTP** for sending OTP emails.
```


# PKCS11 OTP Authentication System

This project implements OTP authentication using PKCS#11 and SoftHSM.

## Documentation

📄 Installation Guide:  
[View Installation Guide](installation_guide.pdf)

## Features
- PKCS#11 based OTP
- SoftHSM token integration
- MySQL database backend
- PHP web interface
