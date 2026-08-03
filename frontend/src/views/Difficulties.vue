<script setup>

import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'


const router = useRouter()

const difficulties = ref([])

const error = ref('')

const keyword = ref('')

const severity = ref('')

const sort = ref('latest')

const fromDate = ref('')
const toDate = ref('')

const fetchDifficulties = async () => {

  try {

    const res = await api.get('/difficulties', {
      params: {
        keyword: keyword.value,
        severity: severity.value,
        sort: sort.value,
        from: fromDate.value,
        to: toDate.value
      }
    })

    difficulties.value = res.data.data

  } catch (e) {

    console.log(e.response)
    error.value = e.message

  }

}

const resetSearch = () => {

  keyword.value = ''

  severity.value = ''

  sort.value = 'latest'

  fromDate.value = ''

  toDate.value = ''

  fetchDifficulties()

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

<div class="pb-10">


<h1>
困りごと一覧
</h1>

<div class="mb-3">
  <v-text-field
    v-model="keyword"
    prepend-inner-icon="mdi-magnify"
    label="タイトル・状況を検索"
    variant="outlined"
    clearable
  />
</div>

<v-select
  v-model="severity"
  :items="[
    { title: 'すべて', value: '' },
    { title: '★以上', value: 1 },
    { title: '★★以上', value: 2 },
    { title: '★★★以上', value: 3 },
    { title: '★★★★以上', value: 4 },
    { title: '★★★★★', value: 5 }
  ]"
  label="困難度"
  variant="outlined"
/>

<v-select
  v-model="sort"
  :items="[
    {
      title: '新しい順',
      value: 'latest'
    },
    {
      title: '古い順',
      value: 'oldest'
    },
    {
      title: '困難度が高い順',
      value: 'severity_desc'
    },
    {
      title: '困難度が低い順',
      value: 'severity_asc'
    }
  ]"
  label="並び順"
  variant="outlined"
/>

<div class="d-flex gap-3">

  <v-text-field
    v-model="fromDate"
    @change="fetchDifficulties"
    type="date"
    label="開始日"
    variant="outlined"
  />


  <v-text-field
    v-model="toDate"
    @change="fetchDifficulties"
    type="date"
    label="終了日"
    variant="outlined"
  />

</div>

<v-btn
  class="mt-2"
  color="primary"
  @click="fetchDifficulties"
>
  検索
</v-btn>

<v-btn
  class="mt-2"
  color="secondary"
  @click="resetSearch"
>
  条件をクリア
</v-btn>

<p v-if="error">
{{ error }}
</p>



<div v-if="difficulties.length" class="mb-10">

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


<v-btn
  class="mt-5 mb-10"
  color="primary"
  @click="createDifficulty"
>

＋ 困りごとを登録

</v-btn>



</div>

</template>