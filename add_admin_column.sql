-- Add admin column to users table
ALTER TABLE `users` ADD `is_admin` TINYINT(1) NOT NULL DEFAULT '0' AFTER `address`;

-- Set a user as admin (change the id to an existing user you want to make admin)
UPDATE `users` SET `is_admin` = 1 WHERE `id` = 1; 