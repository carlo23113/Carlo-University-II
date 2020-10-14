<template>
<div class="w-25">
    <button>hry</button>
    <form @submit.prevent="saveData">
        <div class="input-group mb-3 w-100">
            <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control form-control-lg" aria-label="Recipient's username" aria-describedby="button-addon2" @keydown="form.errors.clear('title')" />
            <div class=",mmmmmmkinput-group-append">
                <button class="btn btn-success btn-lg" type="submit" id="button-addon2">
                    Addasd
                </button>
            </div>
        </div>
        <span class="text-danger pt-3 " style="font-size:15pt" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
    </form>

    <div class="w-25">
        <div v-for="todo in todos" :key="todo.id" class="w-100">
            {{ todo.title }}
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            todos: "",
            form: new Form({
                title: ""
            })
        };
    },

    methods: {
        getTodos() {
            axios
                .get("/api/todo")
                .then(res => {
                    this.todos = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        saveData() {
            let data = new FormData();
            data.append("title", this.form.title);
            axios
                .post("/api/todo", data)
                .then(res => {
                    this.form.reset();
                    this.getTodos();
                })
                .catch(error => {
                    this.form.errors.record(error.response.data.errors);
                });
        }
    },

    mounted() {
        this.getTodos();
    }
};
</script>
