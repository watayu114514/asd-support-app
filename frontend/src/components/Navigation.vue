<script setup>

import { useRouter } from 'vue-router'

const router = useRouter()

</script>

<template>

<nav class="bottom-nav">

<button @click="router.push('/')">
🏠<br>
ホーム
</button>

<button @click="router.push('/difficulties')">
📝<br>
一覧
</button>

<button @click="router.push('/difficulties/create')">
➕<br>
登録
</button>

<button @click="router.push('/profile')">
👤<br>
プロフィール
</button>

</nav>

</template>

<style scoped>

.bottom-nav{

position:fixed;

bottom:0;

left:0;

width:100%;

display:flex;

justify-content:space-around;

padding:12px;

border-top:1px solid #ddd;

background:white;

}

button{

background:none;

border:none;

font-size:16px;

cursor:pointer;

}

</style>