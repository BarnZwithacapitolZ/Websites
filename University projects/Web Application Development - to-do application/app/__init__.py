from flask import Flask
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_object('config')
db = SQLAlchemy(app)

#have to be at bottom since theyre importing the app variable, which is created above
from app import views, models
