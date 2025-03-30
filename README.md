# TanzaAdmin Installation Documentation

## One-Step Installation
Run these commands to create the project and complete installation:

```
composer create-project almirfrances/tanzaadmin
```
```
cd tanzaadmin
```
```
php artisan tanzaadmin:install
```

The process will:
1. Create project directory
2. Install dependencies
3. Configure environment
4. Set up database
5. Initialize admin system

## Installation Flow
During installation, you'll be prompted for:

✔ **Application Name** (default: TanzaAdmin)  
✔ **Application URL** (default: http://localhost:8000)  
✔ **Database Configuration:**  
  - **Host** (default: 127.0.0.1)  
  - **Port** (default: 3306)  
  - **Database Name**  
  - **Username** (default: root)  
  - **Password**  

## Post-Installation
After successful installation:

1. Start development server:  
   ```
   php artisan serve
   ```

2. Build frontend assets:  
   ```
   npm install && npm run dev
   ```

## Admin Access
**Default credentials:**  
- **URL:** [http://localhost:8000/admin](http://localhost:8000/admin)  
- **Username:** admin  
- **Password:** tanzaadmin  

## Configuration
Edit `.env` file for:
- Email settings  
- Cache configuration  
- Session driver  
- Debug mode  

## Troubleshooting

### Database Connection Issues
1. Verify MySQL/MariaDB service is running  
2. Check credentials in `.env`  
3. Ensure database exists  
4. Test connection manually:  
   ```
   mysql -u [username] -p [dbname]
   ```

### Environment Issues
1. Regenerate environment:  
   ```
   rm .env && php artisan tanzaadmin:install
   ```
2. Clear configuration cache:  
   ```
   php artisan config:clear
   ```

### File Permissions
Set proper permissions:  
```
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Maintenance

🔹 **Update to New Version:**  
```
composer update almirfrances/tanzaadmin
```

🔹 **Reset Installation:**  
```
php artisan tanzaadmin:install --force
```

## Support
- **GitHub:** [https://github.com/almirfrances/tanzaadmin](https://github.com/almirfrances/tanzaadmin)  
- **Issues:** [https://github.com/almirfrances/tanzaadmin/issues](https://github.com/almirfrances/tanzaadmin/issues)  

## Version Info
- **Current Stable:** 1.2.0  
- **PHP Required:** 8.1+  
- **Laravel Version:** 10.x  
- **Database:** MySQL 5.7+ / MariaDB 10.3+  
