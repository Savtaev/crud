<template>
<div>
    Нет профиля?
    <router-link :to="{name : 'register'}">Зарегистрироваться</router-link>
</div>
    <form action="" @submit.prevent="loginAction">
        <input type="text" placeholder="Логин" v-model="login">
        <input type="password" placeholder="Введите пароль" v-model="password">
        <button type="submit">Войти</button>
    </form>
</template>

<script>
export default {
    name: "Login",
    data(){
        return{
            login:"",
            password:""
        }
    },
    methods : {
        async loginAction(){
            try {
                await this.$store.dispatch('login' , {'login' : this.login , 'password' : this.password})
                this.$router.push({name: 'home'})
            }
            catch (e){
                console.log(e.data)
            }
        }
    },
}
</script>

<style scoped>

</style>
