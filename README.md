# CreativePulse Studio

This is the web application and order management portal I built for **CreativePulse Studio** as part of my **CSE 4100 (Field Work / Industrial Training)** course at **Northern University of Business and Technology Khulna (NUBTK)**.

The idea was to put together a clean agency site where clients can look through our services, submit a project quote, and log in anytime to check the live status of their order.

Live Site: http://creativepulse-studio.infinityfreeapp.com  
Student: MD. Rahad Islam (ID: 12230120487)  
Supervisor: Md. Apu Hosen

---

## Features

- Home Page (`index.php`): Starts with a 2-second splash screen, followed by a hero section with an interactive 3D Earth globe built using HTML5 Canvas (it reacts to mouse movement and dragging). Below that are the About section, featured work across our four services, and contact info.
- Services (`services.php`): Breaks down what is included in Web Design & Dev, UI/UX Design, Branding & Logo, and Social Media Management. Clicking any package takes you to the quote form with that service already picked.
- Quote Request (`quote.php`): Simple intake form for clients to send their project brief, budget, and target deadline straight into MySQL.
- Client Portal (`client_login.php` & `client_dashboard.php`): Clients can create an account or sign in (with password show/hide toggles) to see where their orders stand (`Pending`, `In Progress`, `Completed`, or `Canceled`) and cancel pending orders if needed.
- Admin Dashboard (`login.php` & `dashboard.php`): Protected admin panel for checking order stats, searching and filtering by status, updating project progress, and removing old entries.

## Tech Stack

- Frontend: HTML5, CSS3, Vanilla JavaScript, HTML5 Canvas, inline SVG
- Backend: PHP (MySQLi, PHP Sessions)
- Database: MySQL (`admins`, `clients`, and `orders` tables)
- Environment: XAMPP for local testing, InfinityFree for live hosting

## Running It Locally (XAMPP)

1. Download or clone this repository into `C:\xampp\htdocs\agency\`.
2. Open the XAMPP Control Panel and start "Apache" and "MySQL".
3. Open `http://localhost/phpmyadmin`, create a database named `agency`, and import the SQL tables (`admins`, `clients`, `orders`).
4. Open `db.php` and make sure it uses your local XAMPP settings (`localhost`, username `root`, empty password `""`, database `agency`).
5. Visit `http://localhost/agency/` in your browser.

Note: If you deploy this to InfinityFree or another live host, update `db.php` directly on the server with your live MySQL hostname and credentials instead of pushing your hosting password to GitHub.