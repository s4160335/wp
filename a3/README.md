# COSC2446 Web Programming – Assessment 3
# BookVerse Online Bookstore Platform

## Student Details
Item	Details
Student name	Abdifatah Mohamed
Student ID	s4160335
GitHub repository URL	https://github.com/s4160335/wp/tree/main/a3
Deployed website URL	https://jupiter.csit.rmit.edu.au/~s4160335/wp/a3/ |


## 1. Purpose of This README
This README provides an overview of the BookVerse Assessment 3 project, including its structure, technologies, functionality and development process. It explains how PHP, MYSQL and JavaScript are used to support dynamic book management, authentication and user interactions.

The document also describes the project's measures, testing procedures, deployment requirements and use of AI tools. It supports the assessment submission by documenting the implementation decisions and providing information about the completed website.

## 2. Copilot and AI Coding Instructions
- Uese HTML5, CSS3, JavaScript, Bootstrap 5, PHP and MYSQL.

- Follow the Assessment 3 requirements and maintain the existing BookVerse design.

- Use procedural MYSQLi and prepared statements for database queries.

- Use the reuired PHP pages and shared include files.

- Keep database connection and session handling in `includes/db_connect.inc`.

- Use `includes/header.inc`, `includes/nav.inc` and i`includes/footer.inc` for consistent page structure.

- Use PHP session for authentication and flash messages.

- Use `password_hash()` for registeration and `password_verify()` for login.

- Restrict adding books to authenticated users.

- Allow users to edit and delete only their own books.

- Validate form input and uploaded image files.

- Store uploaded book cover in `assets/images/covers/`.

- Use Bootstrap for responsive layouts, image galleries and confirmation modals.

- Keep custom CSS in `assets/css/style.css`.

- Keep custom JavaScript in `assets/js/scripts.js`, without inline JavaScript.

- Implement book filtering, searching, seller profiles and CRUD functionality.

- Escape displayed user and database content using `htmlspecialchars()`.

- Preserve the ruquired fonts, icons, colors and page layouts.

- Avoid unnecessary frameworks, libraries or features outside the assessment requirements.

- Test and understand AL-assisted code before includeing it in the project.

- Record meaningful AL useage and debugging activities in `process-evidence.md`.

- Ensure the complete project works locally and on the required deployment server.

## 3. Project Overview
BookVerse is an online bookstore platform that allows users to browse, search and manage book listings. Visitors can explore available books, view book details and visit seller profiles without logging in. Registered users can log in, add new books and edit or delete their own listings. Assessment 3 extends the earlier static website by introducing PHP, MYSQL database storage, authentication and dynamic content. The platform uses HTML5, CSS3, JavaScript, Bootstrap 5, PHP and MYSQL to provide a responsive, database-driven website.

## 4. Website Structure
File	Purpose
index.php	| Displays the homepage, image carousel and four recently added books. |
books.php	| Displays books from the database with available status filtering. |
gallery.php	| Displays book cover images in a responsive gallery with a Bootstrap modal. |
details.php	| Displays details information about a selected book and provides owner-only editing and deletion controls. |
seller.php	| Displays a seller's profile information and books listed by that seller. |
search.php	| Allows visitors to search books by title, author, or description. |
register.php| Allows new users to create an account. |
login.php	| Authenticates registered users and creates login sessions. |
logout.php	| Ends the current user session and logs the user out. |
add.php	    | Allows authenticated users to add books and upload cover images. |
edit.php	| Allows book owners to uptade their listings and replace cover images. |
Optional processing files	| Not used: form processing is handled within the relevant PHP pages. |

## 5. Project Folder Structure
a3/
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
├── details.php
├── seller.php
├── search.php
├── register.php
├── login.php
├── logout.php
├── add.php
├── edit.php
├── README.md
└── process-evidence.md

