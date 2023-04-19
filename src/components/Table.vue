<template>
  <div>
    <v-container>
       <!-- <v-toolbar color="rgba(0,0,0,0)" flat class="pt-2">
                <v-toolbar-title class=""> จัดลำดับคะเเนนสูงสุด </v-toolbar-title>
              </v-toolbar>
              <v-simple-table class="transparent mt-n2">
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">#</th>
                      <th class="text-left">ชื่อ</th>
                      <th class="text-left">นามสกุล</th>
                      <th class="text-left">สถานะ</th>
                      <th class="text-left">แก้ไข</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in admin" :key="item.id">
                      <td>{{ item.id }}</td>
                      <td>{{ item.first }}</td>
                      <td>{{ item.last }}</td>
                      <td>{{ item.expert }}</td>
                      <td>{{ item.date }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table> -->
              <template>
                <v-card class="mt-10">
                  <v-card-title class="pb-0">จัดลำดับคะเเนนสูงสุด
                    <v-row justify="end">
                      <v-col cols="12" sm="6" class="mb-0 pb-0">
                        <!-- {{alllesson.length}} -->
                      <v-select
                        :items="items"
                        label="บทที่"
                        solo
                      ></v-select>
                    </v-col>
                    </v-row>
                  </v-card-title>
                  <!-- <v-card-title class="pt-0">
                    <v-tabs
                      v-model="model"
                      centered
                      grow
                      slider-color="teal"
                    >
                      <v-tab>
                        pretest
                      </v-tab>
                      <v-tab>
                        posttest
                      </v-tab>
                    </v-tabs>
                  </v-card-title> -->
                  <v-card-title class="pt-0">
                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Search"
                      single-line
                      hide-details
                    ></v-text-field>
                  </v-card-title>
                  <v-data-table
                  :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
                    :headers="headers"
                    :items="alluser"
                    :search="search"
                    :items-per-page="5"
                    no-data-text="ไม่พบข้อมูล"
                    no-results-text="ไม่พบข้อมูลที่ค้นหา">
                    <template slot="data">
        <td>{{user_firstname}}</td>
        <td>{{user_lastname}}</td>
      </template>

      <template v-slot:item.posttest="{ item }">
      <v-icon
        small
        @click="postTest(item)"
        color="#56a062"
      >
        10
      </v-icon>
    </template>
    <!-- <template v-slot:item.posttest="{ item }">
      <v-icon
        small
        @click="postTest(item)"
        color="#56a062"
      >
        mdi-checkbox-marked-circle
      </v-icon>
    </template> -->
                  </v-data-table>
                </v-card>
              </template>
              </v-container>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    user_firstname: '',
    user_lastname: '',
    alllesson: [],
    lesson_id: '',
    lesson_unit: '',
    lesson_name: '',
    lesson_description: '',
    lesson: {
      lesson_unit: '',
      lesson_name: '',
      lesson_description: ''
    },
    search: '',
    items: ['ทั้งหมด', '1', '2', '3'],
    admin: [
      {
        id: 1,
        first: 'สิริวิมล',
        last: 'เพชรรเวียง',
        expert: 'นักศึกษา'
        // date: '05:30 pm - 11:00 pm',
      },
      {
        id: 2,
        first: 'เกตุมณี',
        last: 'ศรีสงสาร',
        expert: 'นักศึกษา'
        // date: '05:30 pm - 12:00 pm',
      }
    ],
    headers: [
      {
        text: 'ชื่อ',
        align: 'start',
        value: 'user_firstname'
      },
      { text: 'นามสกุล', value: 'user_lastname' },
      // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
      // { text: 'เวลาที่สอบ', value: 'time', sortable: false },
      // { text: 'วันที่ทำข้อสอบ', value: 'date', sortable: false },
      { text: 'posttest', value: 'posttest', sortable: false }
      // { text: 'posttest', value: 'posttest', sortable: false }

    ],
    desserts: [
      {
        name: 'Frozen Yogurt',
        calories: 159,
        fat: 6.0,
        carbs: 24,
        protein: 4.0,
        iron: '1%'
      },
      {
        name: 'Ice cream sandwich',
        calories: 237,
        fat: 9.0,
        carbs: 37,
        protein: 4.3,
        iron: '1%'
      },
      {
        name: 'Eclair',
        calories: 262,
        fat: 16.0,
        carbs: 23,
        protein: 6.0,
        iron: '7%'
      },
      {
        name: 'Cupcake',
        calories: 305,
        fat: 3.7,
        carbs: 67,
        protein: 4.3,
        iron: '8%'
      },
      {
        name: 'Gingerbread',
        calories: 356,
        fat: 16.0,
        carbs: 49,
        protein: 3.9,
        iron: '16%'
      },
      {
        name: 'Jelly bean',
        calories: 375,
        fat: 0.0,
        carbs: 94,
        protein: 0.0,
        iron: '0%'
      },
      {
        name: 'Lollipop',
        calories: 392,
        fat: 0.2,
        carbs: 98,
        protein: 0,
        iron: '2%'
      },
      {
        name: 'Honeycomb',
        calories: 408,
        fat: 3.2,
        carbs: 87,
        protein: 6.5,
        iron: '45%'
      },
      {
        name: 'Donut',
        calories: 452,
        fat: 25.0,
        carbs: 51,
        protein: 4.9,
        iron: '22%'
      },
      {
        name: 'KitKat',
        calories: 518,
        fat: 26.0,
        carbs: 65,
        protein: 7,
        iron: '6%'
      }
    ],
    alluser: []
  }),
  created () {
    this.getLesson()
    this.getUser()
  },
  methods: {
    async getLesson () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/lesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    async getUser () {
      axios.get('http://localhost/vue-backend/editUser.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
        }
      })
    }
  }
}
</script>

<style>

</style>
