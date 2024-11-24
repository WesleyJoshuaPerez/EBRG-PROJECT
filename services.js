function toggleDropdown() {
    const dropdownOptions = document.getElementById("dropdown-options");
    dropdownOptions.style.display = dropdownOptions.style.display === "none" ? "block" : "none";
}

function showSubmenu(submenuId) {
    document.getElementById(submenuId).style.display = "block";
}

function hideSubmenu(submenuId) {
    document.getElementById(submenuId).style.display = "none";
}

function selectOption(optionText) {
    // Update the displayed text of the selected option
    const selectedOption = document.getElementById("selected-option");
    selectedOption.innerHTML = `${optionText} <span class="dropdown-icon">&#9662;</span>`;

    // Hide the dropdown options after selection
    document.getElementById("dropdown-options").style.display = "none";
}

// Separate function for the "Select Assistance Type" dropdown
function toggleTypeDropdown() {
    const typeOptions = document.getElementById("type-options");
    typeOptions.style.display = typeOptions.style.display === "none" ? "block" : "none";
}

function selectTypeOption(optionText) {
    document.getElementById("assistance-selected-option").innerHTML = `${optionText} <span class="type-icon">&#9662;</span>`;
    document.getElementById("assistance_type").value = optionText;
    document.getElementById("type-options").style.display = "none";
}

// dropdown for monthly income

function toggleTypeDropdown2() {
    const typeOptions = document.getElementById("type-options2");
    typeOptions.style.display = typeOptions.style.display === "none" ? "block" : "none";
}

function selectTypeOption2(optionText) {
    const selectedTypeOption = document.querySelector(".type-dropdown2 .selected-option2");
    selectedTypeOption.innerHTML = `${optionText} <span class="type-icon2">&#9662;</span>`;
    document.getElementById("type-options2").style.display = "none";
}

// dropdowon for number of children
function toggleTypeDropdown3() {
    const typeOptions = document.getElementById("type-options3");
    typeOptions.style.display = typeOptions.style.display === "none" ? "block" : "none";
}

function selectTypeOption3(optionText) {
    const selectedTypeOption = document.querySelector(".type-dropdown3 .selected-option3");
    selectedTypeOption.innerHTML = `${optionText} <span class="type-icon3">&#9662;</span>`;
    document.getElementById("type-options3").style.display = "none";
}

// dropdown for type of business
function toggleTypeDropdown4() {
    const options = document.getElementById('type-options4');
    options.style.display = options.style.display === 'none' ? 'block' : 'none';
}

function selectTypeOption4(type) {
    // Update the visible selected option
    const selectedOption = document.querySelector('.selected-option4');
    selectedOption.innerHTML = `${type} <span class="type-icon4">&#9662;</span>`;

    // Update the hidden input field
    const businessTypeInput = document.getElementById('business_type');
    businessTypeInput.value = type;

    // Hide the dropdown options
    toggleTypeDropdown4();
}

// dropdown for kinder level
function toggleTypeDropdown5() {
    const typeOptions = document.getElementById("type-options5");
    typeOptions.style.display = typeOptions.style.display === "none" ? "block" : "none";
}

function selectTypeOption5(optionText) {
    const selectedTypeOption = document.querySelector(".type-dropdown5 .selected-option5");
    selectedTypeOption.innerHTML = `${optionText} <span class="type-icon5">&#9662;</span>`;
    document.getElementById("kinder_level").value = optionText; // Ensure this is updating the hidden input
    document.getElementById("type-options5").style.display = "none";
}

// for source and monthly income

function selectTypeOption2(optionText) {
    document.querySelector(".selected-option2").innerHTML = `${optionText} <span class="type-icon2">&#9662;</span>`;
    document.getElementById("source_income").value = optionText;
    document.getElementById("type-options2").style.display = "none";
}

function selectTypeOption3(optionText) {
    document.querySelector(".selected-option3").innerHTML = `${optionText} <span class="type-icon3">&#9662;</span>`;
    document.getElementById("monthly_income").value = optionText;
    document.getElementById("type-options3").style.display = "none";
}

function toggleTypeDropdown2() {
    const typeOptions2 = document.getElementById("type-options2");
    typeOptions2.style.display = typeOptions2.style.display === "none" ? "block" : "none";
}

function toggleTypeDropdown3() {
    const typeOptions3 = document.getElementById("type-options3");
    typeOptions3.style.display = typeOptions3.style.display === "none" ? "block" : "none";
}


