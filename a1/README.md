# COSC2446 Web Programming – Assessment 1  
# BookVerse Online Bookstore Platform

## Student Details

| Item | Details |
|---|---|
| Student name | Abdifatah Mohamed |
| Student ID | s4160335 |
| GitHub repository URL | https://github.com/s4160335/wp/tree/main/a1 |
| Deployed website URL | https://jupiter.csit.rmit.edu.au/~s4160335/wp/a1/index.html |

---

## 1. Purpose of This README

This README documents the BookVerse Assessment 1 project. It summarises the website, explains the structure and 
technical choices, records testing and validation, documents deployment, and supports the process-evidence 
requirements for the assessment.

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

- Use only HTML5, CSS3, Bootstrap 5 and beginner-level JavaScript required by the assessment.

- Do not introduce additional frameworks or libraries that are not required.

- Do not generate server-side code, databases, PHP, React, Vue, Angular, jQuer, or any other technologies that are
outside the requirements of the Assessment 1.

- Keep the required project structure with `index.html`, `books.html`, `gallery.html`, `add.html`, 
`assets/css/style.css`, `assets/js/scripts.js`, and the required image folders.

- Keep all custom CSS in `assets/css/style.css`; do not use inline CSS.

- Keep all custom JavaScript in `assets/js/scripts.js`; do not use inline JavaScript.

- Use Bootstrap rows and responsive columns for layout where appropriate.
- Keep the same navigation structure on all pages.

- Use semantic HTML such as `header`, `nav`, `main`, `footer`, and 'headings', correctly associate form labels, meaningful
image 'alt' text, and responsive layouts that remain usbale on Desktop and Mobile.

- Use AI mainly for planning, explanation, structure checking and debugging support. I must understand and be able to 
explain the code I submit.

- For the Books page, use `data-status` attributes and JavaScript to show or hide rows for All, Available, Reserved 
and Sold.

- For the Gallery page, use a Bootstrap modal. Clicking a gallery image should open the modal and display the 
selected full-size image. Previous and Next controls should work correctly.

- For the Add Book page, use labelled required fields and browser validation.

- Validate uploaded cover images in JavaScript and accept only JPG, JPEG, PNG, GIF and WEBP extensions.

- Show an image preview only after a valid image is selected.

- Do not accept AI output automatically. Test it using Live Server, browser developer tools, W3C validators and 
JSHint.

- Record meaningful AI use and debugging work in `process-evidence.md`.
---

## 3. Project Overview
BookVerse is a static online bookstore front-end website created for Web Programming Assessment 1. It is designed for 
users who want to browse featured books, filtter books by availability status, explore book-cover images in gallery, and 
use an Add Book form wth client-site field and image preview. The website was biult useing HTML5, CSS3, Bootstrap 5 and 
JavaScript, with responsive layouts for Desktop and Mobile devices. It is a static front-end project and does not use a 
server-side database in this stage.
---

## 4. Website Structure

Complete the table below by describing the purpose of each page.

| File | Purpose |
|---|---|
| `index.html` | Display the BookVerse home page with navigation, Bootsrap carousel and featured book cards. |
| `books.html` | Displays the book list in a responsive table and allows filtering by availability status. |
| `gallery.html` | Displays the book-cover gallery and opens selected covers in Bootstrap modal with Previous and Next navigation. |
| `add.html` | Contains the Add Book form with required field validation, cover-image extension validation and image preview. |

---

## 5. Project Folder Structure

Show the final structure of your `a1` folder.

