<template>
    <div class="flex">
        <h4>{{ post.title }}</h4>
        <div v-if="post.author_id == this.$store.getters.id">
            <div>
                <button @click="editPost(post)">Изменить</button>
            </div>
            <button class="red" @click="deletePost(post.id)">Удалить</button>
        </div>
    </div>
    <p>{{ post.content }}</p>
    <img :src="post.image" alt="">
    <span>Автор поста: {{ post.author.login }}</span>
</template>

<script>
import axios from "axios";

export default {
    name: "Post",
    props:{
        post: {}
    },
    methods:{
        editPost(post){
            this.postEdit = true
            this.$store.commit('setEdit_post', post)
        },
        async deletePost(id){
            await axios.get('/api/post/delete/' + id).then(res => {
                this.$router.go(0);
            })
        },
    }
}
</script>

<style scoped>

</style>
