# Process Evidence Log

This file combines:
1. Debugging records
2. AI (e.g., Copilot/ChatGPT) usage logs

You must maintain this file throughout development.

---

## General Instructions
- Record entries as you work (not at the end)
- Be honest and specific
- Link to commits.Each debugging record must include at least one related GitHub commit 
(using commit hash and URL).
- Superficial or fabricated entries will not receive marks

---

# Section 1: Debugging Records

## Bug 1

**Date Identified:**  
10/09/2026

**Date Fixed:**  
15/09/2026

**File:**  
a2/inde.php, a2/assets/css/style.css

**Related Commit:**  
706481c - Set up PHP pages, shared includes and site structure  
https://github.com/s4160335/wp/commit/706481c0aa28938fa95d28c7ff56d25df6dced0f

**Symptom:**  
After converting the a1 Home page from HTML to PHP a2, the Home page did not look correct. The carousel, cover images, Feature Books cards and View Details links needed fixing while I was trying to keep the page visually consistent with the required and reference page image.

**Steps to Reproduce:**  
I opened index.php through XAMPP and compared it with the reference image. I checked the four carousel images, Featured Books cards, cover images and View Details links.

**Root Cause:**  
A1 used static HTML, while a2 required PHP and database-driven book content. During the conversion, some PHP structure, image paths, dynamic links, database output and css did not produce the excepted result. The Feature Books query also needed to display the expected four books  in the correct visual order.

**Fix:**  
I converted the Home page to PHP, used the shared includes and connected Feature Books to database while keeping the four carousel images static. I corrected the image paths and dynamic Details links, the card output and query ordering, and adjusted the required css so the page matched the intended design.

**Verification:**  
I refreshed index.php through XAMPP and compared it with the image reference. I confirmed that the carousel images loaded correctly, the expected four featured Books displayed in order, all cover images appeared, the cards displayed correctly, and each View Details button opened the correct book details page.

---

## Bug 2

**Date Identified:**
11/09/2026

**Date Fixed:** 
29/09/2026 

**File:**
a2/details.php, a2/add.php, a2/includes/db_connect.inc

**Related Commit:**
c526344 - Add database book details and Add Book processing
https://github.com/s4160335/wp/commit/c52634464822023deb5c1598b3a948114d130f56

**Symptom:**
After the main PHP structure was working, the database features still needed debugging. The Details page had to load the correct book from its ID, and Add Book had to insert a new record and save its uploaded cover correctly.

**Steps to Reproduce:**
I opened books from Browse Books and tested details.php with different IDs. I then submitted the Add Book from with test book  information and a cover image and checked phpMyAdmin, the cover folder, Browse Books and the Details page.

**Root Cause:**
The Details page needed to safely pass the URL book ID into database query. Add Book also needed matching form values, server-side checks, a prepared INSERT statement and correct handling of the temporary PHP upload before saving the permanently.

**Fix:**
I used a prepared statement in details.php and bound the book ID as an integer. I added a Book not fund. result for an ID with no matching record. In add.php, I added the required form processing and validation, used a prepared INSERT statement, generated a unique image filename annd used move_uploaded_file() to save cover in assets/images/covers/.

**Verification:**
I tested existing and non-existent book IDs, then added a test book through the form. The new record appeared in phpMyAdmin and Browse Books, its unique cover file appesred in the covers folder, and its Details page showed the correct information. I removed the test record and image after testing.

---

## Bug 3

**Date Identified:** 
20/09/2026

**Date Fixed:** 
30/09/2026

**File:**
a2/assets/js/scripts.js, a2/add.php

**Related Commit:** 
5b9d8f9 - Fix Add Book JavaScript form submission
https://github.com/s4160335/wp/commit/5b9d8f92276cef7fa33c7c10dc13b214784c2ff3

da2ff3f - Improve Add Book validation, upload handling and layout
https://github.com/s4160335/wp/commit/da2ff3f5cd647383d791ddcd74ff072a8c89fa45

**Symptom:**
After carrying the a1 JavaScript into a2, the Add Book form could not be used for the new PHP database insertion because the a1 script prevented the form from submitting.

