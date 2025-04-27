from flask import Flask, jsonify
from flask_cors import CORS
import speech_recognition as sr
import pyttsx3

app = Flask(__name__)
CORS(app)  # Ye CORS allow karega browser ke requests

@app.route('/listen', methods=['GET'])
def listen():
    recognizer = sr.Recognizer()
    with sr.Microphone() as source:
        print("Listening...")
        recognizer.adjust_for_ambient_noise(source)
        audio = recognizer.listen(source)

        try:
            print("Recognizing...")
            text = recognizer.recognize_google(audio)
            print(f"You said: {text}")
            speak(f"You said {text}")
            return jsonify({'text': text})
        except sr.UnknownValueError:
            return jsonify({'text': "Sorry, I did not understand."})

def speak(text):
    engine = pyttsx3.init()
    voices = engine.getProperty('voices')
    engine.setProperty('voice', voices[0].id)
    engine.setProperty('rate', 150)
    engine.say(text)
    engine.runAndWait()

if __name__ == "__main__":
    app.run(debug=True)
