<script setup>

import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'


const router = useRouter()

const difficulties = ref([])

const error = ref('')


const fetchDifficulties = async () => {

  try {

    const res = await api.get('/difficulties')

    difficulties.value = res.data.data

  } catch (e) {

    console.log(e.response)
    error.value = e.message

  }

}


const createDifficulty = () => {

  router.push('/difficulties/create')

}

const showDifficulty = (id) => {

  router.push(`/difficulties/${id}`)

}

const formatDate = (date) => {

  if (!date) {
    return ''
  }

  return new Date(date)
    .toLocaleDateString('ja-JP')

}


onMounted(() => {

  fetchDifficulties()

})


</script>



<template>

<div>


<h1>
困りごと一覧
</h1>


<p v-if="error">
{{ error }}
</p>



<div v-if="difficulties.length">


<div
  v-for="item in difficulties"
  :key="item.id"
>


<h3>
{{ item.title }}
</h3>


<p>
状況:
{{ item.situation }}
</p>


<p v-if="item.feeling">

気持ち:
{{ item.feeling }}

</p>


<p>
困難度:

<span>
{{ '★'.repeat(item.severity) }}
</span>

</p>


<p>
発生日:
{{ formatDate(item.occurred_at) }}
</p>

<button
  @click="showDifficulty(item.id)"
>
  詳細
</button>

<hr>


</div>


</div>



<div v-else>

<p>
困りごとはありません
</p>

</div>



<button
@click="createDifficulty"
>

＋ 困りごとを登録

</button>



</div>

</template>