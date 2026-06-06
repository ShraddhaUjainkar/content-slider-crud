CREATE DATABASE IF NOT EXISTS wpoets_assignment
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE wpoets_assignment;

DROP TABLE IF EXISTS slides;
DROP TABLE IF EXISTS tabs;

CREATE TABLE tabs (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(120) NOT NULL,
  icon VARCHAR(255) DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  INDEX idx_tabs_sort_order (sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE slides (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  tab_id INT UNSIGNED NOT NULL,
  tag VARCHAR(120) NOT NULL,
  title VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  learn_more_link VARCHAR(255) NOT NULL DEFAULT '#',
  sort_order INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  INDEX idx_slides_tab_sort (tab_id, sort_order),
  CONSTRAINT fk_slides_tabs
    FOREIGN KEY (tab_id) REFERENCES tabs(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tabs (id, title, icon, sort_order) VALUES
(1, 'Learning', 'assets/uploads/wpoets/DL-learning.svg', 1),
(2, 'Technology', 'assets/uploads/wpoets/DL-technology.svg', 2),
(3, 'Communication', 'assets/uploads/wpoets/DL-communication.svg', 3);

INSERT INTO slides (tab_id, tag, title, image, learn_more_link, sort_order) VALUES
(1, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'assets/uploads/wpoets/DL-Learning-1.jpg', 'https://www.wpoets.com/', 1),
(1, 'Learning Experience Design', 'Role based learning journeys that help teams adopt new workflows faster', 'assets/uploads/wpoets/DL-Learning-1.jpg', 'https://www.wpoets.com/', 2),
(1, 'Training Enablement', 'Practical training programs built around measurable learner outcomes', 'assets/uploads/wpoets/DL-Learning-1.jpg', 'https://www.wpoets.com/', 3),
(2, 'Cloud Based Technology', 'Technology platforms designed for scalable digital operations', 'assets/uploads/wpoets/DL-Technology.jpg', 'https://www.wpoets.com/', 1),
(2, 'Platform Engineering', 'Reliable application foundations for integrations, automation, and growth', 'assets/uploads/wpoets/DL-Technology.jpg', 'https://www.wpoets.com/', 2),
(2, 'Digital Transformation', 'Modern tools that simplify processes and improve business visibility', 'assets/uploads/wpoets/DL-Technology.jpg', 'https://www.wpoets.com/', 3),
(3, 'Communication Strategy', 'Clear communication experiences for connected teams and customers', 'assets/uploads/wpoets/DL-Communication.jpg', 'https://www.wpoets.com/', 1),
(3, 'Customer Messaging', 'Structured content that keeps users informed across every interaction', 'assets/uploads/wpoets/DL-Communication.jpg', 'https://www.wpoets.com/', 2),
(3, 'Collaboration Workflows', 'Communication systems that help distributed teams stay aligned', 'assets/uploads/wpoets/DL-Communication.jpg', 'https://www.wpoets.com/', 3);
