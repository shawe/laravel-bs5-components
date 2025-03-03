{{--
Use:

<x-bs::embedded-pdf
                    :showDownload="true"
                    :showPrint="true"
                    :enableHandTool="true"
                    :url="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"
                    :viewerContainer="'viewerContainer'"
/>
--}}

@props([
    'showDownload' => false,
    'showPrint' => false,
    'enableHandTool' => false,
    'url' => null,
    'viewerContainer' => null,
    'height' => '100%',
    'class' => '',
])

<div id="{{ $viewerContainer }}" class="pdf-viewer w-100" style="height: {{ $height }}"></div>

@once
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf_viewer.min.css" />
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
        <script>
          const url = '{{ $url }}';

          const pdfjsLib = window['pdfjs-dist'];

          // Configurar PDF.js
          pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

          const container = document.getElementById({{ $viewerContainer }});

          // Cargar el PDF
          pdfjsLib.getDocument(url).promise.then(function (pdf) {
            const viewer = new pdfjsLib.PDFViewer({
              container: container,
              removePageBorders: true,
              showDownload: {{ $showDownload }},
              showPrint: {{ $showPrint }},
              enableHandTool: {{ $enableHandTool }},
            });

            viewer.setDocument(pdf);
          });
        </script>
    @endpush
@endonce
