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

    console.log('PROFILE API ERROR', e)

    error.value = 'プロフィール取得に失敗しました'

  }

}

const formatDate = (date) => {

  if (!date) {
    return ''
  }

  return new Date(date)
    .toLocaleDateString('ja-JP')

}

onMounted(() => {

  fetchProfile()

})


</script>



<template>

<v-container class="py-8">


  <v-card
    v-if="profile"
    class="mx-auto"
    max-width="600"
    rounded="xl"
    elevation="3"
  >


    <v-card-title class="text-h5">
      👤 プロフィール
    </v-card-title>


    <v-card-text>


      <v-list>


        <v-list-item>
          <v-list-item-title>
            年齢
          </v-list-item-title>

          <v-list-item-subtitle>
            {{ profile.age ?? '未設定' }}
          </v-list-item-subtitle>
        </v-list-item>



        <v-divider />


        <v-list-item>
          <v-list-item-title>
            職業
          </v-list-item-title>

          <v-list-item-subtitle>
            {{ profile.occupation || '未設定' }}
          </v-list-item-subtitle>
        </v-list-item>



        <v-divider />



        <v-list-item>
          <v-list-item-title>
            ASD診断
          </v-list-item-title>

          <v-list-item-subtitle>

            <v-chip
              :color="profile.diagnosis_status ? 'primary' : 'grey'"
              variant="tonal"
            >
              {{ profile.diagnosis_status ? 'あり' : 'なし' }}
            </v-chip>

          </v-list-item-subtitle>

        </v-list-item>



        <v-divider />



        <v-list-item>
          <v-list-item-title>
            診断日
          </v-list-item-title>

          <v-list-item-subtitle>
            {{ formatDate(profile.diagnosis_date) || '未設定' }}
          </v-list-item-subtitle>

        </v-list-item>



        <v-divider />



        <v-list-item>

          <v-list-item-title>
            困りごとメモ
          </v-list-item-title>


          <v-list-item-subtitle class="mt-2">

            {{ profile.difficulty_note || '未設定' }}

          </v-list-item-subtitle>


        </v-list-item>


      </v-list>


    </v-card-text>



    <v-card-actions
      class="justify-center pb-6"
    >

      <v-btn
        color="primary"
        variant="flat"
        size="large"
        @click="$router.push('/profile/edit')"
      >
        ✏ 編集する
      </v-btn>


    </v-card-actions>


  </v-card>


</v-container>


</template>