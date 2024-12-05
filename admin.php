<?php
// Start the session and get the username
session_start();

// Assuming the username is stored in the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; // Default to 'guest' if not set

// Define the superadmin and admin usernames  
$superadmin_username = 'AdminSuper';  
$admin_username = 'Admin2004';  

// Determine the role based on the username
if ($username === $superadmin_username) {
    $user_role = 'superadmin';
} elseif ($username === $admin_username) {
    $user_role = 'admin';
} else {
    $user_role = 'guest'; // Default role if not superadmin or admin
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="darkmode.css"/>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <li><a href="about_us.php">About us</a></li>
                <li><a href="#">Conducted Projects</a></li>
                <li><a href="vision.php">Vision</a></li>
                <li><a href="mission.php">Mission</a></li>
                <li><a href="#">Guest Mode</a></li>
                <li><a href="#" id="darkModeLink">Dark Mode</a></li>
                <li><a href="index.php">Log Out</a></li>
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
    <div class="btns">
        <!-- Create button visible to all users (superadmin and admin) -->
        <button id="createbtn" class="create" onclick="showDiv('updateForm')">Create</button>
        
        <!-- Manage button visible to both superadmin and admin -->
        <button id="managebtn" class="manage" onclick="showDiv('anounce&event_cont')">Manage</button>
        
        <!-- Services button visible only to superadmin -->
        <?php if ($user_role === 'superadmin') : ?>
            <button id="services" class="services" onclick="showDiv('servicesdiv')">Services</button>
        <?php else : ?>
            <!-- Disable services button if not superadmin -->
            <button id="services" class="services" onclick="showPermissionAlert()">Services</button>
        <?php endif; ?>
    </div>
</div>

<script>
    function showPermissionAlert() {
        // SweetAlert for permission denied
        Swal.fire({
            title: 'Access Denied',
            text: 'You do not have permission to access services.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    }
</script>

        
        <!-- Form for submitting announcements and events -->
        <form id="updateForm" class="content-div"  enctype="multipart/form-data">
          
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
         <!--for updating the events and announcement-->
        <div id="anounce&event_cont" class="content-div" style="display: none;">
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
    
      
        
<!--displaying table info of the services tables -->
<div id="servicesdiv" class="content-div" style="display: none;">
    <!-- Dynamic services data will be loaded here -->
</div>



        <!-- for darkmode feature -->
        <script src="darkmode.js"></script>
        <!-- for navigation -->
        <script src="hamburgermenu.js"></script>
        <!-- for alerts -->
        <script src="sweetalert.js"></script>
        <script src="AESH.js"></script>

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
                    document.getElementById('anounce&event_cont').innerHTML = data;
                })
                .catch(error => console.error('Error loading content:', error));
            }

            // Initial load of content on page load
            loadContent();

            // Load services data
function loadServicesData() {
    fetch('services_fetchdata.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('servicesdiv').innerHTML = data;
        })
        .catch(error => console.error('Error fetching services data:', error));
}

// Call this function when you need to display the services
loadServicesData();

            function editAnnouncement(id) {
    const announcementDiv = document.getElementById('announcement_' + id);
    const title = announcementDiv.querySelector('.fortitle').innerText;
    const content = announcementDiv.querySelector('.cp1').innerText;

    Swal.fire({
        title: 'Edit Announcement',
        html: `
            <input id="swal-title" class="swal2-input custom-input" placeholder="Title" value="${title}">
            <textarea id="swal-content" class="swal2-input custom-textarea" placeholder="Content">${content}</textarea>
        `,
        focusConfirm: false,
        showCancelButton: true, // Show the cancel button
        confirmButtonText: 'Update', // Custom confirm button text
        cancelButtonText: 'Cancel', // Custom cancel button text
        customClass: {
            popup: 'custom-popup',
            title: 'custom-title',
            content: 'custom-content',
            input: 'custom-input',
            textarea: 'custom-textarea',
            confirmButton: 'custom-confirm-button',
            cancelButton: 'custom-cancel-button'
        },
        preConfirm: () => {
            const newTitle = document.getElementById('swal-title').value;
            const newContent = document.getElementById('swal-content').value;
            if (!newTitle || !newContent) {
                Swal.showValidationMessage('Please enter both title and content');
            }
            return { newTitle, newContent };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('updates', 'announcement');
            formData.append('title', result.value.newTitle);
            formData.append('captions', result.value.newContent);
            formData.append('id', id);

            fetch('submit_update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', 'Announcement updated successfully', 'success');
                    loadContent();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An unexpected error occurred.', 'error');
            });
        } else if (result.isDismissed) {
            console.log('Canceled'); // Optional: handle the cancel action
        }
    });
}

