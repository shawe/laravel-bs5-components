{{--
Use:

<x-bs::textarea-tinymce :label="__('Biography')" rows="5" :help="__('Please tell us about yourself.')" model="biography" />
--}}

@props([
    'label' => null,
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'rows' => 3,
    'size' => null,
    'help' => null,
    'model' => null,
    'debounce' => false,
    'lazy' => false,
    'live' => false,
    'value' => null,
    'jsSection' => 'js',
])

@php
    if ($debounce) $bind = '.live.debounce.' . (ctype_digit($debounce) ? $debounce : 300) . 'ms';
    else if ($lazy) $bind = '.blur';
    else if ($live) $bind = '.live';
    else $bind = '';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bs5-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control',
        'wysihtml5-tinymce',
        'form-control-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'id' => $id,
        'name' => $key,
        'rows' => $rows,
        'wire:model' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div>
    <x-bs::label :for="$id" :label="$label"/>

    <div class="input-group">
        <x-bs::input-addon :icon="$icon" :label="$prepend"/>

        <textarea {{ $attributes }}>{!! $value !!}</textarea>

        <x-bs::input-addon :label="$append" class="rounded-end"/>

        <x-bs::error :key="$key"/>
    </div>

    <x-bs::help :label="$help"/>

    @once
        @push($jsSection)
            @php
                $language = str_replace('_', '-', app()->getLocale());
            @endphp
            {{-- From: https://cdnjs.com/libraries/tinymce --}}
            <script src="{{ asset("build/extensions/tinymce/tinymce.min.js") }}"></script>
            {{--<script src="{{ asset("build/extensions/tinymce/plugins/icons/default/icons.min.js") }}"></script>--}}
            {{--<script src="{{ asset("build/extensions/tinymce/plugins/models/dom/model.min.js") }}"></script>--}}
            <script src="{{ asset("build/extensions/tinymce/plugins/accordion/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/advlist/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/anchor/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/autolink/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/autolink/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/autosave/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/charmap/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/code/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/directionality/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/emoticons/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/fullscreen/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/help/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/image/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/insertdatetime/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/link/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/lists/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/media/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/nonbreaking/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/pagebreak/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/preview/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/quickbars/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/save/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/searchreplace/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/table/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/visualblocks/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/visualchars/plugin.min.js") }}"></script>
            <script src="{{ asset("build/extensions/tinymce/plugins/wordcount/plugin.min.js") }}"></script>

            <script type="text/javascript">
                {{-- Load the tinymce editor --}}
                {{-- https://www.tiny.cloud/docs/integrations/laravel/laravel-composer-install/ --}}
                $(document).ready(function () {
                  tinymce.init({
                    selector: 'textarea.wysihtml5-tinymce',
                    language_load: false,
                    language_url: '{{ asset("build/extensions/tinymce-i18n/langs7/". $language . ".js") }}',
                    language: '{{ $language }}',
                    license_key: 'gpl',
                    promotion: false,
                    readonly: false,
                    height: 350,
                    width: '100%',
                    plugins: [
                      "advlist", "autolink", "lists", "link", "image", "charmap", "preview", "anchor", "searchreplace", "visualblocks", "code", "fullscreen", "insertdatetime", "media", "table", "help", "wordcount"
                    ],
                    toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                    content_style: 'body { font-family:"Poppins",sans-serif; font-size:16px }',
                    // skin: (document.documentElement.getAttribute("data-bs-theme") === 'dark' ? "oxide-dark" : 'oxide'),
                    // content_css: (document.documentElement.getAttribute("data-bs-theme") === 'dark' ? "dark" : '')
                  });

                  // Set the readonly mode for the wysihtml5-tinymce editor if the textarea is readonly
                  $('textarea.wysihtml5-tinymce').each(function () {
                    var id = $(this).attr('id');
                    var editor = tinymce.get(id);
                    if ($('#' + editor.id).prop('readonly')) {
                      editor.mode.set('readonly');
                    }
                  });
                  // Remove the promotion message, promotion: false doesn't work
                  $('div.tox-promotion').remove();
                });
            </script>
        @endpush
    @endonce
</div>