## 6. Technologies Used
Technology	How it was used in this project
HTML5	| Structures website pages using semantic elements, forms and accessible content. |
CSS3	| Provides custom styling, colors, spacing and page layouts. |
Bootstrap 5	| Creates responsive grids, navigation, cards, modals and form layouts. |
JavaScript	| Implements book filtering, image previews, file validation and gallery interactions. |
PHP	| Handles dynamic pages, form processing, authentication and book management. |
MySQL	| Stores resgistered users and book information. |
MySQLi procedural prepared statements | Executes database queries using parameter binding. |
PHP sessions	| maintain login information and desplays flash messages. |
Google Fonts	| Provides Righteous and Elms Sans typography. |
Material Icons	| Displays icons throughout the website. |
GitHub	| Stores project code and records development history. |
Coreteaching server	| Hosts the deployed BookVerse website. |
Jacob 5 database server	| Hosts the MYSQL database used by tthe deployed website. |
AI tools	| Support code development, debugging, review and testing. |

## 7. Design and Layout
BookVerse maintains the visual design established in the previous assessments while introducing dynamic PHP functionality.

The website uses the required teal and amber colo palette to create a consistent appearance.
Righteous is used for headings and branding, while Elms Sans is used for body text, navigation and form elements. Material Icons provide visual indicators for actions and page sections.

Bootstrap 5 is used to create responsive layouts that adapt to mobile, tablet and desktop screens. The website includes responsive navigation, book cards, forms and gallery layouts.

Shared PHP include files maintain consistent headers, navigation and footers across the website. The navigation changes depending on the user's login status. Visitors see Login and Register links, while authenticated users can access additional features such as adding books and managing their account.

## 8. Required Features
Feature	Page/File	Explanation
Carousel of latest images	index.php	| Displays book images using a Bootstrap carousel. |
Latest 4 books from database	index.php | Retrieves and displays four recently added books from MYSQL. |
Book table	books.php	| Displays book listing retrieved from database. |
Status filter	books.php	| Filters books by availability status using JavaScript. |
Book detail link	books.php / details.php	| Allows visitors to open the details page for a selected book. |
Details page	details.php	| Displays information about an individual book. |
Seller link	index.php, details.php, books.php | Allows visitors to view the profile of a book's seller. |
Seller page	seller.php	| Displays seller information and books listed by that seller. |
Gallery grid	gallery.php	| Displays book cover images in a responsive grid. |
Bootstrap image modal	gallery.php	| Opens a large image when a gallery image is selected. |
Search	search.php	| Searches bok titles, authors and descriptions. |
User registration	register.php | Allows visitor to create an account. |
User login	login.php	| Authenticates users using their username and password. |
User logout	logout.php	| Ends the user's login session.
Add Book form	add.php	| Allows authenticated users to add new book listings. |
Edit Book form	edit.php | Allows book owners to update their listings. |
Delete action	details.php | Allows book owners to delete listings after confirmation. |
Image upload	add.php / edit.php | Uploads and validates book cover images. |
Flash messages	Session-based pages/actions | Displays success and error messages after user actions. |

## 9. Database Design and Use
BookVerse uses a MYSQL database named bookverse_a3 in thie local development environment. PHP connects to the database through `includes/db_connect.inc` using MYSQLi.

The database stores registered users and book listings. Each book is associated with its owner through the `user_id` field.

The website retrieves book information for the homepage, books page, gallery, details page, seach results and seller profiles.

Authenticated users can add books using `add.php`. Book owners can update their listings through `edit.php` and delete them through `details.php`.
Database queries use procedural MYSQLi prepared statements to safely handle user-suplied values.

Database tables and important fields.
Table	| Important fields	| Purpose
`users`	| `user_id`, `username`, `password`, `location`, `bio`|	Stores registered user accounts and seller profile information.

`books`	| `book_id`, `user_id`, `title`, `author`, `description`, `price`, `status`, `image_path`, `created_at`	| Stores book listings and links each book to its owner. |

