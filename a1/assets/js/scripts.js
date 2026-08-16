//Books Page Status Filter
const statusFilter = document.getElementById("status-filter");

if (statusFilter) {
    const bookRows = document.querySelectorAll("books-table tbody tr");
    statusFilter.addEventListener("change", function () {
        const selectedStatus = statusFilter.value;
        bookRows.forEach(function (row) {
            const bookStatus = row.dataset.status;

            if (selectedStatus === "all" || bookStatus === selectedStatus) {
                row.classList.remove("d-none");
            } else {
                row.classList.add("d-none");
            }
        });
    });
}

// Gallery Modal
const galleryModal = document.getElementById("galleryModal");

if (galleryModal) {

    const galleryItems = document.querySelectorAll(".gallery-item");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("galleryModalLabel");
    const previousButton = document.getElementById("previouseImage");
    const nextButton = document.getElementById("nextImage");

    let currentImage = 0;

    // Display selected image
    function showImage(index) {
        const selectedItem = galleryItems[index];

        modalImage.src = selectedItem.dataset.image;
        modalImage.alt = selectedItem.dataset.title;
        modalTitle.textContent = selectedItem.dataset.title;

        currentImage = index;
    }

    // Open clicked image
    galleryModal.addEventListener("show.bs.modal", function (event) {
        const selectedItem = event.relatedTarget;

        currentImage = Array.from(galleryItems).indexOf(selectedItem);
        showImage(currentImage);
    });

    // Previous image
    previousButton.addEventListener("click", function () {
        currentImage--;

        if (currentImage < 0) {
            currentImage = galleryItems.length - 1;
        }

        showImage(currentImage);
    });

    // Next image
    nextButton.addEventListener("click", function () {
        currentImage++;

        if (currentImage >= galleryItems.length) {
            currentImage = 0;
        }

        showImage(currentImage);
    });
}