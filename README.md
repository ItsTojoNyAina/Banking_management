*******NB***********
***Pour pouvoir utiliser pleinement ce projet vous devez creer la Base de donnees "bank" et executer les codes ci-dessous/creer manuellement les tables : 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) NOT NULL DEFAULT 0.00,  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

***CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('deposit', 'withdrawal') NOT NULL,  
    amount DECIMAL(10, 2) NOT NULL,  
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

***CREATE TABLE loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL, 
    interest_rate DECIMAL(4, 2) NOT NULL,  
    monthly_payment DECIMAL(10, 2) NOT NULL,  
    due_date DATE NOT NULL,  
    status ENUM('pending', 'approved', 'paid', 'defaulted') DEFAULT 'pending',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users

MERCI D'AVANCE <3333!!!!!