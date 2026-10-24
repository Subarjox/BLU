<div align="center">

# BLU

**Web-Based Water Quality Detection System using Fuzzy with WAWQI & IKA Standards**

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)
![Status](https://img.shields.io/badge/status-final%20project-orange)

 ![Hero demo](docs/hero.gif)

</div>

---

## Table of Contents

- [About](#about)
- [Demo & Screenshots](#demo--screenshots)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Database Configuration](#database-configuration)
- [Usage](#usage)
- [Author](#author)
- [Credits](#credits)
- [License](#license)

---

## About

BLU is a **final project for the Web Programming course (Group 10)**.

[FILL: 2-3 sentences answering: (1) what BLU is, (2) what problem it solves, (3) who it is for.]

[FILL: explain the role of the `fuzzy/` folder. Example: "The app uses a fuzzy ... method to determine ...". Remove this line if it is not fuzzy logic.]

---

## Demo & Screenshots

| Page | Preview |
|---|---|
| Landing / home | [Screenshot of home page] |
| Login | [Screenshot of login page] |
| Dashboard | [Screenshot of dashboard] |
| [FILL: core page name] | [Screenshot of core page] |
| Fuzzy workflow (input to result) | [Video demo of the fuzzy process] |

**Live demo:** [FILL: deployment link, or delete this line]

---

## Features

- [FILL: feature 1]
- [FILL: feature 2]
- [FILL: feature 3]
- [FILL: feature 4]
- Responsive dashboard UI built on Bootstrap 5 (Argon Dashboard)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP [FILL: version] |
| Database | [FILL: MySQL / MariaDB] |
| Frontend | HTML, CSS, JavaScript, Bootstrap 5 |
| UI Template | [Argon Dashboard](https://github.com/creativetimofficial/argon-dashboard) v2.1.0 by Creative Tim |
| Build tools | Gulp 5, Sass |
| CI | GitHub Actions (`.github/workflows`) |

---

## Project Structure

```
BLU/
├── .github/workflows/   # [FILL: what the workflow does]
├── assets/              # CSS, JS, images, fonts (Argon base + BLU assets)
├── classes/             # [FILL: PHP classes, e.g. DB connection, models, helpers]
├── database/            # [FILL: .sql files / database schema]
├── docs/                # [FILL: documentation / reports]
├── fuzzy/               # [FILL: fuzzy logic implementation]
├── pages/               # Application pages
├── index.php            # Entry point, redirects to /pages
├── gulpfile.mjs         # Gulp tasks (from the Argon template)
├── package.json
├── CHANGELOG.md
└── LICENSE.md
```

---

## Getting Started

### Prerequisites

- PHP [FILL: minimum version]
- [FILL: MySQL / MariaDB]
- A local web server (XAMPP, Laragon, etc.)
- Node.js and npm (optional, only needed to rebuild SCSS with Gulp)

### Installation

1. Clone the repository into your web server's root folder.

   > `index.php` uses `base_url = '/blu/'`, so the project folder **must be named `blu`** (lowercase), or you must change `base_url` in `index.php`.

   ```bash
   cd /path/to/htdocs
   git clone https://github.com/Subarjox/BLU.git blu
   cd blu
   ```

2. Import the database. [VERIFY: SQL file name inside `database/`]

   ```bash
   mysql -u root -p your_database < database/[FILL: file_name].sql
   ```

3. Configure the database connection. [FILL: which file and variables to edit, e.g. in `classes/...`]

4. (Optional) Install front-end dependencies:

   ```bash
   npm install
   ```

5. Start your web server and open:

   ```
   http://localhost/blu/
   ```

   You will be redirected automatically to `http://localhost/blu/pages`.

---

## Database Configuration

| Parameter | Default value |
|---|---|
| Host | [FILL] |
| User | [FILL] |
| Password | [FILL] |
| Database name | [FILL] |

[FILL: demo account for login, if any. Never put production credentials in a README.]

---

## Usage

1. [FILL: step 1. Example: "Log in as admin"]
2. [FILL: step 2]
3. [FILL: step 3]

[Video of a short usage walkthrough]

---

## Author

**Muhamad Fahreza**, software development

- GitHub: [FILL: @username]
- [FILL: LinkedIn / email, optional]

[FILL: university, course, lecturer, academic year]

---

## Credits

The user interface is built on [Argon Dashboard](https://www.creative-tim.com/product/argon-dashboard) by [Creative Tim](https://www.creative-tim.com/), released under the MIT license.

---

## License

Released under the [MIT License](LICENSE.md).
