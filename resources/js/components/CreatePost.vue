<template>
    <modal>
        <template v-if="$store.getters.user">
            <h3>Создать пост</h3>
            <form action="" @submit.prevent="createPost">
                <input type="text" placeholder="Заголовок" v-model="post.title">
                <textarea name="" id="" cols="30" rows="10" placeholder="Текст поста" v-model="post.content"></textarea>
                <input type="file" ref="inp_create_post" name="image" id="" @change="changeFile($event, this.post)">
                <button type="button" @click="removeImage('inp_create_post')" >Удалить изображение</button>
                <button type="submit">Создать</button>
            </form>
        </template>
    </modal>
</template>
<script>
import axios from "axios";
import modal from "./modal.vue";

export default {
    name: "CreatePost",
    components:{
        modal
    },
    data(){
      return{
          post: {
              title: '',
              content: '',
              image: '',
          },
      }
    },
    methods:{
        async createPost(){
            await axios.post('/api/post/create', this.post)
                .then(res => {
                    this.$router.go(0);
                }).catch(e => console.log(e))
        },
        changeFile(event, post){
            this.$store.dispatch('onChangeFile', {event, post})
        },
        removeImage: function (id, is_array) {
            this.post.image = ''
            this.$refs[id].value = ''
        }
    }
}
</script>

<style scoped>

</style>
