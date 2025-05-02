CREATE TABLE scholarships (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    amount DECIMAL(10,2) NOT NULL,
    eligibility TEXT NULL,
    deadline DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO scholarships (name, description, amount, eligibility, deadline) 
VALUES 
('Merit-Based Scholarship', 'For students with 90%+ marks', 50000, '90%+ in last exam', '2025-06-30'),
('post metric scholarship', 'For students from low-income families', 30000, 'Annual income < ₹2,00,000', '2025-07-15'),


