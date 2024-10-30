<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="darkmode.css"/>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Font style links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div>
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
                <li><a href="index.html">Log Out</a></li>
            </ul>
        </nav>
        <div class="nav_logo">
            <img src="logo/logo_dark.png" alt="EBRGY logo">
        </div>
        <div class="nav-right">
            <img src="logo/icon.jpg" alt="Profile Picture" class="profile-pic">
        </div>
    </header>
    <div class="stickycontainer" id="locktitle">
        <div class="locktitle">
            <h3>Admin <br> istrator <br> page</h3>
            <a href="#locktitle" class="navigate"><button class="create"><strong>create</strong></button></a>
            <div class="separator"></div>
            <a href="#content1" class="navigate"><button class="manage"><strong>manage</strong></button></a>
        </div>
        
        <!-- Form for submitting announcements and events -->
        <form id="updateForm" enctype="multipart/form-data">
            <div class="input-file">
                <div class="select-bg">
                    <input type="file" id="image" name="image" required>
                    <label for="image" class="select" id="fileLabel">
                        <strong><i class="fas fa-upload"></i> &nbsp; Select a picture</strong>
                    </label>
                </div>
            </div>
            <div class="updates">
                <label for="updates">Barangay Updates:</label>
                <div class="select-wrapper">
                    <select name="updates" id="updates" required>
                        <option value="announcement">Announcement</option>
                        <option value="event">Event</option>
                    </select>
                </div>
            </div>
            <div class="title">
                <h4>Write a Title:</h4>
                <textarea class="txt2" name="title" placeholder="Title appears here..." required></textarea>
            </div>
            <div class="caption">
                <h4>Write a caption:</h4>
                <textarea class="txt3" name="captions" placeholder="Captions appear here..." required></textarea>
            </div>
            <button class="publish" type="submit"><strong>Publish</strong></button>
        </form>

        <div id="contentContainer">
            <!-- Example structure for dynamically loaded announcements and events -->
            <div id="announcement_1" class="announcement">
                <div class="fortitle">Announcement Title</div>
                <div class="cp1">Announcement Content</div>
                <button onclick="editUpdates('announcement', 1)">Edit</button>
                <button onclick="deleteAnnouncement(1)">Delete</button>
                <button onclick="editPhoto(1)">Edit Photo</button>
            </div>
            <div id="event_1" class="event">
                <div class="fortitle">Event Title</div>
                <div class="cp1">Event Content</div>
                <button onclick="editUpdates('event', 1)">Edit</button>
                <button onclick="deleteEvent(1)">Delete</button>
                <button onclick="editPhoto(1)">Edit Photo</button>
            </div>
        </div>

        <!-- for darkmode feature -->
        <script src="darkmode.js"></script>
        <!-- for navigation -->
        <script src="hamburgermenu.js"></script>
        <!-- for alerts -->
        <script src="sweetalert.js"></script>

        <script>
            function updateLabelText() {
                const fileInput = document.getElementById('image');
                const label = document.getElementById('fileLabel');
                if (fileInput.files.length > 0) {
                    const fileName = fileInput.files[0].name;
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ${fileName}</strong>`;
                } else {
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; Select a picture</strong>`;
                }
            }

            document.getElementById('image').addEventListener('change', updateLabelText);

            // AJAX for form submission
            document.getElementById('updateForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(this);

                fetch('submit_update.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        swal('Success', 'Successfully Added', 'success');
                        loadContent(); // Reload the content after adding new announcement/event
                    } else {
                        swal('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swal('Error', 'An unexpected error occurred.', 'error');
                });
            });

            // Load announcements and events content
            function loadContent() {
                fetch('load_content.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contentContainer').innerHTML = data;
                })
                .catch(error => console.error('Error loading content:', error));
            }

            // Initial load of content on page load
            loadContent();

            function editAnnouncement(id) {
    const announcementDiv = document.getElementById('announcement_' + id);
    const title = announcementDiv.querySelector('.fortitle').innerText;
    const content = announcementDiv.querySelector('.cp1').innerText;

    const newTitle = prompt("Edit Title:", title);
    const newContent = prompt("Edit Content:", content);

    if (newTitle !== null || newContent !== null) {
        const formData = new FormData(); // Define formData here
        formData.append('updates', 'announcement');
        formData.append('title', newTitle !== null ? newTitle : title); // Keep old title if canceled
        formData.append('captions', newContent !== null ? newContent : content); // Keep old content if canceled
        formData.append('id', id); // Send the ID of the announcement to update

        fetch('submit_update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal('Success', 'Announcement updated successfully', 'success');
                loadContent(); // Reload the content after updating
            } else {
                swal('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            swal('Error', 'An unexpected error occurred.', 'error');
        });
    }
}

function editEvent(id) {
    const eventDiv = document.getElementById('event_' + id);
    const title = eventDiv.querySelector('.fortitle').innerText;
    const content = eventDiv.querySelector('.cp1').innerText;

    const newTitle = prompt("Edit Title:", title);
    const newContent = prompt("Edit Content:", content);

    if (newTitle !== null || newContent !== null) {
        const formData = new FormData(); // Define formData here
        formData.append('updates', 'event');
        formData.append('title', newTitle !== null ? newTitle : title); // Keep old title if canceled
        formData.append('captions', newContent !== null ? newContent : content); // Keep old content if canceled
        formData.append('id', id); // Send the ID of the event to update

        fetch('submit_update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal('Success', 'Event updated successfully', 'success');
                loadContent(); // Reload the content after updating
            } else {
                swal('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            swal('Error', 'An unexpected error occurred.', 'error');
        });
    }
}


          // Function to edit the photo with file upload
function editPhoto(id) {
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*'; // Accept image files only

    fileInput.onchange = function() {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('image', fileInput.files[0]); // Append the selected file

        fetch('update_photo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text(); // Get raw text first
        })
        .then(text => {
            console.log('Response text:', text); // Log the response
            const data = JSON.parse(text); // Then parse it as JSON
            if (data.success) {
                swal('Success', 'Photo updated successfully', 'success');
                loadContent(); // Reload the content after updating the photo
            } else {
                swal('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            swal('Error', 'An unexpected error occurred.', 'error');
        });
    };

    fileInput.click(); // Trigger file input click
}

       
// Function to delete announcements
function deleteAnnouncement(id) {
    if (confirm("Are you sure you want to delete this announcement?")) {
        fetch('delete.php?type=announcement&id=' + id, { method: 'GET' }) // Updated method to GET
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal('Success', 'Announcement deleted successfully', 'success');
                    loadContent(); // Reload content after deletion
                } else {
                    swal('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal('Error', 'An unexpected error occurred.', 'error');
            });
    }
}

// Function to delete events
function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this event?")) {
        fetch('delete.php?type=event&id=' + id, { method: 'GET' }) // Updated method to GET
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal('Success', 'Event deleted successfully', 'success');
                    loadContent(); // Reload content after deletion
                } else {
                    swal('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal('Error', 'An unexpected error occurred.', 'error');
            });
    }
}


        </script>
    </div>
</div>
</body>
</html>