**Steps to Reproduce:**
I selected a valid cover image, completed the Add Book form and tried to submit it. The image validation and preview worked, but the form submission was still being stopped by the JavaScript carried over from a1.

**Root Cause:**
In a1, the Add Book page was only front-end, so event.preventDefault() was used to stop the form from submitting. In a2, the form needed to submit normally so add.php could process the values, upload the cover image and insert the new book into MySQL.

**Fix:**
I removed the a1 preventDefault() form submission code so the Add Book form could sumit normally to add.php. I kept the existing image extension validation and preview functionality. I also comppleted the server-side form checks in add.php so invalid values or a failed image upload prevent the database INSERT. During final HTML validation, I removed the static preview image with the empty src from add.php and kept the existing JavaScript-generated preview image instead.

**Verification:**
I selected a valid cover image and confirmed that the preview still worked, then submitted a test book. The form reached the PHP processing, the new record was inserted into the database and the uploaded cover was saved correctly

---

## Bug 4

**Date Identified:**
20/09/2026  

**Date Fixed:**  
30/09/2026

**File:**
a2/add.php

**Related Commit:**  
da2ff3f - Improve Add Book validation, upload handling and layout
https://github.com/s4160335/wp/commit/da2ff3f5cd647383d791ddcd74ff072a8c89fa45

**Symptom:**
While comparing the a2 Add Book page with the tutor image reference, I noticed that the spacing aroud the form and the heading icon did not match the required design.

**Steps to Reproduce:**
I opened add.php through XAMPP and compared it with the tutor image reference and my ealier page structure. The form content was working, but the spacing around the main conteainer and the icon beside the Add Book heading looked different.

**Root Cause:**
I first through the problem was caused by the custom css, but after comparing the actual page code I found that the a2 container was missing the Bootstrap py-3 class and the heading was using a different Material Icon.

**Fix:**
I restored the py-3 Bootstrap class on the Add Book container and changed the heading icon to the required add_box icon. I did not add extra css because the existing styling was already correct.

**Verification:**
I refreshed add.php and compared it agian with the tutor' image reference. The form spacing and Add Book heading were displayed correctly without changing the exiisting css.

---

# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
10/09/2026

**Task Description:**  
Plan the conversion of my a1 stastic website into the required a2 PHP structure explain steps without losing the existing visual design

**Tool Used:**  
ChatGPT

**Prompt / Input:**  
I am working on an assessment to build a website using PHP. I already have HTML pages with the required structure and design, and I need the PHP version to keep the same visual design shown in the reference images. Explain what I need to do and give me a step-by-step plan to convert the HTML pages to PHP, create the required shared includes, and then connect the website to the database.

**AI Output Summary:**  
ChatGPT explained the conversion process step-by-step further. It suggested changing the required HTML pages to PHP, separating repeated sections into shared header, navigation and footer include files, keeping the HTML/CSS design, and then adding the database connection and dynamic book content.

**What You Accepted:**  
I followed the shared PHP include structure and used PHP/ database content for the parts of the website that needed to become dynamic. I also kept the existing a1 HTML structure and CSS where they were still suitable.

**What You Changed:**  
I adjusted the generated PHP to fit my existing a1 design and the reference image. I kept the carousel images static as required and changed the feature Books query and page layout so the Home page displayed the expected four books and matched the required visuil design.

**Validation Performed:**  
I ran the PHP pages through XAMPP and compared then with the tutor reference image. I checked the carousel, cover images, featured Books cards and View Details buttons and confirmed that the links opened the corrected book details.

**Issues Identified:**  
Some suggested changes affected parts of layout that were correct. I compared the a1 and a2 code before making futher changes and only kept changes that were needed and worked correctly.

---

## AI Task 2

**Date:** 
11/09/2026 

**Task Description:**
Implement and test the a2 database functionally, including book details, prepared statements, Add Book form processing, image upload and validation.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
My PHP pages are now set up. Explain step-by-step how I should connect BookVerse to my MSQL, display one selected book using its ID, and make the Add Book form insert a new book and save its cover image safely.