a1/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       └── covers/
├── index.html
├── books.html
├── gallery.html
├── add.html
├── README.md
└── process-evidence.md
```

## 6. Technologies Used

Complete the table below. Explain how each technology was used in your project.

| Technology | How it was used in this project |
|---|---|
| HTML5 | Used to structure all four pages, including navigation, headings, book content, 
gallery controls, form elements and the footer. |

| CSS3 | Used in one custom stylesheet for colours, typography, spacing, book cards, tables, 
gallery styling, form styling and responsive adjustments. |

| Bootstrap 5 | Used for the responsive navbar, grid system, carousel, table responsiveness, 
modal, buttons, badges and form styling.  |

| JavaScript | Used for book-status filtering, gallery modal image navigation, cover-image extension 
validation and image preview. |

| Google Fonts | Righteous is used for headings and BookVerse branding. While Elms Sanse is used body text,
navigation links, labels, and buttons. |

| Material Icons | Used throughout the navigation, page headings, form labels and action buttons. |

| GitHub | Used for version control, progressive commits and links to debugging evidence. |

| Coreteaching server | TO COMPLETE AFTER DEPLOYMENT.  |
| AI tools | ChatGPT was used for planning, explanations, structure checking, debugging support and validation guidance. 
AI use is documented in `process-evidence.md`. |

## 7. Design and Layout

Based on the assessment document, describe the design and layout choices.

The wbsite follows the required BookVerse visual direction using teal, amber, slate, dark navy and white tone. The design uses
a dark gradient background with contrasting white content areas for cards and tables. Righteous is used for headings and BookVerse
brand, while Elms Sans is used for body and navigation text. Material Icons are used to support navigation, headings and form labels.

Bootstrap is used for the main presponvise structure. The navbar uses Bootstrap collapse behaviour on smaller screens, the Home page
uses responsive columns for book cards, the Gallery uses responsive grid columns, and the Add Book form uses Bootstrap rows and columns
for paired fields. on smaller screens. the Books table keeps Title, Author, Price, and Status visibe while Genre and Year are hidden to
mobile readability.


## 8. Required Features

Complete the table below by explaining where and how each required feature should be implemented.

Feature	Page	Explanation
Carousel	index.html	|Bootstrap carousel displaying four supplied carousel images with Previous and Next 
controls. |

Responsive book layout	index.html	|Eight featured books displayed using Bootstrap responsive grid columns and 
reusable book-card styling. |

Book table	books.html	| Responsive table containing title, author, genre, year, price and availability information. |

Status filter	books.html	| A select control filters table rows by each row's `data-status` value. |

Gallery grid	gallery.html	| Twelve cover images displayed in a Bootstrap responsive grid. |

Bootstrap image modal	gallery.html	| Clicking a gallery cover opens a Bootstrap modal with the selected image and title. 
Previous and Next buttons cycle through the covers. |

Add Book form	add.html	| Form containing labelled and required fields for title, author, genre, year, price, ISBN, 
condition, description, cover image, availability and agreement. |

Image validation	add.html	| JavaScript checks the selected file extension against JPG, JPEG, PNG, GIF and WEBP. |

Image preview	add.html	| JavaScript creates the preview image after a valid file is selected and displays the 
selected filename and image. |

## 9. JavaScript Functionality

Describe the JavaScript features that should be implemented in your website.

JavaScript feature	Page	How it works

Image extension validation	add.html	| Reads the selected filename, extracts the extension and checks it against 
an allowed extensions array. Invalid files are rejected and an error message is shown. |

Image preview	add.html	| Creates a preview `<img>` element with JavaScript and uses `URL.createObjectURL()` to 
display the selected valid image. |

Gallery modal	gallery.html	| Reads `data-image` and `data-title` from the clicked gallery item and updates the 
Bootstrap modal. Previous and Next buttons update the current image index. |

Book status filter	books.html	| Reads the selected filter value and compares it with each row's `data-status`. 
Non-matching rows receive Bootstrap's `d-none` class. |



## 10. Form Validation

All major Add Book form controls are associated with visible labels using matching `for` and `id` attributes. 
Required fields include Book Title, Author Name, Genre, Publication Year, Price, ISBN, Book Condition, Description, 
Cover Image, Availability Status and the agreement checkbox.

Text inputs are used for title, author and ISBN; number inputs are used for year and price; select elements are used 
for genre, condition and availability; a textarea is used for the description; and a file input is used for the book cover.

The cover-image input accepts `.jpg`, `.jpeg`, `.png`, `.gif` and `.webp`. JavaScript checks the selected extension 
before displaying the preview. If the file is invalid, the input receives an invalid state, the preview remains 
hidden, the file selection is cleared and the user receives an error message. A valid image displays the selected 
filename and preview.

## 11. Accessibility and Usability

The project uses unique page titles, consistent navigation, semantic page structure, meaningful headings, visible 
form labels and descriptive image `alt` text. The navigation includes an accessible mobile toggle label and the 
carousel includes visually hidden Previous/Next text. The form uses browser required-field validation and gives clear 
feedback for invalid image types. Bootstrap responsive layouts help keep the pages usable across desktop, tablet and 
mobile screen sizes.

## 12. Testing and Validation

Complete this section after testing your website.

HTML Validation
File	Result	Notes
index.html	| Pass | W3C validation complted with no errors or waning. |

books.html	| Pass | W3C validation completed after replacing non-heading sections with appropriate container elements. |

gallery.html	| Pass | W3C validation completed after correcting modal accessibility structure. |

add.html	| Pass | W3C reported no errors or warnings after the preview image was changed to be created by JavaScript. |
| Deployed site links/assets | Pass | The deployed website was tested on the Coreteaching server and the pages, CSS, 
JavaScript and images loaded correctly. |


##CSS Validation
File	Result	Notes
assets/css/style.css	| Pass | W3C CSS validator completed with no errors after correcting the gradient syntax. |

##Functionality Testing
Feature tested	Result	Notes
Navigation links	| Pass | Navigation between Home, Browse Books, Gallery and Add Book works. |

Carousel	| Pass | Previous and Next carousel controls work. |

Gallery modal	| Pass | Covers open in the modal and Previous/Next work after correcting the Previous button ID. |

Book status filter	| Pass | Show All, Available, Reserved and Sold filters were tested successfully. |

Add Book form validation	| Pass | Empty required fields are blocked and browser validation messages appear after 
removing `novalidate`. |

Image preview	| Pass | Valid image types show the selected filename and image preview; invalid extensions are rejected. |

| Deployed site links/assets | Pass | All pages, links, CSS, JavaScript and images were tested successfully on the Coreteaching server. |


## 13. Deployment

Provide details of your deployed website.
## 13. Deployment

| Item | Details |
|---|---|
| Deployed website URL | https://jupiter.csit.rmit.edu.au/~s4160335/wp/a1/index.html |
| Coreteaching server | Titan |
| Deployment folder | `public_html/wp/a1/` |
| `.htaccess` location | `public_html/.htaccess` |

## 14. Git and Development Process

Briefly describe how you used Git during the project.

I used Git throughout the development of the BookVerse website and made 6 meaningful commits across different development days.
I committed changes after completing and testing important stages of the project rather than making one large commit at the end.

My commits show the progressive development of the website, including the initial page structure, HTML content, CSS styling and
responsive design, JavaScript functionality, testing, debugging, and validation fixes.

The Git history shows how the project developed from the basic website structure to complete responsive and interactive version.
some commits also relate directly to the debugging records in process-evidence.md, where I recorded the probem, root cause, fix,
verification, and related Git commit.

This process help me keep a clear record of my development progress and connect important changes and debugging work with the Git history.

## 15. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:
- [y] I used AI tools meaningfully during this assessment.
- [y] I recorded meaningful AI use in `process-evidence.md`.
- [y] I reviewed, tested, and adapted AI-assisted output.
- [y] I can explain all AI-assisted code submitted.

I used ChatGPT mainly for planning, explanation, structure checking, debugging support and validation guidance. 
I did not accept AI suggestions automatically; I tested changes with Live Server, browser developer tools, 
W3C validation and JSHint, and changed or rejected suggestions when they did not match the project requirements or 
working behaviour.


Detailed AI usage records must be included in process-evidence.md.

## 16. Process Evidence

Confirm that your process evidence file has been completed.

Requirement	Completed?
process-evidence.md file included | Yes | 
At least 2 debugging records included | Yes |
At least 2 meaningful AI usage records included	| Yes |
Relevant commit links included	| Yes |

## 17. Known Issues or Limitations

No known issues at the time of submission.
