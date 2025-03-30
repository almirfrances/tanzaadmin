
# TanzaAdmin Installation Documentation

## Installation Steps

Follow the steps below to install TanzaAdmin and set it up on your Laravel project.

### Step 1: Install the Package

1. Start by creating a new Laravel project or use an existing one. You can install TanzaAdmin using the following Composer command:

   ```bash
   composer create-project almirfrances/tanzaadmin
   ```

2. Navigate to your project folder:

   ```bash
   cd tanzaadmin
   ```

### Step 2: Run the TanzaAdmin Installation Command

1. Now, run the custom artisan command to install TanzaAdmin:

   ```bash
   php artisan tanzaadmin:install
   ```

2. This command will ask for the following database details:
   - **Database Host:** (default is `127.0.0.1`)
   - **Database Name:** (default is `tanzaadmin`)
   - **Database Username:** (default is `root`)
   - **Database Password:** (you can leave it blank for no password)

3. The installation process will:
   - Update the `.env` file with the provided database credentials.
   - Import the `database.sql` dump from the `public/` folder into your MySQL database.
   - Generate a new application key.
   - Create a symbolic link for storage.
   - Clear the cache.

### Step 3: Admin Login Details

After the installation completes, you will see the following information printed in the terminal:

```
TanzaAdmin installed successfully! 🎉
Admin URL: http://localhost/admin
Username: admin
Password: tanzaadmin
```

Use the above credentials to log in to the TanzaAdmin interface.

---

## Customizing the Installation

You can customize the installation process further by making the following adjustments:

1. **Change Admin URL:**
   If you want to change the default admin URL (`/admin`), you can update the .env in Laravel app (ADMIN_ROUTE_PREFIX=).

2. **Database Backup:**
   We recommend backing up your database before running the installation, especially if you are importing an SQL dump to an existing database.

---

## Troubleshooting

If you encounter any issues, here are some common solutions:

- **Database Import Errors:**
   Ensure that your database user has sufficient privileges to perform `INSERT`, `UPDATE`, and `SELECT` operations. Check that the `database.sql` file exists in the `public/` folder.

- **Missing .env file:**
   If the `.env` file is missing, the installation script will automatically create it by copying `.env.example`.

---

## Version Control Tags

You can check out the current version of TanzaAdmin or specific releases on GitHub. Here are some important tags:

- **Current Release:** `v1.0.0`
- **Pre-release:** `v1.0.0-beta`
- **Develop Branch:** `develop`

Check the GitHub repository for the latest updates and release notes:

[GitHub Repository](https://github.com/almirfrances/tanzaadmin)

## License

TanzaAdmin is open-source and distributed under the MIT License. See `LICENSE` for more information.

---

End of Documentation
