package main;

import entities.User;
import services.UserService;
import utils.MyConnection;

import java.sql.SQLException;
import java.util.List;

public class TestJDBC {

    public static void main(String[] args) {

        // Test the connection
        System.out.println("=== Testing Database Connection ===");
        MyConnection.getInstance();

        // Test UserService
        UserService userService = new UserService();

        // Test: Get all users
        System.out.println("\n=== All Users in Database ===");
        List<User> users = userService.getAllUsers();
        for (User u : users) {
            System.out.println("ID: " + u.getId() +
                    ", Name: " + u.getFirstName() + " " + u.getLastName() +
                    ", Email: " + u.getEmail() +
                    ", Role: " + u.getRole());
        }

        // Test: Login with admin
        System.out.println("\n=== Testing Admin Login ===");
        User admin = userService.login("admin@example.com", "admin123");
        if (admin != null) {
            System.out.println("✅ Admin login successful!");
            System.out.println("   Welcome: " + admin.getFirstName() + " " + admin.getLastName());
            System.out.println("   Role: " + admin.getRole());
        } else {
            System.out.println("❌ Admin login failed!");
        }

        // Test: Login with regular user
        System.out.println("\n=== Testing Regular User Login ===");
        User regularUser = userService.login("jean.dupont@example.com", "password123");
        if (regularUser != null) {
            System.out.println("✅ Regular user login successful!");
            System.out.println("   Welcome: " + regularUser.getFirstName() + " " + regularUser.getLastName());
            System.out.println("   Role: " + regularUser.getRole());
        } else {
            System.out.println("❌ Regular user login failed!");
        }

        System.out.println("\n=== Test Complete ===");
    }
}