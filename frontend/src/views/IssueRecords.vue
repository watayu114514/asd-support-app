<script setup>

import { ref, onMounted } from 'vue'
import api from '../api/axios'


const records = ref([])
const error = ref({})


const fetchRecords = async () => {

  try {

    const res = await api.get('/issue-records')

    records.value = res.data.data

  } catch (e) {

    console.error(e)

    error.value = '困りごとの取得に失敗しました'

  }

}


const formatDate = (date) => {

  if (!date) {
    return ''
  }

  return new Date(date)
    .toLocaleDateString('ja-JP')

}


onMounted(() => {

  fetchRecords()

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


<div
  v-for="item in records"
  :key="item.id"
>


<h3>
{{ item.title }}
</h3>


<p>
カテゴリ：
{{ item.category?.name }}
</p>


<p>
状況：
{{ item.situation }}
</p>


<p>
疲労度：
{{ item.fatigue_level }}
</p>


<p>
ストレス：
{{ item.stress_level }}
</p>


<p>
重大度：
{{ item.severity }}
</p>


<p>
発生日：
{{ formatDate(item.occurred_at) }}
</p>


<hr>


</div>


</div>

</template>