package utils;

import entities.User;

/**
 * Singleton session manager for handling the currently logged-in user.
 * Provides thread-safe access to user session state throughout the application.
 */
public class SessionManager {
    
    private static SessionManager instance;
    private User currentUser;
    
    private SessionManager() {
        // Private constructor to enforce singleton pattern
    }
    
    /**
     * Gets the singleton instance of SessionManager.
     * Creates a new instance if one doesn't exist.
     * 
     * @return The SessionManager instance
     */
    public static SessionManager getInstance() {
        if (instance == null) {
            synchronized (SessionManager.class) {
                if (instance == null) {
                    instance = new SessionManager();
                }
            }
        }
        return instance;
    }
    
    /**
     * Gets the currently logged-in user.
     * 
     * @return The current User object, or null if no user is logged in
     */
    public User getCurrentUser() {
        return currentUser;
    }
    
    /**
     * Sets the currently logged-in user.
     * 
     * @param user The User object to set as current user
     */
    public void setCurrentUser(User user) {
        this.currentUser = user;
    }
    
    /**
     * Checks if a user is currently logged in.
     * 
     * @return true if a user is logged in, false otherwise
     */
    public boolean isLoggedIn() {
        return currentUser != null;
    }
    
    /**
     * Logs out the current user by clearing the session.
     */
    public void logout() {
        this.currentUser = null;
    }
    
    /**
     * Gets the full name of the current user.
     * 
     * @return The user's full name (firstName + lastName), or "Guest" if not logged in
     */
    public String getCurrentUserFullName() {
        if (currentUser == null) {
            return "Guest";
        }
        return currentUser.getFirstName() + " " + currentUser.getLastName();
    }
    
    /**
     * Checks if the current user has admin role.
     * 
     * @return true if current user is admin, false otherwise
     */
    public boolean isCurrentUserAdmin() {
        return currentUser != null && currentUser.isAdmin();
    }
    
    /**
     * Gets the current user's ID.
     * 
     * @return The user ID, or -1 if not logged in
     */
    public int getCurrentUserId() {
        return currentUser == null ? -1 : currentUser.getId();
    }
}
