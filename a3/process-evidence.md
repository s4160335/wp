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
19/10/2026

**Date Fixed:**  
20/10/2026

**File:**  
a3/details.php

**Related Commit:**  
9ccba3d - Fix book cover deletion and improve details page security
https://github.com/s4160335/wp/commit/9ccba3d32946dab30db646ad649e4f4412aca419

**Symptom:**  
After deleting a book, its database record was removed, but the uploaded cover image remined in the covers folder.

**Steps to Reproduce:**  
1. Log in to BookVerse.
2. Add a temporary book with an uploaded cover image.
3. Delete the book from its Details page.
4. Check the assets/images/covers folder.
5. Observe that the uploaded image still exists.

**Root Cause:**  
The deletion code used `$imagesPath` instead of the defined variable `$imagePath`. The filename validation pattern also initial did not accept some generated filenames.

**Fix:**  
Corrected the variable name to `$imagePath` and updated the filename validation pattern to accept both 13- and 14-character hexadecimal identifiers.

**Verification:**  
Added another temporary book with a cover image, deleted it, and cofirmed that both the database record and uploaded cover file were removed successfully.

---

## Bug 2

**Date Identified:**
19/10/2026

**Date Fixed:** 
20/10/2026 

**File:**
a3/details.php

**Related Commit:**
9ccba3d - Fix book cover deletion and improve details page security
https://github.com/s4160335/wp/commit/9ccba3d32946dab30db646ad649e4f4412aca419 

**Symptom:**
When a user opened a book details page with an invalid or missing book ID, the page displayed "Book not found." but did not return the appropriate HTTP 404 status.

**Steps to Reproduce:**
1. Opened `http://localhost/wp/details.php?id=999` .
2. Observed the "Book not found." message.
3. Check the HTTP response status.
4. Observe that the page originally returned HTTP 200 instead of HTP 404.

**Root Cause:**
The page displayed an error message when a book was not found, but the PHP code did not explicity set the HTTP response status to 404.

**Fix:**
Added the following PHP code before including the header and navigation:
if (!$book) {
    http_response_code(404);
}

**Verification:**
Opened the Details page with a nonxistet book ID and confirmed that :Book not found." still appeared. Used `curl.exe -I` in the VS code ternimal to verify that the server returned HTTP 404 Not found.

---

## Bug 3

**Date Identified:** 
24/10/2026

**Date Fixed:** 
25/10/2026

**File:**
a3/edit.php

**Related Commit:** 
25ecc54 Complete Edit Book functionality and start Seller Profile
https://github.com/s4160335/wp/commit/25ecc548a822f5cf9680338920b17106dd63fdcb 

**Symptom:**
While developing the Edit Book functionality, i encountered an issue where the previous uploaded cover image remained in the `assets/images/covers/` folder after replacing it with a new image.

**Steps to Reproduce:**
1. Log in to bookverse_test.
2. Opened `edit.php` for a book owner by the logged-in user.
3. Selected a replacement cover image.
4. Click Save Changes.
5. Check the `assets/images/covers/` folder.
6. Observe that the previous uploaded cover image was still present.

**Root Cause:**
The earlier version of `edit.php` did not include the completed image clean-up functionality required to remove the previous uploaded cover after a successful database update.

**Fix:**
Completed the image replacement and clean-up functionality in `edit.php`.

The uploaded code saves the replacement image, updates the book record and checks whether the previous cover image is still referenced by another book.

If the previous cover is no longer used and its filename matches the expected generated format, PHP removes the file using `unlink()`.

**Verification:**
On 28/10/2026, I retested the image replacement functionality using a book I owned.

I selected a new cover image and clicked `Save Changes`. The website displayed the message "Book updated successfully".

I confirmed that the new cover appeared on the Details page. I then checked the `assets/images/covers/` folder and verified that the previous uploaded cover had been removed.

The image replacement and clean-up test passed successfully.

---

## Bug 4

**Date Identified:**
28/10/2026

**Date Fixed:**  
28/10/2026

**File:**
a3/edit.php, a3/assets/css/style.css

**Related Commit:**  
046e6af Fix Edit Book cover preview and improve image styling
https://github.com/s4160335/wp/commit/046e6af655f80215f8ad98ab460273cd81f4d8b4

**Symptom:**
When selecting a replacement cover image on the Edit Book page, the new image preview did not apear. After adding the preview functionality, the image initially displayed at an excessively large size.

**Steps to Reproduce:**
1. Log in as bookverse_test.
2. Opened `edit.php` for a book owned by the logged-in user.
3. Select a replacement cover image.
4. Observe that the replacement preview does not appeared.
5. inspect the HTMl elements required by the existing JavaScript preview function.

**Root Cause:**
The existing JavaScript in `assets/js/scripts.js` required the HTML elements `imagePreviewContainer`, `previewFileName` and `imageError`.

