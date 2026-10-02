# COSC2446 Web Programming – Assessment 2  
# BookVerse Online Bookstore Platform

## Student Details

| Item | Details |
|---|---|
| Student name | Abdifatah Mohamed |
| Student ID | s4160335 |
| GitHub repository URL | TODO |
| Deployed website URL | TODO |

---

## 1. Purpose of This README

This README documents my BookVerse Assessment 2 project. It explains the project struture, technologies, database use, security, testing, development and development process. It also records the main technical choise I made while extending the static Assessment 1 website into a PHP and MuySQL website.

---

## 2. Copilot and AI Coding Instructions
This section must be completed by the student after reading the Assessment 1 brief.

Write clear instructions that would help GitHub Copilot or another AI tool produce code that follows the Assessment 1 requirements.

Your instructions should help the AI understand what it is allowed to generate, what it must not generate, and which assessment constraints must be followed.

TODO: Include instructions about:

- allowed technologies;
- technologies, frameworks, or tools that must not be used;
- required files and folders;
- CSS and JavaScript file requirements;
- whether inline CSS or inline JavaScript is allowed;
- Bootstrap layout requirements;
- form requirements;
- image validation requirements;
- gallery modal requirements;
- book status filtering requirements;
- accessibility and usability expectations;
- AI usage and process-evidence requirements.


### My Copilot / AI instructions

- Use HTML5, CSS3, Bootstrap 5, Javascript, PHP and MySQL only as required by the assessment.

- keep the existing BookVerse visual design from a1 where possible.

- Do not replace the required technologies with another framework or library.

- Keep custom CSS in assets/css/style.css.

- Keep custom JavaScript in assets/js/scripts.js; do not use inline JavaScript.

- Use index.php, books.php, gallery.php, add.php and details.php as the main pages.

- Use includes/header.inc, includes/nav.inc, includes/footer.inc and includes/db_connect.inc for reusable code.

- Use Bootstrap 5 row, columns and responsive classes for layout.

- Use procedural MySQL for database access.

- Use prepared statements whenever user-controlled values are used in SQL queries.

- Use the local bookverse database during XAMPP development and the required student database on Jacob 5 after deployment.

- Keep the four Home page carousel images static.

- Load the featured Books section from the database.

- Load the Books table, Gallery and Details page from database records.

- Validate uploaded cover extesions and allow only only JPG, JPEG, PNG, GIF and WEBP.

- Generate a unique server filename for uploaded cvers instead of relying on the original filename.

- Escape database output with htmlspecialchars() where required.

- Use a Bootstrap modal for the Gallery.

- Use JavaScript and data-status values for the Books status filter.

- Test AI-assisted code before keeping it and record meaningful AI use and debugging in process-evidence.md.

---

## 3. Project Overview

BookVerse is an online bookstore website where users can browse books, view book covers, open individual book details and add a new book. Users can see a featured selection of books on the Home page, view all books in a table with status filtering, explore covers in a gallery, and submit new books through the Add Book form.

---

## 4. Website Structure

Complete the table below by describing the purpose of each page.

| File | Purpose |
|---|---|
| `index.php` | Home page with static carousel and database-driven featured Books |
| `books.php` | Displays all books from database table with a stsic filter |
| `gallery.php` | Shows book covers in a responsive gallery with a modal |
| `add.php` | Add Book form, validation, image upload, and database insertion |
| `details.php` | Displays one selected book using its book_id|
| `process_add.php` *(optional)* | Not used. Add Book form processing is handled directly in 'add.php'. |

---

## 5. Project Folder Structure

Show the final structure of your `a2` folder.

```
a2/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       └── covers/
├── includes/
│   ├── db_connect.inc
│   ├── header.inc
│   ├── nav.inc
│   └── footer.inc
├── index.php
├── books.php
├── gallery.php
├── add.php
├── details.php
├── README.md
└── process-evidence.md

Optional:
└── process_add.php
```

---

## 6. Technologies Used

Complete the table below. Explain how each technology was used in your project.

| Technology | How it was used in this project |
|---|---|
| HTML5 | Provides the semantic page structre, forms, images, tables and content |

| CSS3 | Provides the custom BookVerse colors, typography, spacing and page styling |

| Bootstrap 5 | Provides responsive grib layouts, navigation, carousel, modal, buttons and utility classes |

| JavaScript | Handles the Books status filter, Gallery modal image navigation, image extension validation and image preview |

| PHP | Buillds reusable pages, processes form data and retreieves database content |

| MySQL | Stores the BookVerse book records |

| MySQLi procedural prepared statements | Safely handles SQL that uses statements user-controlled values, including book IDs and Add Book data |

| Google Fonts | Provides Righteous for heaings/branding and Elms Sans for the main interface text |

| Material Icons | Provides icons in nag=vigations, headings and buttons|

| GitHub | Stores the project repository and progressive development history |

| Coreteaching server | Used for the final deployed PHP website |

| Jacob 5 database server | Used for the deployed MySQL database|

