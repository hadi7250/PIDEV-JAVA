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
    // Add iTextPDF modules
    requires itextpdf;

    // Added requirements from Gestion_event integration
    requires javafx.web;
    requires javafx.swing;
    requires java.net.http;
    requires java.prefs;
    requires jdk.httpserver;
    requires org.controlsfx.controls;
    requires com.google.gson;
    requires java.mail;
    requires org.apache.poi.poi;
    requires org.apache.poi.ooxml;

    opens gui to javafx.fxml;
    opens main to javafx.fxml, javafx.graphics;
    opens entities to javafx.base;
    // Allow JavaFX to access controllers and models for binding
    opens controllers to javafx.fxml;
    opens models to javafx.base;
    opens gui to javafx.fxml;
    opens entities to javafx.base;
    opens services to javafx.base;
    opens utils to javafx.base;
    opens models to javafx.base;

    exports entities;
    exports services;
    exports utils;
    exports gui;
    exports controllers;
    exports models;
    exports gui;
    exports entities;
    exports services;
    exports utils;
    exports models;
}
