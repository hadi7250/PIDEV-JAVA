package services;

import models.Category;

import java.sql.SQLException;
import java.util.List;

public interface ICategoryService {

    void add(Category c) throws SQLException;

    List<Category> getAll() throws SQLException;

    Category getById(int id) throws SQLException;

    void update(Category c) throws SQLException;

    void delete(int id) throws SQLException;

    int countEvents(int categoryId) throws SQLException;
}
