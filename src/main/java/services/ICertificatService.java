package services;

import models.Certificat;

import java.sql.SQLException;
import java.util.List;

public interface ICertificatService {

    void add(Certificat c) throws SQLException;

    List<Certificat> getAll() throws SQLException;

    /** Certificates with user email and event title when available. */
    List<Certificat> getAllWithDetails() throws SQLException;

    Certificat getById(int id) throws SQLException;

    Certificat getByCode(String code) throws SQLException;

    List<Certificat> getByUser(int userId) throws SQLException;

    void update(Certificat c) throws SQLException;

    void delete(int id) throws SQLException;
}