## 10. PHP Includes and Reusable Structure
Include file	Purpose
includes/db_connect.inc	| Eatablishes the MYSQL database connection and starts PHP sessions. |
includes/header.inc	| Contains the shared HTML document structure, metadata, stylesheets and font links. |
includes/nav.inc	| Displays the navigation bar and session-based flash messages. |
includes/footer.inc	| Contains the shared footer and JavaScript references. |
Other optional include files | Not used in the cureent implementation. |

The shared files make the website easier to maintain because common components can be uploaded in one location.

They also provide consistent navigation, page layouts,database access and session handling throughout the project.

## 11. Authentication, Sessions, and Access Control
BookVerse uses PHP sessions to manage user authentiation. New users can create accounts through `register.php`. Passwords are securely hashed using `password_hash()` before being stored in the database.

Registered users can log in through `login.php`. The submitted password is checked using `password_verify()`. After successful authentication, the user's ID and username are stored in the session.

The navigation bar displays different options depending on whether a user is logged in. Users must be authenticated before adding books. Editing and deleting books are restricted to the owner of each listing.

Flash messages provide feedback after actions such as logging in, adding, editing, or deleting books.

Protected routes and actions
Page or action	Who can access it?	How access is checked

add.php	|Authenticated users | Checks whether the user is logged in thrug the PHP session. |
edit.php | Book owner only	| Checks the login session and compares the book's `user_id with logged-in user's ID. |
Delete action | Book owner only	| Checks the session and verifies ownership before deleting the book. |
Owner edit/delete buttons | Book owner only	| Buttons are displayed only when the logged-in user owns the book.|
Anonymous visitor pages	| All visitors	| Public pages can can be viewed without logging in. |

## 12. CRUD Functionality
CRUD operation	Page/File	Explanation
Create book	add.php | Inserts a new book into database after validating the form data. |

Read all books	books.php | Retrieves and displays book records from the database. |

Read one book	details.php	| Retrieves one book using its ID from the URL. |

Update book	edit.php | Updates an existing book after verifying ownership. |

Delete book	details.php | Deletes a book after verifying ownership and receiving confirmation. |

The Add Book form allows authenticated users to enter book details and upload a cover image.

The Edit Book form allows owners to update their book information and optionally replace the existing cover image.

The Delete action uses a Bootstrap confirmation modal before submitting the deletion request.

Ownership is checked on the server before editing or deleting a record. This prevents users from modifying books belonging to other accounts.

## 13. Search, Filtering, and Seller Pages
Feature	Page	Explanation
Status filtering	books.php | Uses JavaScript to display books matching the selected availability status. |
Keyword search	search.php | Searches the database for books matching a keyword. |
Seller page	seller.php | Displays information about a selected seller and their book listings. |

### Status Filtering
The Books  page uses the `data-status` attribute to identify each book's availability status.

JavaScript reads the selected filter and shows or hides the relevant book listings without reloading the page.

### Keyword Search
The Search page accepts a keyword entered by the visitor.

PHP uses a MYSQLi prepared statement with the SQL `LIKE` operator to search book titles, authors and descriptions.

Matching results are displayed on the page. If no books match the keyword, the website displays an appropriate message.

### Seller Profile
Each seller is identified by their `user_id`.

The `seller.php` page retrieves the selected seller's information and displays the books associated with that account.

Visitors can access seller profiles through links displayed alongside book information.

## 14. JavaScript Functionality
JavaScript feature	Page	How it works
Image extension validation	add.php / edit.php | Checks the selected image file extension against the permitted formats. |

Image preview	add.php / edit.php | Displays a preview of the selected book cover before submitting form. |

Gallery modal	gallery.php | Uses Bootstrap to display enlarged book cover images in a modal. |

Book status filter	books.php | Shows or hides books based on their `data-status` values. |

Delete confirmation modal	details.php | Displays a confirmation dialog before a book deletion request is submitted. |

Automatic flash-message dismissal | Login/logout messages | Uses Bootstrap JavaScript to close flash messages automatically after five seconds.

Custom JavaScript is maintained in `assets/js/scripts.js` to keep the website's behaviour separate from its HTML and PHP structure.

