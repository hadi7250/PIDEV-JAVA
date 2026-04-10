package services;

import entities.Person;
import utils.MyConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class PersonService implements IService<Person>{

    private Connection cnx;

    public PersonService(){
        cnx = MyConnection.getInstance().getConnection();
    }

    @Override
    public void create(Person person) throws SQLException {
        String query = "INSERT INTO person (firstName, lastName, age) VALUES (?, ?, ?)";
        PreparedStatement pstmt = cnx.prepareStatement(query);
        pstmt.setString(1, person.getFirstName());
        pstmt.setString(2, person.getLastName());
        pstmt.setInt(3, person.getAge());
        pstmt.executeUpdate();
        System.out.println("✅ Person created successfully!");
    }

    @Override
    public void update(Person person) throws SQLException {
        String query = "UPDATE person SET firstName = ?, lastName = ?, age = ? WHERE id = ?";
        PreparedStatement ps = cnx.prepareStatement(query);
        ps.setString(1, person.getFirstName());
        ps.setString(2, person.getLastName());
        ps.setInt(3, person.getAge());
        ps.setInt(4, person.getId());
        ps.executeUpdate();
        System.out.println("✅ Person updated successfully!");
    }

    @Override
    public void delete(Person person) throws SQLException {
        String query = "DELETE FROM person WHERE id = ?";
        PreparedStatement pstmt = cnx.prepareStatement(query);
        pstmt.setInt(1, person.getId());
        pstmt.executeUpdate();
        System.out.println("✅ Person deleted successfully!");
    }

    @Override
    public List<Person> readAll() throws SQLException {
        List<Person> persons = new ArrayList<>();
        String query = "SELECT * FROM person";
        Statement st = cnx.createStatement();
        ResultSet rs = st.executeQuery(query);

        while (rs.next()){
            int id = rs.getInt("id");
            int age = rs.getInt("age");
            String firstName = rs.getString("firstName");
            String lastName = rs.getString("lastName");
            Person p = new Person(id, age, firstName, lastName);
            persons.add(p);
        }
        return persons;
    }
}