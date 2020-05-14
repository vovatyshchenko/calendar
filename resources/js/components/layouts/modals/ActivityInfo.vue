<template>
    <div>
        <!-- Modal -->
        <div ref="modal" class="modal p-0" backdrop="false" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content py-4 px-3">
                    <div class="modal-header pb-0 d-block">
                        <div class="modal-title textActive font">Вы действительно хотите уйти без сохранения?</div>
                    </div>
                    <div class="modal-footer mt-4">
                        <button @click="confirmed" type="button" class="py-3 btn text-uppercase font-12px btnText text-white save d-inline-block mr-3 w-100" data-dismiss="modal">
                            Сохранить
                        </button>
                        <button @click="cancel" type="button" class="py-3 btn-light btn text-uppercase font-12px btnText cancel" data-dismiss="modal">
                            Уйти
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExitConfirmation",
        methods: {
            confirmed()
            {

            },
            cancel()
            {

            },
        },
        computed: {
        }
    }
</script>

<style scoped>
    body {
        padding-right: 0px!important;
    }
    .modal-footer {
        justify-content: start;
    }
    .modal-header, .modal-footer {
        border: 0px;
    }
    .modal {
        padding:0;
    }

    .save {
        max-width: 120px;
        background-color: #1875F0;
    }
    .save:hover {
        background-color: #1875E0;
    }
    .font {
        font-size:18px;
    }
</style>
