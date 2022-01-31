<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/vendor/grapejs/css/grapes.min.css" rel="stylesheet" />
    {{-- <link href="/vendor/grapejs/grapesjs-preset-webpage.min.css" rel="stylesheet" /> --}}
    {{-- <link href="/vendor/grapejs/grapesjs-preset-newsletter.css" rel="stylesheet" /> --}}
    <script src="/js/grapeConfig.js"></script>
    <script src="/vendor/grapejs/grapes.min.js"></script>
    {{-- <script src="/vendor/grapejs/grapesjs-blocks-basic.min.js"></script> --}}
    {{-- <script src="/vendor/grapejs/grapesjs-plugin-ckeditor.min.js"></script> --}}
    {{-- <script src="/vendor/grapejs/grapesjs-preset-webpage.min.js"></script> --}}
    <script src="/vendor/grapejs/grapesjs-preset-newsletter.min.js"></script>


</head>

<body>

    <div id="gjs"></div>
    <div><button id="store-data">Guardar</button></div>
    @csrf

    <script type="text/javascript">

        const editor = grapesjs.init({
            ...defaultGrapeOptions,
            storageManager: {
                ...defaultSotreManager,
                urlStore: 'http://larablog.test/save-page',
                urlLoad: 'http://larablog.test/get-page',
                params: {
                    "_token": document.querySelector('[name=_token]')?.value
                }
            },
            assetManager: {
                ...defaultAssetsManager,
                assets: @json($images),
                upload: 'http://larablog.test/save-image',
                params: {
                    "_token": document.querySelector('[name=_token]')?.value
                }
            }
        });

        grapeOnLoad(editor);


    </script>

</body>

</html>
