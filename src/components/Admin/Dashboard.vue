<template>
  <div class="app">
    <NavbarAdmin/>
      <div>
<v-breadcrumbs
  :items="breadcrumbs"
  large
></v-breadcrumbs>
</div>
  <!-- <SideBarRight /> -->
          <v-row class="mt-n5">
            <v-col>
             <dashboard />
            </v-col>
          </v-row>
          <v-row class="mt-n5" >
            <v-col >
             <LineChart />
            </v-col>
            <v-col >
              <PieChart />
            </v-col>
          </v-row>
          <v-row class="mt-n12">
            <v-col cols="12" sm="12">
              <Table />
            </v-col>
          </v-row>
 </div>
</template>

<script>
import NavbarAdmin from '@/components/NavbarAdmin'
import Table from '../../components/Table'
import dashboard from '../../components/dashboard'
import LineChart from '../../components/LineChart'
import PieChart from '../../components/PieChart'
export default {
  name: 'Home',
  data: () => ({
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false,
        href: 'admindashboard'
      }
    ]
    // lists: [
    //   {
    //     icon: "fas fa-user-md",
    //     title: "Active Doctors",
    //     count: 21,
    //   },
    //   {
    //     icon: "fas fa-procedures",
    //     title: "Active Patients",
    //     count: 41,
    //   },
    //   {
    //     icon: "fas fa-user-nurse",
    //     title: "Active Nurses",
    //     count: 35,
    //   },
    //   {
    //     icon: "fas fa-hospital",
    //     title: "Representative",
    //     count: 15,
    //   },
    // ],
  }),

  components: {
    NavbarAdmin,
    // SideBarRight,
    dashboard,
    LineChart,
    PieChart,
    Table
  }
}
</script>
<style scoped>
.border {
  border: 2px solid #2ebfaf !important;
}
.v-btn--fab.v-size--default.v-btn--absolute.v-btn--top {
  top: 65px !important;
}
.v-btn--absolute.v-btn--left,
.v-btn--fixed.v-btn--left {
  left: -26px !important;
}
.v-breadcrumbs >>> a {
    color: #fcad74;
}
</style>
