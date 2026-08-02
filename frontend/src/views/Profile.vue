<script setup>

import { ref, onMounted } from 'vue'
import api from '../api/axios'


const profile = ref(null)
const error = ref('')


const fetchProfile = async () => {

  try {

    const res = await api.get('/profile')

    profile.value = res.data.data

  } catch (e) {

    error.value = 'プロフィール取得に失敗しました'

  }

}


onMounted(() => {

  fetchProfile()

})


</script>



<template>

<div>

  <h1>
    プロフィール
  </h1>


  <p v-if="error">
    {{ error }}
  </p>



  <div v-if="profile">


    <p>
      年齢:
      {{ profile.age }}
    </p>


    <p>
      職業:
      {{ profile.occupation }}
    </p>


    <p>
      ASD診断:
      {{ profile.asd_diagnosis ? 'あり' : 'なし' }}
    </p>


    <p>
      診断日:
      {{ profile.diagnosis_date }}
    </p>


    <p>
      困りごと:
      {{ profile.difficulty_note }}
    </p>


  </div>


</div>

</template>