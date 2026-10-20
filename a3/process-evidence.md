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

# 🔧 Section 1: Debugging Records

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
Corrected the variable name to `$imagePath` and uploaded the filename validation pattern to accept both 13- and 14-character hexadecimal identifiers.

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
1. Opened `http://localhost/wp/details.php?if=999` .
2. Observed the "Book not found." message.
3. Check the HTTP response status.
4. Observe that the page originally returned HTTP 200 instead of HTP 404.

**Root Cause:**
The page displayed an error message when a book was not found, but the PHP code did not explicity set the HTTP response status to 404.

**Fix:**
Added the following PHP code before including the header and navigation:
if (!$boo) {
    http_response_code(404);
}

**Verification:**
Opened the Details page with a nonxistet book ID and confirmed that :Book not found." still appeared. Used `curl.exe - I` in the VS code ternimal to verify that the server returned HTTP 404 Not found.

---

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
ChatGPT suggested adding htt_response_code(404) before including the page header and navigation so that nonexistent books return the correct HTTP status.

**What You Accepted:**  
I accepted the suggested HTTP 404 handling because it improves the server reponse without changing the existing page design.

**What You Changed:**  
I added an if (!$book) condition that calls htt_response_code(404) before loading the page header.

**Validation Performed:**  
I opened details.php with a nonexistent book ID and confirmed that the page still displayed "Book not found." Then ran `curl.exe - I` in the VS code ternimal and confirmed HTTP/1.1 404 Not found.

**Issues Identified:**  
The page displayed a suitable error message but did not explicity return HTTP 404 when the requested book did not exist.

---

# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
