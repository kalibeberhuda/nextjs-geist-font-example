# Installation Guide for Member-Based Cooperative Savings & Loan System

## Requirements

- PHP 7.4 or higher
- Composer
- MySQL or compatible database
- Web server (Apache, Nginx, etc.)
- Node.js and npm (optional, for frontend assets)

## Setup Steps

1. Clone the repository:

```bash
git clone <repository-url>
cd <repository-folder>
```

2. Install PHP dependencies:

```bash
composer install
```

3. Configure environment variables:

- Copy `.env.example` to `.env`
- Set database credentials and other settings in `.env`

4. Run database migrations:

```bash
php spark migrate
```

5. Set writable permissions for `writable` directory:

```bash
chmod -R 777 writable
```

6. Start the development server:

```bash
php spark serve
```

7. Access the application at:

```
http://localhost:8080
```

## Additional Notes

- Configure Google OAuth credentials in `Config/GoogleOAuth.php`
- For production, configure a proper web server and SSL
- Set up email sending for password recovery

## Troubleshooting

- Ensure PHP extensions like `intl`, `mbstring`, `openssl` are enabled
- Check database connection settings
- Review server error logs for issues

## Support

For support, contact the development team or open an issue in the repository.
