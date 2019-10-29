from flask_wtf import FlaskForm  
from flask_wtf.file import FileField, FileAllowed
from wtforms import IntegerField, StringField, DateField, SubmitField, PasswordField, BooleanField, SelectField, HiddenField
from wtforms.validators import DataRequired, Length, Email, EqualTo, Optional

#Add a new task to a list
class addTaskForm(FlaskForm):
    name = StringField('name', validators=[DataRequired(), 
                                                Length(min=1, max=50)],
                                                render_kw={"placeholder": "Task Name"})
    dueDate = DateField('Set a Date (optional)', format='%d/%m/%Y',
                                    validators=[Optional()], 
                                    render_kw={"placeholder": "dd/mm/yyyy"})
    taskList = HiddenField('list')
    submit = SubmitField('Add')

# #create a new list
class createListForm(FlaskForm):
    name = StringField('name', validators=[DataRequired(),
                                            Length(min=1, max=20)],
                                            render_kw={"placeholder": "New List"})

    colors = ['red', 'green', 'purple', 'blue', 'yellow', 'orange']
    color = HiddenField('color', validators=[DataRequired()])

    icons = ['star-black', 'sun-black', 'calender-black', 'tick-black', 'important-black', 'writing-black']
    icon = HiddenField('icon', validators=[DataRequired()])

    submit = SubmitField('Create List')

class deleteListForm(FlaskForm):
    submit = SubmitField('')

class completeTaskForm(FlaskForm):
    taskId = HiddenField('id', validators=[DataRequired()])
    submit = SubmitField('')

class deleteTaskForm(FlaskForm):
    taskId = HiddenField('id', validators=[DataRequired()])
    submit = SubmitField('')

    


