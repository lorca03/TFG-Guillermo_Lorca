CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `lastname` varchar(255),
  `email` varchar(255) UNIQUE
);

CREATE TABLE `watch_list` (
  `user_id` int,
  `pelicula` varchar(255),
  `estado` boolean,
  PRIMARY KEY (`user_id`, `pelicula`)
);

CREATE TABLE `comentarios` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pelicula` varchar(255),
  `commentario` varchar(255),
  `user_id` int
);

CREATE TABLE `valoraciones` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pelicula` varchar(255),
  `valoracion` float,
  `user_id` int
);

ALTER TABLE `watch_list` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `valoraciones` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `comentarios` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
