import login from "./components/login.vue";
import adminhome from "./components/admin/adminhome.vue";
import home from "./components/home.vue";
import adminstudents from "./components/admin/adminstudents";
import admincourses from "./components/admin/admincourses";
import adminteachers from "./components/admin/adminteachers";

export const routes = [
    {
        name: "login",
        path: "/login",
        component: login
    },
    {
        name: "adminhome",
        path: "/adminhome",
        component: adminhome
    },
    {
        name: "home",
        path: "/home",
        component: home
    },
    {
        name: "adminstudents",
        path: "/adminstudents",
        component: adminstudents
    },
    {
        name: "admincourses",
        path: "/admincourses",
        component: admincourses
    },
    {
        name: "adminteachers",
        path: "/adminteachers",
        component: adminteachers
    }
];
