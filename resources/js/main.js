import './bootstrap';

import {createApp} from 'vue'
import router from "./route";
import store from "./components/store";
import App from './App.vue'

//Создание прлиожения внутри что-бы отрисовка
//не мигала после получения данных пользователя
axios.get('/sanctum/csrf-cookie').then(response => {
    store.dispatch('getUser').then((res)=>{
        f()
    }).catch(()=>{
        f()
    } )
});
function f() {
    createApp(App)
        .use(router)
        .use(store)
        .mount("#app")
}




