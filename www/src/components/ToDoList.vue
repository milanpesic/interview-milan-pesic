<template>
    <div style="margin-top: 100px">
        <div class="row section" style="width: 60%">
            <table class="centered z-depth-5" v-if="load === false ">
                <thead>
                <tr>
                    <th>
                        <i class="material-icons medium green-text">edit</i>
                    </th>
                    
                    <th>
                        <div class="input-field">
                            <input placeholder="Add your todo" type="text" v-model="task" id="task" class="mediumSize">
                        </div>
                    </th>

                    <th>
                        <button class="btn btn-large green mediumSize" style="font-weight: bold" v-if="loading === false" :disabled="disabled" type="button" name="action" @click="toDoCreate">ADD
                            <i class="medium material-icons right">add</i>
                        </button>
                        <button class="btn btn-large green mediumSize pulse" style="font-weight: bold" v-else>ADD
                            <i class="medium material-icons right">add</i>
                        </button>
                    </th>

                </tr>
                </thead>
                <tbody v-for="showToDoTask in showToDoTasks" :key="showToDoTask.id">
                    <tr>
                        <td v-if="showToDoTask.checked">
                            <div><i class="medium material-icons green-text pointer" @click="toDoChecked(showToDoTask)">check_box</i></div>
                        </td>

                        <td v-if="showToDoTask.checked">
                            <div v-if="edit === false || edit != showToDoTask.id"><del class="mediumSize green-text"><b>{{ showToDoTask.task }}</b></del></div>
                            <div><input style="font-weight: bold" type="text" v-if="edit == showToDoTask.id" v-model="showToDoTask.task" class="mediumSize"></div>
                        </td>
                    
                        <td v-if="!showToDoTask.checked">
                            <div><i class="medium material-icons red-text pointer" @click="toDoChecked(showToDoTask)">check_box_outline_blank</i></div>
                        </td>

                        <td v-if="!showToDoTask.checked">
                            <div v-if="edit === false || edit != showToDoTask.id"><b class="mediumSize red-text" style="font-style: italic">{{ showToDoTask.task }}</b></div>
                            <div><input style="font-weight: bold" type="text" v-if="edit == showToDoTask.id" v-model="showToDoTask.task" class="mediumSize"></div>
                        </td>
                    
                        <td>
                            <b @click="edit = showToDoTask.id" v-if="edit != showToDoTask.id"><i class="material-icons medium blue-text pointer">edit</i></b>
                            <b @click="toDoUpdate(showToDoTask)" v-if="edit == showToDoTask.id"><i class="material-icons medium green-text pointer">edit</i></b>
                            <b><i class="material-icons medium red-text pointer" v-if="deleting != showToDoTask.id" @click="toDoDelete(showToDoTask.id)">delete</i></b>
                            <b v-if="deleting === showToDoTask.id"> 
                                <i class="material-icons medium pointer">delete</i>     
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </b>

                        </td>
                        
                    </tr>
                   
                </tbody>

                <tbody v-if="updating === true">
                    <tr>
                        <td colspan="3" style="align: center">
                            <div class="loader"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        <div class="loader" style="width: 200px; height: 200px;" v-if="load === true"></div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    data() {
        return {
            loading: false,
            load: false,
            deleting: null,
            updating: false,
            crudLoading: false,
            edit: false,
            checked: false,
            disabled: true,
            showToDoTasks: [],
            task: '',
            data: null,
            url: 'http://localhost:8080/api/todo/'
        }
    },
    methods: {
        toDoShow() {
            this.load = true,
            axios.get(this.url + 'show')
                .then(response => (this.showToDoTasks = response.data)) 
                .catch(error => (console.log(error)))
                .finally(() => {
                   this.load = false
                });
        },
        toDoCreate() {
            this.loading = true,
            this.updating = true,
            axios.post(this.url +  'create', { task: this.task, checked: 0 })
                .then(response => {
                  return (this.showToDoTasks=response.data, this.task='', this.disabled=true);
                }) 
                .catch(error => (console.log(error.response.data)))
                .finally(() => {
                    this.loading = false,
                    this.updating = false
                });
        },
        toDoUpdate(val) {
            this.edit = false,
            axios.post(this.url + 'update/' + val.id, { task: val.task }).then(() => {}).catch(error => (console.log(error)));
        },
        toDoChecked(val) {
            val.checked = !val.checked
            if(val.checked === true) {
                this.data = {
                    checked: 1
                }
            } else {
                this.data = {
                    checked: 0
                }
            }
            axios.post(this.url + 'checked/' + val.id, this.data).then(() => {}).catch(error => (console.log(error)));
        },
        toDoDelete(id) {
            this.deleting = id,
            axios.post(this.url + 'delete/' + id)
                .then(response => {
                    return (this.showToDoTasks = response.data)
                })
                .catch(error => (console.log(error)))
                .finally(() => {
                    this.deleting != id
                });
        }
    },
    watch: {
        task() {
            return this.task ? this.disabled = false : this.disabled = true;
        }
    },
    mounted() {
        this.toDoShow();
    }
}
</script>


<style>
.pointer {
  cursor: pointer;
}

.mediumSize {
    font-size: 30px !important;
}

.border {
    border-style: solid;
    padding: 15px;
}

.loader {
  border: 26px solid #f3f3f3;
  border-radius: 50%;
  border-top: 26px solid green;
  width: 90px;
  height: 90px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 1s linear infinite;
  margin: auto;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>