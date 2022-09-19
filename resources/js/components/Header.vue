<template>
    <header>
        <div v-if="user">
            <button class="btn" href="#" @click.prevent="logout">Выйти</button>
            <div>{{ user.login }}</div>
            <button class="green btn" @click="$emit('createPost')">Создать пост</button>
        </div>
        <div v-else>
            <router-link :to="{name : 'login'}">Войти</router-link>
            <router-link :to="{name : 'register'}">Зарегистироваться</router-link>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    data(){
        return{
        }
    },
    methods:{
        async logout() {
            await this.$store.dispatch('logout');
            this.$router.push({name : 'home'});
        }
    },
    computed:{
        user() {
            return this.$store.getters.user;
        }
    },

}
</script>

<style scoped>
header{
    background-color: #00daff;
    min-height: 50px;
    padding: 0 20px;
    display: grid;
    align-items: center;
}
</style>
