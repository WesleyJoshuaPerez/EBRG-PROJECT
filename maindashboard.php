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
    <!-- Use to include SweetAlert CSS and js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Use to include Google Translate API -->
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
                <li><a href="about_us.php">About us</a></li>
                <li><a href="#">Conducted Projects</a></li>
                <li><a href="vision.php">Vision</a></li>
                <li><a href="mission.php">Mission</a></li>
                <li><a href="#">Guest Mode</a></li>
                <li><a href="#" id="darkModeLink">Dark Mode</a></li>

                <!-- Language translation section as a list item -->
                <li>
                    <div id="Langtrans">
                        <div id="google_translate_element" style="display: block;"></div>
                    </div>
                </li>
                <li><a href="#" onclick="showFeedbackModal(); return false;">Log Out</a></li>
                <!-- Delete Account Link -->
                <li><a href="maindashboard.php?action=delete_account" id="changeaccount_status">Delete Account</a></li>
            </ul>

        </nav>
        <!-- user profile -->
        <div class="user-profile" onclick="showUserDetails()">
            <i class="fa-solid fa-user profile-icon"></i>
            <div class="profile-details">
            <p class="profile-name" id="profile-name">Loading...</p>
            </div>
        </div>

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

    <div class="btns">
        <button id="announcementsBtn" class="a1" onclick="showDiv('announcements')">Announcements</button>
        <button id="eventsBtn" class="e1" onclick="showDiv('events')">Events</button>
        <button id="servicesBtn" class="s1" onclick="showDiv('services' , 'certupdate')">Services</button>
        <button id="contact_usBtn" class="h1" onclick="showDiv('hotlines')">Contact us</button>
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

    <div id="services" class="content-div" style="display: none;">
        <div id="serv">
            <h4 class="type">Type of Service:</h4>

            <!-- START OF DROPDOWN -->

            <div class="custom-dropdown">
                <div class="selected-option" id="selected-option" onclick="toggleDropdown()">
                    -- Select Barangay Services -- <span class="dropdown-icon">&#9662;</span> <!-- Dropdown arrow -->
                </div>

                <div class="dropdown-options" id="dropdown-options" style="display: none;">

                    <div class="dropdown-option certificates-option" onmouseover="showSubmenu('certificates-submenu')" onmouseout="hideSubmenu('certificates-submenu')">
                        Certificates
                        <!-- Submenu for Certificates -->
                        <div class="submenu" id="certificates-submenu" style="display: none;">
                            <div class="submenu-option" onclick="selectOption('Certificate of Indigency'); showCertificateDetails('indigency')">Certificate of Indigency</div>
                            <div class="submenu-option" onclick="selectOption('Certificate of Residency'); showCertificateDetails('residency')">Certificate of Residency</div>
                            <div class="submenu-option" onclick="selectOption('Certificate of First Time Job Seeker'); showCertificateDetails('job_seeker')">Certificate of First Time Job Seeker</div>
                            <div class="submenu-option" onclick="selectOption('Certificate of Job Absence'); showCertificateDetails('absence')">Certificate of Job Absence</div>
                            <div class="submenu-option" onclick="selectOption('Certificate of Solo Parent'); showCertificateDetails('solo_parent')">Certificate of Solo Parent</div>
                            <div class="submenu-option" onclick="selectOption('Barangay Clearance'); showCertificateDetails('brgy_clearance')">Barangay Clearance</div>
                            <div class="submenu-option" onclick="selectOption('Fencing Clearance'); showCertificateDetails('fencing_clearance')">Fencing Clearance</div>
                            <div class="submenu-option" onclick="selectOption('Building Clearance'); showCertificateDetails('bldg_clearance')">Building Clearance</div>
                            <div class="submenu-option" onclick="selectOption('Order of Payment'); showCertificateDetails('order_payment')">Order of Payment</div>
                            <div class="submenu-option" onclick="selectOption('Electricity Installation Clearance'); showCertificateDetails('electricity')">Electricity Installation Clearance</div>
                        </div>
                    </div>
                    <div class="dropdown-option" onclick="selectOption('Daycare Student Shortlisting'); showField('daycare')">Daycare Student Shortlisting</div>
                </div>
            </div>
            <div id="div1" class="val-div" style="display: none;">
                <!-- Content will be updated here based on the selected submenu option -->
            </div>

            <div id="daycare_container2" class="val-div" style="display: none;">
            </div>
            <div style="height: 90px;"></div>
        </div>
        </div>
    </div>
 <!--use to see what happens on the certificate-->
