//Componenetes a añadir una vez creado el contenedor grape
function grapeOnLoad(editor) {

    const blockManager = editor.BlockManager;
    const assetManager = editor.AssetManager;

    editor.on('load', function () {

        //Añadir selectores de estilos #id, objeto, posicion
        editor.StyleManager.addSector('general', generalConfig, { at: 0 });
        editor.StyleManager.addSector('extra', extraConfig, { at: 5 });

        //Añadir oja de esilos a iframe
        editor.addComponents(`<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">`);

        /**
         * Eventos de assets (imagenes)
         */
        // The upload is started
        editor.on('asset:upload:start', () => {
            console.log('start');
        });

        // The upload is ended (completed or not)
        editor.on('asset:upload:end', () => {
            console.log('end');
        });

        // Error handling
        editor.on('asset:upload:error', (err) => {
            console.log('error');
        });

        // Do something on response
        editor.on('asset:upload:response', (response) => {
            return console.log('response');
        });

        editor.on('storage:start', () => console.log('start'));
        editor.on('storage:end', () => console.log('end'));
        editor.on('storage:error', (err) => {
            alert(`Error: ${err}`);
        });

        //Añadir campos al objecto en el momento de guardar
        editor.on('storage:start:store', (objectToStore) => {
            objectToStore.customHtml = saveEditor(editor);
        });

        //Añadir componentes crear las vistas
        blockManager.add('video', {
            label: 'video',
            /* category: 'basic', */
            attributes: { class: 'fa fa-youtube-play' },
            content: {
                type: 'Video',
                src: 'img/video2.webm',
                style: {
                    height: '350px',
                    width: '615px',
                }
            },
        });
        blockManager.add('list-ul', {
            label: 'List ul',
            attributes: { class: 'fa fa-list-ul', title: 'Insert list ul block' },
            content: '<ul><li>Añade tu lista aquí</li><li>Si quiere añadir lineas, copielas y peguelas encima de este</li></ul>',
        });
        blockManager.add('list-ol', {
            label: 'List ol',
            attributes: { class: 'fa fa-list-ol', title: 'Insert list ol block' },
            content: '<ol><li>Put your list here</li><li>Put your list here</li></ol>',
        });



    });

}

//Funcion para guardar html con css en linea
function saveEditor(editor) {
    return editor.runCommand('gjs-get-inlined-html');
}

const defaultGrapeOptions = {
    container: '#gjs', //id contenedor
    plugins: ['gjs-preset-newsletter'], //plugins activos
    pluginsOpts: {}, //configuracion de plugins
    storageManager: {}, //congiguracion de gaurdado #local o remota
    commands: {
        defaults: [
            {
                id: 'store-data',
                run(editor) {
                    editor.store();
                },
            }
        ]
    },
};

const defaultSotreManager = {
    id: 'gjs-',             // Prefix identifier that will be used inside storing and loading
    type: 'remote',          // Type of the storage
    autosave: false,         // Store data automatically
    autoload: true,         // Autoload stored data on init
    stepsBeforeSave: 1,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
    storeComponents: true,  // Enable/Disable storing of components in JSON format
    storeStyles: true,      // Enable/Disable storing of rules in JSON format
    storeHtml: true,        // Enable/Disable storing of components as HTML string
    storeCss: true,         // Enable/Disable storing of rules as CSS string
    urlStore: '',
    urlLoad: '',
    params: {
        "_token": ''
    }, // Custom parameters to pass with the remote storage request, eg. CSRF token
    headers: {}, // Custom headers for the remote storage request
};

const defaultAssetsManager = {
    params: {
        "_token": ''
    },
}

const generalConfig = {
    name: 'General',
    open: false,
    buildProps: ["float", "display", "position", "top", "right", "left", "bottom"]
};

const extraConfig = {
    name: "Extra",
    open: false,
    buildProps: ["opacity", "transition"], //["opacity", "transition", "perspective", "transform"],
    properties: [
        {
            type: "slider",
            property: "opacity",
            defaults: 1,
            step: 0.01,
            max: 1,
            min: 0
        }
    ]
};
