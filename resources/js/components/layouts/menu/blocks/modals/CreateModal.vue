<template>
  <v-row justify="center">
    <v-dialog v-model="showModal" persistent max-width="850px">
      <v-card>
        <v-btn icon class="close" @click="closeModal()"><v-icon>mdi-close</v-icon></v-btn>
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
        </v-card-title>
        <v-tabs-items v-model="tab">
            <v-tab-item>
                <v-card-text>
                    <activity-modal ></activity-modal>
                </v-card-text>
            </v-tab-item>
           <v-tab-item>
                <v-card-text>
                    <task-modal></task-modal>
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
            checkIsUpdateActivity:false,
            checkIsUpdateTask:false,
            checkIsUpdateBirthday:false,
            items: [
                'МЕРОПРИЯТИЕ', 'ЗАДАЧА', 'ДЕНЬ РОЖДЕНИЯ',
            ],
        }),
        created() {
            this.$eventBus.$on('type', this.getType);
        },
        beforeDestroy() {
            this.$eventBus.$off('type');
        },
        methods: {
            closeModal() {
                this.$store.commit('setActivityValues', {});
                this.$store.commit('setTaskValues', {});
                this.$store.commit('setBirthdayValues', {});
                this.$store.commit('changeShowModal')
            },
            getType(value) {
                 if (value == 'activity') {
                    this.tab = 0;
                     this.$store.commit('setIsUpdateActive',true);
                } else if (value == 'task') {
                    this.tab = 1;
                     this.$store.commit('setIsUpdateTask',true);
                } else if (value == 'birthday') {
                     this.$store.commit('setIsUpdateBirthday',true);
                    this.tab = 2;
                }
            },
        },
        computed: {
            showModal() {
                return this.$store.getters.showModal;
            },
        },
	}
</script>
<style type="scss">
    .delimiter {
        margin-bottom: 17px;
    }
    .error-message{
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 60px;
        text-align: center;
        color: #F44336;
    }
    .v-dialog {
        background: #fff;
        box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.07);
        border-radius: 6px;
    }
    .v-card__text {
        width: 483px;
        margin: 0 auto;
    }
    .v-card__title {
        border-bottom: 3px solid #F5F5F5;
    }
    .title__input_modal {
        padding-left: 17px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        color: #808080;
    }
    .label {
        padding-left: 17px;
        margin-right: 50px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
    }
    .v-tab {
        margin: 0 auto;
        border: 2px solid #F5F5F5;
        font-size: 10px;
        border-radius: 4px;
    }
    .v-tab:hover {
        background-color: #1875F0;
        color: #fff !important;
    }
    .v-tab--active {
        background-color: #1875F0;
        color: #fff !important;
        border: 2px solid #1875F0;
        border-radius: 4px;
    }
    .v-tabs-slider-wrapper {
        opacity: 0;
    }
</style>
