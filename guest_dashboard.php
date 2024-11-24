<?php
session_start(); // Start the session
include 'connectdb.php'; // Include database connection

// Redirect to login if no user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username']; // Retrieve the username from session

// Check if the user clicked "Delete Account"
if (isset($_GET['action']) && $_GET['action'] === 'delete_account') {
    $sql = "UPDATE registereduser_ebrg SET account_status='Inactive' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        // If account deactivation is successful
        $_SESSION['account_status_message'] = "success";
    } else {
        // If there's an error in the query
        $_SESSION['account_status_message'] = "error";
    }
    header("Location: maindashboard.php"); // Redirect back to avoid re-triggering the deletion
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primary Dashboard</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="stylesheet" href="maindashboard.css" />
    <link rel="stylesheet" href="darkmode.css" />
    <!--font style links-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Use to inclue SweetAlert CSS and js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Use to inclue Google Translate API -->
    <script type="text/javascript" src="languagetrans.js"></script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body>
    <header id="header">
        <div class="hamburger" id="hamburger">
            &#9776; <!-- Unicode character for hamburger icon -->
        </div>
        <nav id="nav-menu" class="nav_menu">
            <ul>
                <li><a href="Guest_about_us.php">About us</a></li>
                <li><a href="#">Conducted Projects</a></li>
                <li><a href="Guest_vision.php">Vision</a></li>
                <li><a href="Guest_mission.php">Mission</a></li>
                <li><a href="#" id="darkModeLink">Dark Mode</a></li>
                <li><a href="index.php">Back to Login</a></li>
                <!-- Language translation section as a list item -->
                <li>
                    <div id="Langtrans">
                        <div id="google_translate_element" style="display: block;"></div>
                    </div>
                </li>
            </ul>

        </nav>
        <div class="nav_logo">
            <img src="logo/mainpage_logo.png" alt="EBRGY logo">
        </div>
        <!--For search bar-->
        <input type="text" placeholder="Search..." class="search_bar">
    </header>
    <footer>
        <nav id="nav_left" class="nav_left">
            <ul>
                <li><a href="mission.html">Mission</a></li>
            </ul>
        </nav>
        <div class="footer_center">
            <p>Copyright © 2024. All Rights Reserved</p>
        </div>
        <nav id="nav_right" class="nav_right">
            <ul>
                <li><a href="vision.html">Vision</a></li>
            </ul>
        </nav>
    </footer>

    <div class="guest_buttons">
        <button id="Guest_announcementsBtn" class="a1" onclick="showDiv('announcements')">announcements</button>
        <button id="Guest_eventsBtn" class="e1" onclick="showDiv('events')">events</button>
        <button id="Guest_contact_usBtn" class="h1" onclick="showDiv('hotlines')">contact us</button>
    </div>

    <div id="announcements" class="content-div">

        <div id="AnnouncementContainer">
            <!-- Announcements will be dynamically loaded here -->
        </div>
        <div style="height: 110px;"></div>

        <script>
            function loadAnnouncements() {
                fetch('announcement-content.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('AnnouncementContainer').innerHTML = data;
                    })
                    .catch(error => console.error('Error loading announcements:', error));
            }

            // Initial load of announcements on page load
            loadAnnouncements();
        </script>
    </div>

    <div id="events" class="content-div" style="display: none;">
        <div id="EventsContainer">
            <!-- Events will be dynamically loaded here -->
        </div>
        <div style="height: 110px;"></div>

        <script>
            function loadEvents() {
                fetch('event-content.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('EventsContainer').innerHTML = data;
                    })
                    .catch(error => console.error('Error loading announcements:', error));
            }

            // Initial load of announcements on page load
            loadEvents();
        </script>
    </div>

    </div>

    <div id="hotlines" class="content-div" style="display: none;">
        <div id="hotl">
            <i class="fas fa-phone" style="color: white; font-size: 40px; margin-left: 30px; margin-top: 30px; color:#D4D0CD;"></i>
            <h4 class="emergency">emergency hotlines</h4>
            <div class="contact1">
                <h3 class="national">NATIONAL <br> EMERGENCY <br> HOTLINE</h3>
                <h5 class="national_num">911</h5>
                <div class="info-hover">Ensures safety and rapid response in emergencies nationwide.</div>
            </div>
            <div class="contact2">
                <h3 class="pnp">PNP <br> BATAAN</h3>
                <h5 class="pnp_num">633 5160</h5>
                <div class="info-hover">Committed to maintaining peace and order in Bataan.</div>
            </div>
            <div class="contact3">
                <h3 class="redcross">REDCROSS <br> BATAAN <br> CHAPTER</h3>
                <h5 class="redcross_num">791 2351</h5>
                <h5 class="redcross_num2">791 4779</h5>
                <div class="info-hover">Provides humanitarian aid and disaster relief in times of need.</div>
            </div>
        </div>

        <div id="hotl2">
        <div class="contact4">
                <h3 class="mdrrmo">DINALUPIHAN <br> MDRRMO</h3>
                <h5 class="mdrrmo_num">0998-587-0391</h5>
                <div class="info-hover">Dedicated to disaster risk reduction, preparedness, and emergency response for the safety and resilience of Dinalupihan.</div>
        </div>
        <div class="contact5">
                <h3 class="mps">DINALUPIHAN <br> MPS</h3>
                <h5 class="mps_num">0998-598-5359</h5>
                <div class="info-hover">Ensures public safety, crime prevention, and swift response to emergencies for the peace and order of Dinalupihan.</div>
        </div>
        <div class="contact6">
                <h3 class="fire">DINALUPIHAN <br> FIRE <br> STATION</h3>
                <h5 class="fire_num">0933-550-7373</h5>
                <div class="info-hover">Protects lives, properties, and the environment through fire prevention, suppression, and emergency rescue services.</div>
        </div>

        </div>
        <div style="height: 90px;"></div>
    </div>

    <!-- Link to the JavaScript file for darkmode function -->
    <script src="darkmode.js"></script>
    <!-- Link to the JavaScript file for hamburger menu function -->
    <script src="hamburgermenu.js"></script>
    <script src="AESH.js"></script>
    <script src="sweetalert.js"></script>

    <!--Function for searchbar-->
    <script>
        document.querySelector('.search_bar').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') { // Check if the pressed key is Enter
                event.preventDefault(); // Prevent form submission

                const query = event.target.value.toLowerCase();

                if (query.trim() === '') {
                    // If input is empty, keep the divs hidden and prevent showing them
                    hideAllContentDivs();
                } else {
                    // Trigger the filtering function
                    filterContent(query);
                }
            }
        });

        function filterContent(query) {
            const contentDivs = document.querySelectorAll('.content-div');
            const titleDivs = document.querySelectorAll('.fortitle'); // This targets the title class inside the content-div
            let foundMatch = false; // Flag to track if any match is found

            titleDivs.forEach(function(titleDiv) {
                const titleText = titleDiv.textContent || titleDiv.innerText; // Get the text inside the title
                const titleLower = titleText.toLowerCase();

                // Clear previous highlights
                titleDiv.innerHTML = titleText;

                if (titleLower.includes(query)) {
                    // If the title matches the query, show the parent content-div
                    titleDiv.closest('.content-div').style.display = 'block';
                    highlightText(titleDiv, query); // Highlight the matched text
                    foundMatch = true; // Mark as found
                } else {
                    // If the title doesn't match the query, hide the parent content-div
                    titleDiv.closest('.content-div').style.display = 'none';
                }
            });

            if (!foundMatch) {
                // Show SweetAlert if no results are found
                Swal.fire({
                    icon: 'info',
                    title: 'No Results Found',
                    text: 'Please try a different search query.',
                    confirmButtonText: 'Okay'
                });
            }
        }

        function hideAllContentDivs() {
            const contentDivs = document.querySelectorAll('.content-div');
            contentDivs.forEach(function(contentDiv) {
                contentDiv.style.display = 'none'; // Hide all content-divs when input is empty
            });
        }

        function highlightText(titleDiv, query) {
            const text = titleDiv.textContent || titleDiv.innerText;
            const regex = new RegExp(query, 'gi'); // Case-insensitive matching
            const highlightedText = text.replace(regex, match => `<span class="highlight">${match}</span>`); // Wrap matched text in span
            titleDiv.innerHTML = highlightedText; // Update the HTML with highlighted text
        }
    </script>

</body>

</html>