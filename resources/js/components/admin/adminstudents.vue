<template>
<div class="admin-students">
    <div class="filter-students">
        <form @submit.prevent="search" method="post">
            <div class="search-section">
                <div class="search">
                    <input v-model="inputsearch" id="search-student" type="text" placeholder="Enter firstname" />
                    <button id="search-btn">
                        SEARCH
                    </button>
                </div>
            </div>
        </form>
        <h1 id="filter" style="margin-bottom: 20px;color: black">FILTER</h1>
        <form @submit.prevent="filterstudents" method="post">
            <label for="">Year Level</label><br />
            <select name="" v-model="filter.year" id="year-level" required>
                <option value="1st year">1st year</option>
                <option value="2nd year">2nd year</option>
                <option value="3rd year">3rd year</option>
                <option value="4th year">4th year</option>
            </select><br />
            <label for="">Course</label><br />
            <select name="" id="year-level" v-model="filter.course" required>
                <option v-for="courses in listcourse" :key="courses.id">{{
                        courses.coursecode
                    }}</option>
            </select>
            <button id="enroll" type="submit">
                SUBMIT
            </button>
        </form>
        <button id="enroll" @click.prevent="displaystudents">
            RESET</button><br />
        <button id="enroll" data-toggle="modal" data-target="#enrollModal">
            ENROLL NEW STUDENT
        </button>
    </div>
    <div class="students-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STUDENT ID</th>
                    <th scope="col">FULLNAME</th>
                    <th scope="col">YEAR LVL</th>
                    <th scope="col">COURSE</th>
                    <th scope="col">SECTION</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student in students" :key="student.student_id">
                    <th scope="row">{{ student.student_id }}</th>
                    <td>
                        {{ student.firstname }} {{ student.middlename }}
                        {{ student.lastname }}
                    </td>
                    <td>{{ student.year }}</td>
                    <td>{{ student.course }}</td>
                    <td>{{ student.section }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <form @submit.prevent="enrollstudent">
        <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Enroll a student
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Enter Firstname</label>
                        <input type="text" v-model="studentinfo.firstname" placeholder="Firstname" /><br />
                        <label for="">Enter Middlename</label>
                        <input type="text" v-model="studentinfo.middlename" placeholder="Middlename" /><br />
                        <label for="">Enter Lastname</label>
                        <input type="text" v-model="studentinfo.lastname" placeholder="Lastname" /><br />
                        <label for="">Year level</label>
                        <select name="" id="" v-model="studentinfo.year">
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select><br />
                        <label for="">Enter Course</label>
                        <select name="" id="year-level" v-model="studentinfo.course" required>
                            <option v-for="courses in listcourse" :key="courses.id">{{ courses.coursecode }}</option>
                        </select><br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</template>

<script>
import {
    host
} from "../../host.js";
export default {
    data() {
        return {
            studentinfo: {
                student_id: "",
                firstname: "",
                middlename: "",
                lastname: "",
                year: "",
                course: ""
            },
            students: [],
            filter: {
                year: "",
                course: "",
                section: ""
            },
            inputsearch: "",
            listcourse: []
        };
    },
    methods: {
        enrollstudent() {
            this.axios
                .post(host + `/api/enrollstudent`, this.studentinfo)
                .then(response => this.message(response))
                .catch(error => console.log(error))
                .finally(() => this.displaystudents());
        },
        message(response) {
            if (response.data == "student enrolled") {
                this.clear();
                $("#enrollModal").modal("hide");
            }
        },
        displaystudents() {
            this.axios
                .get(host + `/api/displaystudents`)
                .then(response => (this.students = response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            this.clear();
        },
        clear() {
            this.studentinfo.firstname = "";
            this.studentinfo.middlename = "";
            this.studentinfo.lastname = "";
            this.studentinfo.year = "";
            this.studentinfo.course = "";
            this.inputsearch = "";
            this.filter.course = null;
            this.filter.year = null;
        },
        filterstudents() {
            this.axios
                .post(host + `/api/filterstudents`, this.filter)
                .then(response => (this.students = response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
        },
        search() {
            this.axios
                .post(host + `/api/searchstudent/search?q=` + this.inputsearch)
                .then(response => (this.students = response.data))
                .catch(error => console.log(error));
            this.clear();
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
        this.displaystudents();
        this.displaycourses();
    }
};
</script>
