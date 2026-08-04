<script setup>

import { ref, onMounted } from 'vue'
import api from '../api/axios'
import CategoryCountChart from '../components/CategoryCountChart.vue'

const categories = ref([])

const loading = ref(true)

const topCategory = ref(null)

const fetchAnalysis = async () => {

  try {

    const res = await api.get('/category-analysis')

    categories.value = res.data.data

    if (categories.value.length) {

        topCategory.value = categories.value.reduce(
            (max, category) => {

            return category.difficulty_records_count >
                max.difficulty_records_count
                ? category
                : max

            },
            categories.value[0]
        )

    }

  } catch(e) {

    console.error(e)

  } finally {

    loading.value = false

  }

}


const severityText = (value) => {

  if (!value) {
    return 'データなし'
  }

  return '★'.repeat(Math.round(value))

}


onMounted(() => {

  fetchAnalysis()

})


</script>


<template>

<div class="container mt-4">

<h2>
カテゴリ別分析
</h2>


<p v-if="loading">
読み込み中...
</p>

<div
v-if="topCategory"
class="card mb-4 border-primary"
>

<div class="card-body">

<h3>
🌟 一番多い困りごと
</h3>


<h4>
📂 {{ topCategory.name }}
</h4>


<p>
登録件数：
{{ topCategory.difficulty_records_count }}件
</p>


</div>

</div>

<h3 class="mt-4 mb-3">
カテゴリ別困りごと件数
</h3>


<CategoryCountChart
  v-if="categories.length"
  :categories="categories"
/>

<div
v-for="category in categories"
:key="category.id"
class="card mb-3"
>


<div class="card-body">


<h4>
{{ category.name }}
</h4>


<p>
登録件数：
{{ category.difficulty_records_count }}件
</p>


<p>
平均困難度：

<span v-if="category.difficulty_records_avg_severity">
{{ severityText(category.difficulty_records_avg_severity) }}
</span>

<span v-else>
データなし
</span>

</p>


</div>


</div>


</div>

</template>