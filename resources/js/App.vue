<template>
    <Header @createPost="postCreate = true"></Header>
    <main>
        <router-view />
        <CreatePost v-if="postCreate" :class="{active: postCreate}"></CreatePost>
    </main>
    <div id="notice" :class="[notice ? 'show' : 'hide']">
        {{ this.notice }}
    </div>

    <div v-if="isHome" class="posts-wrap">
        <div v-for="(post, k) in posts" class="post" ref="comments">
            <post :post="post"></post>
            <div>
                <div class="comments">
                    <h5>Коментарии</h5>
                    <div v-for="comment in post.comments" class="comment">
                        <div class="flex">
                            <h6>
                                {{comment.author.login}}
                                <span>{{ comment.created_at }}</span>
                            </h6>
                            <div v-if="comment.author_id == this.$store.getters.user.id">
                                <button @click="editComment(comment)">Изменить</button>
                                <button class="red" @click="deleteComment(comment.id)">Удалить</button>
                            </div>
                        </div>
                        <p>{{comment.content}}</p>
                        <img :src="comment.image" alt="">
                    </div>
                </div>
                <h5>Написать коментарий</h5>
                <form action="" @submit.prevent="createComment(post)">
                    <input type="text" name="" id="" v-model="post.comment">
                    <input type="file" name="image" id="" @change="changeFile($event, post)">
                    <button type="button" class="btn" @click="removeImage(k)" >Удалить изображение</button>
                    <button type="submit">Отправить</button>
                </form>
                ID поста: {{ post.id }}
            </div>
        </div>
    </div>
    <div v-if="postEdit" class="modal">
        <PostEdit></PostEdit>
    </div>
    <div v-if="commentEdit" class="modal">
        <CommentEdit></CommentEdit>
    </div>
</template>

<script>
import PostEdit from "./components/PostEdit.vue";
import CommentEdit from "./components/CommentEdit.vue";
import CreatePost from "./components/CreatePost.vue";
import Header from "./components/Header.vue";
import post from "./components/Post.vue";
import axios from "axios";
export default {
    data(){
        return{
            posts: [],
            postEdit: false,
            commentEdit: false,
            postCreate: false,
        }
    },

    methods:{
        editComment(comment){
            this.commentEdit = true
            this.$store.commit('setEdit_comment', comment)
        },
        async deleteComment(id){
            await axios.get('/api/comment/delete/' + id).then(res => {
                this.$router.go(0);
            })
        },
        changeFile(event, post){
            this.$store.dispatch('onChangeFile', {event, post})
        },
        async getPost(){
            await axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data
                }).catch(e => console.log(e))
        },
        async createComment(post){
            await axios.post('/api/comment/create', {
                post_id: post.id,
                comment: post.comment,
                image: post.newCommentIimage ?? null
            })
                .then(res => {
                    this.$router.go(0);
                }).catch(e => console.log(e))
        },
        removeImage: function (id) {
            this.$refs.comments[id].lastElementChild.lastElementChild.childNodes[1].value = ''
        }
    },
    computed:{
        notice(){
          return this.$store.getters.notice
        },
        user() {
            return this.$store.getters.user;
        },
        isHome(){
            return !this.$route.path.match(/register|login|post/g)
        }

    },
    components:{
        Header,
        PostEdit,
        CommentEdit,
        CreatePost,
        post
    },
    created() {
        this.getPost()
        //if (!this.$store.getters.id) this.$router.push({name: 'register'})
    },
    name: "App"
}
</script>

<style scoped>

</style>
