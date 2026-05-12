<?php
require_once 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use App\Entity\User;

// Simple approach - create admin user with plain password first
$entityManager = EntityManager::create([
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'port' => '3306',
    'dbname' => 'pidev_db',
    'user' => 'root',
    'password' => ''
]);

$admin = new User();
$admin->setName('admin');
$admin->setEmail('admin@example.com');
$admin->setPassword('admin123'); // Will be hashed automatically by Doctrine if configured
$admin->setRoles(['ROLE_ADMIN']);

$entityManager->persist($admin);
$entityManager->flush();

echo "Admin user created successfully!\n";
echo "Email: admin@example.com\n";
echo "Password: admin123\n";
?>
