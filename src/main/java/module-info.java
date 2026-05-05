module pidev.java {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.sql;
    requires java.desktop;
    requires java.compiler;
    requires com.opencsv;
    requires org.hibernate.validator;
    requires jakarta.validation;
    requires jasperreports;
    requires org.json;
    requires eu.mihosoft.monacofx;

    opens gui to javafx.fxml;
    opens main to javafx.fxml, javafx.graphics;
    opens entities to javafx.base;
    
    exports entities;
    exports services;
    exports utils;
    exports gui;
}
