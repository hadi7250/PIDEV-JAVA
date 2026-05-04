package services;

import javax.mail.*;
import javax.mail.internet.*;
import java.util.Properties;
import java.util.Random;

public class EmailService {

    // Configuration email (remplace avec tes identifiants)
    private static final String FROM_EMAIL = "rajhia003@gmail.com"; // Ton email
    private static final String FROM_PASSWORD = "qebr jdws tvix ykyb"; // Ton mot de passe ou mot de passe d'application
    private static final String SMTP_HOST = "smtp.gmail.com";
    private static final String SMTP_PORT = "587";

    /**
     * Envoie un code de réinitialisation par email
     * @param toEmail L'email du destinataire
     * @param code Le code à envoyer
     * @return true si l'email a été envoyé, false sinon
     */
    public boolean sendResetCode(String toEmail, String code) {
        Properties props = new Properties();
        props.put("mail.smtp.auth", "true");
        props.put("mail.smtp.starttls.enable", "true");
        props.put("mail.smtp.host", SMTP_HOST);
        props.put("mail.smtp.port", SMTP_PORT);

        Session session = Session.getInstance(props, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(FROM_EMAIL, FROM_PASSWORD);
            }
        });

        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(FROM_EMAIL));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(toEmail));
            message.setSubject("🔐 Réinitialisation de votre mot de passe");

            String htmlContent = "<div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>"
                    + "<h2 style='color: #667eea;'>🔐 Réinitialisation du mot de passe</h2>"
                    + "<p>Bonjour,</p>"
                    + "<p>Vous avez demandé à réinitialiser votre mot de passe.</p>"
                    + "<p>Voici votre code de vérification :</p>"
                    + "<div style='background: #f0f0f0; padding: 15px; text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 5px; border-radius: 8px;'>"
                    + code
                    + "</div>"
                    + "<p>Ce code expirera dans 15 minutes.</p>"
                    + "<p>Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.</p>"
                    + "<hr>"
                    + "<p style='font-size: 12px; color: #888;'>Application de gestion d'utilisateurs</p>"
                    + "</div>";

            message.setContent(htmlContent, "text/html; charset=utf-8");

            Transport.send(message);
            System.out.println("✅ Email envoyé à: " + toEmail);
            return true;

        } catch (MessagingException e) {
            System.err.println("❌ Erreur d'envoi d'email: " + e.getMessage());
            return false;
        }
    }

    /**
     * Génère un code aléatoire à 6 chiffres
     */
    public String generateCode() {
        Random random = new Random();
        int code = 100000 + random.nextInt(900000);
        return String.valueOf(code);
    }
}