| AI tools | Used mainly for step‑by‑step explanations, planning HTML‑to‑PHP conversion, reviewing PHP/MySQL code and debugging problems |

---

## 7. Design and Layout

Based on the assessment document, describe the required design and layout choices.

The a2 design continues the visual style developed in a1 instead of replacing it with a new design. The required teal, amber, green, slate, white and light background colors are used throughout the interface. Righteous is used for headings and branding, while Elms Sans is used for body test, labels, navigation and buttons. Material icons are used consistently grid and components and actions. Bootstrap 5 procides the responsive grid and components, while the shared PHP include files kepp the header, navigation and footer consistent across pages.

---

## 8. Required Features

Complete the table below by explaining where and how each required feature should be implemented.

| Feature | Page/File | Explanation |
|---|---|---|
| Carousel | `index.php` | Uses the four required static cover images with Bootstrap carouel |

| Latest 4 books from database | `index.php` | Retrieves four book database records from the database and displays them as Featured Book cards. The current ordering is set to match the required Home page visual reference. |

| Book table | `books.php` | Retrieves all books and disolays their title, author, genre, price and status|

| Status filter | `books.php` | JavaScript reads each row's data-status value and shows or hides rows based on the selected status|

| Book detail link | `books.php` / `details.php` | Each title to details.php details.php?id=.. using its database book_id|

| Details page | `details.php` | Uses aprepared statement to retrieve one selected book and displays its complete information|

| Gallery grid | `gallery.php` | Retrieves book cover and titles from database and displays them a responsive Bootstrap grid |

| Bootstrap image modal | `gallery.php` | Clicking a cover opens the selected image and title in Bootstrap modal with Previous and Next controls|

| Add Book form | `add.php` | Collects the required book information and cover image |

| Record insertion | `add.php` or `process_add.php` | Uses a prepared INSERT statement to add a valid new book to the database |

| Image upload | `add.php` or `process_add.php` | Receives the uploaded cover, validates its extension, generates a unique filename and moves it into 'assets/images/covers/' |

---

## 9. Database Design and Use

Describe how the database is used in your project.

During local development, BookVerse uses the bookverse MySQL database through XAMPP. After deploymest, the database will be hosted on Jacob 5 using the required student database name. The supplied books table schema is used without changing the required field names or enum values.

The main pages retrieve records using MySQLi.  index.php, book.php and galley.php retrieve the records they need for display. details.php receive a book ID from the query string and uses a prepared statement to retrieve that single record. add.php uses a prepared INSERT statement to add a new book after validation and image processing.

### Database tables and important fields

Complete this section using the schema supplied for the assessment.

| Table | Important fields | Purpose |
|---|---|---|
| 'books' | 'book_id', 'title', 'author', 'genre', 'publication_year', 'isbn', 'description', 'book_condition', 'price', 'image_path', 'status', 'created_at' | Stores all BookVerse book information used throughout the website. |

---

## 10. PHP Includes and Reusable Structure

Describe how the include files are used.

| Include file | Purpose |
|---|---|
| `includes/db_connect.inc` | Creates the MySQL connection and selects the correct local or deployed database |

| `includes/header.inc` | Cantains the shared document start metadata, Bootstrp, fonts, icons and custom stylesheet link |

| `includes/nav.inc` | Contains the shared BookVerse header and navigation links|

| `includes/footer.inc` | Contains the shared footer and JavaScript file links |

| Other optional include files | Not used. The four required include files provide the reusable structure needed for this project.|

The include files reduce repeated code and keep the main pages easier to maintain. Changes to shared navigation, paga setup or the footer can be made once instead of being repeated on every paga. The database connection includ also provides one consistent connection point for pages that need MySQL data.

---

## 11. JavaScript Functionality

Describe the JavaScript features that should be implemented in your website.

| JavaScript feature | Page | How it works |
|---|---|---|
| Image extension validation | `add.php` | Reads the selected validation filename and allows only jpg, jpng, png, git and webp. An invalid selection displays an error and clears the input |

| Image preview | `add.php` | Uses URL.createObjectURL() to display the selected valid cover before submission 
|
| Gallery modal | `gallery.php` | Reads data-image and data-title from the selected gallery item and updates the Bootstrap moal. Previous and Next buttons moce through the gallery |

| Book status filter | `books.php` |  Uses data-status values on table rows and JavaScript to show or hide rows based on the selected status option |

---

## 12. Form Handling and Validation

Describe the validation and processing used on the Add Book form.

The Add Book form includes the required fields for title, author, genre, publication year, price, ISBN, condition, description, cover image and status. Labels are connected to their form controls and suitable HTML input ypes and required attributes are used.

JavaScript checks the selected cover extenseion and displays an image preview for a valid file. PHP performs sever-sidde checks before processing the record. The uploaded file is first received through PHP's upload system, given a unique filename with uniqid(), and then moved into assets/images/covers/ with move_uploaded_files(). A procedural MySQL prepared INSERT statement adds the va;idated data to the database. The page displays feedback to tell the user whether the book was added or whether the submission could not be completed.

