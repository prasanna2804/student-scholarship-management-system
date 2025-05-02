-- Database Schema for Scholarship Application System


-- Table to store student applications
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_no VARCHAR(50) NOT NULL,
    student_online_id VARCHAR(50) NOT NULL,
    course VARCHAR(100) NOT NULL,
    year ENUM('I', 'II', 'III', 'IV', 'V') NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    father_guardian_name VARCHAR(255) NOT NULL,
    occupation VARCHAR(255),
    address TEXT NOT NULL,
    bank_account_no VARCHAR(50) NOT NULL,
    bank_name VARCHAR(100) NOT NULL,
    branch_name VARCHAR(100) NOT NULL,
    micr_code VARCHAR(20),
    ifsc_code VARCHAR(20) NOT NULL,
    sex ENUM('Male', 'Female', 'Other') NOT NULL,
    umis_no VARCHAR(50),
    aadhaar_no VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
    community VARCHAR(100) NOT NULL,
    sub_caste VARCHAR(100),
    date_of_joining DATE NOT NULL,
    student_mobile VARCHAR(15) NOT NULL,
    parent_mobile VARCHAR(15),
    student_email VARCHAR(255) NOT NULL,
    received_other_scholarship ENUM('YES', 'NO') NOT NULL,
    hosteller ENUM('YES', 'NO') NOT NULL,
    application_status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to store uploaded documents separately
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    document_type ENUM(
        'Identity Card', 'Bonafide Certificate', '10th Marksheet', '12th Marksheet', 
        'Income Certificate', 'Community Certificate', 'Bank Passbook', 
        'Tuition Fee Challan', 'Aadhaar Card', 'Hostel Certificate', 'Attendance Certificate', 'First Graduate Certificate'
    ) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
);

