<script setup>

import {
  Bar,
  Pie,
  Line
} from 'vue-chartjs'


import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  ArcElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement
} from 'chart.js'

import {
  computed
} from 'vue'

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  ArcElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement
)



const props = defineProps({

  statistics:{
    type:Object,
    required:true
  }

})


console.log(
  'DifficultyChart statistics',
  props.statistics
)


// ======================
// 困りごとランキング
// ======================

const barData = {


  labels:

    props.statistics.topTitles.map(
      item => item.title
    ),



  datasets:[

    {

      label:'困りごと件数',



      data:

        props.statistics.topTitles.map(
          item => item.count
        ),



      backgroundColor:

        props.statistics.topTitles.map(
          item => {


            const colors = {

              1:'#9E9E9E',

              2:'#8BC34A',

              3:'#FFC107',

              4:'#FF9800',

              5:'#F44336'

            }


            return colors[item.severity] ?? '#1976D2'


          }

        )


    }

  ]

}




// ======================
// 困難度割合
// ======================


const pieData = {


  labels:

    Object.keys(
      props.statistics.severityGraph
    )
    .map(

      value =>

      `${'★'.repeat(Number(value))}`

    ),



  datasets:[

    {

      data:

        Object.values(
          props.statistics.severityGraph
        ),



      backgroundColor:

        Object.keys(
          props.statistics.severityGraph
        )
        .map(

          value => {


            const colors={

              1:'#9E9E9E',

              2:'#8BC34A',

              3:'#FFC107',

              4:'#FF9800',

              5:'#F44336'

            }


            return colors[value] ?? '#1976D2'


          }

        )

    }

  ]

}

// ======================
// 月別推移
// ======================

const monthlyData = computed(() => ({

  labels:

    (props.statistics.monthlyGraph ?? [])
      .map(
        item => item.month
      ),


  datasets:[

    {

      label:'困りごと件数',

      data:

        (props.statistics.monthlyGraph ?? [])
          .map(
            item => item.count
          ),


      borderColor:'#1976D2',

      backgroundColor:'#1976D2',

      tension:0.3

    }

  ]

}))

</script>



<template>


<v-card

class="pa-5"

rounded="xl"

>


<h3>
📊 困りごとの傾向
</h3>



<div class="mt-5">


<h4>
よくある困りごと
</h4>



<Bar
v-if="statistics.topTitles.length"
:data="barData"
/>


</div>





<div class="mt-8">


<h4>
困難度割合
</h4>


<Pie
v-if="Object.keys(statistics.severityGraph).length"
:data="pieData"
/>

</div>



<div class="mt-8">


<h4>
📅 困りごとの推移
</h4>


<Line

v-if="monthlyData && monthlyData.labels && monthlyData.labels.length"

:data="monthlyData"

/>


</div>



</v-card>


</template>