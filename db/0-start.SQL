DROP DATABASE proyect_Ticos_Rides;

CREATE DATABASE proyect_Ticos_Rides;

USE proyect_Ticos_Rides;

CREATE TABLE IF NOT EXISTS users(
    id INT  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS rides (
 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 ride_name VARCHAR(255) NOT NULL,
 start_from VARCHAR(255) NOT NULL,
 end_to VARCHAR(255) NOT NULL,
 description VARCHAR(255) NOT NULL,
 departure_time TIME NOT NULL,
 arrival_time TIME NOT NULL,
 days VARCHAR(255) not NULL,
 user_id INT NOT NULL,
 FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE profile(
    id INT  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    speed_avarage VARCHAR(200) NOT NULL,
    about_me VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)


INSERT INTO users(name,last_name,phone,username,password)
VALUES ('Rofrigo', 'Salas', 61813099, 'RoSal', 'Rosales123');


INSERT INTO rides (ride_name, start_from, end_to, description, departure_time, arrival_time, days, user_id) 
VALUES ('Para la casa', 'Casa', 'Casa Jimena', 'Ya me quería ir', '09:30:00', '10:30:00', 'Sunday', 1),
('Para la casa de Jimena', 'Casa de Jimena', 'Casa', 'Ya me quería ir de la casa', '12:30:00', '1:30:00', 'Saturday', 1);