<?php
// Include the external file for getting certificate updates
include 'certupdate.php';

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Get the session username
    $updates = getCertUpdates($username);
} else {
    $updates = "<p>Please log in to see your updates.</p>";
}
?>

<div id="certupdate" class="content-div" style="display: none;">
    <div class="titlecert">
        <h1>UPDATES</h1>
        <button class="clear_updates" onclick="Clearupdates()">Clear</button>
    </div>
        <?php echo $updates; ?>
</div>

<!--Use for clearing the certificates update-->
<script>
function Clearupdates() {
    var certUpdateDiv = document.getElementById('certupdate');
    var items = certUpdateDiv.querySelectorAll(':scope > div:not(.titlecert)');

    items.forEach(function (child, index) {
        // Add a fade-out class to each child
        setTimeout(function () {
            child.classList.add('fade-out');

            // Remove the child after the animation ends
            child.addEventListener('animationend', function () {
                child.remove();

                // Add the placeholder message once the last item is removed
                if (index === items.length - 1) {
                    var placeholder = document.createElement('p');
                    placeholder.textContent = "No updates available.";
                    placeholder.className = "placeholder";
                    certUpdateDiv.appendChild(placeholder);
                }
            });
        }, index * 300); // Delay removal for each item
    });
    console.log("Updates cleared!");
}
</script>
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
    
    <!-- feedback -->
    <div id="feedbackModal" class="modal" style="display: none;">
    <form id="feedbackForm">
        <div class="modal-content">
            <h3>We value your feedback!</h3>
            <p>How was your experience using our system?</p>
            <div class="emoji-options">
                <span class="emoji" data-value="😃" onclick="selectEmoji(this)">😃</span>
                <span class="emoji" data-value="😊" onclick="selectEmoji(this)">😊</span>
                <span class="emoji" data-value="😐" onclick="selectEmoji(this)">😐</span>
                <span class="emoji" data-value="😢" onclick="selectEmoji(this)">😢</span>
                <span class="emoji" data-value="😡" onclick="selectEmoji(this)">😡</span>
            </div>
            <input type="hidden" name="emoji" id="selectedEmoji" />
            <textarea id="feedbackComment" name="comment" placeholder="Tell us more about your experience (optional)"></textarea>
            <button class="submit_feedback" onclick="submitFeedback(event)">Submit Feedback</button>
        </div>
    </form>
