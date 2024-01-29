<template>
    <div>
        <h1>Student List</h1>
        <table class="table table-hover">
            <thead>
                <th>Student Name</th>
                <th>Course</th>
                <th>Address</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <tr v-for="(item, index) in studentList" :key="item.id">
                    <td>{{ item.student_name }}</td>
                    <td>{{ item.course }}</td>
                    <td>{{ item.address }}</td>
                    <td>
                        <button class="btn btn-sm" @click="edit(item)"><i class="fa-regular fa-pen"></i></button>
                        <button class="btn btn-sm" @click="remove(item, index)"><i class="fa-regular fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Student Name" v-model="form.student_name">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Course" v-model="form.course">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Input Address" v-model="form.address">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button class="btn btn-sm" @click="submit"><i class="fa-regular fa-plus"></i></button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Student Name</label>
                        <input type="text" class="form-control" placeholder="Input Student Name" v-model="formEdit.student_name">
                    </div>
                    <div class="form-group">
                        <label for="">Course</label>
                        <input type="text" class="form-control" placeholder="Input Course" v-model="formEdit.course">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder="Input Address" v-model="formEdit.address">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save()">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['student'],
    data() {
        return {
            studentList: this.student,
            form: {
                student_name: null,
                course: null,
                address: null
            },
            formEdit: {
                student_name: null,
                course: null,
                address: null
            },
            selectedId: null
        }
    },
    methods: {
        submit() {
            const vm = this;
            axios.post('/students', this.form)
            .then(function(response) {
                vm.studentList.push(response.data.data);
                vm.student_name = null
                vm.course = null
                vm.address = null
            })
            .catch(function(error) {
                console.log(error)
            });
        },
        remove(item, index) {
            const vm = this;
            axios.delete(`/students/${item.id}`)
            .then(function(response) {
                vm.studentList.splice(index,1);
            })
            .catch(function(error) {
                console.log(error)
            });
        },
        edit(item) {
            const vm = this;
            $("#exampleModal").modal('show');
            vm.formEdit.student_name = item.student_name;
            vm.formEdit.course = item.course;
            vm.formEdit.address = item.address;
            this.selectedId = item.id
        },
        save() {
            const vm = this;
            axios.put(`/students/${vm.selectedId}`, this.formEdit)
            .then(function(response) {
                alert('Student has been successfully updated')
                location.reload();
            })
            .catch(function(error) {
                console.log(error)
            });
        }
    }
}
</script>