## 15. Form Handling and Validation
BookVerse includes forms for registration, login, adding books and editing book information. The forms use labels, appropriate input types and required attributes to help users enter information correctly.

Client-side validation checks required field and supported image file extensions. JavaScript also displays a preview when a user selects a book cover.

PHP performs server-side validation before processing submitted information. This includes checking required values, validating uploaded images and verifying that the user has permission to perform the requested action.

Uploaded images are checked against the permitted formats: JPG, JPEG, PNG, GIF and WebP. Unique filenames are generated to avoid conflicts between uploaded files.

When editing a book, users can keep the existing cover image by leaving the image upload field empty. if a valid replacement image is uploaded, the new image is saved and the previous uploaded cover is removed.

The website displays appropriate success or error messages to inform users about the result of their actions.

## 16. File Uploads and File-System Hygiene
BookVerse stores uploaded book cover images in `assets/images/covers/`.
PHP validates uploaded images before saving them. The system checks supported file extensions and verifies that the uploaded file is an image.

Uploaded images receive unique filenames generated using PHP `uniqid()` function. This prevents filename conflicts and avoids relying on the original filenames supplied by users.

When a book owner replaces an uploaded cover image, the previous uploaded file is removed after the update succeeds.

When a book is deleted, its associated uploaded cover image is also removed when it matches the expected generated filename format.

The project uses `.gitignore` to exclude files that should not be tracked, such as locally generated uploads or sensitive configuration files, where appropriate.

The deployed upload directory must have the permissions required for PHP to save uploaded images.

## 17. Security and Best Practices
BookVerse uses several ecurity practices to protect user accouts and database records.

Procedural MYSQLi prepared statements are used for database operations involving user-supllied values. This helps protect the website against SQL injection.

User passwords are stored using `password_hash()` and checked during login using `password_verify()`.

PHP sessions maintain authenticatiion information and control access to protected pages.

Server-side ownership checks prevent users from editing or deleting books belonging to other accouts.

The website uses `htmlspecialchars()` when displaying user-supplied or database content to reduce the risk of HTML injection.

Form values and query string parameters are validated before use. Uploaded images are checked for supported file types and assigned unique filenames.

The delete functionality also uses a CSRF token to validate deletion requests.

Flash messages provide feedback after successful or unseccessful actions.

Database connection errors and sensitive information should not be exposed to visitors on the deployed website.

## 18. Accessibility and Usability
BooVerse uses sementic HTML elements, including headers, navigation, main content areas and footers, to provide a clear page structure.

Pages use meaningful titles, consistent navigation and labelled form fields.

Book cover images include alternative text to help users understand image content.

Bootstrap provides responsive layouts that adapt to desktop, tablet and mobile screens.

The website uses consistent typography, spacing and colors to support readability.

Interactive features, including book filtering, image previews and confirmation modals, helpinh users complete tasks more easily.

Success and error messages provide feedback after important actions.

The navigation also changes according to login status, allowing authenticated users to access book management features while keeping public browseing available to visitiors.

## 19. Testing and Validation

### Rendered HTML Validation
Page	Result	Notes

index.php | Pass | No errors found	|
books.php | Pass |  No errors found |
gallery.php	| Pass |  No errors found	|
details.php	| Pass | No errors found	|
seller.php	| Pass | No errors found	|
search.php	| Pass | No errors found	|
register.php | Pass | No errors found	|
login.php	| Pass | No errors found	|
add.php	| Pass | No errors found	|
edit.php | Pass | No errors found	|

### CSS Validation
File	Result	Notes
assets/css/style.css | Pass | CSS validated successfully with W3C Jigsaw validator|

### Functionality Testing
Feature tested	Result	Notes

Navigation links | Pass | Main navigation was reviewed during page testing.

Database connection	| Pass | Book and user records were retrieved successfully.

Latest books display | Pass | Homepage displays database-driven book listings.

Books table	| Pass | Book listings displayed correctly.

