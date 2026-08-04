<script setup>

import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api/axios'


const route = useRoute()
const router = useRouter()


const loading = ref(true)

const error = ref('')

const categories = ref([])


const difficulty = ref({
  category_id: null,
  title: '',
  situation: '',
  feeling: '',
  severity: 1,
  occurred_at: ''
})


const fetchDifficulty = async () => {

  try {

    const res = await api.get(
      `/difficulties/${route.params.id}`
    )


    difficulty.value = res.data.data


  } catch (e) {

    console.error(e)

    error.value = '取得に失敗しました'

  }

}



const fetchCategories = async () => {

  try {

    const res = await api.get('/categories')

    categories.value = res.data.data


  } catch (e) {

    console.error(e)

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


  } catch (e) {

    console.error(e)

    error.value = '更新に失敗しました'

  }

}



const formatDate = (date) => {

  if (!date) {
    return ''
  }


  return date.substring(0,10)

}



onMounted(async () => {

  await fetchCategories()

  await fetchDifficulty()

  difficulty.value.occurred_at =
    formatDate(difficulty.value.occurred_at)


  loading.value = false

})


</script>

<style scoped>

.edit-container {
  max-height: calc(100vh - 80px);
  overflow-y: auto;
  padding-bottom: 40px;
}

</style>

<template>

<v-container
max-width="700"
class="py-8 edit-container"
>


<v-card
rounded="xl"
elevation="3"
>


<v-card-title class="text-h5 pa-5">

✏ 困りごと編集

</v-card-title>



<v-divider />



<v-card-text>


<v-alert
v-if="error"
type="error"
class="mb-4"
>

{{ error }}

</v-alert>



<div v-if="loading">

読み込み中...

</div>



<div v-else>


<v-select

v-model="difficulty.category_id"

:items="categories"

item-title="name"

item-value="id"

label="カテゴリ"

variant="outlined"

class="mb-4"

/>



<v-text-field

v-model="difficulty.title"

label="タイトル"

variant="outlined"

maxlength="50"

counter

class="mb-4"

/>



<v-textarea

v-model="difficulty.situation"

label="状況"

variant="outlined"

rows="4"

counter

class="mb-4"

/>



<v-textarea

v-model="difficulty.feeling"

label="気持ち"

variant="outlined"

rows="3"

counter

class="mb-4"

/>



<div class="mb-4">


<div class="text-subtitle-1 mb-2">

困難度

</div>



<v-rating

v-model="difficulty.severity"

length="5"

size="32"

color="amber"

/>


</div>



<v-text-field

v-model="difficulty.occurred_at"

type="date"

label="発生日"

variant="outlined"

class="mb-4"

/>



</div>


</v-card-text>




<v-divider />



<v-card-actions
class="justify-center pa-5 ga-3"
>


<v-btn

color="primary"

variant="elevated"

prepend-icon="mdi-content-save"

@click="updateDifficulty"

>

保存する

</v-btn>



<v-btn

color="secondary"

variant="tonal"

prepend-icon="mdi-arrow-left"

@click="router.back()"

>

戻る

</v-btn>



</v-card-actions>


</v-card>


</v-container>

</template>