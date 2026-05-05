package services;

import models.Participation;

import java.sql.SQLException;
import java.util.List;

public interface IParticipationService {

    void add(Participation p) throws SQLException;

    List<Participation> getAll() throws SQLException;

    /** Participations with {@link Participation#getUser()} and {@link Participation#getEvent()} labels filled when available. */
    List<Participation> getAllWithDetails() throws SQLException;

    Participation getById(int id) throws SQLException;

    boolean userHasJoined(int userId, int eventId) throws SQLException;

    List<Participation> getByUser(int userId) throws SQLException;

    List<Participation> getByEvent(int eventId) throws SQLException;

    void update(Participation p) throws SQLException;

    void delete(int id) throws SQLException;

    int countByEvent(int eventId) throws SQLException;
}
