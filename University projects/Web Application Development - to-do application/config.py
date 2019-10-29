import os

WTF_CSRF_ENABLED = True
SECRET_KEY = '599e2d63d8d676f5bf4eb35577bf7fc3'

#set the location of the database
basedir = os.path.abspath(os.path.dirname(__file__))
SQLALCHEMY_DATABASE_URI = 'sqlite:///' + os.path.join(basedir, 'app.db')
SQLALCHEMY_TRACK_MODIFICATIONS = True