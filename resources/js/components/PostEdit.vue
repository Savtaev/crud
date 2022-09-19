<template>
    <modal>
        <h2>Редактирование поста</h2>
        <form action="" @submit.prevent = editPost()>
            <input type="text" v-model="edit_post.title" placeholder="Заголовок поста">
            <input type="text" v-model="edit_post.content" placeholder="Контент">
            <input type="file" name="image" id="" @change="changeFile($event, edit_post)">
            <img ref='image' alt="" style="width: 100%;">
            <button type="submit">Отправить</button>
        </form>
    </modal>
</template>

<script>
import axios from "axios";
import modal from "./modal.vue";
export default {
    name: "PostEdit",
    components:{
        modal
    },
    data(){
      return{
      }
    },
    methods:{
        async editPost(){
            await axios.post('/api/post/edit/' + this.edit_post.id, this.edit_post)
                .then(res => {
                    this.$router.go(0);
                })
                .catch()
        },

        changeFile(event, post){
            this.$store.dispatch('onChangeFile', {event, post})
        },
    },
    computed:{
        edit_post(){
            return this.$store.getters['edit_post'];
        },
    }
}
</script>

<style scoped>

</style>
