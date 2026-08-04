<script setup>

import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'


const router = useRouter()

const profile = ref({
  age: '',
  occupation: '',
  diagnosis_status: false,
  diagnosis_date: '',
  difficulty_note: ''
})

const error = ref('')


const fetchProfile = async () => {

  try {

    const res = await api.get('/profile')

    profile.value = {
        ...res.data.data,
        diagnosis_status: Number(res.data.data.diagnosis_status)
    }

  } catch(e) {

    console.error(e)

    error.value = 'プロフィール取得に失敗しました'

  }

}


const updateProfile = async () => {

  try {

    await api.put(
      '/profile',
      profile.value
    )

    router.push('/profile')

  } catch(e) {

    console.error(e)

    error.value = '更新に失敗しました'

  }

}


onMounted(() => {

  fetchProfile()

})

</script>


<template>

<v-container class="py-8">

  <v-card
    class="mx-auto"
    max-width="600"
    rounded="xl"
    elevation="3"
  >

    <v-card-title class="text-h5">
      ✏ プロフィール編集
    </v-card-title>


    <v-card-text>


      <v-alert
        v-if="error"
        type="error"
        class="mb-4"
      >
        {{ error }}
      </v-alert>



      <v-text-field
        v-model="profile.age"
        label="年齢"
        type="number"
        variant="outlined"
        class="mb-3"
      />



      <v-text-field
        v-model="profile.occupation"
        label="職業"
        variant="outlined"
        class="mb-3"
      />



      <v-switch
        v-model="profile.diagnosis_status"
        label="ASD診断あり"
        :true-value="1"
        :false-value="0"
        color="primary"
        class="mb-3"
      />


      <v-text-field
        v-model="profile.diagnosis_date"
        label="診断日"
        type="date"
        variant="outlined"
        class="mb-3"
      />



      <v-textarea
        v-model="profile.difficulty_note"
        label="困りごとメモ"
        variant="outlined"
        rows="5"
      />


    </v-card-text>



    <v-card-actions
      class="justify-center pb-6"
    >

      <v-btn
        color="primary"
        variant="flat"
        size="large"
        @click="updateProfile"
      >
        保存
      </v-btn>


      <v-btn
        color="grey"
        variant="tonal"
        size="large"
        @click="router.back()"
      >
        戻る
      </v-btn>


    </v-card-actions>


  </v-card>


</v-container>

</template>