<template>
  <v-container>
    <v-row justify="center" class="space">
        <v-col cols="9" md="8">
    <v-card height="" flat color="transparent" class="mt-20">
      <!-- <v-card-title>สถิติการทำแบบทดสอบต่อเดือน</v-card-title> -->
      <v-toolbar color="rgba(0,0,0,0)" flat class="py-4">
        <v-toolbar-title class=""> สถิติการทำแบบทดสอบต่อเดือน </v-toolbar-title>
      </v-toolbar>
      <div class="hello">
        <h1>{{ msg }}</h1>
        <canvas id="myChart" width="10%" height="10%"></canvas>
      </div>
    </v-card>
     </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Chart from 'chart.js/auto'
export default {
  name: 'testt',
  props: {
    msg: String
  },
  mounted () {
    console.log('Component mounted.')

    const ctx = document.getElementById('myChart')
    const labels = ['บทที่ 1',
      'บทที่ 2',
      'บทที่ 3',
      'บทที่ 4',
      'บทที่ 5',
      'บทที่ 6',
      'บทที่ 7']
    const data = {
      labels: labels,
      datasets: [
        {
          label: 'จำนวนผู้ใช้',
          data: [95, 20, 80, 81, 56, 55, 40],
          backgroundColor: [
            'rgba(255, 99, 132, 2)',
            'rgba(255, 159, 64, 2)',
            'rgba(75, 192, 192, 2)',
            'rgba(153, 102, 255, 2)',
            'rgba(54, 162, 235, 2)',
            'rgba(255, 205, 86, 2)',
            'red'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(75, 192, 192)',
            'rgb(153, 102, 255)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }
      ]
    }
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    })
    myChart()
  }
}
</script>

<style scoped>
*{
font-family: 'Prompt', sans-serif !important;
}
</style>
