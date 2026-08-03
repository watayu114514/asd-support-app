<script setup>

import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api/axios'


const route = useRoute()
const router = useRouter()


const difficulty = ref({
  title: '',
  situation: '',
  feeling: '',
  severity: 1,
  occurred_at: ''
})


const loading = ref(true)
const error = ref('')


const fetchDifficulty = async () => {

  try {

    const res = await api.get(
      `/difficulties/${route.params.id}`
    )

    difficulty.value = res.data.data

  } catch(e) {

    console.error(e)
    error.value = '取得に失敗しました'

  } finally {

    loading.value = false

  }

}


const updateDifficulty = async () => {

  try {

    await api.put(
      `/difficulties/${route.params.id}`,
      difficulty.value
    )


    router.push(
      `/difficulties/${route.params.id}`
    )


  } catch(e) {

    console.error(e)
    error.value = '更新に失敗しました'

  }

}


onMounted(() => {

  fetchDifficulty()

})

</script>


<template>

<div class="container mt-4">

<h2>
困りごと編集
</h2>


<p v-if="loading">
読み込み中...
</p>


<p v-if="error">
{{ error }}
</p>


<div v-if="!loading">


<div class="mb-3">

<label>
タイトル
</label>

<input
class="form-control"
v-model="difficulty.title"
/>

</div>


<div class="mb-3">

<label>
状況
</label>

<textarea
class="form-control"
v-model="difficulty.situation"
/>

</div>


<div class="mb-3">

<label>
気持ち
</label>

<textarea
class="form-control"
v-model="difficulty.feeling"
/>

</div>


<div class="mb-3">

<label>
困難度
</label>

<input
type="number"
min="1"
max="5"
class="form-control"
v-model="difficulty.severity"
/>

</div>


<button
class="btn btn-primary"
@click="updateDifficulty"
>
保存
</button>


<button
class="btn btn-secondary ms-2"
@click="router.back()"
>
戻る
</button>


</div>


</div>

</template>