function editEvent(id) {
    const eventDiv = document.getElementById('event_' + id);
    const title = eventDiv.querySelector('.fortitle').innerText;
    const content = eventDiv.querySelector('.cp1').innerText;

    Swal.fire({
        title: 'Edit Event',
        html: `
            <input id="swal-title" class="swal2-input custom-input" placeholder="Title" value="${title}">
            <textarea id="swal-content" class="swal2-input custom-textarea" placeholder="Content">${content}</textarea>
        `,
        focusConfirm: false,
        showCancelButton: true, // Show the cancel button
        confirmButtonText: 'Update', // Custom confirm button text
        cancelButtonText: 'Cancel', // Custom cancel button text
        customClass: {
            popup: 'custom-popup',
            title: 'custom-title',
            content: 'custom-content',
            input: 'custom-input',
            textarea: 'custom-textarea',
            confirmButton: 'custom-confirm-button',
            cancelButton: 'custom-cancel-button'
        },
        preConfirm: () => {
            const newTitle = document.getElementById('swal-title').value;
            const newContent = document.getElementById('swal-content').value;
            if (!newTitle || !newContent) {
                Swal.showValidationMessage('Please enter both title and content');
            }
            return { newTitle, newContent };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('updates', 'event');
            formData.append('title', result.value.newTitle);
            formData.append('captions', result.value.newContent);
            formData.append('id', id);

            fetch('submit_update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', 'Event updated successfully', 'success');
                    loadContent();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An unexpected error occurred.', 'error');
            });
        } else if (result.isDismissed) {
            console.log('Canceled'); // Optional: handle the cancel action
        }
    });
}



          // Function to edit the photo with file upload
// Function to edit the photo with file upload
function editPhoto(id, type) {
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*'; // Accept image files only

    fileInput.onchange = function() {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('type', type); // Append the type ('announcement' or 'event')
        formData.append('image', fileInput.files[0]); // Append the selected file

        fetch('update_photo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Directly parse JSON response
        .then(data => {
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
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this announcement!",
        icon: "warning",
        buttons: true, // Show confirm and cancel buttons
        dangerMode: true, // Style the cancel button as dangerous
    })
    .then((willDelete) => {
        if (willDelete) {
            fetch('delete.php?type=announcement&id=' + id, { method: 'GET' })
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
        } else {
            swal("Your announcement is safe!"); // Inform user if the action was cancelled
        }
    });
}

// Function to delete events
function deleteEvent(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this event!",
        icon: "warning",
        buttons: true, // Show confirm and cancel buttons
        dangerMode: true, // Style the cancel button as dangerous
    })
    .then((willDelete) => {
        if (willDelete) {
            fetch('delete.php?type=event&id=' + id, { method: 'GET' })
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
        } else {
            swal("Your event is safe!"); // Inform user if the action was cancelled
        }
    });
}

//function for deleting services request
function deleteRecord(id, type) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this certificate!",
        icon: "warning",
        buttons: true, // Show confirm and cancel buttons
        dangerMode: true, // Style the cancel button as dangerous
    })
    .then((willDelete) => {
        if (willDelete) {
            fetch('deletecert.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&type=' + type
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal('Success', 'Certificate deleted successfully!', 'success');
                    // Optionally reload the page to reflect the deletion
                    loadServicesData();
                } else {
                    swal('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal('Error', 'An unexpected error occurred.', 'error');
            });
        } else {
            swal("Your certificate is safe!"); // Inform the user if the action is cancelled
        }
    });
}
// Function to check if the notification textarea meets the length requirements
// Function to check if the notification textarea meets the length requirements
function Checknotiftextarea(id, type) {
    var notificationText = document.querySelector('textarea[name="notification"]').value.trim(); // Get the textarea value
    var pickupDate = document.querySelector('input[name="pickup_date"]').value; // Get the date input value

    if (pickupDate === "" || pickupDate === null) {
        swal('Error', 'Please select a pickup date.', 'error'); // Show error if date is empty or null
    } else if (notificationText !== "" && (notificationText.length < 10 || notificationText.length > 50)) {
        swal('Error', 'Notification must be between 10 and 50 characters long.', 'error'); // Show error for invalid notification length
    } else {
        // Proceed to accept the certificate
        acceptCert(id, type, pickupDate, notificationText); // Pass pickup_date and notification text
    }
}


// Function for accepting a service request
function acceptCert(id, type, pickupDate, notificationText) {
    swal({
        title: "Are you sure?",
        text: "Once accepted, the status will be changed to 'Accepted' and cannot be undone.",
        icon: "warning",
        buttons: true, // Show confirm and cancel buttons
        dangerMode: false, // No need for danger style here
    })
    .then((willAccept) => {
        if (willAccept) {
            // Send request to change the status to accepted
            fetch('acceptcert.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&type=' + type + '&pickup_date=' + encodeURIComponent(pickupDate) + '&remarks=' + encodeURIComponent(notificationText)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal('Success', 'Request accepted successfully!', 'success');
                    // Optionally reload the page to reflect the status change
                    loadServicesData();
                } else {
                    swal('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal('Error', 'An unexpected error occurred.', 'error');
            });
        } else {
            swal("The request was not accepted."); // Inform the user if the action is cancelled
        }
    });
}



        </script>
    </div>
</div>
</body>
</html>