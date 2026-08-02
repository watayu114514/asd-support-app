<script setup>

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'

const router = useRouter()

const title = ref('')
const situation = ref('')
const feeling = ref('')
const severity = ref(3)
const occurred_at = ref(
  new Date().toISOString().split('T')[0]
)

const error = ref('')

const save = async () => {

  try {

    await api.post('/difficulties', {
      title: title.value,
      situation: situation.value,
      feeling: feeling.value,
      severity: severity.value,
      occurred_at: occurred_at.value
    })

    router.push('/difficulties')

  } catch (e) {

    error.value = '登録に失敗しました'

  }

}

</script>

<template>

<div>

<h1>困りごと登録</h1>

<p v-if="error">
  {{ error }}
</p>

<div>

<label>タイトル</label>

<input
  v-model="title"
  type="text"
/>

</div>

<div>

<label>状況</label>

<textarea
  v-model="situation"
/>

</div>

<div>

<label>気持ち</label>

<textarea
  v-model="feeling"
/>

</div>

<div>

<label>困難度</label>

<select v-model="severity">

<option :value="1">★</option>
<option :value="2">★★</option>
<option :value="3">★★★</option>
<option :value="4">★★★★</option>
<option :value="5">★★★★★</option>

</select>

</div>

<div>

<label>発生日</label>

<input
  v-model="occurred_at"
  type="date"
/>

</div>

<br>

<button @click="save">

登録

</button>

</div>

</template>