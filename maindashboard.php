
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primary Dashboard</title>
    <link rel="stylesheet" href="maindashboard.css" />
    <link rel="stylesheet" href="darkmode.css"/>
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
    <script  type="text/javascript" src="languagetrans.js"></script>
     <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
    <header>
        <div class="hamburger" id="hamburger">
            &#9776; <!-- Unicode character for hamburger icon -->
        </div>
        <nav id="nav-menu" class="nav_menu">
        <ul>
    <li><a href="about_us.html">About us</a></li>
    <li><a href="#">Conducted Projects</a></li>
    <li><a href="vision.html">Vision</a></li>
    <li><a href="mission.html">Mission</a></li>
    <li><a href="#">Guest Mode</a></li>
    <li><a href="#" id="darkModeLink">Dark Mode</a></li>

    <!-- Language translation section as a list item -->
    <li>
        <div id="Langtrans">
            <div id="google_translate_element" style="display: block;"></div>
        </div>
    </li>

    <li><a href="index.php">Log Out</a></li>
    <li><a href="#">Delete Account</a></li>
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
    
    <div class="btns">
        <button id="announcementsBtn" class="a1" onclick="showDiv('announcements')">announcements</button>
        <button id="eventsBtn" class="e1" onclick="showDiv('events')">events</button>
        <button id="servicesBtn" class="s1" onclick="showDiv('services')">services</button>
        <button id="contact_usBtn" class="h1" onclick="showDiv('contact_us')">contact us</button>
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

        <div class="dropdown-option" onclick="selectOption('Health Services & Medications'); showField('health_services')">Health Services & Medications</div>
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

<!-- END OF DROPDOWN -->


    <div id="hotlines" class="content-div" style="display: none;">
        <div id="hotl"></div>
        <div id="hotl2"></div>
    </div>
    

        <!-- Link to the JavaScript file for darkmode function -->
        <script src="darkmode.js"></script>
       <!-- Link to the JavaScript file for hamburger menu function -->
       <script src="hamburgermenu.js"></script>
       <script src="AESH.js"></script>
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

    <!-- submit -->
    <script>
     
    </script>
</body>
</html>