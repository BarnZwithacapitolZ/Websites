from app import db #import db variable from __init__.py
from datetime import datetime

class Task(db.Model):
    id = db.Column(db.Integer, primary_key = True)
    name = db.Column(db.String(30), nullable = False)
    dueDate = db.Column(db.DateTime)
    complete = db.Column(db.Boolean, default = False, nullable = False)
    list_id = db.Column(db.Integer, db.ForeignKey('list.id'), nullable = False) #referencing table name which is a lower case

    def __repr__(self):
        return f"Task('{self.name}', '{self.dueDate}')"

class List(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(20), nullable = False)
    color = db.Column(db.String(20))
    icon = db.Column(db.String(20), default = 'star')
    tasks = db.relationship('Task', cascade="all, delete-orphan", backref = 'list', lazy = True)
    #add icon column

    def __repr__(self):
        return f"List('{self.name}', '{self.color}', '{self.tasks}')"