<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        /* CSS for styling the header */
        header {
            background-color: #f2f2f2;
            text-align: center; /* Center-aligns content */
        }

        /* CSS for styling the image in the header */
        header img {
            height: 80%;
            weight: 20%; /* Adjust height of the image */
        }
    </style>
</head>
<body>
    <header>
    <!-- Insert an image into the header -->
    <img src="Capture.png" alt="">
    </header>
    <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li class="nav-item">
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li class="nav-item">
            <a href="#events" class="navbar-link" data-nav-link>Events</a>
          </li>

          <li class="nav-item">
            <a href="#internships" class="navbar-link" data-nav-link>Internships</a>
          </li>

          <li class="nav-item">
            <a href="#projects" class="navbar-link" data-nav-link>Projects</a>
          </li>

          <li class="nav-item">
            <a href="#" class="navbar-link" data-nav-link>Contact Us</a>
          </li>

        </ul>
      </nav>
    <div class="container">
        <h2>Survey Form</h2>
        <div class="form-wrapper">
            <!-- Corrected form with POST method and proper enctype for file uploads -->
            <form action="connect.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group gender">
                    Gender:
                    <div class="genderDiv">
                        <input type="radio" name="gender" id="male" value="Male" required>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" id="female" value="Female">
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="college">College:</label>
                    <input type="text" name="college" id="college" placeholder="Enter your college name">
                </div>
                <div class="form-group">
                    <label for="rollNumber">Roll Number:</label>
                    <input type="text" name="rollNumber" id="rollNumber" placeholder="Enter your roll number" required>
                </div>
                <div class="form-group">
                    <label for="branch">Branch:</label>
                    <select name="branch" id="branch">
                    <option value="">Choose your branch</option>
                        <option value="CSM">CSM</option>
                        <option value="IT">IT</option>
                        <option value="CSE">CSE</option>
                        <option value="EEE">EEE</option>
                        <option value="ECE">ECE</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <select name="year" id="year">
                        <option value="">Choose your year</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="event">Choose Event:</label>
                    <select name="event" id="event" onchange="showBox()">
                        <option value="">--select--</option>
                        <option value="Hackathon">Hackathon</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Conference">Conference</option>
                        <option value="Webinar">Webinar</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>

                <!-- Updated hidden box functionality -->
                <div id="hiddenBox" style="display: none;">
                    <label for="eventStartDate">Event Start Date:</label>
                    <input type="date" name="eventStartDate"><br><br>

                    <label for="eventEndDate">Event End Date:</label>
                    <input type="date" name="eventEndDate"><br><br>

                    <label for="domain">Domain:</label>
                    <input type="text" name="domain" placeholder="Enter domain name"><br><br>

                    <label for="certificate">Submit Certificate:</label>
                    <input type="file" name="file"><br><br>
                </div>

                <script>
                    function showBox() {
                        var eventSelect = document.getElementById("event");
                        var hiddenBox = document.getElementById("hiddenBox");

                        if (eventSelect.value !== "") {
                            hiddenBox.style.display = "block";
                        } else {
                            hiddenBox.style.display = "none";
                        }
                    }
                </script>

                <div class="form-group">
                    <label for="feedback">What did you learn from the event?</label>
                    <br>
                    <textarea name="feedback" id="feedback" cols="10" rows="10"></textarea>
                </div>
                <button type="submit">Submit</button>
                </form>
        </div>
    </div>
</body>
</html>
