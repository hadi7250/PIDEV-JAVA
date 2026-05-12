package utils;

import org.json.JSONArray;
import org.json.JSONObject;

import javax.sound.sampled.*;
import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.file.Files;
import java.nio.file.Path;

public class VoiceSearchService {

    private static final String DEEPGRAM_API_URL =
            "https://api.deepgram.com/v1/listen?model=nova-2&smart_format=true";

    // ⚠️ Hardcoded API key (NOT recommended for production)
    private static final String DEEPGRAM_API_KEY =
            "xxxxxxxxxxxxxxxxxxxxxx";

    /**
     * Sends a WAV file to Deepgram and returns the transcription
     */
    public String transcribeWav(Path wavFile) throws IOException, InterruptedException {

        byte[] audio = Files.readAllBytes(wavFile);

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(DEEPGRAM_API_URL))
                .header("Authorization", "Token " + DEEPGRAM_API_KEY)
                .header("Content-Type", "audio/wav")
                .POST(HttpRequest.BodyPublishers.ofByteArray(audio))
                .build();

        HttpResponse<String> response = HttpClient.newHttpClient()
                .send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() < 200 || response.statusCode() >= 300) {
            throw new IOException("Deepgram API error: "
                    + response.statusCode() + " - " + response.body());
        }

        JSONObject json = new JSONObject(response.body());

        JSONArray channels = json
                .getJSONObject("results")
                .getJSONArray("channels");

        if (channels.isEmpty()) return "";

        JSONArray alternatives = channels
                .getJSONObject(0)
                .getJSONArray("alternatives");

        if (alternatives.isEmpty()) return "";

        return alternatives
                .getJSONObject(0)
                .optString("transcript", "");
    }

    /**
     * Records audio for a fixed duration and transcribes it
     */
    public String recordAndTranscribe(int seconds) throws Exception {

        Path tempFile = Files.createTempFile("voice_search", ".wav");

        // ✅ Use widely supported format
        AudioFormat format = new AudioFormat(
                44100.0f, // sample rate (FIXED)
                16,       // sample size in bits
                1,        // mono
                true,     // signed
                false     // little endian
        );

        DataLine.Info info = new DataLine.Info(TargetDataLine.class, format);

        if (!AudioSystem.isLineSupported(info)) {
            throw new Exception("Microphone format not supported. Try another device.");
        }

        TargetDataLine line = (TargetDataLine) AudioSystem.getLine(info);

        try {
            line.open(format);
            line.start();

            System.out.println("🎤 Recording started...");

            // Stop recording after N seconds
            new Thread(() -> {
                try {
                    Thread.sleep(seconds * 1000L);
                } catch (InterruptedException ignored) {}
                line.stop();
                line.close();
                System.out.println("🛑 Recording stopped.");
            }).start();

            AudioInputStream ais = new AudioInputStream(line);

            // This blocks until recording stops
            AudioSystem.write(ais, AudioFileFormat.Type.WAVE, tempFile.toFile());

        } catch (LineUnavailableException e) {
            throw new Exception("Microphone unavailable: " + e.getMessage());
        }

        // Send to Deepgram
        String result = transcribeWav(tempFile);

        // Clean temp file
        Files.deleteIfExists(tempFile);

        return result;
    }
}