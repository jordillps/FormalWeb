// obtain cookieconsent plugin
var cc = initCookieConsent();

// example logo
var logo = 'Configuració de cookies';
var cookie = '';

// run plugin with config object
cc.run({
    current_lang : 'es',
    autoclear_cookies : true,                   // default: false
    cookie_name: 'cc_cookie',                   // default: 'cc_cookie'
    cookie_expiration : 365,                    // default: 182
    page_scripts: true,                         // default: false

    // auto_language: null,                     // default: null; could also be 'browser' or 'document'
    // autorun: true,                           // default: true
    // delay: 0,                                // default: 0
    // force_consent: false,
    // hide_from_bots: false,                   // default: false
    // remove_cookie_tables: false              // default: false
    // cookie_domain: location.hostname,        // default: current domain
    // cookie_path: "/",                        // default: root
    // cookie_same_site: "Lax",
    // use_rfc_cookie: false,                   // default: false
    // revision: 0,                             // default: 0

    gui_options: {
        consent_modal: {
            layout: 'box',                      // box,cloud,bar
            position: 'bottom right',           // bottom,middle,top + left,right,center
            transition: 'slide'                 // zoom,slide
        },
        settings_modal: {
            layout: 'box',                      // box,bar
            // position: 'left',                // right,left (available only if bar layout selected)
            transition: 'slide'                 // zoom,slide
        }
    },

    onFirstAction: function(){
        console.log('onFirstAction fired');
    },

    onAccept: function (cookie) {
        console.log('onAccept fired ...');
    },

    onChange: function (cookie, changed_preferences) {
        console.log('onChange fired ...');
    },

    languages: {
        'ca': {
            consent_modal: {
                title: cookie + ' ¡Utilizamos cookies! ',
                description: 'Hola, este sitio web utiliza cookies esenciales para garantizar su correcto funcionamiento y cookies de seguimiento para entender cómo interactúa con él. Éste último sólo se establecerá después del consentimiento. <button type="button" data-cc="c-settings" class="cc-link">Déjame elegir</button>',
                primary_btn: {
                    text: 'Acceptarlas todas',
                    role: 'accept_all'              // 'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: 'Rechazarlas todas',
                    role: 'accept_necessary'        // 'settings' or 'accept_necessary'
                }
            },
            settings_modal: {
                title: logo,
                save_settings_btn: 'Guarda la configuración',
                accept_all_btn: 'Acceptarlas todas',
                reject_all_btn: 'Rechazarlas todas',
                close_btn_label: 'Cerrar',
                cookie_table_headers: [
                    {col1: 'Name'},
                    {col2: 'Domain'},
                    {col3: 'Expiration'},
                    {col4: 'Description'}
                ],
                blocks: [
                    {
                        title: 'Uso de las cookies',
                        description: 'Utilizamos cookies para garantizar las funcionalidades básicas del sitio web y para mejorar tu experiencia online. Puedes escoger por cada categoría para activar/desactivarte cuando quieras. Para obtener más información sobre las cookies y otros datos sensibles, lea la <a href="https://laraveltest.dev/politica-cookies" class="cc-link">política de cookies</a> completa.'
                    }, {
                        title: 'Cookies estrictamente necesarias',
                        description: 'Estas cookies son esenciales para el buen funcionamiento de mi sitio web. Sin estas cookies, el sitio web no funcionaría correctamente',
                        toggle: {
                            value: 'necessary',
                            enabled: true,
                            readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Cookies analíticas',
                        description: 'Nos permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización que hacen del servicio ofrecido',
                        toggle: {
                            value: 'analytics',     // there are no default categories => you specify them
                            enabled: true,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: '^_ga',
                                col2: 'google.com',
                                col3: '1 año',
                                // col4: 'description ...',
                                is_regex: true
                            },
                            // {
                            //     col1: '_gid',
                            //     col2: 'google.com',
                            //     col3: '1 day',
                            //     col4: 'description ...',
                            // }
                        ]
                    }, 
                    // {
                    //     title: 'Advertisement and Targeting cookies',
                    //     description: 'These cookies collect information about how you use the website, which pages you visited and which links you clicked on. All of the data is anonymized and cannot be used to identify you',
                    //     toggle: {
                    //         value: 'targeting',
                    //         enabled: false,
                    //         readonly: false
                    //     }
                    // }, 
                    // {
                    //     title: 'More information',
                    //     description: 'For any queries in relation to my policy on cookies and your choices, please <a class="cc-link" href="https://orestbida.com/contact">contact me</a>.',
                    // }
                ]
            }
        }
    }

});
