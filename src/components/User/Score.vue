<template>
  <v-container>
    <NavbarUser />
    <div>
      <v-breadcrumbs :items="items">
        <template v-slot:divider>
          <v-icon>mdi-chevron-right</v-icon>
        </template>
      </v-breadcrumbs>
    </div>
    <v-item-group mandatory class="mt-n4">
      <v-row justify="center" class="space">
        <div class="col-md-12">
          <h1 class="lesson">บทที่2</h1>
          <h2 class="lesson">พันธุ์ไก่พื้นเมือง</h2>
        </div>

        <v-col cols="9" md="6">
          <v-item v-slot="{ active, toggle }">
            <v-card
              :color="active ? '#fcad74' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="250"
              @click="toggle"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <v-icon x-large :color="active ? 'white' : '#fcad74'"
                        >mdi-notebook-check-outline</v-icon
                      >

                      <v-list-item-subtitle
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                        >คะเเนนPretest</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>5/10 คะแนน</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
          </v-item>
        </v-col>
        <v-col cols="9" md="6">
          <v-item v-slot="{ active, toggle }">
            <v-card
              :color="active ? '#fcad74' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="250"
              @click="toggle"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-1">
                    <v-list-item-content>
                      <v-icon x-large :color="active ? 'white' : '#fcad74'"
                        >mdi-notebook-check-outline</v-icon
                      >

                      <v-list-item-subtitle
                        class="headline mb-1 align-center"
                        :class="active ? 'white--text' : 'black--text'"
                        >คะเเนนPretest</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>9/10 คะแนน</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
          </v-item>
        </v-col>
      </v-row>
    </v-item-group>
  </v-container>
</template>

<script>
import NavbarUser from '@/components/NavbarUser'
export default {
  components: {
    NavbarUser
  },
  data: () => ({
    items: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'post'
      },
      {
        text: 'แบบทดสอบ',
        disabled: false,
        href: 'breadcrumbs_link_1'
      },
      {
        text: 'Link 2',
        disabled: true,
        href: 'breadcrumbs_link_2'
      }
    ]
  })
}
</script>

<style>
.headline {
  text-align: center;
  margin-top: 20px;
}
.mt {
  text-align: center;
}
.lesson {
  text-align: center;
  margin-top: 30px;
}
</style>
