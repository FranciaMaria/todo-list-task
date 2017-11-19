<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="initAddTask()" class="btn btn-primary btn-xs pull-right">
                            + Add New Task
                        </button>
                        My Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="tasks.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Description
                                </th>
                                  <th>
                                    Priority
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(task, index) in tasks" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    {{ task.name }}
                                </td>
                                <td>
                                    {{ task.description }}
                                </td>
                                <td>
                                    {{ task.priority }}
                                </td>
                                <td v-if="task.completed != true">
                                    <button @click="completeTask(task)" class="btn btn-warning btn-xs">Complete</button>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteTask(task)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                                <td v-if="task.completed != false">
                                    <!-- <button @click="completed(task)" class="btn btn-warning btn-xs">Uncompleted</button> -->
                                    <button @click="completedTask(task)" class="btn btn-warning btn-xs">Completed</button>
                                    <!-- <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button> -->
                                    <button @click="deleteTask(task)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Task</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Task Name" class="form-control"
                                   v-model="task.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="task.description"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <label for="priority">Priority:</label>
                            <input type="text" name="priority" id="priority" placeholder="Task Priority: Very important, Important, Less Imporatnt, Unimportant" class="form-control"
                                   v-model="task.priority"> -->
                            <input type="radio" id="very important" value="very important" v-model="task.priority">
                            <label for="very important">Very Important</label>
                            <br>
                            <input type="radio" id="important" value="important" v-model="task.priority">
                            <label for="important">Important</label>
                            <br>
                            <input type="radio" id="less important" value="less important" v-model="task.priority">
                            <label for="less important">Less Important</label>
                            <br>
                            <span>Priority: {{ task.priority }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Task</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" placeholder="Task Name" class="form-control"
                                   v-model="update_task.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="update_task.description"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <label for="priority">Priority:</label>
                            <input type="text" name="priority" id="priority" placeholder="Task Priority: Very important, Important, Less Imporatnt, Unimportant" class="form-control"
                                   v-model="update_task.priority"> -->
                            <input type="radio" id="very important" value="very important" v-model="update_task.priority">
                            <label for="very important">Very Important</label>
                            <br>
                            <input type="radio" id="important" value="important" v-model="update_task.priority">
                            <label for="important">Important</label>
                            <br>
                            <input type="radio" id="less important" value="less important" v-model="update_task.priority">
                            <label for="less important">Less Important</label>
                            <br>
                            <span>Priority: {{ update_task.priority }}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
    export default {
        data(){
            return {
                task: {
                    name: '',
                    description: '',
                    priority: '',
                    completed : false
                },
                errors: [],
                tasks: [],
                update_task: {}
            }
        },
        mounted()
        {
            this.readTasks();
        },
        methods: {
            initAddTask()
            {
                $("#add_task_model").modal("show");
            },
            createTask()
            {
                axios.post('/task', {
                    name: this.task.name,
                    description: this.task.description,
                    priority: this.task.priority,
                })
                    .then(response => {

                        this.reset();

                        this.tasks.push(response.data.task);

                        $("#add_task_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }

                        if (error.response.data.errors.priority) {
                            this.errors.push(error.response.data.errors.priority[0]);
                        }
                    });

                    window.location.href = "http://localhost:8000/home";
            },
            reset()
            {
                this.task.name = '';
                this.task.description = '';
                this.task.priority = '';
            },
            readTasks()
            {
                axios.get('/task')
                    .then(response => {

                        this.tasks = response.data.tasks;

                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_task_model").modal("show");
                this.update_task = this.tasks[index];
            },
            updateTask()
            {
                axios.patch('/task/' + this.update_task.id, {
                    name: this.update_task.name,
                    description: this.update_task.description,
                    priority: this.update_task.priority,
                })
                    .then(response => {

                        $("#update_task_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }

                        if (error.response.data.errors.priority) {
                            this.errors.push(error.response.data.errors.priority[0]);
                        }
                    });
            },

            completeTask(task) {

                let conf = confirm("Completed?");
                if (conf === true) {

                    axios.put('/task/complete/' + task.id)
                        .then(response => {

                            this.task.completed = true;

                        })
                        .catch(error => {

                        });

                    window.location.href = "http://localhost:8000/home";

                }
            
            },

            completedTask(task) {

                let conf = confirm("Uncompleted this task?");
                if (conf === true) {

                    axios.put('/task/completed/' + task.id)
                        .then(response => {

                            //task.completed = ! task.completed;
                            this.task.completed = false;

                        })
                        .catch(error => {

                        });

                    window.location.href = "http://localhost:8000/home";

                }
            
            },

            deleteTask(task)
            {
                let conf = confirm("Do you really want to delete this task?");
                if (conf === true) {

                    axios.delete('/task/' + task.id)
                        .then(response => {

                            this.tasks.splice(task.id, 1);

                        })
                        .catch(error => {

                        });

                    window.location.href = "http://localhost:8000/home";

                }
            }
        }
    }
</script>