</div>

    <!-- Link to the JavaScript file for darkmode function -->
    <script src="darkmode.js"></script>
    <!-- Link to the JavaScript file for hamburger menu function -->
    <script src="hamburgermenu.js"></script>
    <!-- Select button function -->
    <script src="AESH.js"></script>
    <!-- Services forms -->
    <script src="services.js"></script>
    <script src="clear_form.js"></script>
    <script src="insert.php"></script>
    <script src="sweetalert.js"></script>


    <script>
        // Updates the selected image label
        function updateLabel(input, labelId) {
            const label = document.getElementById(labelId); // Get the corresponding label by ID
            const iconHTML = `<i class="fas fa-upload"></i>&nbsp;`; // Icon HTML

            if (input.files && input.files[0]) {
                // Update the label with the selected file name
                label.innerHTML = `<strong>${iconHTML}${input.files[0].name}</strong>`;
            } else {
                // Reset the label text if no file is selected
                label.innerHTML = `<strong>${iconHTML}Select a picture</strong>`;
            }
        }
    </script>
    <script>
        // Get the query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        // Display SweetAlert based on status
        if (status === 'success') {
            Swal.fire({
                title: 'Success!',
                text: 'Record added successfully. Please wait for admin approval.',
                icon: 'success'
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while processing your request.',
                icon: 'error'
            });
        } else if (status === 'file_error') {
            Swal.fire({
                title: 'File Upload Error!',
                text: 'Failed to upload the file. Please try again.',
                icon: 'warning'
            });
        }
    </script>
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

    <!-- input fields functions -->
    <script>
        // Function to convert input to uppercase
        function toUppercase(input) {
            input.value = input.value.toUpperCase();
        }

        // Function to prevent numeric input
        function preventNumbers(event) {
            const key = event.key;
            // Allow only letters, backspace, tab, arrow keys, and space
            if (!/^[a-zA-Z\s]+$/.test(key) && key !== "Backspace" && key !== "Tab" && !key.startsWith("Arrow")) {
                event.preventDefault();
            }

        }
        // Function to validate the age input
        function validateAge(input) {
            // Ensure the length is limited to 2 digits
            if (input.value.length > 2) {
                input.value = input.value.slice(0, 2); // Trim input to 2 characters
            }

            // Optional: Validate the range (0-99)
            if (parseInt(input.value, 10) > 99) {
                input.value = 99; // Set to the maximum allowed value
            } else if (parseInt(input.value, 10) < 0) {
                input.value = 0; // Set to the minimum allowed value
            }
        }

        function preventNonNumbers(event) {
            const key = event.key;

            // Allow only numbers, backspace, delete, and arrow keys
            if (!/^\d$/.test(key) && key !== "Backspace" && key !== "Delete" && key !== "ArrowLeft" && key !== "ArrowRight" && key !== "Tab") {
                event.preventDefault(); // Block non-numeric keys
            }
        }

    // checks if all fields are populated
    function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll("input[required], select[required], textarea[required]");
    const submitButton = form.querySelector(".submit"); // Ensure your submit button has this class
    let isValid = true;

    inputs.forEach(input => {
        // Trim input value to handle spaces
        const value = input.type === "radio" || input.type === "checkbox" ? input.checked : input.value.trim();

        if (!value) {
            // Highlight empty fields
            input.style.border = "2px solid red";
            isValid = false;
        } else {
            // Remove highlight if the field is filled
            input.style.border = "";
        }
    });

    // Update submit button style and state
    if (isValid) {
        submitButton.style.backgroundColor = "#4CAF50"; // Green when all fields are valid
        submitButton.disabled = false; // Enable the button
    } else {
        submitButton.style.backgroundColor = "#D3D3D3"; // Gray when fields are missing
        submitButton.disabled = true; // Disable the button
    }

    if (!isValid) {
        // Show an alert if validation fails
        Swal.fire({
            title: "Error!",
            text: "Please fill out all required fields before submitting.",
            icon: "error",
            confirmButtonText: "OK",
        });
    }

    return isValid;
}

    </script>

    <script>
        // disable previous dates
        document.addEventListener("DOMContentLoaded", function() {
            const absenceDateField = document.getElementById("absence_date");

            if (absenceDateField) {
                const today = new Date();
                const formattedDate = today.toISOString().split("T")[0]; // Format as yyyy-mm-dd
                absenceDateField.setAttribute("min", formattedDate); // Set minimum date to today

                console.log("Min date set for absence_date:", formattedDate);
            } else {
                console.error("Element with ID 'absence_date' not found.");
            }
        });
    </script>
    <script>
        <?php if (isset($_SESSION['account_status_message'])): ?>
            <?php if ($_SESSION['account_status_message'] === "success"): ?>
                Swal.fire({
                    title: 'Account Deleted!',
                    text: 'Your account has been successfully deactivated.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php'; // Redirect to login after success
                });
            <?php elseif ($_SESSION['account_status_message'] === "error"): ?>
                Swal.fire({
                    title: 'Error!',
                    text: 'Unable to deactivate your account. Please try again later.',
                    icon: 'error'
                });
            <?php endif; ?>
            <?php unset($_SESSION['account_status_message']); // Clear the message after displaying 
            ?>
        <?php endif; ?>
    </script>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent the default link action
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will deactivate your account!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href; // Proceed with the deletion
                }
            });
            return false; // Prevent immediate navigation
        }

        // Attach the confirmation handler
        document.getElementById('changeaccount_status').addEventListener('click', confirmDelete);
    </script>

    <!-- feedback js -->
    <script>
    let selectedEmoji = null;

    // Show the feedback modal
    function showFeedbackModal() {
    const modal = document.getElementById("feedbackModal");
    const header = document.getElementById("header");
    if (header) {
        header.style.display = "none"; // Hide the header for focus
    }
    modal.style.display = "flex"; // Show the modal
    }

    // Select an emoji
    function selectEmoji(emojiElement) {
    // Deselect all emojis
    const allEmojis = document.querySelectorAll(".emoji");
    allEmojis.forEach((emoji) => emoji.classList.remove("selected"));

    // Select the clicked emoji
    emojiElement.classList.add("selected");
    selectedEmoji = emojiElement.getAttribute("data-value");

    // Update the hidden input for the form
    const emojiInput = document.getElementById("selectedEmoji");
    if (emojiInput) {
        emojiInput.value = selectedEmoji; // Set the selected emoji value in the hidden input
    }
    }

    // Submit feedback
    function submitFeedback(event) {
    event.preventDefault(); // Prevent the default form submission

    if (!selectedEmoji) {
        // Ensure that an emoji is selected
        Swal.fire({
            icon: "error",
            title: "Feedback Required",
            text: "Please select an emoji to provide your feedback.",
            confirmButtonText: "OK",
        });
        return;
    }

    // Get the comment value
    const comment = document.getElementById("feedbackComment").value;

    // Prepare the form data for submission
    const formData = new FormData();
    formData.append("emoji", selectedEmoji);
    formData.append("comment", comment);

    // Submit feedback via an AJAX request
    fetch("insert_feedbackdb.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.text())
        .then((data) => {
            // Show success message and redirect
            Swal.fire({
                icon: "success",
                title: "Thank You!",
                text: "Your feedback has been submitted.",
                confirmButtonText: "OK",
            }).then(() => {
                window.location.href = "index.php"; // Redirect to index page
            });
        })
        .catch((error) => {
            // Show error message
            Swal.fire({
                icon: "error",
                title: "Submission Failed",
                text: "An error occurred while submitting your feedback. Please try again.",
                confirmButtonText: "OK",
            });
            console.error("Feedback submission error:", error);
        });
    }
     </script>
    
    <!-- swal that displays details of current account logged in -->
    <script>
    async function fetchUserData() {
    try {
        const response = await fetch("getUserData.php"); // API to fetch user data
        if (!response.ok) {
            throw new Error("Failed to fetch user data");
        }
        const userData = await response.json();
        return userData;
    } catch (error) {
        console.error("Error fetching user data:", error);
        return null;
    }
    }

    // Fetch user data on page load and update the profile name
    async function initializeUserProfile() {
    const userData = await fetchUserData();
    const profileNameElement = document.getElementById("profile-name");
    if (userData) {
        profileNameElement.textContent = `${userData.firstname} ${userData.lastname}`;
        // Store user data globally for modal use
        window.currentUserData = userData;
    } else {
        profileNameElement.textContent = "Guest"; // Fallback for errors
        window.currentUserData = null; // No user data
    }
    }

    // Show user details in a SweetAlert modal
    function showUserDetails() {
    if (window.currentUserData) {
        const { firstname, lastname, email, username, account_status, updated_time } = window.currentUserData;
        Swal.fire({
            title: "User Profile",
            html: `
                <strong>Name:</strong> ${firstname} ${lastname}<br>
                <strong>Email:</strong> ${email}<br>
                <strong>Username:</strong> ${username}<br>
                <strong>Account Status:</strong> ${account_status}<br>
                <strong>Last Login:</strong> ${updated_time || "N/A"}
            `,
            icon: "info",
            confirmButtonText: "Close"
        });
    } else {
        Swal.fire({
            title: "Error",
            text: "No user data available. Please log in.",
            icon: "error",
            confirmButtonText: "Close"
        });
    }
    }

    // Run the function on page load
    document.addEventListener("DOMContentLoaded", initializeUserProfile);

    </script>
</body>

</html>

