package utils;

import entities.User;
import models.Certificat;
import models.Event;
import services.CertificatService;
import services.EventService;
import services.ICertificatService;
import services.IEventService;
import services.IUserService;
import services.UserService;
import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpServer;

import java.io.IOException;
import java.io.OutputStream;
import java.net.BindException;
import java.net.InetAddress;
import java.net.InetSocketAddress;
import java.nio.charset.StandardCharsets;
import java.sql.SQLException;
import java.net.NetworkInterface;
import java.util.Enumeration;
import java.util.concurrent.Executors;


/**
 * One shared HTTP server for local certificate verification pages.
 * Binds the first free port in a range so "address already in use" is avoided
 * when another process (or a previous run) still holds 8080.
 */
public class LocalServerService {

    private static final int PORT_MIN = 8080;
    private static final int PORT_MAX = 8190;

    private static volatile LocalServerService instance;

    private final ICertificatService certificatService;
    private final IUserService userService;
    private final IEventService eventService;

    private HttpServer server;
    private int port = -1;

    public static LocalServerService getInstance() {
        if (instance == null) {
            synchronized (LocalServerService.class) {
                if (instance == null) {
                    instance = new LocalServerService(
                            new CertificatService(),
                            new UserService(),
                            new EventService()
                    );
                }
            }
        }
        return instance;
    }

    private LocalServerService(ICertificatService certificatService, IUserService userService, IEventService eventService) {
        this.certificatService = certificatService;
        this.userService = userService;
        this.eventService = eventService;
    }

    /**
     * Start once on the first available port in {@value #PORT_MIN}–{@value #PORT_MAX}.
     */
    public synchronized void startAuto() throws IOException {
        if (server != null) {
            return;
        }
        IOException last = null;
        for (int p = PORT_MIN; p <= PORT_MAX; p++) {
            try {
                this.port = p;
                server = HttpServer.create(new InetSocketAddress("0.0.0.0", p), 0);
                server.createContext("/", exchange -> {
                    String b = "<html><body style='font-family:sans-serif;text-align:center;padding:50px;background:#0f172a;color:white;'>"
                            + "<h1>EduConnect Local Server</h1>"
                            + "<p>Serveur actif sur le port " + port + "</p>"
                            + "</body></html>";
                    writeResponse(exchange, 200, b);
                });
                server.createContext("/health", this::handleHealth);
                server.createContext("/cert", this::handleCert);
                server.createContext("/event", this::handleEvent);
                server.setExecutor(Executors.newCachedThreadPool());

                server.start();
                return;
            } catch (BindException e) {
                last = e;
                server = null;
            } catch (IOException e) {
                if (e.getMessage() != null && e.getMessage().toLowerCase().contains("in use")) {
                    last = e;
                    server = null;
                } else {
                    throw e;
                }
            }
        }
        throw new IOException("Aucun port libre entre " + PORT_MIN + " et " + PORT_MAX, last);
    }

    public synchronized int getPort() {
        return port;
    }

    public synchronized boolean isRunning() {
        return server != null;
    }

    public synchronized String getBaseUrl() throws IOException {
        String ip = getLocalIpAddress();
        return "http://" + ip + ":" + port;
    }

    private String getLocalIpAddress() {
        String bestIp = "127.0.0.1";
        try {
            Enumeration<NetworkInterface> interfaces = NetworkInterface.getNetworkInterfaces();
            while (interfaces.hasMoreElements()) {
                NetworkInterface ni = interfaces.nextElement();
                String name = ni.getDisplayName().toLowerCase();
                if (ni.isLoopback() || !ni.isUp() || ni.isVirtual()
                        || name.contains("virtual") || name.contains("vmware")
                        || name.contains("vbox") || name.contains("virtualbox")
                        || name.contains("host-only") || name.contains("hyper-v")) {
                    continue;
                }
                Enumeration<InetAddress> addresses = ni.getInetAddresses();
                while (addresses.hasMoreElements()) {
                    InetAddress addr = addresses.nextElement();
                    String ip = addr.getHostAddress();
                    if (ip.contains(":")) continue;
                    if (ip.startsWith("192.168.") || ip.startsWith("10.") || ip.startsWith("172.")) {
                        return ip;
                    }
                    bestIp = ip;
                }
            }
        } catch (Exception ignored) {}
        return bestIp;
    }


