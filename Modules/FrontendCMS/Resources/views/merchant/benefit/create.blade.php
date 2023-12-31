<div id="add_item_modal">
    <div class="modal fade" id="item_add">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ __('common.add_new') }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body item_create_form">
                    @include('frontendcms::merchant.benefit.form',['form_id' => 'item_create_form','benefit_modal_tab_id' => 'bmcelement','btn_id' => 'create_benefit_btn', 'button_level_name' => __('common.save') ])
                </div>
            </div>
        </div>
    </div>
</div>