These elements were missing from `edit.php`, preventing the preview functionality from working correctly.

The replacement image needed CSS styling to control its displayed dimensions.

**Fix:**
I added the messing preview elements to `edit.php`:

<div id="imageError" class="text-danger mt-2"></div>

<div id="imagePreviewContainer" class="mt-2 d-none">
    <p id="previewFileName" class="mb-2"></p>
</div>

I also updated `assets/css/style.css` to control the replacement preview size:

/* Edit Book - Replacement Cover Preview */
.edit-form #imagePreviewContainer {
    max-width: 100px;
}

.edit-form #imagePreview {
    display: block;
    width: 80%;
    height: 55px;
    object-fit: contain;
    border-radius: 6px;
}

The existing JavaSscript preview function was reused without adding duplicated JavaScript code.

**Verification:**
On 28/10/2026, I selected a replacement cover image on the Edit Book page.

The selected filename and replacement image appeared before submitting the form.

I adjusted the CSS until the preview displayed at an appropriate size without verflowing the form.

The original cover remained visible, and replacement preview worked successfully.

---

## Bug 5

**Date Identified:**
25/10/2026

**Date Fixed:**
25/10/2026

**File:**
a3/search.php

**Related Commit:**
7792115 Add completed Search page with corrected SQL query and validation
https://github.com/s4160335/wp/commit/7792115f40a683497433d4cdd030aaeb51223878

**Symptom:**
During development, the Search page contained errors in its SQL query and page structure. These issues needed to be corrected before the search functionality could work properly.

**Steps to Reproduce:**
1. Opened `search.php`
2. Review the SQL query used to search for books.
3. Check the conditions and placeholders in the query.
4. Observe that the final search condition was missing the `LIKE` keyword.
5. Check the page structure for additinal errors.

**Root Cause:**
The SQL query container an incomplete search condition with a missing `LIKE` keyword and an incorrectly separated placeholder. The page also contained an unwanted < character and was missing its footer include.

**Fix:**
I corrected the SQL query by adding the missing `LIKE` keyword and fixing the placeholder. Roved the unwanted character and added the missing footer incude.

**Verification:**
On 25/10/2026, I checkedthe corrected PHP code and tested the search functionality using book title, including `Gatsby and The Midnight Library`. The search returned the expected results after the corrections.

# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
20/10/2026

**Task Description:**  
Debug the book deletion feature because uploaded cover images were not being removed after deleting a book.

**Tool Used:**  
ChatGPT

**Prompt / Input:**  
Help me to investigate why the uploaded cover image remained in the assets/images/covers folder after its book was deleted.

**AI Output Summary:**  
ChatGPT suggested checking the uploaded filename validation pattern, file path, and unlink() function. The filename validation was updated to support the generated filenames.

**What You Accepted:**  
I accepted the suuggestion to investigate the image deletion logic and update the filename validation pattern.

**What You Changed:**  
After further testing, I identified a variable name mismatch. The code used `$imagesPath` instead of `$imagePath`. I corrected the variable name kept the updated filename validation.

**Validation Performed:**  
I created a temporary book with an uploaded cover image, deleted the book, and checked that both the database record and image file were removed successfully.

**Issues Identified:**  
The filename validation initially rejiucted some generated filenames. A separate variable name error also prevented the image filename being deleted.

---

## AI Task 2

**Date:** 
20/10/2026 

**Task Description:**
Improve error handling in details.php when a book ID is invalid or missing.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
I shared screenshot showing the "Book not found." message and provided the relevant PHP code for review.

**AI Output Summary:**  
ChatGPT suggested adding http_response_code(404) before including the page header and navigation so that nonexistent books return the correct HTTP status.

**What You Accepted:**  
I accepted the suggested HTTP 404 handling because it improves the server reponse without changing the existing page design.

**What You Changed:**  
I added an if (!$book) condition that calls htt_response_code(404) before loading the page header.

**Validation Performed:**  
I opened details.php with a nonexistent book ID and confirmed that the page still displayed "Book not found." Then ran `curl.exe - I` in the VS code ternimal and confirmed HTTP/1.1 404 Not found.

**Issues Identified:**  
The page displayed a suitable error message but did not explicity return HTTP 404 when the requested book did not exist.

---

## AI Task 3

**Date:** 
25/10/2026

**Task Description:**
Review the Edit Book image replacement functionality and investigate why previous uploaded cover image were not being removed.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
I shared my `edit.php` code for review and ask for help checking the image replacement and file clean-up functionality.

**AI Output Summary:**  
ChatGTP assisted with reviewing the imag replacement process, including saving the new image, updating the database record and removing the previous uploaded cover.

The review focused on ensuring that the previous image was removed only after a successful update and that file still referenced by other books were not deleted..

**What You Accepted:**  
I accepted the approach of checking the previous image filename and whether another book still referenced the image before removing it.