    public synchronized String getCertificateUrl(String code) throws IOException {
        if (!isRunning() || code == null) {
            return null;
        }
        return getBaseUrl() + "/cert?code=" + java.net.URLEncoder.encode(code, StandardCharsets.UTF_8);
    }

    public synchronized String getEventUrl(int id) throws IOException {
        if (!isRunning()) {
            return null;
        }
        return getBaseUrl() + "/event?id=" + id;
    }


    private void handleHealth(HttpExchange exchange) throws IOException {
        writeResponse(exchange, 200, "Server OK");
    }

    private void handleCert(HttpExchange exchange) throws IOException {
        String query = exchange.getRequestURI().getQuery();
        String code = null;
        if (query != null) {
            for (String p : query.split("&")) {
                if (p.startsWith("code=")) {
                    code = p.substring(5);
                    break;
                }
            }
        }

        if (code == null || code.isBlank()) {
            writeResponse(exchange, 400, "<h2>Code certificat manquant.</h2>");
            return;
        }

        try {
            Certificat c = certificatService.getByCode(java.net.URLDecoder.decode(code, StandardCharsets.UTF_8));
            if (c == null) {
                writeResponse(exchange, 404, "<h2>Certificat introuvable.</h2>");
                return;
            }
            User u = userService.getById(c.getUserId());
            Event e = eventService.getById(c.getEventId());

            String uName = u != null ? u.getName() : "N/A";
            String eTitle = e != null ? e.getTitre() : "N/A";
            String date = c.getDateObtention() != null ? c.getDateObtention().toString() : "N/A";

            String body = "<!DOCTYPE html><html lang='fr'><head><meta charset='UTF-8'>"
                    + "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
                    + "<style>"
                    + "body { margin: 0; background: #0f172a; color: #1e293b; font-family: 'Georgia', serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; box-sizing: border-box; }"
                    + ".cert-container { background: #fffdf5; padding: 40px; border-radius: 4px; position: relative; width: 100%; max-width: 600px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); border: 15px solid #fffdf5; outline: 2px solid #b8860b; outline-offset: -10px; }"
                    + ".header { text-align: center; border-bottom: 2px solid #b8860b; padding-bottom: 20px; margin-bottom: 30px; }"
                    + "h1 { margin: 0; font-size: 28px; color: #b8860b; text-transform: uppercase; letter-spacing: 2px; }"
                    + ".sub-header { font-size: 12px; color: #64748b; margin-top: 5px; font-family: sans-serif; }"
                    + ".content { text-align: center; }"
                    + ".label { font-size: 14px; color: #64748b; font-style: italic; margin-bottom: 10px; }"
                    + ".name { font-size: 32px; font-weight: bold; color: #0f172a; margin: 15px 0; border-bottom: 1px solid #e2e8f0; display: inline-block; padding: 0 30px; }"
                    + ".event { font-size: 20px; color: #1e40af; margin: 15px 0; font-weight: bold; }"
                    + ".meta { display: flex; justify-content: space-between; margin-top: 40px; font-family: sans-serif; font-size: 11px; color: #94a3b8; }"
                    + ".signature { text-align: right; margin-top: 30px; font-family: 'Brush Script MT', cursive; font-size: 24px; color: #0f172a; border-top: 1px solid #cbd5e1; display: inline-block; float: right; padding-top: 5px; }"
                    + ".seal { position: absolute; bottom: 20px; left: 40px; width: 60px; height: 60px; background: #b8860b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 8px; font-weight: bold; transform: rotate(-15deg); border: 2px dashed white; box-shadow: 0 0 0 3px #b8860b; }"
                    + "</style></head><body>"
                    + "<div class='cert-container'>"
                    + "  <div class='header'>"
                    + "    <h1>Certificat de Réussite</h1>"
                    + "    <div class='sub-header'>EDUCONNECT PROFESSIONAL RECOGNITION</div>"
                    + "  </div>"
                    + "  <div class='content'>"
                    + "    <div class='label'>Ce document officiel atteste que</div>"
                    + "    <div class='name'>" + safe(uName) + "</div>"
                    + "    <div class='label'>a validé avec succès l'événement</div>"
                    + "    <div class='event'>" + safe(eTitle) + "</div>"
                    + "  </div>"
                    + "  <div class='meta'>"
                    + "    <div>Délivré le: " + safe(date) + "<br>ID: " + safe(c.getCodeUnique()) + "</div>"
                    + "    <div class='signature'>Nasri Mohamed</div>"
                    + "  </div>"
                    + "  <div class='seal'>OFFICIEL<br>CERTIFIÉ</div>"
                    + "</div></body></html>";

            writeResponse(exchange, 200, body);
        } catch (SQLException ex) {
            writeResponse(exchange, 500, "<h2>Erreur serveur: " + safe(ex.getMessage()) + "</h2>");
        }

    }

