package services;

import models.Event;

import java.sql.SQLException;
import java.util.List;

public interface IEventService {

    void add(Event e) throws SQLException;

    List<Event> getAll() throws SQLException;

    Event getById(int id) throws SQLException;

    List<Event> getByCategory(int categoryId) throws SQLException;

    List<Event> search(String keyword) throws SQLException;

    void update(Event e) throws SQLException;

    void delete(int id) throws SQLException;
}
