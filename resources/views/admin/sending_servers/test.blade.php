<div class="modal-header new-modal">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ trans('messages.test_sending_server') }}</h4>
</div>
<div class="modal-content">
    <form action="" method="POST" class="ajax_upload_form form-validate-jquery">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="">
        <input type="hidden" name="uids" value="">

        @foreach (request()->all() as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="modal-body">
            <p>{{ trans('messages.test_sending_server.intro') }}</p>
            @include('helpers.form_control', [
                'type' => 'autofill',
                'id' => 'sender_from_input',
                'class' => 'email',
                'name' => 'from_email',
                'value' => '',
                'label' => trans('messages.from_email'),
                'rules' => ['from_email' => 'required'],
                'help_class' => 'campaign',
                'url' => action('Admin\SendingServerController@fromDropbox', $server->uid),
                'empty' => trans('messages.sender.dropbox.empty'),
                'error' => trans('messages.sender.dropbox.error', [
                    'sender_link' => action('Admin\SendingServerController@index'),
                ]),
                'header' => trans('messages.verified_senders'),
            ])
            @include('helpers.form_control', [
                'type' => 'text',
                'class' => 'email',
                'label' => trans('messages.to_email'),
                'name' => 'to_email',
                'value' => '',
                'help_class' => 'sending_server',
                'rules' => ['to_email' => 'required']
            ])
            @include('helpers.form_control', [
                'type' => 'text',
                'class' => '',
                'label' => trans('messages.subject'),
                'name' => 'subject',
                'value' => '',
                'help_class' => 'sending_server',
                'rules' => ['subject' => 'required']
            ])
            @include('helpers.form_control', [
                'type' => 'textarea',
                'class' => '',
                'label' => trans('messages.content'),
                'name' => 'content',
                'value' => '',
                'help_class' => 'sending_server',
                'rules' => ['content' => 'required']
            ])
        </div>
        <div class="modal-footer text-left">
            <a
                href="{{ action('Admin\SendingServerController@test', $server->uid) }}"
                type="button"
                class="btn bg-teal mr-5 ajax_link"
                data-in-form="true"
                data-method="POST"
                mask-title="{{ trans('messages.sending_server.testing_connection') }}"
            >
                {{ trans('messages.send') }}
            </a>
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('messages.close') }}</button>
        </div>
    </form>
</div>
    
<script>
    //$(document).ready(function() {
        // auto fill
        var box = $('#sender_from_input').autofill({
            messages: {
                header_found: '{{ trans('messages.sending_identity') }}',
                header_not_found: '{{ trans('messages.sending_identity.not_found.header') }}'
            }
        });
        box.loadDropbox(function() {
        })
    //})
</script>