**What You Changed:**  
I completed the image replacement and clean-up logic in `edit.php`.

The updated code uses `move_uploaded_file()` to save the replacement image and `unlink()` to remove the previous uploaded cover when it is no longer needed.

**Validation Performed:**  
On 28/10/2026, I retested the completed functionality by replacing the cover image of a book I owned.

The new cover appeared on the Details page, and the previous uploaded image was removed from the covers folder.

**Issues Identified:**  
The earlier Edit Book implementation did not include the completed image clean-up process, allowing previous uploaded cover to remain after replacement.

---

## AI Task 4

**Date:** 
28/10/2026

**Task Description:**
Debug the replacement cover image preview in `edit.php` and improve its appearance.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
I shared the JavaScript image preview code, the relevant HTML from `edit.php` and screenshots showing the preview problems.

I asked for help displaying the selected replacement and making its size consistent with the existing Edit Book design.

**AI Output Summary:**  
ChatGPT identified that the Edit Book page was missing HTML elements required by the existing JavaScript preview function.

It suggested adding the preview contianer, selected filename display and image validation error element.
ChatGPT also suggested css rules to control the preview dimensions.

**What You Accepted:**  
I accepted the recommendation to reuse the existing JavaScript preview function and add the missing HTML elements.

I also accepted the approach of using css to control the replacement preview size.

**What You Changed:**  
I updated `edit.php` to include the reqired preview elements. I added css styling for the replacement preview in `assets/css/style.css`.

After testing different dimensions, I selected a smaller preview size that suited the existing Edit Book layout.
I also updated the file input's accepted extensionsto include JPG, JPEG, PNG, GIF, WebP, matching the existing PHP and JavaScript validation.

**Validation Performed:**  
I selected a replacement image and confirmed that its filename and preview appeared before submitting the form.

The initial preview was too large, so I adjusted the css and tested it again. After several adjustments, the replacement preview displayed correctly without affecting the Add Book page.

**Issues Identified:**  
The Edit Book page was missing the HTML elements required by the JavaScript preview function. The initail preview image displayed at an excessive size.

The HTML file input also omitted GIF and WebP from its accepted extensions, even though the server-side validation supported them.

----

## AI Task 5

**Date:** 
25/10/2026 - 28/10/2026

**Task Description:**
Review the BookVerse website and improve functionalit, including search behaviour, paga structure and login/logout flash messages.

**Tool Used:** 
ChatGPT

**Prompt / Input:**  
I shared sections of my BookVerse project for review, including PHP pages and JavaScript functionality. I asked for help identifying coding errors, checking the assessment requirements and improving the website's functionality.

**AI Output Summary:**  
ChatGPT assisted with reviewing the implementation and identifying areas that required correction or improvement. The review included checking the Search page's SQL query, PHP page structure and JavaScript functionality.

The project also included JavaScript that automatically dismisses login/logout flash messages after five seconds using Bootstrap.

**What You Accepted:**  
I accepted the corrections needed for the Search page and used the review to check other parts of he website. I also included the automatic flash-message dismissal functionality to improve the user experience.

**What You Changed:**  
I corrected the SQL query and page structure in `search.php`. I also included JavaScript functionality in the project's scripts file to automatically close login/logout flash messages after five seconds.

**Validation Performed:**  
I tested the corrected Search page using book titles and confirmed that the expected search results appeared. The flash message code was reviewed, but its browser test result still needs to be recorded.

**Issues Identified:**  
The Search page container an incomplete SQL condition, an incorrectly separated placeholder and page structure issues.

The login/logout flash messages were als identified as an area where the user experience could be improved.

---

# Final Reflection (End of Assessment)

**What AI was most useful for:**
AI was most usedful for reviewing my PHP code, identifying errors and suggesting improvements. It helped me understand problem further with SQL queries, image deletion, HTTP response codes and image previews. I also used AI to review my website against the assessment requirements and identify areas that needed further testing.

**Where AI was incorrect or misleading:**
Some AI suggestions were not necessary because the functionality was already implemented in my code. For example, during the review of `add.php`, I found that the agreement checkbox already had server-side validation. This showed me that AI suggestions should not be accepted without checking the existing code. I learned to compare AI responses with my actual implementation before making changes.

**What you learned about debugging:**  
I learned that debugging involves identifying cause of problem rather than changing code without understanding it. I used Git history, code reviews and browser testing to investigate issues. I also learned how to check image files after database operations, verify HTTP response codes and test different inputs to confirm that a fix works correctly.

**How your approach changed over time:**  
AT the beginning, I found mainly on implementing the required features. As development progressed, I started reviewing my code more carefully, testing different scenarios and checking for security and validation issues. I also became more selective with AI suggestions, making sure I understood the changes before applying them. By the end of the assessment, I was using AI as a support tool while taking responsibility for testing and maintaining my own code.