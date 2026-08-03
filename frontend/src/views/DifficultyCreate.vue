<script setup>

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'


const router = useRouter()


const form = ref({
  title: '',
  situation: '',
  feeling: '',
  severity: 1,
  occurred_at: ''
})


const error = ref('')


const submit = async () => {

  try {

    await api.post('/difficulties', form.value)

    router.push('/difficulties')

  } catch (e) {

    console.log(e)

    error.value = '登録に失敗しました'

  }

}


</script>


<template>

<div>

<h1>
困りごと登録
</h1>


<p v-if="error">
{{ error }}
</p>


<div>

<label>
タイトル
</label>

<input
v-model="form.title"
/>


</div>


<div>

<label>
状況
</label>

<textarea
v-model="form.situation"
/>


</div>


<div>

<label>
感じたこと
</label>

<textarea
v-model="form.feeling"
/>


</div>


<div>

<label>
困りごとの大きさ
</label>

<select v-model="form.severity">

<option :value="1">★</option>
<option :value="2">★★</option>
<option :value="3">★★★</option>
<option :value="4">★★★★</option>
<option :value="5">★★★★★</option>

</select>

</div>


<div>

<label>
発生日時
</label>

<input
type="datetime-local"
v-model="form.occurred_at"
/>

</div>


<button
@click="submit"
>
登録
</button>


<button
@click="router.push('/difficulties')"
>
戻る
</button>


</div>

</template>