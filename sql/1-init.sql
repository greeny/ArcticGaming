CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nick` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) COMMENT='';

ALTER TABLE `user`
ADD UNIQUE `nick` (`nick`),
ADD UNIQUE `email` (`email`);
