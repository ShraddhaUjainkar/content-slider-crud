# WPoets Full Stack PHP + MySQL Assignment

A complete PHP 8+ and MySQL CRUD project for managing tabs and synchronized content slides. The frontend uses Bootstrap 5, jQuery, and Swiper.js to deliver the requested desktop three-column layout and mobile accordion layout.

## Features

- PHP 8+ with clean MVC-style folders
- MySQL database with foreign key relationship
- PDO prepared statements for all database writes and reads
- Admin panel for tab CRUD and slide CRUD
- Icon and image uploads with file type and size validation
- CSRF-protected admin forms and delete actions
- Desktop vertical tabs, content slider, and synchronized square image panel
- Mobile Bootstrap accordion with slide images as backgrounds
- Sample seed data for Learning, Technology, and Communication
- Official WPoets assignment images from `files/images`

## Requirements

- PHP 8.0 or newer
- MySQL 5.7+ or MySQL 8+
- Apache/Nginx or PHP built-in server
- PDO MySQL extension enabled

## Setup

1. Create the database and seed data:

```bash
mysql -u root -p < database.sql
```

2. Update database credentials in `config/config.php` if needed:

```php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'wpoets_assignment');
define('DB_USER', 'root');
define('DB_PASS', '');
```

3. Make sure uploads are writable:

```bash
chmod -R 755 assets/uploads
```

4. Run the project locally:

```bash
php -S localhost:8000
```

5. Open:

- Frontend: `http://localhost:8000/index.php`
- Admin: `http://localhost:8000/admin/index.php`

## Project Structure

```text
project/
├── admin/
│   └── index.php
├── assets/
│   ├── css/
│   ├── js/
│   └── uploads/
├── config/
│   ├── config.php
│   ├── Database.php
│   └── Upload.php
├── controllers/
│   ├── AdminController.php
│   └── HomeController.php
├── models/
│   ├── Slide.php
│   └── Tab.php
├── views/
│   ├── admin/
│   └── home.php
├── database.sql
├── index.php
├── README.md
└── Answers to technical questions.md
```

## Admin Usage

Tabs:

- Create, edit, and delete tabs
- Upload an icon for each tab
- Control frontend order with `sort_order`

Slides:

- Create, edit, and delete slides
- Assign every slide to a tab
- Upload a slide image
- Control slide order with `sort_order`

## Security Notes

- PDO prepared statements are used for database operations.
- Admin forms include CSRF token validation.
- File uploads validate MIME type and size.
- Output is escaped with `htmlspecialchars`.
- Slide records are deleted automatically when their parent tab is deleted because of `ON DELETE CASCADE`.

## Customization

- Frontend styling: `assets/css/style.css`
- Admin styling: `assets/css/admin.css`
- Slider behavior: `assets/js/app.js`
- Database credentials and upload limits: `config/config.php`

## Provided Assignment Assets

The official WPoets image assets are stored in `assets/uploads/wpoets/` and referenced by `database.sql`:

- `DL-learning.svg`
- `DL-technology.svg`
- `DL-communication.svg`
- `DL-Learning-1.jpg`
- `DL-Technology.jpg`
- `DL-Communication.jpg`
- `arrow-right.svg`
- `plus-01.svg`
- `minus-01.svg`
