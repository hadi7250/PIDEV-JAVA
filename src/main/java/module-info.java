module pidev.java {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.sql;
    requires java.desktop;

    opens gui to javafx.fxml;
    opens main to javafx.fxml;
}
