-- Add is_code_evaluation and language columns to evaluation table if they don't exist
ALTER TABLE `evaluation`
ADD COLUMN IF NOT EXISTS `is_code_evaluation` BOOLEAN DEFAULT FALSE,
ADD COLUMN IF NOT EXISTS `language` VARCHAR(50) DEFAULT 'java';
