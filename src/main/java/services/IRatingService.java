package services;

import models.Rating;

import java.sql.SQLException;
import java.util.List;

public interface IRatingService {

    void add(Rating r) throws SQLException;

    List<Rating> getAll() throws SQLException;

    /** Ratings with user email and event title when available. */
    List<Rating> getAllWithDetails() throws SQLException;

    Rating getById(int id) throws SQLException;

    List<Rating> getByEvent(int eventId) throws SQLException;

    boolean userHasRated(int userId, int eventId) throws SQLException;

    double getAverageRating(int eventId) throws SQLException;

    void update(Rating r) throws SQLException;

    void delete(int id) throws SQLException;
}
