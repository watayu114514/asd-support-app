<script setup>

import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'
import DifficultyChart from '../components/DifficultyChart.vue'


const router = useRouter()


const user = ref(null)

const difficultyCount = ref(0)

const recentDifficulties = ref([])

const aiAdvice = ref('')


const aiAnalysis = ref({

  mainProblem: '',

  severity: '',

  weekday: '',

  time: '',

  suggestion: ''

})

const pdcaAnalysis = ref({

  plan: '',

  do: '',

  check: '',

  action: ''

})

const statistics = ref({

  count: 0,

  averageSeverity: 0,

  topTitles: [],

  severityGraph: {},

  monthlyGraph: [],

  weekdayGraph: [],

  timeGraph: []

})




// ======================
// AIアドバイス
// ======================

const generateAdvice = () => {


  if (statistics.value.count >= 3) {


    aiAdvice.value =
      '最近、困りごとの記録が増えています。予定や作業を小さく分けて整理すると負担を減らせるかもしれません。'


  } else if (
    statistics.value.averageSeverity >= 4
  ) {


    aiAdvice.value =
      '困難度の高い出来事が記録されています。無理をせず、事前準備や相談できる環境づくりを意識してみましょう。'


  } else {


    aiAdvice.value =
      '困ったことを記録することで、自分の傾向を理解する助けになります。今日も少しずつ記録を続けてみましょう。'


  }


}




// ======================
// AI分析
// ======================
const generateAnalysis = () => {

  const topProblem =
    statistics.value.topTitles?.[0]

  const topWeekday =
    [...(statistics.value.weekdayGraph || [])]
      .sort((a, b) => b.count - a.count)[0]

  const topTime =
    [...(statistics.value.timeGraph || [])]
      .sort((a, b) => b.count - a.count)[0]

  // データなし
  if (!topProblem) {

    aiAnalysis.value = {
      mainProblem: 'まだ困りごとの記録がありません',
      severity: 'データ不足',
      weekday: topWeekday
        ? `${topWeekday.weekday}に多い傾向があります`
        : '曜日傾向なし',
      time: topTime
        ? `${topTime.time}に多い傾向があります`
        : '時間帯傾向なし',
      suggestion:
        '困ったことを記録すると、自分の傾向を分析できます'
    }

    return
  }

  // データあり
  aiAnalysis.value = {

    mainProblem:
      `「${topProblem.title}」が最も多い困りごとです（${topProblem.count}件）`,

    severity:
      `平均困難度は ${statistics.value.averageSeverity} / 5 です`,

    weekday:
      topWeekday
        ? `${topWeekday.weekday}に困りごとが多い傾向があります（${topWeekday.count}件）`
        : '曜日傾向はまだありません',

    time:
      topTime
        ? `${topTime.time}に困りごとが多い傾向があります（${topTime.count}件）`
        : '時間帯傾向はまだありません',

    suggestion:
      statistics.value.averageSeverity >= 4
        ? '負担が大きい出来事が多いため、事前準備や手順整理を取り入れてみましょう'
        : '記録を続けることで、自分が困りやすい場面を把握できます'
  }
}


// ======================
// PDCA分析
// ======================
const generatePdcaAnalysis = () => {

  const topProblem =
    statistics.value.topTitles?.[0]

  if (!topProblem) {

    pdcaAnalysis.value = {
      plan:
        'まだ分析できる記録がありません',

      do:
        '困った場面を記録してみましょう',

      check:
        '困難度の変化を確認します',

      action:
        '自分に合った方法を探していきます'
    }

    return
  }

  const severity =
    statistics.value.averageSeverity

  pdcaAnalysis.value = {

    plan:
      `「${topProblem.title}」への対策方法を考えます`,

    do:
      severity >= 4
        ? '事前準備、メモ、手順整理を試します'
        : '困った場面と対応方法を記録します',

    check:
      `平均困難度 ${severity}/5 を基準に改善効果を確認します`,

    action:
      severity >= 4
        ? '効果があった方法を継続します'
        : '自分に合う方法を少しずつ増やします'
  }
}


// ======================
// データ取得
// ======================
const load = async () => {

  try {

    const userRes = await api.get('/user')
    
    user.value = userRes.data.data.user

    const difficultyRes =
      await api.get('/difficulties')

    recentDifficulties.value =
          difficultyRes.data.data.slice(0,3)

    difficultyCount.value =
          difficultyRes.data.data.length

    const statisticsRes =
      await api.get('/difficulties/statistics')

    statistics.value =
      statisticsRes.data

    generateAdvice()
    generateAnalysis()
    generatePdcaAnalysis()

  } catch (e) {

    console.error(e)

  }
}

