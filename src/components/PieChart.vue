<template>
<v-container>
  <v-row justify="center" class="space">
        <v-col cols="9" md="8">
  <v-card height="" flat color="transparent" class="mt-20">
                <v-toolbar color="rgba(0,0,0,0)" flat class="py-4">
                  <v-toolbar-title class=""> สถิติผู้ใช้งานวันนี้ </v-toolbar-title>
                </v-toolbar>

  <div class="hello">
    <h1>{{ msg }}</h1>
    <canvas id="myChartpie" width="10px" height="10px"></canvas>
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
    const ctx = document.getElementById('myChartpie')
    const data = {
      labels: [
        'นักศึกษา',
        'เกษตรกร',
        'ผู้ใช้ทั้งหมด',
        'ผู้ดูแลระบบ'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [20, 50, 70, 5],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgba(75, 192, 192, 2)'
        ],
        hoverOffset: 4
      }]
    }

    const myChartpie = new Chart(ctx, {
      type: 'doughnut',
      data: data

    })
    myChartpie()
  }
}
</script>

<style>
.myChartpie{
  width: 100px !important;
  height: 100px !important;
}
</style>
