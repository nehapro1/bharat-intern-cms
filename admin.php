<?php
// Include your config file or any other necessary PHP files
include('config.php');

// Assuming you have some backend logic for handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submissions
    $type = $_POST['type'];
    $content = $_POST['content'];

    // Perform necessary operations such as data validation, sanitization, and storage
    // Example: Validate that the type is not empty
    if (empty($type)) {
        echo "Type is required";
    } else {
        // Sanitize data (e.g., using mysqli_real_escape_string)
        $type = mysqli_real_escape_string($conn, $type);
        $content = mysqli_real_escape_string($conn, $content);

        // Update the database or perform other backend tasks
        $sql = "INSERT INTO components (type, content) VALUES ('$type', '$content')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Component inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Froala CMS</title>

    <!-- Include Bootstrap CSS, Bootstrap Icons, Froala Editor, and Custom CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css"/>
<link href="css/froala_editor_styles.css" rel="stylesheet" type="text/css"/>
<link href="css/index.css" rel="stylesheet" type="text/css"/>

    <!-- Include Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Include Froala JS -->
    <script type="text/javascript" src="js/froala_editor.pkgd.min.js"></script>

    <!-- Include Custom JS -->
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-xl">
            <div class="container-fluid">
                <a class="navbar-brand text-green" href="#">Froala CMS</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="bi bi-eye text-blue" href="#" onclick="toggleToolbar()"></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="row mt-5 px-xl-5 mx-xl-5" id="toolbar">
        <p class="lead ms-xl-5">
            This is your CMS toolbar. You can add new components to your page by clicking any of the buttons below. To toggle the visibility of the toolbar, click the eye (<i class="bi bi-eye"></i>) icon on the navbar.
        </p>
        <div class="col-xxl-3 col-md-4">
        <div class="m-xl-5 shadow p-xl-5 rounded border border-0 toolbarBox" data-bs-toggle="modal" data-bs-target="#headingModal">
        <div class="row text-center display-4">
          <i class="bi bi-type-h1"></i>
        </div>
        <div class="row text-center h3">
          <label>Heading</label>
        </div>
      </div>
        </div>
        <div class="col-xxl-3 col-md-4">
        <div class="m-xl-5 shadow p-xl-5 rounded border border-0 toolbarBox" data-bs-toggle="modal" data-bs-target="#textModal">
        <div class="row text-center display-4">
          <i class="bi bi-fonts"></i>
        </div>
        <div class="row text-center h3">
          <label>Text</label>
        </div>
      </div>
        </div>
        <div class="col-xxl-3 col-md-4">
        <div class="m-xl-5 shadow p-xl-5 rounded border border-0 toolbarBox" data-bs-toggle="modal" data-bs-target="#linkModal">
        <div class="row text-center display-4">
          <i class="bi bi-link-45deg"></i>
        </div>
        <div class="row text-center h3">
    <label>Link</label>
         </div>
       </div>
        </div>
    <!-- ... (existing toolbar code) ... -->

<!-- Image Button -->
<div class="col-xxl-3 col-md-4">
    <div class="m-xl-5 shadow p-xl-5 rounded border border-0 toolbarBox" data-bs-toggle="modal" data-bs-target="#imageModal">
        <div class="row text-center display-4">
            <i class="bi bi-image"></i>
        </div>
        <div class="row text-center h3">
            <label>Image</label>
        </div>
    </div>
</div>

<!-- Video Button -->
<div class="col-xxl-3 col-md-4">
    <div class="m-xl-5 shadow p-xl-5 rounded border border-0 toolbarBox" data-bs-toggle="modal" data-bs-target="#videoModal">
        <div class="row text-center display-4">
            <i class="bi bi-play-btn"></i>
        </div>
        <div class="row text-center h3">
            <label>Video</label>
        </div>
    </div>
</div>

<!-- ... (existing toolbar code) ... -->

<!-- Content Form -->
<div class="row mt-5 px-xl-5 mx-xl-5">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Add the type field -->
        <div class="mb-3">
            <label for="type">Component Type:</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>

        <!-- Add the content field -->
        <div class="mb-3">
            <label for="content">Component Content:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Component</button>
    </form>
</div>



    <!-- Your existing modals and JavaScript imports -->
    <!-- ... (your existing code for modals and JS imports) ... -->

    <!-- Modal for Heading -->
    <div class="modal fade" id="headingModal" tabindex="-1" aria-labelledby="headingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="headingModalLabel">Add a heading:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="headingContent">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light"  onclick="resetValue('heading')" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="createComponent('heading')" data-bs-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
    </div>
<!-- Modal for Text -->
<div class="modal fade" id="textModal" tabindex="-1" aria-labelledby="textModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="textModalLabel">Add Text:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="textTitle" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="textTitle">
                </div>
                <div class="mb-3">
                    <label for="textContent" class="form-label">Content:</label>
                    <textarea class="form-control" id="textContent"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="resetValue('text')" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createComponent('text')" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Link -->
<div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="linkModalLabel">Add Link:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="linkURL" class="form-label">URL:</label>
                    <input type="url" class="form-control" id="linkURL" required>
                </div>
                <div class="mb-3">
                    <label for="linkText" class="form-label">Link Text:</label>
                    <input type="text" class="form-control" id="linkText">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="resetValue('link')" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createComponent('link')" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal for Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- ... (similar structure as other modals) ... -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="imageUrl" class="form-label">Image URL:</label>
                    <input type="url" class="form-control" id="imageUrl" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="resetValue('link')" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createComponent('link')" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Video -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- ... (similar structure as other modals) ... -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="videoUrl" class="form-label">Video URL:</label>
                    <input type="url" class="form-control" id="videoUrl" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="resetValue('link')" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createComponent('link')" data-bs-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>
