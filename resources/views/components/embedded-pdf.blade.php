{{--
Use:

<x-bs::embedded-pdf
    :url="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf"
/>
--}}

@props([
    'showDownload' => false,
    'showPrint' => false,
    'enableHandTool' => false,
    'url' => null,
    'pdfViewerContainer' => null,
    'previousTxt' => '<i class="ti ti-chevron-left"></i>',
    'nextTxt' => '<i class="ti ti-chevron-right"></i>',
    'scale' => 1,
])

@php
    $showDownload = (bool) filter_var($showDownload, FILTER_VALIDATE_BOOLEAN);
    $showPrint = (bool) filter_var($showPrint, FILTER_VALIDATE_BOOLEAN);
    $enableHandTool = (bool) filter_var($enableHandTool, FILTER_VALIDATE_BOOLEAN);

    $attributes = $attributes->class([
        'pdf-viewer', 'w-100', 'h-100', 'text-center',
    ])->merge([
        'id' => $pdfViewerContainer ?? 'pdfViewerContainer' . Str::random(8),
    ]);
@endphp

<div>
    <div {{ $attributes }}>
        <div class="row">
            <div class="col-12">
                <div class="btn-group" role="group">
                    <button id="previousBtn" class="btn btn-primary">
                        {!! $previousTxt !!}
                    </button>
                    <button class="btn btn-outline-primary">
                        <span id="pageNum"></span> / <span id="pageCount"></span>
                    </button>
                    <button id="nextBtn" class="btn btn-primary">
                        {!! $nextTxt !!}
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <canvas id="pdfCanvas"></canvas>
            </div>
        </div>
    </div>
</div>

@once
    @push('css')
        <style>
            .pdf-viewer canvas {
                border: 1px solid black;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
        <script type="module">
          const url = '{{ $url }}';
          const { pdfjsLib } = globalThis;

          // Configurar PDF.js
          pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.mjs';

          let pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = {{ $scale ?? 1 }},
            canvas = document.getElementById('pdfCanvas'),
            ctx = canvas.getContext('2d');

          /**
           * Get page info from document, resize canvas accordingly, and render page.
           * @param num Page number.
           */
          function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
              var viewport = page.getViewport({scale: scale});
              canvas.height = viewport.height;
              canvas.width = viewport.width;

              // Render PDF page into canvas context
              var renderContext = {
                canvasContext: ctx,
                viewport: viewport
              };
              var renderTask = page.render(renderContext);

              // Wait for rendering to finish
              renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                  // New page rendering is pending
                  renderPage(pageNumPending);
                  pageNumPending = null;
                }
              });
            });

            // Update page counters
            document.getElementById('pageNum').textContent = num;
          }

          /**
           * If another page rendering in progress, waits until the rendering is
           * finised. Otherwise, executes rendering immediately.
           */
          function queueRenderPage(num) {
            if (pageRendering) {
              pageNumPending = num;
            } else {
              renderPage(num);
            }
          }

          /**
           * Displays previous page.
           */
          function onPrevPage() {
            if (pageNum <= 1) {
              return;
            }
            pageNum--;
            queueRenderPage(pageNum);
          }
          document.getElementById('previousBtn').addEventListener('click', onPrevPage);

          /**
           * Displays next page.
           */
          function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
              return;
            }
            pageNum++;
            queueRenderPage(pageNum);
          }
          document.getElementById('nextBtn').addEventListener('click', onNextPage);

          /**
           * Asynchronously downloads PDF.
           */
          pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('pageCount').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
          });
        </script>
    @endpush
@endonce
