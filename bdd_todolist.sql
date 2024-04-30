CREATE TABLE IF NOT EXISTS `user`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email  VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `task`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    create_at TIMESTAMP,
    deadline TIMESTAMP,
    image VARCHAR(255),
    user_id INT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id)
);