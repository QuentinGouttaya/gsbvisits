-- Create Family Table if not exists
CREATE TABLE IF NOT EXISTS Family (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL
);

-- Create Medicament Table if not exists
CREATE TABLE IF NOT EXISTS Medicament (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    family_id INT,
    composition TEXT,
    effects TEXT,
    contraindication TEXT,
    FOREIGN KEY (family_id) REFERENCES Family(id)
);

-- Create Visitor Table if not exists
CREATE TABLE IF NOT EXISTS Visitor (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    cp VARCHAR(10),
    ville VARCHAR(50),
    hiringDate DATE
);

-- Create Doctor Table if not exists
CREATE TABLE IF NOT EXISTS Doctor (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(20),
    additionalSpeciality VARCHAR(255),
    province VARCHAR(50),
    mail VARCHAR(50)
);

-- Create Report Table if not exists
CREATE TABLE IF NOT EXISTS Report (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
    reason VARCHAR(255),
    summary TEXT,
    visitor_id INT,
    doctor_id INT,
    FOREIGN KEY (visitor_id) REFERENCES Visitor(id),
    FOREIGN KEY (doctor_id) REFERENCES Doctor(id)
);

-- Create Offer Table if not exists
CREATE TABLE IF NOT EXISTS Offer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    medicament_id INT,
    report_id INT,
    FOREIGN KEY (medicament_id) REFERENCES Medicament(id),
    FOREIGN KEY (report_id) REFERENCES Report(id)
);

-- Mock Inserts for Family Table
INSERT INTO Family (libelle) VALUES
('Painkillers'),
('Antibiotics'),
('Anti-inflammatory'),
('Vitamins');

-- Mock Inserts for Medicament Table
INSERT INTO Medicament (name, family_id, composition, effects, contraindication) VALUES
('Aspirin', 1, 'Acetylsalicylic acid', 'Pain relief', 'Hypersensitivity'),
('Amoxicillin', 2, 'Amoxicillin', 'Antibacterial', 'Allergy to penicillin'),
('Ibuprofen', 3, 'Ibuprofen', 'Anti-inflammatory', 'Gastrointestinal bleeding'),
('Vitamin C', 4, 'Ascorbic acid', 'Immune system support', 'Kidney stones');

-- Mock Inserts for Visitor Table
INSERT INTO Visitor (name, surname, login, mdp, address, cp, ville, hiringDate) VALUES
('John', 'Doe', 'john.doe', 'password123', '123 Main St', '12345', 'City', '2022-03-01'),
('Alice', 'Smith', 'alice.smith', 'securepass', '456 Oak St', '67890', 'Town', '2022-03-02');

-- Mock Inserts for Doctor Table
INSERT INTO Doctor (name, surname, address, phone, additionalSpeciality, province, mail) VALUES
('Smith', 'Johnson', '789 Elm St', '123-456-7890', 'Cardiology', 'Yvelines', 'doctor@example.com'),
('Jensen', 'Alice', '101 Pine St', '987-654-3210', 'Neonatology', 'Picardie', 'doctor2@example.com');

-- Mock Inserts for Report Table
INSERT INTO Report (date, reason, summary, visitor_id, doctor_id) VALUES
('2022-03-15', 'Sales visit', 'Offered new painkiller. Discussed benefits and samples given.', 1, 1),
('2022-03-16', 'Product presentation', 'Introduced anti-inflammatory medication. Samples provided.', 2, 2);

-- Mock Inserts for Offer Table
INSERT INTO Offer (quantity, medicament_id, report_id) VALUES
(2, 1, 1),
(1, 3, 2);

