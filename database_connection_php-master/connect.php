<?php
// Establish the database connection


$con = mysqli_connect('localhost', 'root', '', 'survey');

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verify the SQL query with proper placeholders
$query = "
    INSERT INTO registration (
        name, email, gender, college, rollNumber, branch, year, event, 
        eventstartdate, eventenddate, domain, feedback,certificate
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
";

// Prepare the SQL statement
$stmt = $con->prepare($query);

// Check if the preparation was successful
if ($stmt === false) {
    die("Prepare failed: " . mysqli_error($con));
}
if (file_exists("download/" . $_FILES["file"]["name"]))
					{
						echo '<script language="javascript">alert(" Sorry!! Filename Already Exists...")</script>';
					}
					else
					{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"download/" . $_FILES["file"]["name"]) ;
                    }
// Define variables before calling bind_param()
$name = $_POST['name'] ?? ''; // Proper initialization outside bind_param
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';
$college = $_POST['college'] ?? '';
$rollNumber = $_POST['rollNumber'] ?? '';
$branch = $_POST['branch'] ?? '';
$year = $_POST['year'] ?? 0; // Default to 0 if not set
$event = $_POST['event'] ?? '';
$eventstartdate = $_POST['eventStartDate'] ?? '';
$eventenddate = $_POST['eventEndDate']?? '';
$domain = $_POST['domain'] ?? '';
$certificate=$_FILES["file"]["name"]?? '';
$feedback = $_POST['feedback'] ?? '';


// Now bind parameters, passing pre-defined variables
$stmt->bind_param(
    "ssssisissssss",
    $name,
    $email,
    $gender,
    $college,
    $rollNumber,
    $branch,
    $year,
    $event,
    $eventstartdate,
    $eventenddate,
    $domain,
    $feedback,
    $certificate
);
if ($stmt->execute()) {
    // Start the HTML output with PHP
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Download the Files</title>
        <!-- Inline CSS (consider moving to external CSS file for large projects) -->
        <style>
            body {
                background-color: rgb(252, 252, 252);
            }

            #form {
                background-color: rgb(167, 227, 245);
                width: 25%;
                border-radius: 4px;
                margin: 120px auto;
                padding: 50px;
                box-shadow: 10px 10px 5px rgb(133, 179, 231);
            }

            #btn {
                color: rgb(253, 250, 250);
                background-color: rgb(189, 47, 22);
                padding: 10px;
                font-size: large;
                border-radius: 10px;
            }

            @media screen and (max-width: 570px) {
                #form {
                    width: 65%;
                    padding: 40px;
                }
            }
        </style>
    </head>
    <body>
        <div id="form">
            <h1>Download the files</h1>
            <form name="form" action="display.php" onsubmit="return isvalid()" method="POST">
                    <label for="event">Select Event:</label>
                    <select name="event" id="event" onchange="showBox()">
                        <option value="">--select--</option>
                        <option value="Hackathon">Hackathon</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Conference">Conference</option>
                        <option value="Webinar">Webinar</option>
                        <option value="Internship">Internship</option>
                    </select>
                <input type="submit" id="btn" value="Click Here" name="Click Here" />
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
}

// Close the statement and the database connection
$stmt->close();
$con->close();
?>