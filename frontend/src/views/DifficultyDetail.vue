<script setup>

import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api/axios'


const route = useRoute()
const router = useRouter()


const loading = ref(true)

const difficulty = ref(null)


const fetchDifficulty = async () => {

  try {

    const response = await api.get(
      `/difficulties/${route.params.id}`
    )

    difficulty.value = response.data.data

  } catch (e) {

    console.error(e)

  } finally {

    loading.value = false

  }

}


onMounted(() => {

  fetchDifficulty()

})


const deleteDifficulty = async () => {

  if (!confirm('この困りごとを削除しますか？')) {
    return
  }


  try {

    await api.delete(
      `/difficulties/${difficulty.value.id}`
    )


    router.push('/difficulties')


  } catch (e) {

    console.error(e)

    alert('削除に失敗しました')

  }

}


const formatDate = (date) => {

  if (!date) {
    return ''
  }

  return new Date(date)
    .toLocaleString('ja-JP')

}


const severityLabel = (severity) => {

  const labels = {
    1: '少し困った',
    2: '軽い負担',
    3: '困った',
    4: 'かなり困った',
    5: '非常につらい'
  }


  return labels[severity] ?? ''

}


const severityColor = (severity) => {

  if (severity >= 5) {
    return 'danger'
  }

  if (severity >= 4) {
    return 'warning'
  }

  if (severity >= 3) {
    return 'info'
  }

  return 'success'

}

</script>


<template>

<div class="container mt-4">


<h2 class="mb-4">
📝 困りごと詳細
</h2>


<div v-if="loading">

読み込み中...

</div>


<div v-else-if="difficulty">


<!-- メインカード -->

<div class="card shadow-sm mb-4">

<div class="card-body">


<div class="mb-3">

<span class="badge bg-primary">

📂 {{ difficulty.category?.name }}

</span>

</div>


<h3 class="mb-3">

{{ difficulty.title }}

</h3>


<div class="mb-4">

<span
class="badge"
:class="`bg-${severityColor(difficulty.severity)}`"
>

{{ '★'.repeat(difficulty.severity) }}

</span>


<span class="ms-2">

{{ severityLabel(difficulty.severity) }}

</span>


</div>



<hr>



<div class="card mb-3">

<div class="card-body">

<h5>
📝 状況
</h5>

<p class="mb-0">

{{ difficulty.situation }}

</p>

</div>

</div>



<div
v-if="difficulty.feeling"
class="card mb-3"
>

<div class="card-body">

<h5>
💭 気持ち
</h5>


<p class="mb-0">

{{ difficulty.feeling }}

</p>


</div>

</div>



<div class="text-muted small mt-4">

登録日：
{{ formatDate(difficulty.created_at) }}

</div>


</div>

</div>



<div class="d-flex justify-center ga-3 mt-5">


<v-btn

color="primary"

variant="elevated"

prepend-icon="mdi-pencil"

@click="router.push(`/difficulties/${difficulty.id}/edit`)"

>

編集する

</v-btn>



<v-btn

color="secondary"

variant="tonal"

prepend-icon="mdi-arrow-left"

@click="router.push('/difficulties')"

>

一覧へ戻る

</v-btn>



<v-btn

color="error"

variant="tonal"

prepend-icon="mdi-delete"

@click="deleteDifficulty"

>

削除

</v-btn>


</div>


</div>


</div>

</template>