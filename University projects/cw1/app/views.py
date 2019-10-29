from flask import render_template, url_for, flash, redirect
from app import app, db #so routes can use @app variable, import app and db variables from __init__.py
from .forms import addTaskForm, createListForm, deleteListForm, completeTaskForm, deleteTaskForm
from .models import Task, List


# view all the lists currently available 
@app.route('/', methods=('GET', 'POST'))
@app.route('/lists', methods=('GET', 'POST'))
def viewLists():
    taskLists = List.query.all()

    return render_template('index.html',
                            title = 'view-lists',
                            taskLists = taskLists,
                            background = 'white')


# Allow the user to create a new list
@app.route('/create', methods=('GET', 'POST'))
def createList():
    form = createListForm()

    # Create a new list then redirect to view all lists with the new list included
    if form.validate_on_submit():
        newList = List(name = form.name.data, 
                        color = form.color.data,
                        icon = form.icon.data)

        db.session.add(newList)
        db.session.commit()
        flash('List created successfully!')
        return redirect(url_for('viewLists'))

    return render_template('create.html',
                            title="create-list",
                            form = form,
                            background = 'white')


# delete a list, including all the tasks within that list, 
# then redirect to list all the lists with the deleted list withdrawn
@app.route('/delete/<int:listId>', methods=('GET', 'POST'))
def deleteList(listId):
    form = deleteListForm()

    if form.validate_on_submit():
        deleteList = List.query.get_or_404(listId)
        db.session.delete(deleteList)
        db.session.commit()
        flash("List Successfully Deleted!")

    return redirect(url_for('viewLists'))


# View all the tasks in a specified list
# All form functionality of this template carried out in seperate views as to prevent the 
# form submissions from interacting with each other
@app.route('/lists/tasks/<int:listId>')
def viewTaskLists(listId):
    taskList = List.query.get_or_404(listId)
    addForm = addTaskForm()
    completeForm = completeTaskForm()
    deleteForm = deleteListForm()

    return render_template('add.html',
                        title = taskList.name,
                        taskList = taskList,
                        addForm = addForm,
                        completeForm = completeForm,
                        deleteForm = deleteForm,
                        background = taskList.color)


# complete a new task to the specified list then redirect to view the list with the completed task withdrawn
@app.route('/lists/complete/<int:listId>', methods=('GET', 'POST'))
def completeTask(listId):
    taskList = List.query.get_or_404(listId) 
    addForm = addTaskForm()
    completeForm = completeTaskForm()
    deleteForm = deleteListForm()

    if completeForm.validate_on_submit():
        task = Task.query.filter_by(id = completeForm.taskId.data).first()
        task.complete = True
        db.session.commit()
        flash("Task Successfully Completed!")
        return redirect(url_for('viewTaskLists', listId = taskList.id))

    return render_template('add.html',
                            title=taskList.name,
                            taskList = taskList,
                            addForm = addForm,
                            completeForm = completeForm,
                            deleteForm = deleteForm,
                            background = taskList.color)


# add a new task to the specified list then redirect to view the list with the new tasks
@app.route('/lists/add/<int:listId>', methods=('GET', 'POST'))
def addTask(listId):
    taskList = List.query.get_or_404(listId) 
    addForm = addTaskForm()
    completeForm = completeTaskForm()
    deleteForm = deleteListForm()

    if addForm.validate_on_submit():
        task = Task(name = addForm.name.data, 
            dueDate = addForm.dueDate.data,
            list_id = addForm.taskList.data)

        db.session.add(task)
        db.session.commit()
        flash('Task Successfully Created!')
        return redirect(url_for('viewTaskLists', listId = taskList.id))

    return render_template('add.html',
                            title=taskList.name,
                            taskList = taskList,
                            addForm = addForm,
                            completeForm = completeForm,
                            deleteForm = deleteForm,
                            background = taskList.color)


# Direct to the completed tasks for the specified list 
@app.route('/lists/completed/<int:listId>', methods=('GET', 'POST'))
def viewCompleted(listId):
    taskList = List.query.get_or_404(listId)
    form = deleteTaskForm()

    # Dete a completed task from the specified list
    if form.validate_on_submit():
        deleteTask = Task.query.filter_by(id = form.taskId.data).first() 
        db.session.delete(deleteTask)
        db.session.commit()

        flash("Task Deleted Successfully!")

        #check if there are any tasks left in the list, if none redirect off the complete page
        if db.session.query(Task).filter_by(list_id = taskList.id, complete = True).count() <= 0:
            return redirect(url_for('viewTaskLists', listId = taskList.id))

    return render_template('complete.html',
                            title = taskList.name + ' | Complete',
                            taskList = taskList,
                            form = form,
                            background = taskList.color)

    

