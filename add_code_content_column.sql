-- Add code_content and language columns to evaluation table if they don't exist
ALTER TABLE `evaluation`
ADD COLUMN IF NOT EXISTS `code_content` text DEFAULT NULL,
ADD COLUMN IF NOT EXISTS `language` varchar(50) DEFAULT NULL;

