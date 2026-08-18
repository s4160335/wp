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
16/08/2026

**Date Fixed:**  
17/08/2026

**File:**  
gallery.html and assets/js/scripts.js

**Related Commit:**  
To add after commit: commit hash and GiHub commit URL

**Symptom:**  
The Gallery modal  opened correctly, but the Previous and Next buttons did not change the displayed image.

**Steps to Reproduce:**  
1. Open `gallery.html` using Live Server.  
2. Click any gallery image to open the modal.  
3. Click the Previous or Next button.  
4. The image does not change.  
5. Open the browser Console and a JavaScript error appears saying that `addEventListener` is being called on `null`.

**Root Cause:**  
The Previous button ID in the HTML did not match the ID used in JavaScript. The HTML used previouseImage, while JavaScript searched 
for previousImage. Because the element could not be found, getElementById() returned null, which caused the script to stop before 
the navigation event listeners were attached.

**Fix:**  
Changed the Previous button ID in gallery.html from previouseImage to previousImage so it matched the JavaScript.

**Verification:**  
Reloaded the page using Live Server, opened the modal, and tested both Previous and Next. Both buttons cycled through the gallery 
images correctly. I also checked the browser Console and there were no red JavaScript errors.

---

## Bug 2

**Date Identified:**  

**Date Fixed:**  

**File:**  

**Related Commit:**  

**Symptom:**  

**Steps to Reproduce:**  

**Root Cause:**  

**Fix:**  

**Verification:**  

---

# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
17/08/2026

**Task Description:**  
Planning and checking the structure of the BookVerse assessment before and during development, including the Home, Books, 
Gallery, and Add Book pages.

**Tool Used:**  
ChatGPT

**Prompt / Input:**  
I am a working a web programming assessment building a BookVerse website using HTML, CSS, Bootstrap and JavaScript. 
Please help me plan the steps for implementing the required pages and features, including the books status filter, 
gallery modal, and add-book form. Keep the explanations clear and help me understanding the structure rather 
than just giving me a finished project.

**AI Output Summary:**  
The AI broke the assessment into smaller development steps and explained how the required pages could be structured 
using shared navigation, semantic HTML, Bootstrap layout, one external CSS file, and one external JavaScript file. It 
also explained the purpose of the Books filter, Gallery modal, and Add Book image preview/validation features.

**What You Accepted:**  
I followed the suggested page-by-page structure and used the plan to build and test each required feature separately 
instead of trying to finish the whole site at once.

**What You Changed:**  
I adapted the suggested plan to match the assessment requirements and the teacher's reference screenshots. During development,
I made my own decisions about layout sizes, spacing, colors, card sizes, and header/footer sizing. I also kept the 
implementation at a level that I could understand.

**Validation Performed:**  
I tested each page with Live Server, checked browser behaviour, used the W3C HTML validator for all HTML pages, 
the W3C CSS validator for `style.css`, and JSHint for `scripts.js`.

**Issues Identified:**  
Some AI suggestions needed correction during testing. For example, a few HTML validation fixes and JavaScript changes 
had to be adjusted after checking the validator output and browser Console. I did not keep changes that broke working 
functionality.

---

## AI Task 2

**Date:**  

**Task Description:**  

**Tool Used:**  

**Prompt / Input:**  

**AI Output Summary:**  

**What You Accepted:**  

**What You Changed:**  

**Validation Performed:**  

**Issues Identified:**  

---

# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