const formatDate = (date) => {

  if (!date) {
    return ''
  }

  return new Date(date).toLocaleString('ja-JP')
}

onMounted(load)

</script>



<template>

<v-container class="mt-5">



<!-- ヘッダー -->

<v-card
  color="primary"
  class="pa-6"
  rounded="xl"
>
  <h1 class="text-white">
    ASD Work Assistant
  </h1>

  <div
    v-if="user"
    class="text-h5 text-white mt-4"
  >
    👋 おかえりなさい
    <br>
    {{ user.name }} さん
  </div>
</v-card>





<!-- 今日の記録 -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

📊 今日の記録

</div>


<div class="text-h3 mt-3">

{{ difficultyCount }}

<span class="text-h5">

件

</span>


</div>


</v-card>


<v-card
  class="mt-5 pa-5"
  rounded="xl"
>

<div class="text-h6">
  最近の困りごと
</div>


<v-list>

<v-list-item
  v-for="item in recentDifficulties"
  :key="item.id"
  @click="router.push(`/difficulties/${item.id}`)"
>

<v-list-item-title>
{{ item.title }}
</v-list-item-title>


<v-list-item-subtitle>
{{ formatDate(item.created_at) }}
</v-list-item-subtitle>


</v-list-item>

</v-list>

</v-card>




<!-- 傾向 -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

📈 あなたの傾向

</div>


<p class="mt-4">

困りごと登録数：

<strong>

{{ statistics.count }}

</strong>

件

</p>



<p>

平均困難度：

<strong>

{{ statistics.averageSeverity }}

</strong>

/ 5

</p>


</v-card>





<!-- よくある困りごと -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

🔍 よくある困りごと

</div>



<v-list>


<v-list-item

v-for="item in statistics.topTitles"

:key="item.title"

>


<v-list-item-title>

{{ item.title }}

</v-list-item-title>


<v-list-item-subtitle>

{{ item.count }} 件

</v-list-item-subtitle>


</v-list-item>


</v-list>


</v-card>





<!-- グラフ -->

<DifficultyChart

v-if="statistics.count"

:statistics="statistics"

/>


<!-- AI分析 -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

🤖 AI分析

</div>


<p class="mt-4">

📌 一番多い困りごと

</p>


<strong>

{{ aiAnalysis.mainProblem }}

</strong>



<p class="mt-4">

🔥 困難度傾向

</p>


<strong>

{{ aiAnalysis.severity }}

</strong>

<p class="mt-4">

📅 曜日傾向

</p>

<strong>

{{ aiAnalysis.weekday }}

</strong>

<p class="mt-4">

⏰ 時間帯傾向

</p>


<strong>

{{ aiAnalysis.time }}

</strong>


<p class="mt-4">

💡 おすすめ

</p>


<p>

{{ aiAnalysis.suggestion }}

</p>


</v-card>

<!-- PDCA改善サイクル -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

🔄 困りごと改善サイクル

</div>



<v-card

class="mt-4 pa-3"

variant="tonal"

>


<div>

📝 Plan（計画）

</div>


<p class="mt-2">

{{ pdcaAnalysis.plan }}

</p>


</v-card>




<v-card

class="mt-3 pa-3"

variant="tonal"

>


<div>

▶ Do（実行）

</div>


<p class="mt-2">

{{ pdcaAnalysis.do }}

</p>


</v-card>





<v-card

class="mt-3 pa-3"

variant="tonal"

>


<div>

🔍 Check（確認）

</div>


<p class="mt-2">

{{ pdcaAnalysis.check }}

</p>


</v-card>





<v-card

class="mt-3 pa-3"

variant="tonal"

>


<div>

🔁 Action（改善）

</div>


<p class="mt-2">

{{ pdcaAnalysis.action }}

</p>


</v-card>

</v-card>


<!-- AIアドバイス -->

<v-card

class="mt-5 pa-5"

rounded="xl"

>


<div class="text-h6">

🤖 今日のアドバイス

</div>


<p class="mt-4">

{{ aiAdvice }}

</p>


</v-card>





<!-- メニュー -->

<v-btn

block

color="primary"

size="large"

class="mt-5"

@click="router.push('/difficulties')"

>

📝 困りごと一覧

</v-btn>



<v-btn

block

color="success"

size="large"

class="mt-3"

@click="router.push('/difficulties/create')"

>

➕ 新しく記録する

</v-btn>



<v-btn

block

color="secondary"

size="large"

class="mt-3"

@click="router.push('/profile')"

>

👤 プロフィール

</v-btn>



</v-container>

</template>