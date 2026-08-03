<template>
  <div class="container mt-4">

    <h2>困りごと詳細</h2>

    <div v-if="loading">
      読み込み中...
    </div>

    <div v-else-if="difficulty">

      <div class="card">
        <div class="card-body">

          <h4>
            {{ difficulty.title }}
            </h4>

            <hr>

            <p>
            状況：
            {{ difficulty.situation }}
            </p>

            <p v-if="difficulty.feeling">
            気持ち：
            {{ difficulty.feeling }}
            </p>

            <p>
            困難度：
            {{ '★'.repeat(difficulty.severity) }}
            </p>

            <p>
            発生日：
            {{ formatDate(difficulty.occurred_at) }}
            </p>
          <hr>

          <small>
            作成日：{{ formatDate(difficulty.created_at) }}
          </small>

        </div>
      </div>

      <div class="mt-3">

        <RouterLink
          to="/difficulties"
          class="btn btn-secondary me-2"
        >
          一覧へ戻る
        </RouterLink>

        <button
          class="btn btn-warning me-2"
          @click="router.push(`/difficulties/${difficulty.id}/edit`)"
        >
          編集
        </button>

        <button
          class="btn btn-danger"
          @click="deleteDifficulty"
        >
          削除
        </button>

      </div>

    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api/axios'

const route = useRoute()
const router = useRouter()

const loading = ref(true)
const difficulty = ref(null)

onMounted(async () => {

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
</script>