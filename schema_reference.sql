-- schema for versetdb (reference)
USE versetdb;
CREATE TABLE IF NOT EXISTS versets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reference VARCHAR(100) NOT NULL,
  texte TEXT NOT NULL,
  categorie VARCHAR(50) DEFAULT NULL,
  date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS versetdujour (
  id INT PRIMARY KEY,
  verset_id INT DEFAULT NULL,
  updated_at DATE DEFAULT NULL,
  FOREIGN KEY (verset_id) REFERENCES versets(id) ON DELETE SET NULL
);
INSERT INTO versetdujour (id, verset_id, updated_at) VALUES (1, NULL, NULL)
ON DUPLICATE KEY UPDATE id=id;
