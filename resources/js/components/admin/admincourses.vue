<template>
<div class="admin-students">
    <div class="filter-students">
        <div class="search-section">
            <input id="search-student" type="text" placeholder="Search a student" />
        </div>
        <h1 id="filter">ADD COURSE</h1>
        <form @submit.prevent="addcourse" method="post">
            <input id="search-student" v-model="course.coursecode" type="text" placeholder="Course Code" required />
            <input id="search-student" v-model="course.coursedescription" type="text" placeholder="Course Description" required /><br />
            <button id="enroll" type="submit" data-toggle="modal" data-target="#enrollModal">
                ADD
            </button>
        </form>
    </div>
    <div class="students-table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">COURSE CODE</th>
                    <th scope="col">COURSE DESCRIPTION</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="allcourse in listcourse" :key="allcourse.id">
                    <th scope="row">{{ allcourse.coursecode }}</th>
                    <td>{{ allcourse.coursedescription }}</td>
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
            course: {
                coursecode: "",
                coursedescription: ""
            },
            listcourse: []
        };
    },
    methods: {
        addcourse() {
            this.axios
                .post(host + `/api/addcourse`, this.course)
                .then(response => this.message(response))
                .catch(error => console.log(error));
        },
        message(response) {
            if (response.data == "course added") {
                this.displaycourses();
                this.clear();
            }
        },
        displaycourses() {
            this.axios
                .get(host + `/api/displaycourses`)
                .then(response => (this.listcourse = response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
        },
        clear() {
            this.course.coursecode = "";
            this.course.coursedescription = "";
        }
    },
    created() {
        this.displaycourses();
    }
};
</script>
