package services;

import entities.User;

import java.sql.SQLException;
import java.util.List;

/**
 * Vue admin des utilisateurs (adaptée sur {@link UserService}).
 */
public interface IUserService {

    List<User> getAll() throws SQLException;

    User getById(int id) throws SQLException;

    void add(User user) throws SQLException;

    void update(User user) throws SQLException;

    boolean delete(int id) throws SQLException;
}
