<template>
<div class="admin-students">
    <div class="filter-students">
        <div class="search-section">
            <input id="search-student" type="text" placeholder="Search a student" />
        </div>
        <h1 id="filter">ADD A TEACHER</h1>
        <form @submit.prevent="addteacher" method="post">
            <input id="search-student" type="text" v-model="teacherinfo.firstname" placeholder="Firstname" />
            <input id="search-student" type="text" v-model="teacherinfo.middlename" placeholder="Middlename" />
            <input id="search-student" type="text" v-model="teacherinfo.lastname" placeholder="Lastname" />
            <select name="" id="year-level" v-model="teacherinfo.department" required>
                <option v-for="courses in listcourse" :key="courses.id">{{
                        courses.coursecode
                    }}</option>
            </select><br />
            <br />
            <button id="enroll" type="submit">
                ADD
            </button>
        </form>
    </div>
    <div class="students-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">TEACHER ID</th>
                    <th scope="col">FULLNAME</th>
                    <th scope="col">DEPARTMENT</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="teacher in teachers" :key="teacher.teacher_id">
                    <th scope="row">{{ teacher.teacher_id }}</th>
                    <td>
                        {{ teacher.firstname }} {{ teacher.middlename }}
                        {{ teacher.lastname }}
                    </td>
                    <td>{{ teacher.department }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import {
    host
} from "../../host.js";
export default {
    data() {
        return {
            teacherinfo: {
                firstname: "",
                middlename: "",
                lastname: "",
                department: ""
            },
            teachers: [],
            listcourse: []
        };
    },
    methods: {
        addteacher() {
            this.axios
                .post(host + `/api/addteachers`, this.teacherinfo)
                .then(response => this.message(response))
                .catch(error => console.log(error))
                .finally(() => this.displayteachers());
        },
        message(response) {
            if (response.data == "teacher saved'") {
                this.clear();
                this.displayteachers();
            }
        },
        displayteachers() {
            this.axios
                .get(host + `/api/displayteachers`)
                .then(response => (this.teachers = response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
        },
        clear() {
            this.teacherinfo.firstname = "";
            this.teacherinfo.middlename = "";
            this.teacherinfo.lastname = "";
            this.teacherinfo.department = "";
        },
        displaycourses() {
            this.axios
                .get(host + `/api/displaycourses`)
                .then(response => (this.listcourse = response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
        }
    },
    mounted() {
        this.displayteachers();
        this.displaycourses();
    }
};
</script>
