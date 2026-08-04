<script setup>

import {
  Bar
} from 'vue-chartjs'

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js'


ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
)


const props = defineProps({

  categories: {
    type: Array,
    required: true
  }

})


const chartData = {

  labels: props.categories.map(
    item => item.name
  ),

  datasets: [

    {
      label: '困りごと件数',

      data: props.categories.map(
        item => item.difficulty_records_count
      )

    }

  ]

}


const chartOptions = {

  responsive: true,

  plugins: {

    legend: {
      display: false
    }

  }

}

</script>


<template>

  <Bar
    :data="chartData"
    :options="chartOptions"
  />

</template>