import axios from 'axios';
import {createStore} from "vuex";


//import sharedMutations from 'vuex-shared-mutations';


export default createStore({
    state() {
        return {
            user: null,
            notice: null,
            edit_post: null,
            edit_comment: null,
        }
    },
    getters: {
        user(state) {
            return state.user;
        },
        id(state) {
            if (state.user) return state.user.id
            return null
        },
        edit_post(state) {
            if (state.user) return state.edit_post
            return null
        },
        edit_comment(state) {
            if (state.user) return state.edit_comment
            return null
        },
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setEdit_post(state, payload) {
            state.edit_post = payload;
        },
        setEdit_comment(state, payload) {
            state.edit_comment = payload;
        }

    },
    actions: {
        async login({ dispatch }, payload) {
            try {
                await axios.post('/api/login', payload).then((res) => {
                     dispatch('getUser');
                }).catch((err) => {
                    throw err.response
                });
            } catch (e) {
                throw e
            }

        },
        async register({ dispatch }, payload) {
            try {
                await axios.post('/api/register' , payload).then((res) => {
                    return dispatch('login' ,
                        {
                            'login' : payload.login,
                            'password' : payload.password
                        })
                }).catch((err) => {
                    throw(err.response)
                })
            } catch (e) {
                throw (e)
            }
        },
        async logout({ commit }) {
            await axios.post('/api/logout').then((res) => {
                commit('setUser', null);
            }).catch((err) => {

            })

        },
        async getUser({commit}) {
            await axios.get('/api/user')
                .then((res) => {
                    commit('setUser', res.data);
                })
                .catch((err) => {
                })
        },


        onChangeFile({ dispatch }, params) {
            const files = params.event.target.files || params.event.dataTransfer.files
            if (!files.length) return;
            dispatch('createImage', {file: files[0], post: params.post});
        },
        createImage({ dispatch }, params) {
            let reader = new FileReader();
            reader.onload = (e) => {
                params.post.newCommentIimage = e.target.result
                params.post.image = e.target.result
            };
            reader.readAsDataURL(params.file);
        },
    },



    //plugins: [sharedMutations({ predicate: ['setUser'] })],

})
