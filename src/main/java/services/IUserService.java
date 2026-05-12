package services;

import entities.User;
import java.sql.SQLException;
import java.util.List;

public interface IUserService {
    void add(User u) throws SQLException;
    List<User> getAll() throws SQLException;
    User getById(int id) throws SQLException;
    User getByEmail(String email) throws SQLException;
    void update(User u) throws SQLException;
    void delete(int id) throws SQLException;

    // Compatibility & Helper Methods
    boolean emailExists(String email);

    User login(String email, String password);
    boolean register(User u);

    String getUserPhotoPath(int id);
    boolean updateUserPhoto(int id, String path);
    User getUserById(int id);

    // Legacy Aliases
    List<User> getAllUsers() throws SQLException;
    boolean updateProfile(User u);

    boolean deleteUser(int id);


    // Password Reset methods
    void saveResetCode(String email, String code);
    boolean verifyResetCode(String email, String code);
    boolean updatePasswordWithReset(String email, String newPassword);
    User getUserByEmail(String email);
}

