<script setup>

import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'

const router = useRouter()


const form = ref({
  category_id: '',
  title: '',
  situation: '',
  feeling: '',
  severity: 1,
  occurred_at: ''
})


const error = ref({})


const submit = async () => {

  error.value = {}


  if (!form.value.category_id) {

    error.value.category_id = [
      'カテゴリを選択してください'
    ]

    return

  }


  try {

    await api.post('/difficulties', {
      ...form.value,
      category_id: form.value.category_id.id
    })

    router.push('/difficulties')

  } catch (e) {

    if (e.response?.status === 422) {

      error.value = e.response.data.errors

    } else {

      alert('登録に失敗しました')

    }

  }

}

const categories = ref([])


const getCategories = async () => {

  try {

    const res = await api.get('/categories')

    categories.value = res.data.data

  } catch (e) {

    console.error(e)

  }

}


onMounted(() => {
  getCategories()
})

</script>

<style scoped>

.page-container {
  padding-bottom: 160px;
}

</style>

<template>

<div class="page-container">

  <v-container class="mt-5">

    <v-card
      class="pa-6"
      rounded="xl"
    >

      <h1 class="mb-5">
        📝 困りごと登録
      </h1>

      <div class="mb-5">

      <v-select
        v-model="form.category_id"
        label="カテゴリ"
        variant="outlined"
        :items="categories"
        item-title="name"
        item-value="id"
        return-object
        :error-messages="error.category_id"
      />

      </div>

      <div class="mb-5">

      <v-text-field
        v-model="form.title"
        label="困りごとのタイトル"
        variant="outlined"
        maxlength="50"
        :error-messages="error.title"
      />

      <div class="text-end text-muted">
        {{ form.title?.length ?? 0 }} / 50文字
      </div>

    </div>


    <div class="mb-5">

      <v-textarea
        v-model="form.situation"
        label="どんな場面でしたか？"
        rows="5"
        variant="outlined"
        maxlength="500"
        :error-messages="error.situation"
      />

      <div class="text-end text-muted">
        {{ form.situation?.length ?? 0 }} / 500文字
      </div>

    </div>


    <div class="mb-5">

      <v-textarea
        v-model="form.feeling"
        label="感じたこと"
        rows="3"
        variant="outlined"
        maxlength="500"
        :error-messages="error.feeling"
      />

      <div class="text-end text-muted">
        {{ form.feeling?.length ?? 0 }} / 500文字
      </div>

    </div>


    <div class="mb-5">

      <v-select
        v-model="form.severity"
        label="困りごとの大きさ"
        variant="outlined"
        :items="[
          {
            title:'★',
            value:1
          },
          {
            title:'★★',
            value:2
          },
          {
            title:'★★★',
            value:3
          },
          {
            title:'★★★★',
            value:4
          },
          {
            title:'★★★★★',
            value:5
          }
        ]"
      />

    </div>


    <div class="mb-5">

      <v-text-field
        v-model="form.occurred_at"
        type="datetime-local"
        label="発生日時"
        variant="outlined"
        :error-messages="error.occurred_at"
      />

    </div>


      <v-btn
        block
        size="large"
        color="primary"
        @click="submit"
      >
        📝 記録する
      </v-btn>


      <v-btn
        block
        size="large"
        class="mt-3"
        color="secondary"
        @click="router.push('/difficulties')"
      >
        戻る
      </v-btn>


    </v-card>

  </v-container>

</div>

</template>