<template>
  <v-row justify="center">
    <v-dialog v-model="showModal" persistent max-width="800px">
      <v-card>
        <v-card-title>
            <v-tabs
                v-model="tab"
                background-color="transparent"
            >
                <v-tab
                    v-for="item in items"
                    :key="item"
                >
                    {{ item }}
                </v-tab>
            </v-tabs>
            <!--<v-btn icon  @click="todo"><v-icon>mdi-close</v-icon></v-btn>-->
        </v-card-title>
        <v-tabs-items v-model="tab">
            <v-tab-item>
                <v-card-text>
                    <activity-modal></activity-modal>
                </v-card-text>
            </v-tab-item>
             <v-tab-item>
                <v-card-text>
                    <reminders-modal></reminders-modal>
                </v-card-text>
            </v-tab-item>
           <v-tab-item>
                <v-card-text>
                    <tasks-modal></tasks-modal>
                </v-card-text>
            </v-tab-item>
            <v-tab-item>
                <v-card-text>
                    <bdays-modal></bdays-modal>
                </v-card-text>
            </v-tab-item>
        </v-tabs-items>
      </v-card>

    </v-dialog>
  </v-row>
</template>

<script>
	export default {

        data: () => ({
            tab: null,
            items: [
                'МЕРОПРИЯТИЕ', 'НАПОМИНАНИЕ', 'ЗАДАЧА', 'ДЕНЬ РОЖДЕНИЯ',
            ],
        }),

        computed: {
            showModal() {
                return this.$store.getters.showModal;
            }
        },
	}
</script>
<style scoped type="scss">
</style>