Book status filter | Pass | JavaSript correctly filters book listings according to thier availability status.

Details page query string | Pass | Selected book details displayed correctly.

Seller page query string | Pass | Valid, invalid and nonexistent seller IDs were tested.

Search	| Pass | Keyword search returned matching book results.

Gallery modal | Pass | Image modal navigation was tested.

Registration | Pass | Successfully registered the `bookverse_test` account.

Login	| Pass | correct and incorrect passwords were tested.

Logout	| Pass | Successfully logged out of the `bookverse_test` multiple times.

Session flash messages | Pass | Login and book management messages were displayed.

Add Book form validation | pass | Required fields and agreement checkbox were tested.

Image upload | Pass | Book covver uploads replacements were tested.

Image preview | Pass | Image preview functionality works in both `add.ph` and `edit.php`.

Edit Book | Pass | Price and cover image updates were tested.

Delete confirmation | Pass | confirmed deletion successfully removed a book.

Owner-only access | Pass | Editting restrictions were tested with different accounts.

Anonymous user access | Pass | Logged-out access to the edit page redirected to loging.

Deployed site links/assets |Pass| Tested the delopyed homepage, navigation, book listings, search, details and seller pages. CSS, JavaScript and book cover images loaded correctly.

Deployed database content | Pass | Verified that the Jacob 5 database catains user and book records. Registeration, login, adding, editing and deleting books were successfully tested on Coreteaching.

## 20. Deployment
BookVerse Assessment 3 was deployed to the Coreteaching server using Git. The website files were updated through Putty using `git pull`, and the application connects to the Jacob 5 MySQL database.

Item	Details
Deployed website URL	https://jupiter.csit.rmit.edu.au/~s4160335/wp/a3/ |
Jacob 5 database name	S4160335_159009
Deployment folder	public_html/wp/a3
.htaccess location	public_html/.htaccess 
Upload folder permissions	`chmod 777` for `a2/assets/images/covers` on Coreteaching

After deploying BookVerse to the Coreteaching server, I tested the website using a browser inside RMIT Desktop. I verified that the pages, navigation, stylesheets, JavaScript features and book cover images loaded correctly. I also tested registration, login, logout, book creation, image uploads, editing, cover replacement and deletion. The website successfully retrieved and updated records in Jacob 5 MySQL database, and ownership restrictions prevented users from editing books beloging to other account.

## 21. Git and Development Process
Git and GitHub are used to manage the BookVerse source code and maintain a record of project development.

The repository records changes made to PHP pages, database functionality, authentication, styling and JavaScript features.

Commits provide a history of the project's development and help identify changes made during implementation and devugging.

The development process is also documented in `process-evidence.md`, which records debugging activities and meaningful AI-assisted work.

The final Git history should demonstrates progressive development through meaningful commit made across the required development period.

## 22. AI Use Declaration

 [y] I used AI tools meaningfully during this assessment.
 [y] I recorded meaningful AI use in process-evidence.md.
 [y] I reviewed, tested, and adapted AI-assisted output.
 [y] I can explain all AI-assisted code submitted.

During the development of BookVerse Assessment 3, I used the lab examples and assessment requirements as references for implementing the website.

I used AI tools to assist with reviewing code, debugging errors, testing functionality, identifying potential security vulnebilities and checking for missing assessment requirements.

I reviewed the AI suggestions, tested the functionality myself and decided which changes were necessary for my project. I also checked that the implemented features followed the assessment requirements.

I am responsible for undestanding, explaining and maintaining the submitted code. My AI-assisted activities, debugging experiences and development decisions are documented in `process-evidence.md`.

Detailed AI usage records must be included in process-evidence.md.

## 23. Process Evidence
Requirement	Completed?
process-evidence.md file included | Yes |
At least 5 debugging records included	| Yes |
At least 5 meaningful AI usage records included	| Yes |
Relevant commit links included	| Yes |

## 24. Known Issues or Limitations
No known issues at the time of submission.