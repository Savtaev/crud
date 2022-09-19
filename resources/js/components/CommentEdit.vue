<template>
    <modal>
        <h2>Изменить коментарий</h2>
        <form action="" @submit.prevent = editComment()>
            <input type="text" v-model="edit_comment.content" placeholder="Контент">
            <input type="file" name="image" id="" @change="changeFile($event, edit_comment)">
            <img ref='image' alt="" style="width: 100%;">
            <button type="submit">Отправить</button>
        </form>
    </modal>
</template>

<script>
import axios from "axios";
import modal from "./modal.vue";

export default {
    name: "CommentEdit",
    components:{
        modal
    },
    data(){
        return{
        }
    },
    methods:{
        async editComment(){
            console.log(5555)
            console.log(this.edit_comment)
            await axios.post('/api/comment/edit/' + this.edit_comment.id, this.edit_comment)
                .then(res => {
                    this.$router.go(0);
                })
                .catch(e => console.log(e))
        },

        changeFile(event, post){
            this.$store.dispatch('onChangeFile', {event, post})
        },
    },
    computed:{
        edit_comment(){
            return this.$store.getters['edit_comment'];
        },
    }
}
</script>

<style scoped>

</style>