    private void handleEvent(HttpExchange exchange) throws IOException {
        String query = exchange.getRequestURI().getQuery();
        int id = -1;
        if (query != null) {
            for (String p : query.split("&")) {
                if (p.startsWith("id=")) {
                    try {
                        id = Integer.parseInt(p.substring(3));
                    } catch (NumberFormatException ignored) {}
                    break;
                }
            }
        }

        if (id == -1) {
            writeResponse(exchange, 400, "<h2>ID Événement manquant.</h2>");
            return;
        }

        try {
            Event e = eventService.getById(id);
            if (e == null) {
                writeResponse(exchange, 404, "<h2>Événement introuvable.</h2>");
                return;
            }
            String body = "<!DOCTYPE html><html lang='fr'><head><meta charset='UTF-8'>"
                    + "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
                    + "<style>"
                    + "body { margin: 0; background: #0f172a; color: #f8fafc; font-family: sans-serif; }"
                    + ".hero { height: 200px; background: linear-gradient(135deg, #6366f1, #a855f7); display: flex; align-items: flex-end; padding: 20px; box-sizing: border-box; }"
                    + ".hero h1 { margin: 0; font-size: 28px; text-shadow: 0 4px 6px rgba(0,0,0,0.3); }"
                    + ".content { padding: 20px; }"
                    + ".card { background: #1e293b; padding: 20px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }"
                    + ".label { color: #94a3b8; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }"
                    + ".value { color: #f1f5f9; font-size: 16px; font-weight: bold; margin-bottom: 15px; }"
                    + ".desc { line-height: 1.6; color: #cbd5e1; }"
                    + ".footer { text-align: center; padding: 20px; color: #475569; font-size: 12px; border-top: 1px solid #1e293b; }"
                    + "</style></head><body>"
                    + "<div class='hero'><h1>" + safe(e.getTitre()) + "</h1></div>"
                    + "<div class='content'>"
                    + "<div class='card'>"
                    + "<div class='label'>📍 Lieu</div><div class='value'>" + safe(e.getLieu()) + "</div>"
                    + "<div class='label'>📅 Date</div><div class='value'>" + safe(String.valueOf(e.getDateDebut())) + "</div>"
                    + "<div class='label'>⏱ Durée</div><div class='value'>" + e.getDuree() + " min</div>"
                    + "</div>"
                    + "<div class='card'>"
                    + "<div class='label'>📝 Description</div>"
                    + "<div class='desc'>" + safe(e.getDescription()) + "</div>"
                    + "</div>"
                    + "</div>"
                    + "<div class='footer'>© " + java.time.Year.now().getValue() + " EduConnect Mobile View</div>"
                    + "</body></html>";
            writeResponse(exchange, 200, body);
        } catch (SQLException ex) {
            writeResponse(exchange, 500, "<h2>Erreur serveur: " + safe(ex.getMessage()) + "</h2>");
        }

    }


    private static String safe(String v) {
        if (v == null) {
            return "";
        }
        return v.replace("&", "&amp;").replace("<", "&lt;").replace(">", "&gt;");
    }

    private void writeResponse(HttpExchange exchange, int status, String body) throws IOException {
        byte[] bytes = body.getBytes(StandardCharsets.UTF_8);
        exchange.getResponseHeaders().set("Content-Type", "text/html; charset=utf-8");
        exchange.sendResponseHeaders(status, bytes.length);
        try (OutputStream os = exchange.getResponseBody()) {
            os.write(bytes);
        }
    }
}
