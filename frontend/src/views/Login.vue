<script setup>

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'


const router = useRouter()

const auth = useAuthStore()


const email = ref('')
const password = ref('')

const error = ref('')


const login = async () => {


  try {


    await auth.login(
    email.value,
    password.value
    )

    router.push('/')


  } catch (e) {


    error.value =
      'ログインに失敗しました'


  }


}

</script>



<template>

<div>


<h1>ログイン</h1>



<p v-if="error">
{{ error }}
</p>



<form @submit.prevent="login">


<div>

<label>
メールアドレス
</label>


<input

v-model="email"

type="email"

/>


</div>




<div>

<label>
パスワード
</label>


<input

v-model="password"

type="password"

/>


</div>




<button>

ログイン

</button>


</form>



</div>

</template>