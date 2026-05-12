package utils;

import models.Event;
import entities.User;
import javax.mail.*;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import java.util.List;
import java.util.Properties;

public class MailService {
    private static final String SENDER_EMAIL = "mohamednasrixxx@gmail.com";
    private static final String APP_PASSWORD = "Ukaghkatdebqtack";

    public void sendNewEventNotification(Event event, List<User> users) {
        Properties props = new Properties();
        props.put("mail.smtp.auth", "true");
        props.put("mail.smtp.starttls.enable", "true");
        props.put("mail.smtp.host", "smtp.gmail.com");
        props.put("mail.smtp.port", "587");
        props.put("mail.smtp.ssl.trust", "smtp.gmail.com");

        Session session = Session.getInstance(props, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(SENDER_EMAIL, APP_PASSWORD);
            }
        });

        // Run in background to avoid freezing the UI
        new Thread(() -> {
            for (User user : users) {
                if (user.getEmail() == null || !user.getEmail().contains("@")) continue;
                
                try {
                    Message message = new MimeMessage(session);
                    message.setFrom(new InternetAddress(SENDER_EMAIL));
                    message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(user.getEmail()));
                    message.setSubject("🎭 Nouvel Événement sur EduConnect : " + event.getTitre());

                    String htmlContent = "<div style=\"background-color: #f8fafc; padding: 40px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #1e293b;\">"
                            + "<div style=\"max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);\">"
                            + "  <div style=\"background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 40px 30px; text-align: center;\">"
                            + "    <h1 style=\"color: #ffffff; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -0.5px;\">EduConnect</h1>"
                            + "    <p style=\"color: rgba(255,255,255,0.9); margin: 10px 0 0 0; font-size: 16px;\">Nouvel Événement Disponible !</p>"
                            + "  </div>"
                            + "  <div style=\"padding: 40px 30px;\">"
                            + "    <h2 style=\"margin-top: 0; color: #1e293b; font-size: 22px;\">Bonjour " + user.getFirstName() + " " + user.getLastName() + " 👋</h2>"
                            + "    <p style=\"font-size: 16px; color: #64748b;\">Une nouvelle opportunité vient de paraître sur notre plateforme. Voici les détails de l'événement qui pourrait vous intéresser :</p>"
                            + "    <div style=\"margin: 30px 0; padding: 25px; background: #f1f5f9; border-radius: 12px; border-left: 6px solid #6366f1;\">"
                            + "      <h3 style=\"margin: 0 0 15px 0; color: #4f46e5; font-size: 20px;\">" + event.getTitre() + "</h3>"
                            + "      <p style=\"margin: 8px 0; font-size: 15px;\"><strong style=\"color: #1e293b;\">📍 Lieu :</strong> " + event.getLieu() + "</p>"
                            + "      <p style=\"margin: 8px 0; font-size: 15px;\"><strong style=\"color: #1e293b;\">📅 Date :</strong> " + (event.getDateDebut() != null ? event.getDateDebut().toString() : "À venir") + "</p>"
                            + "      <p style=\"margin: 8px 0; font-size: 15px;\"><strong style=\"color: #1e293b;\">⏱ Durée :</strong> " + event.getDuree() + " minutes</p>"
                            + "      <p style=\"margin: 15px 0 0 0; font-size: 15px; color: #475569; font-style: italic;\">\"" + (event.getDescription() != null ? event.getDescription() : "Aucune description") + "\"</p>"
                            + "    </div>"
                            + "    <div style=\"text-align: center; margin-top: 35px;\">"
                            + "      <a href=\"#\" style=\"background-color: #6366f1; color: white; padding: 14px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; display: inline-block;\">Voir sur l'Application</a>"
                            + "    </div>"
                            + "  </div>"
                            + "  <div style=\"background-color: #f1f5f9; padding: 25px 30px; text-align: center; border-top: 1px solid #e2e8f0;\">"
                            + "    <p style=\"margin: 0; font-size: 13px; color: #94a3b8;\">© 2026 EduConnect Team. Tous droits réservés.</p>"
                            + "    <p style=\"margin: 5px 0 0 0; font-size: 12px; color: #94a3b8;\">Vous recevez cet email car vous êtes inscrit sur notre plateforme.</p>"
                            + "  </div>"
                            + "</div>"
                            + "</div>";


                    message.setContent(htmlContent, "text/html; charset=utf-8");
                    Transport.send(message);
                    System.out.println("Email envoyé avec succès à : " + user.getEmail());
                } catch (MessagingException e) {
                    System.err.println("Impossible d'envoyer l'email à " + user.getEmail() + " : " + e.getMessage());
                }
            }
        }).start();
    }
}