function showCertificateDetails(type) {
    const div1 = document.getElementById("div1");
    const daycare_container2 = document.getElementById("daycare_container2");
    div1.style.display = 'block';
    daycare_container2.style.display = 'none';

    if (type === 'indigency') {
        div1.innerHTML = `
            <form id="indigencyForm" action="submit.php" method="POST" onsubmit="handleSubmit(event, 'indigencyForm')" enctype="multipart/form-data">
                <h4 class="detail">Details:</h4>
                <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
                <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
                <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
                <input type="number" id="age" name="age" min="0" step="1" value="" maxlength="2" oninput="validateAge(this)" placeholder="Age" required>
                
                <!-- File input for ID Picture with label -->
                <div class="select-bg">
                    <input type="file" id="image" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
                    <label for="image" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
                </div>
                
                <!-- Assistance Type Dropdown -->
                <div class="type-dropdown">
                <div class="selected-option" id="assistance-selected-option" onclick="toggleTypeDropdown()">
                 -- Assistance Type -- <span class="type-icon">&#9662;</span> <!-- Dropdown arrow -->
                </div>
                <div class="type-options" id="type-options" style="display: none;">
                <div class="type-option" onclick="selectTypeOption('Financial')">Financial</div>
                <div class="type-option" onclick="selectTypeOption('Medical')">Medical</div>
                </div>
                <input type="hidden" id="assistance_type" name="assistance_type" value="" required>
                </div>
    
                <!-- Radio button for "Apply for myself" -->
                <label class="myself-option">
                <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
                </label>

                <!-- Clear and Submit Buttons -->
                <button type="button" class="clear" id="clearBtn" onclick="clearForm('div1')">CLEAR</button>
                <button type="submit" class="submit" >SUBMIT</button>
            </form>
        `;
        document.querySelector('#clearBtn').addEventListener('click', () => {
            clearForm(['div1']); 
        });
    } else if (type === 'residency') {
        div1.innerHTML = `
            <form id="residencyForm" action="submit.php" method="POST" onsubmit="handleSubmit(event, 'residencyForm')" enctype="multipart/form-data">
    <h4 class="detail">Details:</h4>
    <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
    <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
    <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
    <input type="number" id="years_of_occupancy" name="yrs_of_occupancy" min="0" step="1" value="" placeholder="Years of Occupancy" required>
    <input type="text" class="address" name="address" oninput="toUppercase(this)" placeholder="Complete Address" required>
    <div class="select-bg2">
        <input type="file" id="image" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
        <label for="image" class="select" id="fileLabel1">
            <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
        </label>
    </div>
    <label class="myself-option2">
        <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
    </label>
    <button id="clearBtn" class="clear2" onclick="clearForm('div1')">CLEAR</button>
    <button type="submit" class="submit2">SUBMIT</button>
</form>

        `;
        document.querySelector('#clearBtn').addEventListener('click', () => {
            clearForm(['div1']);
        });
    } else if (type === 'job_seeker') {
        div1.innerHTML = `
        <form id="jobseekForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'jobseekForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg3">
        <input type="file" id="image" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
        <label for="image" class="select" id="fileLabel1">
            <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
        </label>
        </div>
        <input type="text" class="employer" name="employer" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Employer/Company Name" required>
        <label class="myself-option3">
        <input type="radio" name="apply_myself" value="Apply for Myself" required> Apply for myself
        </label>
        <button id="clearBtn" class="clear3" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit3">SUBMIT</button>
        </form>
        `;
        document.querySelector('#clearBtn').addEventListener('click', () => {
            clearForm(['div1']); 
        });
    } else if (type === 'absence') {
        div1.innerHTML = `
        <form id="jobabsenceForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'jobabsenceForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg3">
                    <input type="file" id="image" name="id_pic" onchange="updateLabel(this, 'fileLabel1')" required>
                    <label for="image" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
        </div>
        <input type="text" class="employer2" name="employer" oninput="toUppercase(this)" placeholder="Employer/Company Name" required>
        <label for="absence_date" class="absence_label">Absence Date:</label>
        <input
        type="date"
        min="2024-11-23"
        id="absence_date"
        class="absence_date"
        name="absence_date"
        placeholder="Absence Date"
        required
        />
        <input type="number" id="duration" name="duration" min="0" step="1" value="" placeholder="Duration" required>
        <input type="text" class="reason" name="reason" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Reason" required>
        <label class="myself-option2">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
        </label>
        <button id="clearBtn" class="clear4" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit4">SUBMIT</button>
        </form>
        `;
        document.querySelector('#clearBtn').addEventListener('click', () => {
            clearForm(['div1']); 
        });
    } else if (type === 'solo_parent') {
        div1.innerHTML = `
        <form id="soloparentForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'soloparentForm')" enctype="multipart/form-data">
            <h4 class="detail">Details:</h4>
            <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
            <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
            <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
            <div class="select-bg3">
                <input type="file" id="image" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
                <label for="image" class="select" id="fileLabel1">
                    <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                </label>
            </div>
            <input type="number" id="years_of_separation" name="years_of_separation" min="0" step="1" value="" placeholder="Years of Separation" required>
            <input type="number" id="number_of_children" name="num_children" min="0" step="1" value="" placeholder="No. of Children" required>
            
            <!-- Source of Income Dropdown -->
            <div class="type-dropdown2">
                <div class="selected-option2" onclick="toggleTypeDropdown2()"> 
                    -- Source of Income -- <span class="type-icon2">&#9662;</span> <!-- Dropdown arrow -->
                </div>
                <div class="type-options2" id="type-options2" style="display: none;">
                    <div class="type-option2" onclick="selectTypeOption2('Employment')">Employment</div>
                    <div class="type-option2" onclick="selectTypeOption2('Self-Employment')">Self-Employment</div>
                    <div class="type-option2" onclick="selectTypeOption2('Investment')">Investment</div>
                    <div class="type-option2" onclick="selectTypeOption2('Retirement Income')">Retirement Income</div>
                    <div class="type-option2" onclick="selectTypeOption2('Savings')">Savings</div>
                    <div class="type-option2" onclick="selectTypeOption2('No Income')">No Income</div>
                </div>
                <input type="hidden" id="source_income" name="source_income" value="" required>
            </div>
            
            <!-- Monthly Income Dropdown -->
            <div class="type-dropdown3">
                <div class="selected-option3" onclick="toggleTypeDropdown3()"> 
                    -- Monthly Income -- <span class="type-icon3">&#9662;</span> <!-- Dropdown arrow -->
                </div>
                <div class="type-options3" id="type-options3" style="display: none;">
                    <div class="type-option3" onclick="selectTypeOption3('₱10,000 - ₱20,000')">₱10,000 - ₱20,000</div>
                    <div class="type-option3" onclick="selectTypeOption3('₱20,000 - ₱30,000')">₱20,000 - ₱30,000</div>
                    <div class="type-option3" onclick="selectTypeOption3('Above ₱30,000')">Above ₱30,000</div>
                </div>
                <input type="hidden" id="monthly_income" name="monthly_income" value="" required>
            </div>
    
            <label class="myself-option4">
                <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
            </label>
            <button id="clearBtn" class="clear6" onclick="clearForm('div1')">CLEAR</button>
            <button id="submitBtn" class="submit5">SUBMIT</button>
        </form>
        `;
    } else if (type === 'brgy_clearance') {
        div1.innerHTML = `
        <form id="brgyclearanceForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'brgyclearanceForm')" enctype="multipart/form-data">
            <h4 class="detail">Details:</h4>
            <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
            <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
            <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
            <input type="number" id="age2" name="age" min="0" step="1" value="" maxlength="2" oninput="validateAge(this)" placeholder="Age" required>
            <div class="select-bg">
                    <input type="file" id="image" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
                    <label for="image" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
            </div>
            <input type="number" id="years_of_occupancy1" name="yrs_occupancy" min="0" step="1" value="" placeholder="Years of Occupancy" required>
        <label class="myself-option5">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
        </label>
        <button id="clearBtn" class="clear5" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit">SUBMIT</button>
        </form>
        `;
    } else if (type === 'fencing_clearance') {
        div1.innerHTML = `
        <form id="fencingclearanceForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'fencingclearanceForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg4">
            <input type="file" id="id_pic" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
            <label for="id_pic" class="select" id="fileLabel1">
                <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
            </label>
        </div>
        <input type="text" class="address2" name="address" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Complete Address" required>
        <div class="select-bg5">
            <input type="file" id="lot_cert" name="lot_cert" required onchange="updateLabel(this, 'fileLabel2')">
            <label for="lot_cert" class="select" id="fileLabel2">
                <strong><i class="fas fa-upload"></i> &nbsp; Updated Lot Certification</strong>
            </label>
        </div>
            <label class="myself-option4">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
            </label>
        <button id="clearBtn" class="clear4" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit4">SUBMIT</button>
        </form>
        `;
    } else if (type === 'bldg_clearance') {
        div1.innerHTML = `
        <form id="blgclearanceForm" action="submit2.php" method="POST" onsubmit="return handleSubmit(event, 'blgclearanceForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg6">
            <input type="file" id="lot_cert" name="lot_cert" required onchange="updateLabel(this, 'fileLabel2')">
            <label for="lot_cert" class="select" id="fileLabel2">
                <strong><i class="fas fa-upload"></i> &nbsp; Updated Lot Certification</strong>
            </label>
        </div>
            <label class="measurement_label"> Lot Measurement in sqm: </label>
            <input type="number" id="measurement" name="measurement" min="0" step="1" value="" placeholder="Lot Measurement" required>
            <label class="myself-option6">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
            </label>
        <button id="clearBtn" class="clear7" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit2">SUBMIT</button>
        </form>
        `;
    } else if (type === 'order_payment') {
        div1.innerHTML = `
        <form id="orderpaymentForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'orderpaymentForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg4">
                    <input type="file" id="id_pic" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
                    <label for="id_pic" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
            </div>
        <input type="text" class="business_name" name="business_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Business Name" required>
        <div class="type-dropdown4">
            <div class="selected-option4" onclick="toggleTypeDropdown4()">
            -- Type of Business -- <span class="type-icon4">&#9662;</span> <!-- Dropdown arrow -->
            </div>
            <div class="type-options4" id="type-options4" style="display: none;">
            <div class="type-option4" onclick="selectTypeOption4('Retail and E-commerce')">Retail and E-commerce</div>
            <div class="type-option4" onclick="selectTypeOption4('Food and Beverage')">Food and Beverage</div>
            <div class="type-option4" onclick="selectTypeOption4('Service-Based')">Service-Based</div>
            <div class="type-option4" onclick="selectTypeOption4('Manufacturing and Production')">Manufacturing and Production</div>
            <div class="type-option4" onclick="selectTypeOption4('Finance and Real Estate')">Finance and Real Estate</div>
            </div>
            <input type="hidden" id="business_type" name="business_type" value="" required>
        </div>
        <input type="text" class="address3" name="business_address" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Business Address" required>
            <label class="myself-option7">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
            </label>
        <button id="clearBtn" class="clear8" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit6">SUBMIT</button>
        </form>
        `;
    } else if (type === 'electricity') {
        div1.innerHTML = `
        <form id="electricityForm" action="submit.php" method="POST" onsubmit="return handleSubmit(event, 'electricityForm')" enctype="multipart/form-data">
        <h4 class="detail">Details:</h4>
        <input type="text" class="firstname" name="first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
        <input type="text" class="middlename" name="middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
        <input type="text" class="lastname" name="last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
        <div class="select-bg3">
                    <input type="file" id="id_pic" name="id_pic" required onchange="updateLabel(this, 'fileLabel1')">
                    <label for="id_pic" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
        </div>
        <div class="select-bg7">
                    <input type="file" id="lot_cert" name="lot_cert" required onchange="updateLabel(this, 'fileLabel2')">
                    <label for="lot_cert" class="select" id="fileLabel2">
                        <strong><i class="fas fa-upload"></i> &nbsp; Updated Lot Certification</strong>
                    </label>
        </div>
        <label class="myself-option2">
            <input type="radio" name="apply_myself" value="Apply for Myself"> Apply for myself
        </label>
        <button id="clearBtn" class="clear2" onclick="clearForm('div1')">CLEAR</button>
        <button id="submitBtn" class="submit2">SUBMIT</button>
        </form>
        `;
    }
}

