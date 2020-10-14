<template>
    <div>
        <nav v-if="user == 1" class="navbar navbar-expand-md navbar-dark">
            <router-link class="navbar-brand" to="/home" href="#"
                >MCJ UNIVERSITY</router-link
            >
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/adminhome"
                            >HOME</router-link
                        >
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/adminstudents"
                            >STUDENTS</router-link
                        >
                    </li>
                    <li class="nav-item active">
                        <router-link
                            to="/adminteachers"
                            class="nav-link"
                            href="#"
                            >TEACHERS</router-link
                        >
                    </li>
                    <li class="nav-item dropdown active">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            MAINTENANCE
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdown"
                        >
                            <router-link
                                to="/admincourses"
                                class="dropdown-item"
                                href="#"
                                >Courses</router-link
                            >
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                            <a
                                class="dropdown-item"
                                href=""
                                @click.prevent="showlogout()"
                                >Logout</a
                            >
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            ADMIN
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdown"
                        >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                            <a
                                class="dropdown-item"
                                href=""
                                @click.prevent="showlogout()"
                                >Logout</a
                            >
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="body">
            <router-view></router-view>
        </div>

        <!-- Modal -->
        <form @submit.prevent="logout()" method="get">
            <div
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Are you sure you want to logout?
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                NO
                            </button>
                            <button type="submit" class="btn btn-primary">
                                YES
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { host } from "../host.js";
export default {
    data() {
        return {
            user: 0,
            id: 0,
            usertype: ""
        };
    },
    methods: {
        logout() {
            this.axios
                .post(host + `/logout`)
                .then(response => this.message(response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            location.reload();
        },
        showlogout() {
            $("#exampleModal").modal("show");
        },
        check(data) {
            if (data.user == "admin") {
                this.user = 1;
            } else {
                this.$router.push({
                    name: "login"
                });
            }
        },
        home() {
            if (window.location.href == host + "/") {
                this.$router.push({
                    name: "home",
                    params: {
                        id: this.id
                    }
                });
            }
        },

        getusertype() {
            console.log(this.session);
        }
    },
    created() {
        this.home();
        this.axios
            .get(host + `/checksession`)
            .then(response => {
                this.check(response.data);
            })
            .catch(error => console.log(error))
            .finally(() => (this.loading = false));
    }
};
</script>
