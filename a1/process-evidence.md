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
https://github.com/s4160335/wp/commit/a095cd1840300f29fa6006688af6d146ddca78a8

a095cd1

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
18/08/2026
**Date Fixed:**  
18/08/2026

**File:**  
assets/css/style.css

**Related Commit:**  
https://github.com/s4160335/wp/commit/f903eea1307c4cd63c6cc82816479f54aa1fd401

f903eea

**Symptom:**  
on the mobile version of the Browser Books page, the books table was wider than the screen. the user had to scroll 
horizontally to see information such as the price and status. 

**Steps to Reproduce:**  
1. I Open `books.html`using Live Server.  
2. I opened Developer Tools and switched to mobile screen size.
3. I selected a status suach as reserved or show all.  
4. The table extends beyond the visible screen and requires horizontal scrolling.

**Root Cause:**
the contained six columns and used white-space: nowrap, which prevented the content form fitting comfortably on a small 
mobile screen.

**Fix:**  
I updated the mobile css for the books table. I reduced the font size and phone padding, allowed text to wrap, and hid 
the Genre and Year columns on small screens so the important Title, Author, Price, and Status information remained visible.

**Verification:**  
I tested book.html again using Live server from Vs code to view mobile screen. The table displayed Title, Author, Price, and
Status within the mobile layout without requiring horizontal scrolling.

---

# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
17/08/2026

**Task Description:**  
Plan and check the structure of the BookVerse assessment before and during development, including the Home, Books, 
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
I accepted the AI's suggestion to breake to break the assessment into smaller development steps and work through the
required pages and features separatelt. I also followed the suggested overall structure of shared navigation, sementic
HTML, Bootstrap, one css file, and one JavaScript file.

**What You Changed:** 
I adapted the AI's suggested plan instead of following it exactly. I changed the order and details of some development 
steps to match the assessment requirements and teachr's reference screenshots. I also kept the implementation simple and
only used suggestions that I could understand, test, and explain myself.

**Validation Performed:**  
I tested each page with Live Server, checked browser behaviour, used the W3C HTML validator for all HTML pages, 
the W3C CSS validator for `style.css`, and JSHint for `scripts.js`.

**Issues Identified:**  
Some AI suggestions needed correction during testing. For example, a few HTML validation and JavaScript changes 
had to be adjusted after checking the validator output and browser Console. I did not keep changes that broke working 
functionality.

---

## AI Task 2

**Date:**  
18/08/2026

**Task Description:**  
Used AI to help test and improve the responsive Browser Book page and JavaScript status filter.

**Tool Used:**  
ChatGPT

**Prompt / Input:**  
on the mobile version of my Browser Books page, the table does not show all of the book details and I have to scroll
to the right. Is this normal, or should I fix it? I already have a responsive table and mobile css. I want to keep the
page simple and responsive without unnecessary parts of the project.

**AI Output Summary:**  
The AI explained that horizontal scrolling is valid for responsive Bootstrap tables, but suggested that this particular
table could be improved for mobile because six columns wer difficult to fit on a small screen. it suggested reducing mobile
spacing and hiding less important columns such as Genre and Year wwhile keeping Title, Author, Price, and Status visible.

**What You Accepted:**
I accepted the suggestion to simplify the Books table on mobilr by keeping the most important information visible and 
hiding less important columns.

**What You Changed:**  
The AI initially suggested several responsive changes to make the full table fir on mible. After testing them, the
table still required horizontal scrolling. instead of continuing to reduce all columns, I changed the approach and kept
Title, Author, price, and Status visible while hading Genre and Year only on mobile.


**Validation Performed:** 
I tested the Books page at desktop and mobile screen size. on the desktop all book information remained visible. on mobile,
the four important columns fit within the page without horizontal scrolling. I also tested Show All, Available, Reserved, and Sold to
confirm that the JavaScript status filter continued to work.

**Issues Identified:** 
The fist responsive changes did not completely solve the problem because the table was still wider than the mobile screen.
I tasted the result and made another adjustment rather than accepting the first suggestion as the final solutions.
---

# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  
AI was usefull for breaking the assessment into manageable steps, explaining unfimiliar code, helping me 
understand validation and console messages, and suggesting possible approaches when debugging responsive
layout and JavaScript problems. it was also useful for comaparing diffrent ways of solving a problem before
I decided which approach suited this assessment.

**Where AI was incorrect or misleading:**  
Some AI suggestions were too general or did not fully solve the problem after testing. For example, the first
responsive changes to the Books table still required horizontal scrolling on mobile. I learned not to accept a 
suggestion just beacuse it sounded correct. I compared suggestions with the assessment requirements, teacher's 
reference screenshots, my existing code, validator results, and actual browser behaviour before keeping a change.

**What you learned about debugging:** 
I learnt to reproduce the problem first, check the browser Console, compare HTML IDs and JavaScript selectors
carefully, make one change at a time, and test again. I also learnt that responsive problems sometimes require
testing diffrent approaches rather than only reducing sizes. For the Books table. I eventually kept the most 
important details visible on mobile while keeping complete information available on desktop.

**How your approach changed over time:** 
At the beginning I focused mainly on building the required pages and getting the wesite to look close to the
reference screenshots. A development continued, I became more systematic by testing each feature separatelt, 
checking desktop and mobile layouts, using HTML, CSS, and JavaScriptvalidators, checking the browser console, and
recording the cause and verification of the debugging fixes. I also became more selective with AI suggestions by
testing and modifying them instead of automatically using the first solution provided.