**AI Output Summary:**  
ChatGPT expalined the database connection, prepared statements, quey-string book ID, INSERT proccessing and PHP file-upload process, including hy an uploaded file first has a temporary filename.

**What You Accepted:**  
I used procedural MySQLi, prepared statements for the Details and Add Book operations, a unique filename for each upload cover. I also kept the temporary filename approach and used move_uploaded_file() to save it.

**What You Changed:**  
I kept the supplied database schema and field values rather than changing the database design. I also kept the form processing inside add.php because a separate process_add.php was optional.

**Validation Performed:**  
I tested existing and invalid Is and added a temporary test book. I checked the new database row, generated cover file, Browse Books result and Details page before deleting the test data.

**Issues Identified:**  
Testing showed that database IDs can contain gaps, so I checked the actual generated ID instead of assuming what the next ID would be.

---

## AI Task 3

**Date:** 
20/09/2026

**Task Description:**
Adapt the existing a1 Add Book JavaScript so the form could work with the new a2 PHP processing.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
My a1 Add Book page already has image validation and preview, but a2 now needs the form to submit to PHP and insert the book into MySQL. Check my existing JavaScript and explain what needs to change without rebuilding features that already work.

**AI Output Summary:**  
ChatGPT identified that a1 script used event.preventDefault() to stop form submission. It explained that this needed to be removed for a2 so add.php could receive and process the submitted form.It also showed that the existing image validation and preview could be kept.

**What You Accepted:**  
I removed the code that prevented the form from submitting and kept the exisiting image validation and preview functionality.

**What You Changed:**  
I revomed the a1 form submisson blocking code but ept the existing image validation and preview functionality. During final HTML validation, I kept the preview image creation in JavaScript instread of leaving a static image element with an empty src in add.php..

**Validation Performed:**  
I confirmed that the image preview still worked and then submitted a test book. The form reached PHP processing the database record was inserted and the uploaded cover was saved.

**Issues Identified:**  
Some JavaScript from a1 could be reused, but the form submission behaviour had to change because a2 was no longer only a front-end website.

---

## AI Task 4

**Date:** 
30/09/2026

**Task Description:**
Review the Add Book page an find why its layout looked different from the required design without changing parts that were already working.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
Compare my a1 and a2 Add Book code and find the exact reason the page look different before changing the css.

**AI Output Summary:**  
ChatGPT compared the a1 and a2 page structure and identified that the visual difference came from a missing Bootstrap py-3 class and a different Material Icon rather than the main css.

**What You Accepted:**  
I restored the py-3 class and changed the heading icon to add_box..

**What You Changed:**  
I did not keep the unnecessery css adjustments that had been suggested before the actual cause was found. I used the smaller structural fix after comparing the working a1 and a2 code.

**Validation Performed:**  
I refreshed the Add Book page through XAMPP and compared it with the tutor reference image again. The spacing and heading icon displyed correctly without changing the existing css.

**Issues Identified:**  
The first suggestions focused on css before the page structure had been compared properly. Checking the a1 and a2 code directly identified the actual cause and avoided unnecessary changes.

# Final Reflection (End of Assessment)

**What AI was most useful for:**
AI was most used for explaining PHP/MySQL cocepts further, checking prepared statements, reviewing the HTML-to-PHP conversing, and helping trace problems acroos PHP, JavaScript, CSS and the database.

**Where AI was incorrect or misleading:**
AI was less useful when it suggested a change before the real cause had been checked. The clearest example was the Add Book layout, where css changes were initially considered even though the actual difference was a missing Bootstrap py-3 class and a different icon.

**What you learned about debugging:**  
I learned to reproduce the problem first, compare the working and non-working code, identify the root cause, make one targeted change and then test again. I also learned to check the database, URL values, generated HTML and file paths instead of assuming every visual problem comes from CSS.

**How your approach changed over time:**  
At the start I mainly focused on converting the pages and getting them to display. As the project developed, I started testing one feature at a time and checking the actual source of a problem before changing code. This made the later databse, JavaScript and form debugging more controlled and easier for me to explain.
