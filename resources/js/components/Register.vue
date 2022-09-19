<template>
    Регистрация
    <form action="" @submit.prevent="register">
        <input type="text" placeholder="Логин" v-model="login">
        <input type="email" placeholder="Email" v-model="email">
        <input type="password" placeholder="Введите пароль" v-model="password">
        <button type="submit">Зарегистрироваться</button>
    </form>
</template>

<script>
export default {
    name: "Register",
    data(){
        return{
            login:"",
            email:"",
            password:""
        }
    },
    methods : {
        async register() {
            try {
                await this.$store.dispatch('register' , {
                    'login' : this.login,
                    'email' : this.email,
                    'password' : this.password ,
                });
                this.$router.push({name: 'home'})
            } catch (e) {
                console.log(e)
            }
        }
    },
}
</script>

<style scoped>

</style>
