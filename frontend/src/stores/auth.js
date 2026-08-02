import { defineStore } from 'pinia'
import api from '../api/axios'

export const useAuthStore = defineStore('auth',{


state:()=>({

    user:null,

    token:localStorage.getItem('token')

}),


getters:{

    isLogin:(state)=>{

        return !!state.token

    }

},



actions:{


async login(email,password){


    const res = await api.post('/login',{

        email,

        password

    })


    this.token=res.data.token


    localStorage.setItem(
        'token',
        this.token
    )


    await this.fetchUser()


},



async logout(){


    await api.post('/logout')


    this.token=null

    this.user=null


    localStorage.removeItem('token')


},



async fetchUser(){


    const res = await api.get('/user')


    this.user=res.data.data ?? res.data


}


}


})