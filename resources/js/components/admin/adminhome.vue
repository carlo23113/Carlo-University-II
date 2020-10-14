<template>
<div class="home">
    <div class="news-feed">
        <div class="nf-body">
            <h1>NEWS FEED</h1>
            <div class="post-section">
                <form @submit.prevent="postnewsfeed" method="POST">
                    <input type="text" id="inputpost" v-model="newsfeed.post" placeholder="What's on your mind? Jan?" /><br />
                    <button type="submit" id="post-btn">POST</button>
                    <button id="upload-btn">UPLOAD</button>
                </form>
            </div>
            <div class="viewposts-section">
                <div class="post" v-for="newsfeed in displaynews" :key="newsfeed.id">
                    <div class="displaypost">
                        <img src="/images/profile pic.jpg" alt="" />
                        <span id="name">Jan Carlo Espiritu -</span>
                        <span id="usertype">Student</span>
                        <span id="time">10m ago</span>
                        <p>{{ newsfeed.post }}</p>
                    </div>

                    <div class="button">
                        <a href="" @click.prevent="deletenewsfeed(newsfeed.id)"><svg width="30px" height="30px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="white" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                            </svg></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="general-announcement">
        <div class="ga">
            <h1>GENERAL ANNOUNCEMENT</h1>
            <div class="ga-body">
                <div class="announcement-section">
                    <div class="announce">
                        <form @submit.prevent="postannouncement()" method="post" enctype="multipart/form-data">
                            <input type="text" v-model="announce.announcement" required id="inputannouncement" placeholder="Post your announcement..." />
                            <button type="submit" id="post-btn">
                                POST
                            </button>

                            <button type="submit" id="upload-btn">
                                UPLOAD
                            </button>
                            <input id="upload" @change="imageSelected" type="file" />
                        </form>
                    </div>
                </div>
                <div class="viewannouncement-section">
                    <fieldset>
                        <div v-for="announcement in displayannouncement" :key="announcement.id" class="announcement">
                            <p id="announcement">
                                {{ announcement.announcement }}
                            </p>
                            <img style="max-width:100%;margin: auto" :src="announcement.image" />
                            <div class="ab">
                                <button id="edit-btn">EDIT</button>
                                <button @click.prevent="
                                            deletepost(announcement.id)
                                        " id="delete-btn">
                                    DELETE
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Modal title
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form @submit.prevent="postannouncement()" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel">
                            Create Announcement
                        </h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" v-model="announce.announcement" id="inputannouncement" placeholder="Post your announcement..." />
                        <div v-if="imagepreview">
                            <img :src="imagepreview" class="figure-img img-fluid rounded" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" type="submit">
                            POST
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
            announce: {
                announcement: ""
            },
            displayannouncement: [],
            displaynews: [],
            id: "",
            id1: "",
            image: null,
            imagepreview: null,
            thumbnail: "",
            newsfeed: {
                post: ""
            },
            posts: []
        };
    },
    methods: {
        postannouncement() {
            let data = new FormData();
            data.append("image", this.image);
            data.append("text", this.announce.announcement);
            this.axios
                .post(host + `/api/postannouncement/`, data)
                .then(response => this.message(response))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            this.displayannounce();
            $("#exampleModal1").modal("hide");
            this.displayannounce();
        },
        message(response) {
            if (
                response.data == "Success" ||
                response.data == "newsfeed post"
            ) {
                console.log("post");
                this.clear();
            } else if (response == "Announcement deleted") {
                this.displayannounce();
            } else if (response == "newsfeed deleted") {
                this.displaynewsfeed();
            }
        },

        displayannounce() {
            this.axios
                .get(host + `/api/displayannouncements`)
                .then(response => (this.displayannouncement = response.data));
        },
        deletepost(id) {
            this.id = parseInt(id);
            console.log(this.id);
            this.axios
                .post(host + `/api/deletepost/${this.id}`)
                .then(reponse => this.message(response))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            this.displayannounce();
        },
        clear() {
            this.announce.announcement = "";
            this.newsfeed.post = "";
        },
        imageSelected(e) {
            this.image = e.target.files[0];

            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.imagepreview = e.target.result;
            };
            $("#exampleModal1").modal("show");
        },
        postnewsfeed() {
            this.axios
                .post(host + `/api/postnewsfeed`, this.newsfeed)
                .then(response => this.message(response))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            this.displaynewsfeed();
        },
        displaynewsfeed() {
            this.axios
                .get(host + `/api/displaynewsfeed`)
                .then(response => (this.displaynews = response.data));
        },
        deletenewsfeed(id) {
            this.id = id;

            this.axios
                .get(host + `/api/deletenewsfeed/${this.id}`)
                .then(response => this.message(response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
            this.displaynewsfeed();
        }
    },
    mounted() {
        this.displayannounce();
        this.displaynewsfeed();
    }
};
</script>