---

## 13. Security and Best Practices

Briefly explain how your project addresses security and best practices.

The project uses procedural MySQLi prepared statement for SQL that contains user-controlled value, reducing SQL injection risk. Database content is escaped with htmlspecialchars() before being placed into HTML where required. The book ID from the Details URL is converted to an interger and used with a prepared statement.

Uploaded cover are checked against the allowed images extensions and are stored using unique generated filenames instead of trusting the original filename. Uploaded cover files are excluded from normal Git tracking through .gitignore, while the covers folder can still be kept in the project structure. The deployed version should avoid exposing raw database errors to normal users.

---

## 14. Accessibility and Usability

Briefly describe what accessibility and usability features must be implemented.

Each page uses a meaningful paga title and semantic elements such as `headder, nav, main, section, artical and footer` where appropriate. Form feild have labels and book images use descriptive `alt` text. Navigation remains consistent across the websit. The color palette and typography are designed to keep text readable, and Bootstrap provides responsive behaviour for different screen sizes. Form and interactive features also provide visible feedback when the userperforms an action.

---

## 15. Testing and Validation

Complete this section after testing your website.

### Rendered HTML Validation

| Page | Result | Notes |
|---|---|---|
| `index.php` |  Pass | No issue found |
| `books.php` |  Pass | No issue found |
| `gallery.php` |  Pass | No issue found |
| `add.php` |  Pass | No issue found |
| `details.php` | Pass | No issue found |

### CSS Validation

| File | Result | Notes |
|---|---|---|
| `assets/css/style.css` | Pass | CSS validated successfully with W3C Jigsaw validator|

### Functionality Testing

| Feature tested | Result | Notes |
|---|---|---|
| Navigation links | Pass| Shared navigation links open the required PHP pages |
| Database connection | Pass | locally Local XAMPP/MySQL |
| Latest books display | Pass | for current four database-driven required visual order featured Book cards display on Home |
| Books table | Pass  | Daatabase records display correctly |
| Book status filter | Pass | Show All, Available, Reserved and Sold filtering tested |
| Details page query string | Pass| Existing IDs load string correctely and a non-existent ID ddisplays "Book not found" |
| Gallery modal | Pass| Correct image/title and Previous/Next navigation tested |
| Add Book form validation | Pass | for tested Valid submission validation submission processed successfully |
| Image upload | Pass | Test cover received a unique filename and was moved to the covers folder |
| Image preview | Pass | Valid selected image displays in the preview |
| Deployed site links/assets | Pending| To be tested after deployment |
| Deployed database content | Pending | To be tested after deployment |

---

## 16. Deployment

Provide details of your deployed website.

| Item | Details |
|---|---|
| Deployed website URL | TODO |
| Coreteaching server | Titan Coreteaching|
| Jacob 5 database name | 'S4160335_159009' |
| Deployment folder | public_html/wp/a2 |
| `.htaccess` location | public_html/.htaccess |
| Upload folder permissions | TODO |

Deployment testing will be completed after the project is deployed to Coreteaching and connected to the Jacob 5 database. The live PHP pages. navigation, assets, database reads and writes, imagpe uploads and status filtering will then be checked.

---

## 17. Git and Development Process

Briefly describe how you used Git during the project.

I used Git throughout the development of the assessment2 to record the progression of the project rather than only committing the final version. My commit show the development from the initial a1-to-a2 PHP conversion through database integeration, dynamic pages, JavaScript adjustments, denugging, testing and documentation.

I made meaningful commits as different pparts of the project were developed and tested. The Git history provides evidence of changes to the PHP pages, shared includes, database functioanlity, JavaScript, styling and project documentation.

The debugging records in 'proccess-evidence.md' are connected to relevant development commits using their commit hashes and GitHub URLs. This allows the recorded problems, fixes and testing to be connected with the project's actual development history.

---

## 18. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:

- [y ] I used AI tools meaningfully during this assessment.
- [y ] I recorded meaningful AI use in `process-evidence.md`.
- [y ] I reviewed, tested, and adapted AI-assisted output.
- [y ] I can explain all AI-assisted code submitted.

I used ChatGPT mainly for step-by-step explanations, planning the
HTML-to-PHP conversion, reviewing PHP/MySQL code and debugging problems.
I did not treat AI output as automatically correct. I compared
suggestions with my existing code and the assessment requirements,
changed the parts that did not fit my project, and tested the code
before keeping it.

Detailed AI usage records are included in process-evidence.md.

---

## 19. Process Evidence

Confirm that your process evidence file has been completed.

| Requirement | Completed? |
|---|---|
| `process-evidence.md` file included | Yes |
| At least 4 debugging records included | Yes |
| At least 4 meaningful AI usage records included |Yes|
| Relevant commit links included |  Yes |

---

## 20. Known Issues or Limitations

> No known issues identified during local testing.