function showField(type) {
    const div1 = document.getElementById("div1");
    const daycare_container2 = document.getElementById("daycare_container2"); // Declare daycare_container2

    // Hide daycare container and reset div1 content initially
    div1.style.display = 'block';
    daycare_container2.style.display = 'none';

    // Clear the content of both div1 and daycare_container2
    div1.innerHTML = '';
    daycare_container2.innerHTML = '';

    if (type === 'daycare') {
        div1.innerHTML = `
        <!-- Shared Form -->
        <form id="daycareForm" action="submit2.php" method="POST" onsubmit="return handleSubmit(event, 'daycareForm')" enctype="multipart/form-data">
            <!-- Student's Information -->
            <div id="div1">
                <h4 class="detail">Student's Information:</h4>
                <input type="text" class="firstname" name="student_first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
                <input type="text" class="middlename" name="student_middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
                <input type="text" class="lastname" name="student_last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
                <div class="select-bg3">
                    <input type="file" id="health_record" name="health_record" required onchange="updateLabel(this, 'fileLabel1')">
                    <label for="health_record" class="select" id="fileLabel1">
                        <strong><i class="fas fa-upload"></i> &nbsp; Health Record</strong>
                    </label>
                </div>
                <div class="select-bg8">
                    <input type="file" id="birth_cert" name="birth_cert" required onchange="updateLabel(this, 'fileLabel2')">
                    <label for="birth_cert" class="select" id="fileLabel2">
                        <strong><i class="fas fa-upload"></i> &nbsp; Birth Certificate</strong>
                    </label>
                </div>
                <div class="type-dropdown5">
                    <div class="selected-option5" onclick="toggleTypeDropdown5()">
                        -- Kinder Level -- <span class="type-icon5">&#9662;</span>
                    </div>
                    <div class="type-options5" id="type-options5" style="display: none;">
                        <div class="type-option5" onclick="selectTypeOption5('Kinder I')">Kinder I</div>
                        <div class="type-option5" onclick="selectTypeOption5('Kinder II')">Kinder II</div>
                    </div>
                    <input type="hidden" id="kinder_level" name="kinder_level" value="" required>
                </div>
            </div>

            <div style="height: 90px;"></div>
    
            <!-- Guardian's Information -->
            <div id="daycare_container2" style="display: block;">
                <h4 class="detail2">Guardian's Information:</h4>
                <input type="text" class="firstname2" name="guardian_first_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="First Name" required>
                <input type="text" class="middlename2" name="guardian_middle_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Middle Name" required>
                <input type="text" class="lastname2" name="guardian_last_name" oninput="toUppercase(this)" onkeydown="preventNumbers(event)" placeholder="Last Name" required>
                <input type="number" id="age3" name="guardian_age" min="0" step="1" value="" value="" maxlength="2" oninput="validateAge(this)" placeholder="Age" required>
                <div class="select-bg9">
                    <input type="file" id="guardian_id" name="guardian_id" required onchange="updateLabel(this, 'fileLabel3')">
                    <label for="guardian_id" class="select" id="fileLabel3">
                        <strong><i class="fas fa-upload"></i> &nbsp; ID Picture</strong>
                    </label>
                </div>
                <input type="text" class="contact_num" name="guardian_contact_num" maxlength="11" onkeydown="preventNonNumbers(event)" placeholder="Contact Number" required>
                <button id="clearBtn" class="clear3" type="button" onclick="clearForm1(['div1', 'daycare_container2'])">CLEAR</button>
                <button id="submitBtn" class="submit3">SUBMIT</button>
            </div>
        </form>
        `;
        document.querySelector('#clearBtn').addEventListener('click', () => {
            clearForm(['div1']);
        });

        // Show the daycare container
        daycare_container2.style.display = 'none';
    }
}


function showSubmenu(id) {
    document.getElementById(id).style.display = 'block';
}

// Hide submenu on mouse leave
document.getElementById("certificates-submenu").addEventListener("mouseleave", function() {
    this.style.display = "none";
});

// Close the dropdown if clicking outside of it
document.addEventListener("click", function(event) {
    // Dropdown 1: Custom dropdown
    const customDropdown = document.querySelector(".custom-dropdown");
    const customDropdownOptions = document.getElementById("dropdown-options");
    const submenu = document.getElementById("certificates-submenu");

    if (customDropdown && !customDropdown.contains(event.target)) {
        if (customDropdownOptions) customDropdownOptions.style.display = "none";
        if (submenu) submenu.style.display = "none";
    }

    // Dropdown 2: Type dropdown
    const typeDropdown = document.querySelector(".type-dropdown");
    const typeDropdownOptions = document.getElementById("type-options");

    if (typeDropdown && !typeDropdown.contains(event.target)) {
        if (typeDropdownOptions) typeDropdownOptions.style.display = "none";
    }
});
