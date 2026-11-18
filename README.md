# CreativePulse Studio — Digital Agency Client & Order Management Portal

A full-stack web application built for **CSE 4100 (Field Work / Industrial Training)** at **Northern University of Business and Technology Khulna (NUBTK)**.

- **Live Website:** http://creativepulse-studio.infinityfreeapp.com
- **Student:** MD. Rahad Islam (ID: 12230120487)
- **Supervisor:** Md. Apu Hosen

## Key Features
- **Editorial Landing Page (`index.php`):** 2-second welcome splash screen, interactive HTML5 `<canvas>` wireframe globe hero, agency overview, featured portfolio across four services, and value pillars.
- **Detailed Services Catalog (`services.php`):** Deliverable breakdowns for Web Design & Dev, UI/UX Design, Branding & Logo, and Social Media Management with one-click quote pre-selection.
- **Project Quote Submission (`quote.php`):** Client brief intake form with interactive budget selection chips stored directly in MySQL.
- **Real-Time Order Tracker (`track.php`):** Flexible lookup by client name, registered email, or service type with a visual 3-stage pipeline timeline (`Pending` → `In Progress` → `Completed`).
- **Admin Management Dashboard (`login.php` & `dashboard.php`):** Session-protected admin portal with live order statistics, search/status filtering, status updates with toast notifications, and automatic sequential ID re-indexing upon deletion.

## Technology Stack
- **Frontend:** HTML5, Custom CSS3 (CSS Variables, Grid, Flexbox), Vanilla JavaScript (ES6+ & HTML5 Canvas)
- **Backend:** Procedural PHP 8+ (`mysqli`, PHP Sessions)
- **Database:** MySQL (`agency_portal.sql`)
- **Deployment:** XAMPP (Local) & InfinityFree (Live Cloud Hosting)

## Local Setup Instructions (XAMPP)
1. Clone or download this repository into `C:\xampp\htdocs\agency\`.
2. Start **Apache** and **MySQL** in the XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`, create a database named `agency_portal`, and import `agency_portal.sql`.
4. Visit `http://localhost/agency/` in your browser.
5. **Default Admin Login:** Username `admin` | Password `1234`