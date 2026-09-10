<?php include "includes/db_connect.inc";

$sql ="SELECT * FROM books ORDER BY book_id ASC";
$result = mysqli_query($conn, $sql);
?>

<?php
$pageTitle = "BookVerse | Browser Books";
include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="books-page">
    <div class="container books-container py-5">
        
        <!-- Page Heading-->
            <h1 class="books-title mb-4">
            <span class="material-icons">library_books</span>
            All Books
            </h1>

            <!-- Status Tilter -->
            <div class="book-filter mb-4">
            <label for="statusFilter">Filter by Status:</label>

            <select id="statusFilter" class="form-select form-select-sm">
                <option value="all">Show All</option>
                <option value="available">Available</option>
                <option value="reserved">Reserved</option>
                <option value="sold">Sold</option>
            </select>
            </div>

            <!--Books Table -->
            <div class="books-table-wrapper">
            <div class="table-responsive">

                <table class="table books-table align-middle mb-0">
                    <tbody>
                        <?php while ($book = mysqli_fetch_assoc($result)): ?>
                            <tr data-status="<?php echo strtolower($book["status"]); ?>">
                                <td>
                                    <a href="details.php?id=<?php echo $book["book_id"]; ?>">
                                        <?php echo htmlspecialchars($book["title"]); ?>
                                    </a>
                                </td>

                                <td><?php echo htmlspecialchars($book["author"]); ?></td>
                                <td><?php echo htmlspecialchars($book["genre"]); ?></td>
                                <td><?php echo htmlspecialchars($book["publication_year"]); ?></td>
                                <td><?php echo number_format((float) $book["price"], 2); ?></td>

                                <td><?php $status = strtolower($book["status"]); ?>
                                    <span class="badge status-<?php echo $status; ?>">
                                        <?php echo htmlspecialchars($book["status"]); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.inc"; ?>