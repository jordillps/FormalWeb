// obtain cookieconsent plugin
var cc = initCookieConsent();

// example logo
var logo = 'Configuració de cookies';
var cookie = '';

// run plugin with config object
cc.run({
    current_lang : 'ca',
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
                title: cookie + ' Utilitzem cookies! ',
                description: 'Hola, aquest lloc web utilitza cookies essencials per garantir el seu correcte funcionament i cookies de seguiment per entendre com interactueu amb ell. Aquest últim només s\'establirà després del consentiment. <button type="button" data-cc="c-settings" class="cc-link">Deixa\'m triar</button>',
                primary_btn: {
                    text: 'Acceptar-les totes',
                    role: 'accept_all'              // 'accept_selected' or 'accept_all'
                },
                secondary_btn: {
                    text: 'Rebutjar-les totes',
                    role: 'accept_necessary'        // 'settings' or 'accept_necessary'
                }
            },
            settings_modal: {
                title: logo,
                save_settings_btn: 'Desa la configuració',
                accept_all_btn: 'Acceptar-les totes',
                reject_all_btn: 'Rebutjar-les totes',
                close_btn_label: 'Tancar',
                cookie_table_headers: [
                    {col1: 'Name'},
                    {col2: 'Domain'},
                    {col3: 'Expiration'},
                    {col4: 'Description'}
                ],
                blocks: [
                    {
                        title: 'Ús de les cookies',
                        description: 'Utilitzem cookies per garantir les funcionalitats bàsiques del lloc web i per millorar la teva experiència en línia. Pots escollir per a cada categoria per activar/desactivar-te quan vulguis. Per obtenir més informació sobre les galetes i altres dades sensibles, llegiu la <a href="https://laraveltest.dev/politica-cookies" class="cc-link">política de cookies</a> completa.'
                    }, {
                        title: 'Cookies estrictament necessàries',
                        description: 'Aquestes cookies són essencials per al bon funcionament del meu lloc web. Sense aquestes cookies, el lloc web no funcionaria correctament',
                        toggle: {
                            value: 'necessary',
                            enabled: true,
                            readonly: true          // cookie categories with readonly=true are all treated as "necessary cookies"
                        }
                    }, {
                        title: 'Cookies analítiques',
                        description: 'Ens permeten quantificar el nombre d\'usuaris i així realitzar el mesurament i anàlisi estadística de la utilització que fan del servei ofert',
                        toggle: {
                            value: 'analytics',     // there are no default categories => you specify them
                            enabled: true,
                            readonly: false
                        },
                        cookie_table: [
                            {
                                col1: '^_ga',
                                col2: 'google.com',
                                col3: '1 any',
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
